<?php
/**
 * Created by PhpStorm.
 * User: phamc
 * Date: 4/1/2019
 * Time: 23:39
 */

namespace api\models\HoaDon;


use api\models\ChiTietHoaDon\ChiTietHoaDon;
use api\models\TaiKhoanThe\TaiKhoanThe;
use api\models\TheNap\TheNap;
use api\models\UserKhachHang\UserKhachHang;
use api\models\UserKhachHang\UserKhachHangUtil;
use common\Utilities\SessionUtils;
use common\Utilities\StringUtils;
use Faker\Provider\Uuid;
use Yii;
use common\Utilities\DatetimeUtils;

class HoaDonUtil extends HoaDon
{

    /**
     * @return array $listHoaDon
     */
    public static function getListHoaDon()
    {
        $listHoaDon = HoaDon::find()
            ->select(['hoa_don.*', 'dm_khach_hang.ho_ten'])
            ->joinWith('khachhang', false, "INNER JOIN")
            ->where(['hoa_don.is_delete' => 0])
            ->asArray()
            ->all();
        return $listHoaDon;
    }

    /**
     * @param $idUser
     * @return array
     */
    public static function getListHoaDonCustomer($idUser)
    {
        $obHoaDonCusTomer = array();
        if (!is_null($idUser)) {
            $modelKhachHang = UserKhachHang::find()
                ->select(['dm_khach_hang.id', 'dm_khach_hang.ho_ten', 'dm_khach_hang.sdt', 'tai_khoan_the.so_du'])
                ->joinWith('khachhang', false, "INNER JOIN")
                ->joinWith('taikhoanthe', false, "INNER JOIN")
                ->where(['user_khach_hang.is_delete' => 0])
                ->asArray()
                ->andWhere(['user_khach_hang.id' => $idUser])->one();
            foreach ($modelKhachHang as $key => $value) {
                $obHoaDonCusTomer[$key] = $value;
            }
            $modelHoaDon = HoaDon::find()
                ->select(['hoa_don.id', 'hoa_don.ma_hoa_don', 'hoa_don.tong_tien'])
                ->joinWith('khachhang', false, "INNER JOIN")
                ->where(['hoa_don.is_delete' => 0, 'hoa_don.is_success' => 0])
                ->andWhere(['khach_hang_id' => $modelKhachHang["id"]])
                ->groupBy(['ma_hoa_don'])
                ->all();
            $obHoaDonCusTomer["so_du"] = (float)$obHoaDonCusTomer["so_du"];
            $obHoaDonCusTomer["user_id"] = $idUser;
            $obHoaDonCusTomer["hoa_don"] = $modelHoaDon;
        }
        return $obHoaDonCusTomer;
    }

