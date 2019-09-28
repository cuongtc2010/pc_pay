<?php
/**
 * Created by PhpStorm.
 * User: phamc
 * Date: 4/19/2019
 * Time: 22:06
 */

namespace api\controllers;
use api\models\KhachHang\KhachHang;
use api\models\KhachHang\KhachHangUtil;
use api\models\UserKhachHang\UserKhachHang;
use api\models\UserKhachHang\UserKhachHangUtil;
use \yii\rest\Controller;
use Yii;
use common\Utilities\DatetimeUtils;

class ThongTinKhachHangController extends Controller
{
    private $_result = [
        'status' => 200,
        'data' => null
    ];

    protected function verbs()
    {
        return [
            'index' => ['GET', 'OPTIONS'],
            'update' => ['POST', 'OPTIONS'],
        ];
    }

    /**
     * @return array
     */
    public function actionIndex()
    {
        $modelUserKhachHang = UserKhachHangUtil::getThongTinCaNhanKhachHang($this->userId->data->id);

        if($modelUserKhachHang){
            $modelUserKhachHang["gioi_tinh"] = (bool)$modelUserKhachHang["gioi_tinh"];
            $modelUserKhachHang["so_du"] = (float)$modelUserKhachHang["so_du"];
            $modelUserKhachHang["ngay_sinh"] = DatetimeUtils::formatDate($modelUserKhachHang["ngay_sinh"]);
            $this->_result["data"]["profile"] = $modelUserKhachHang;
        }
        return $this->_result;
    }

    public function actionUpdate()
    {
        $params = Yii::$app->request->post();
        if(!empty($this->userId->data->id)){
            $modelUserKhachHang = UserKhachHang::find()->select(['khach_hang_id'])->where(["id"=>$this->userId->data->id])->one();
            $modelKhachHang = KhachHang::findOne(['id' => $modelUserKhachHang->khach_hang_id]);
        }

        if (!empty($params)){
            $modelKhachHang->attributes = $params;
            if (KhachHangUtil::saveKhachHang($modelKhachHang)){
                $this->_result["data"] = ["message"=>"Thành công!"];
            }else{
                $this->_result["status"] = ["message" => "Thất bại!"];
            }
        }

        return $this->_result;
    }
}