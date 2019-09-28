<?php
/**
 * Created by PhpStorm.
 * User: phamc
 * Date: 4/6/2019
 * Time: 22:39
 */

namespace api\controllers;


use api\models\KhachHang\KhachHang;
use api\models\KhachHang\KhachHangUtil;
use yii\rest\Controller;
use Yii;

class KhachHangController extends Controller
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
            'thong-tin-ca-nhan' => ['GET', 'OPTIONS'],
        ];
    }

    public function actionIndex()
    {
        $modelHoaDon = KhachHangUtil::getListKhachHang();
        if(!empty($modelHoaDon)){
            $this->_result['data'] = $modelHoaDon;
        }
        return $this->_result;
    }

    /**
     * @getBodyParams string $params -> get id from http.post request with param = id.
     * @return array {"status"=>value,"data"=>[]}
     */
    public function actionUpdate()
    {
        $params = Yii::$app->request->post();
        $modelKhachHang = new KhachHang();

        if (!empty($params['id'])) {
            $modelKhachHang = KhachHang::findOne(["id" => $params['id']]);
        }

        if (!empty($params)){
            $modelKhachHang->attributes = $params;
            if (KhachHangUtil::saveKhachHang($modelKhachHang)) {
                $this->_result['data'] = ["message" => "Thành công!"];
                return $this->_result;
            }else{
                $this->_result["data"] = ["message" => "Thất bại!"];
            }
        }else{
            $this->_result["data"] = ["message" => "Thiếu params!"];
        }

        return $this->_result;
    }

    public function actionThongTinCaNhan()
    {

        return $this->_result;
    }
}