    /**
     * @param array $params the attributes given by params[field]. params["hoa_don_chi_tiet"] is a json string.
     * @param $modelHoaDon
     * @return boolean whether the saving succeeded.
     */
    public static function saveHoaDon($params, $modelHoaDon)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            /** @var $modelHoaDon HoaDon */
            if (!empty($params["so_luong"]) && !empty($params["san_pham"])) {
                $listSoLuong = json_decode($params["so_luong"]);
                $listSanPhamId = json_decode($params["san_pham"]);
                $modelHoaDon->id = Uuid::uuid();
                $modelHoaDon->ma_hoa_don = self::autoGenMaHoaDon();
                $modelHoaDon->loai_hoa_don = "BAN_HANG";
                $modelHoaDon->khach_hang_id = $modelHoaDon->khach_hang_id;
                $modelHoaDon->tong_tien = StringUtils::convertStringDecimalToInt($modelHoaDon->tong_tien);
                $modelHoaDon->nhan_vien_id = SessionUtils::getUserId();
                $modelHoaDon->save();
                for ($i = 0; $i < count($listSanPhamId); $i++) {
                    $modelHoaDonChiTiet = new ChiTietHoaDon();
                    $modelHoaDonChiTiet->id = Uuid::uuid();
                    $modelHoaDonChiTiet->hoa_don_id = $modelHoaDon->id;
                    $modelHoaDonChiTiet->san_pham_id = $listSanPhamId[$i];
                    $modelHoaDonChiTiet->so_luong = $listSoLuong[$i];
                    $modelHoaDonChiTiet->save();
                }
            }
            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
        }
        return false;
    }

    /**
     * @param $modelTheNap
     * @param $tai_khoan_id
     * @return bool
     * @throws \Throwable
     */
    public static function saveHoaDonTheNap($modelTheNap, $tai_khoan_id)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            /** @var $modelTheNap TheNap */
            if (!is_null($modelTheNap->id)) {
                $params = array(
                    "is_delete",
                    "updated_by",
                    "updated_at",
                );
                $modelTheNap->is_delete = 1;
                $modelTheNap->updated_by = SessionUtils::getUsername();
                $modelTheNap->updated_at = DatetimeUtils::getCurrentDatetime();
                $modelTheNap->save(true, $params);

                /** @var $modelHoaDon */
                $modelHoaDon = new HoaDon();
                $modelHoaDon->id = Uuid::uuid();
                $modelHoaDon->ma_hoa_don = $modelTheNap->ma_the;
                $modelHoaDon->is_success = true;
                $modelHoaDon->khach_hang_id = UserKhachHangUtil::getKhachHangIDByTaiKhoanID($tai_khoan_id);
                $modelHoaDon->loai_hoa_don = "THE_NAP";
                $modelHoaDon->tong_tien = $modelTheNap->menh_gia;
                $modelHoaDon->nhan_vien_id = SessionUtils::getUserId();
                $modelHoaDon->save();

                /** @var $modelChiTietHoaDon ChiTietHoaDon */
                $modelChiTietHoaDon = new ChiTietHoaDon();
                $modelChiTietHoaDon->id = Uuid::uuid();
                $modelChiTietHoaDon->hoa_don_id = $modelHoaDon->id;
                $modelChiTietHoaDon->the_nap_id = $modelTheNap->id;
                $modelChiTietHoaDon->save();

                /** @var $modelTaiKhoanThe TaiKhoanThe */
                $modelTaiKhoanThe = TaiKhoanThe::findOne(["id" => $tai_khoan_id]);
                $modelTaiKhoanThe->so_du = $modelTaiKhoanThe->so_du + $modelTheNap->menh_gia;
                $modelTaiKhoanThe->update();


            } else {
                return false;
            }
            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
        }
        return false;
    }

    /**
     * @param $id
     * @return bool
     * @throws \Throwable
     */
    public static function huyHoaDon($id)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $modelHoaDon = HoaDon::findOne(['id' => $id]);
            $modelHoaDon->is_huy = 1;
            $modelHoaDon->update();
            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
        }
        return false;
    }

    /**
     * @return string
     */
    private function autoGenMaHoaDon()
    {
        $maHoaDon = HoaDon::find()->select(["ma_hoa_don"])->limit(1)->orderBy(["created_at" => SORT_DESC])->one();
        if (!is_null($maHoaDon)) {
            $expMaHoaDon = explode('_', $maHoaDon->ma_hoa_don);
            $maHoaDonMoi = array_pop($expMaHoaDon) + 1;
            $count = strlen($maHoaDonMoi);
            if ($count <= 3) {
                for ($i = 1; $i <= 3 - $count; $i++) {
                    $maHoaDonMoi = "0" . $maHoaDonMoi;
                }
            }
            return "HD" . date("Y") . "_" . $maHoaDonMoi;
        } else {
            $MaHoaDon = "HD" . date("Y") . "_" . '001';
            return $MaHoaDon;
        }
    }

    /**
     * @param $params
     * @return bool
     * @throws \Throwable
     */
    public static function thanhtoanHoaDon($params)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if (!is_null($params["user_id"]) && !is_null($params["hoa_don_id"])) {
                $modelHoaDon = HoaDon::findOne(['id' => $params["hoa_don_id"]]);
                $modelHoaDon->is_success = 1;
                $modelHoaDon->update();
                $modelUserKhachHang = UserKhachHang::find()
                    ->select(['user_khach_hang.tai_khoan_id','so_du'])
                    ->joinWith('taikhoanthe', false, "INNER JOIN")
                    ->where(["user_khach_hang.id" => $params["user_id"]])
                    ->asArray()
                    ->one();
                $newSoDu = $modelUserKhachHang['so_du'] - $modelHoaDon['tong_tien'];
                if ($newSoDu < 0) {
                    return false;
                }
                $query = "UPDATE `tai_khoan_the` SET so_du = $newSoDu WHERE id =  '{$modelUserKhachHang['tai_khoan_id']}'";
                Yii::$app->db->createCommand($query)->execute();
                $transaction->commit();
                return true;
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
        }
        return false;
    }

    /**
     *
     * @param $model
     * @param $tai_khoan_id
     */
    public static function pushNotificationNapThe($model, $tai_khoan_id){
        $API_SERVER_KEY = "AAAAUxvbgHA:APA91bFvtl6VYkipubEqAafhzu6Tp-TuAsO9KuDd9Wb_MgnFODL2-r3JrPK0nsmmTruMtAP2MsPU539ss7xinVEio5c2PjM-u6-s2WUw7XkXa81PUMhyUeRuj5UUNsV-zxOhNwd3QCXL";
        $path_to_firebase_cm = 'https://fcm.googleapis.com/fcm/send';

        if(!is_null($tai_khoan_id)){

            $modelUserKhachHang = UserKhachHang::findOne(['tai_khoan_id' => $tai_khoan_id]);
        }
        if (!is_null($modelUserKhachHang->device_token)) {
            $fields = array(
                'to' => $modelUserKhachHang->device_token,
                'priority' => 10,
                'notification' => array(
                    'title' => "PC Pay thông báo",
                    'body' => "Tài khoản của bạn nhận được " . number_format($model->menh_gia, 0,'.',','),
                    'sound' => 'default',
                ),
            );

            $headers = array(
                'Authorization:key=' . $API_SERVER_KEY,
                'Content-Type:application/json'
            );

            // Open connection
            $ch = curl_init();
            // Set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $path_to_firebase_cm);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            // Execute post
            curl_exec($ch);
            // Close connection
            curl_close($ch);
        }
    }
}