<?php
/**
 * Created by PhpStorm.
 * User: phamc
 * Date: 4/1/2019
 * Time: 23:27
 */

namespace api\controllers;


use api\models\ChiTietHoaDon\ChiTietHoaDonUtil;
use api\models\HoaDon\HoaDon;
use api\models\HoaDon\HoaDonUtil;
use api\models\UserKhachHang\UserKhachHang;
use common\Utilities\NumberUtils;
use common\Utilities\SessionUtils;
use Yii;
use yii\rest\Controller;

class HoaDonController extends Controller
{
    private $_result = [
        'status' => 200,
        'data' => null
    ];

    protected function verbs()
    {
        return [
            'index' => ['GET', 'OPTIONS'],
            'chi-tiet-hoa-don' => ['GET', 'OPTIONS'],
            'update' => ['POST', 'OPTIONS'],
            'huy-hoa-don' => ['POST', 'OPTIONS'],
            'thanh-toan' => ['POST', 'OPTIONS'],
            'hoa-don-customer' => ['POST', 'OPTIONS'],
            'hoa-don-khach-hang' => ['POST', 'OPTIONS']
        ];
    }

    public function actionIndex()
    {
        if(SessionUtils::isRoleAdmin()){
            $modelHoaDon = HoaDonUtil::getListHoaDon();
            $this->_result['status'] = 200;
            $this->_result['data'] = $modelHoaDon;
        }else{
            $this->_result['status'] = 403;
            return $this->_result['data'] = "Bạn không có quyền truy cập trang này!";
        }
        return $this->_result;
    }
    public function actionChiTietHoaDon($id = null)
    {
        if(!is_null($id)){
            $modelChiTietHoaDon = ChiTietHoaDonUtil::getChiTietHoaDon($id);
            //$modelChiTietHoaDon["tong_tien"] = NumberUtils::formatNumberWithDecimal((float)$modelChiTietHoaDon["gia"] * (float)$modelChiTietHoaDon["so_luong"],0);
        }
        if(!empty($modelChiTietHoaDon)){
            $this->_result['status'] = 200;
            $this->_result['data'] = $modelChiTietHoaDon;
        }else{
            return $this->_result['data'] = ["message"=>"Lỗi"];
        }
        return $this->_result;
    }

    public function actionHuyHoaDon($id=null)
    {

        if(SessionUtils::isRoleAdmin()){
            if(!is_null($id)){
                if(HoaDonUtil::huyHoaDon($id)){
                    $this->_result['status'] = 200;
                    $this->_result['data'] = ["message"=>true];
                }else{
                    $this->_result['data'] = ["message"=>false];
                }
            }
        }else{
            $this->_result['status'] = 403;
            return $this->_result['data'] = ["message"=>"Bạn không có quyền truy cập trang này!"];
        }
        return $this->_result;
    }

    public function actionUpdate()
    {
        if(SessionUtils::isRoleAdmin()){
            $params = Yii::$app->request->post();
            $modelHoaDon = new HoaDon();
            if (!empty($params)) {
                $modelHoaDon->attributes = $params;
                if (HoaDonUtil::saveHoaDon($params,$modelHoaDon)){
                    $this->_result['status'] = 200;
                    $this->_result['data'] = ['message'=>"Thành công!"];
                    return $this->_result;
                }else{
                    $this->_result['status'] = 200;
                    $this->_result['data'] = ['message'=>"Lỗi!"];
                    return $this->_result;
                }
            }
        }else{
            $this->_result['status'] = 403;
            return $this->_result['data'] = ["message"=>"Bạn không có quyền truy cập trang này!"];
        }
        return $this->_result;
    }

    public function actionHoaDonCustomer()
    {
        $idKhachHang = Yii::$app->request->getBodyParam('id');
        if (!empty($idKhachHang)) {
            $listHoaDonCustomer = HoaDonUtil::getListHoaDonCustomer($idKhachHang);
            $this->_result["data"] = $listHoaDonCustomer;
        }

        return $this->_result;
    }


    public function actionThanhToan()
    {
        $params = Yii::$app->request->getBodyParams();
        if (!empty($params)) {
            if (HoaDonUtil::thanhtoanHoaDon($params)) {
                $this->_result['data'] = ['message'=>"Thành công!"];
                return $this->_result;
            } else {
                $this->_result["status"] = false;
                $this->_result["data"] = ['message'=>"Lỗi!"];
            }
        }

        return $this->_result;
    }
    /**
     * @return array
     */
    public function actionHoaDonByKhachHang()
    {
        if (!is_null($this->userId->data->id)) {
            $userKhachHang = UserKhachHang::findOne(['id' => $this->userId->data->id]);
            if (!empty($userKhachHang)) {
                $listHoaDon = HoaDon::find()
                    ->select(['id', 'ma_hoa_don', 'created_at', 'tong_tien', 'is_huy' , 'is_success'])
                    ->where(['khach_hang_id'=>$userKhachHang->khach_hang_id])
                    ->andWhere(['loai_hoa_don' => 'BAN_HANG'])
                    ->asArray()
                    ->all();
                $this->_result['data'] = $listHoaDon;
                return $this->_result;
            }
        }
        return $this->_result;
    }
}