<?php
/**
 * Created by PhpStorm.
 * User: phamc
 * Date: 4/7/2019
 * Time: 14:50
 */

namespace api\controllers;

use api\models\ChiTietHoaDon\ChiTietHoaDon;
use api\models\HoaDon\HoaDon;
use api\models\HoaDon\HoaDonUtil;
use api\models\TheNap\TheNap;
use api\models\TheNap\TheNapUtil;
use api\models\UserKhachHang\UserKhachHang;
use api\models\UserKhachHang\UserKhachHangUtil;
use Yii;
use yii\rest\Controller;

class TheNapController extends Controller
{
    public $modelClass = "api\models\TheNap\TheNap";
    private $_result = [
        "status" => 200,
        "data" => null
    ];

    protected function verbs()
    {
        return [
            'index' => ['GET', 'OPTIONS'],
            'update' => ['POST', 'OPTIONS'],
            'nap-the-ho' => ['POST', 'OPTIONS'],
            'the-nap-by-khach-hang' => ['GET', 'OPTIONS'],
        ];
    }

    /**
     * @return array|string $_result the attributes given by field => value
     */
    public function actionIndex()
    {
        $modelTheNap = TheNapUtil::getListTheNap();
        $this->_result['data'] = $modelTheNap;

        return $this->_result;
    }

    public function actionUpdate()
    {
        $params = Yii::$app->request->post();
        $modelTheNap = new TheNap();

        if (!empty($params['id'])) {
            var_dump("GG");die;
            $modelTheNap = TheNap::findOne(["id" => $params['id']]);
        }

        if (!empty($params)) {
            $modelTheNap->attributes = $params;
            if (TheNapUtil::saveTheNap($modelTheNap)) {
                $this->_result['data'] = ["message" => "Thành công!"];
                return $this->_result;
            }else{
                $this->_result["status"] = ["message" => "Thất bại!"];
            }
        }
        return $this->_result;
    }

    /**
     * @return array
     * @throws \Throwable
     */
    public function actionNapTheHo()
    {
        $params = Yii::$app->request->post();
        $modelTheNap = new TheNap();

        if (!empty($params['id']) && !empty($params["khach_hang_id"])) {
            $modelTheNap = TheNap::findOne(["id" => $params['id']]);
            $modelUserKhachHang = UserKhachHang::findOne(['khach_hang_id' => $params["khach_hang_id"]]);
        }

        if ($modelUserKhachHang) {
            if (!empty($modelUserKhachHang->tai_khoan_id)) {
                if (HoaDonUtil::saveHoaDonTheNap($modelTheNap,$modelUserKhachHang->tai_khoan_id)) {
                    HoaDonUtil::pushNotificationNapThe($modelTheNap,$modelUserKhachHang->tai_khoan_id);
                    $this->_result['data'] = ["message" => "Thành công!"];
                    return $this->_result;
                }else{
                    $this->_result["status"] = ["message" => "Thất bại!"];
                }
            }
        }
        return $this->_result;
    }

    public function actionNapThe()
    {
        $params = Yii::$app->request->post();
        if (!empty($params["ma_the"])) {
            $modelTheNap = TheNap::findOne(["ma_the" => $params['ma_the'], "is_delete" => 0]);
            if (empty($modelTheNap)) {
                $this->_result['data'] = ["message" => "Thẻ nạp không tồn tại."];
            }
        }
        if (!is_null($this->userId->data->id)) {
            $userKhachHang = UserKhachHang::findOne(['id' => $this->userId->data->id]);
            if (!empty($userKhachHang)) {
                if (HoaDonUtil::saveHoaDonTheNap($modelTheNap,$userKhachHang->tai_khoan_id)) {
                    HoaDonUtil::pushNotificationNapThe($modelTheNap,$userKhachHang->tai_khoan_id);
                    $this->_result['data'] = ["message" => "Thành công!"];
                    return $this->_result;
                }else{
                    $this->_result["status"] = ["message" => "Thất bại!"];
                }
            }
        }
        return $this->_result;
    }

    /**
     * @return array
     */
    public function actionTheNapByKhachHang()
    {
        if (!is_null($this->userId->data->id)) {
            $userKhachHang = UserKhachHang::findOne(['id' => $this->userId->data->id]);
            if (!empty($userKhachHang)) {
                $listHoaDon = ChiTietHoaDon::find()
                    ->select(['ma_the', 'seri', 'menh_gia', 'is_success', ])
                    ->joinWith('hoadon', false, 'INNER JOIN')
                    ->joinWith('thenap', false, 'INNER JOIN')
                    ->where(['khach_hang_id'=>$userKhachHang->khach_hang_id])
                    ->andWhere(['loai_hoa_don' => 'THE_NAP'])
                    ->asArray()
                    ->all();
                $this->_result['data'] = $listHoaDon;
                return $this->_result;
            }
        }
        return $this->_result;
    }
}