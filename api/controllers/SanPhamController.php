<?php
/**
 * Created by PhpStorm.
 * User: phamc
 * Date: 5/2/2019
 * Time: 2:32
 */

namespace api\controllers;
use api\models\SanPham\SanPhamUtil;
use yii\rest\Controller;

class SanPhamController extends Controller
{
    private $_result = [
        'status' => 200,
        'data' => null
    ];

    protected function verbs()
    {
        return [
            'index' => ['GET', 'OPTIONS'],
        ];
    }
    public function actionIndex()
    {
            $modelSanPham = SanPhamUtil::getListSanPham();
            $this->_result['status'] = 200;
            $this->_result['data'] = $modelSanPham;

        return $this->_result;
    }
}