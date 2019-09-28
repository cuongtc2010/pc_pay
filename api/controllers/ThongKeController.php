<?php
/**
 * Created by PhpStorm.
 * User: phamc
 * Date: 4/16/2019
 * Time: 12:50
 */

namespace api\controllers;


use api\models\ThongKe\ThongKeUtil;
use common\Utilities\SessionUtils;
use yii\rest\Controller;

class ThongKeController extends Controller
{
    private $_result = [
        "status" => 200,
        "data" => null
    ];

    public function verbs()
    {
        return [
            'thong-ke-san-pham' => ['GET', 'OPTIONS']
        ];
    }

    public function actionThongKeSanPham()
    {
        if (SessionUtils::isRoleAdmin()) {
            $this->_result['data'] = ThongKeUtil::soluongSanPham();
        } else {
            $this->_result['data'] = ['message' => "Bạn không có quyền truy cập trang này."];
        }

        return $this->_result;
    }

    public function actionTopKhachHang()
    {
        if (SessionUtils::isRoleAdmin()) {
            $this->_result['data'] = ThongKeUtil::topKhachHang();
        } else {
            $this->_result['data'] = ['message' => "Bạn không có quyền truy cập trang này."];
        }

        return $this->_result;
    }

    public function actionDoanhThuThang()
    {
        if (SessionUtils::isRoleAdmin()) {
            $this->_result['data'] = ThongKeUtil::thongkeDoanhThuThang();
        } else {
            $this->_result['data'] = ['message' => "Bạn không có quyền truy cập trang này."];
        }

        return $this->_result;
    }

    public function actionDoanhThuNam()
    {
        if (SessionUtils::isRoleAdmin()) {
            $this->_result['data'] = ThongKeUtil::thongkeDoanhThuNam();
        } else {
            $this->_result['data'] = ['message' => "Bạn không có quyền truy cập trang này."];
        }

        return $this->_result;
    }

}