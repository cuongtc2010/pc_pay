<?php
/**
 * Created by PhpStorm.
 * User: phamc
 * Date: 4/16/2019
 * Time: 1:32
 */

namespace api\models\UserKhachHang;


class UserKhachHangUtil extends UserKhachHang
{
    /**
     * @param $id
     * @return array|\yii\db\ActiveRecord|null
     */
    public static function getThongTinCaNhanKhachHang($id){
        $modelKhachHang = UserKhachHang::find()
            ->select(['dm_khach_hang.email', 'dm_khach_hang.ho_ten', 'dm_khach_hang.sdt','dm_khach_hang.dia_chi','dm_khach_hang.cmnd','dm_khach_hang.gioi_tinh','dm_khach_hang.ngay_sinh', 'tai_khoan_the.so_tai_khoan', 'tai_khoan_the.so_du'])
            ->joinWith('khachhang', false, 'INNER JOIN')
            ->joinWith('taikhoanthe',false,'INNER JOIN')
            ->where(["user_khach_hang.id"=>$id])
            ->asArray()
            ->one();
        return $modelKhachHang;
    }
    /**
     * @param $khach_hang_id
     * @return bool
     */
    public static function checkSoDu($khach_hang_id)
    {
        if (!is_null($khach_hang_id)) {
            $sodu = UserKhachHang::find()
                ->select(['tai_khoan_the.so_du'])
                ->join('INNER JOIN','tai_khoan_the','tai_khoan_the.id = user_khach_hang.tai_khoan_id')
                ->where(['khach_hang_id'=>$khach_hang_id])
                ->asArray()
                ->one();
            if ((float)$sodu["so_du"] > 0) {
                return true;
            }
        }
        return false;
    }

    public static function getKhachHangIDByTaiKhoanID($tai_khoan_id){
        $modelUserKhachHang =  UserKhachHang::find()
            ->select(['khach_hang_id'])
            ->where(['tai_khoan_id'=>$tai_khoan_id])->one();
        return $modelUserKhachHang['khach_hang_id'];
    }
}