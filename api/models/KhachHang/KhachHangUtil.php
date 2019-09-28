<?php
/**
 * Created by PhpStorm.
 * User: phamc
 * Date: 4/6/2019
 * Time: 22:43
 */

namespace api\models\KhachHang;
use api\models\TaiKhoanThe\TaiKhoanThe;
use api\models\UserKhachHang\UserKhachHang;
use common\Utilities\DatetimeUtils;
use Faker\Provider\Uuid;
use Yii;
use common\Utilities\StringUtils;
use common\Utilities\SessionUtils;

class KhachHangUtil extends KhachHang
{
    /**
     * @return array $modelKhachHang.
     */
    public static function getListKhachHang()
    {
        $modelKhachHang = UserKhachHang::find()
            ->select(["user_khach_hang.id as user_khach_hang_id",'dm_khach_hang.*', "user_khach_hang.username", "tai_khoan_the.so_tai_khoan","tai_khoan_the.so_du"])
            ->joinWith("khachhang", false, "INNER JOIN")
            ->joinWith("taikhoanthe",false,"INNER JOIN")
            ->orderBy(["dm_khach_hang.ho_ten" => SORT_ASC])
            ->asArray()
            ->all();
        return $modelKhachHang;
    }

    /**
     * @param object $modelKhachHang the attributes given by field => value.
     * @return boolean whether the saving succeeded.
     */
    public static function saveKhachHang($modelKhachHang)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            /** @var $modelKhachHang KhachHang */
            if (!is_null($modelKhachHang->id)) {
                $params = array(
                    "ho_ten",
                    "sdt",
                    "gioi_tinh",
                    "ngay_sinh",
                    "cmnd",
                    "dia_chi",
                    "updated_by",
                    "updated_at"
                );
                $modelKhachHang->ngay_sinh = DatetimeUtils::convertStringToDate($modelKhachHang->ngay_sinh);
                $modelKhachHang->updated_by = SessionUtils::getUsername();
                $modelKhachHang->updated_at = DatetimeUtils::getCurrentDatetime();
                $modelKhachHang->save(true, $params);
            }else{
                $modelKhachHang->id = Uuid::uuid();
                $modelKhachHang->ngay_sinh = DatetimeUtils::convertStringToDate($modelKhachHang->ngay_sinh);
                $modelKhachHang->save();

                /** @var  $modelTaiKhoanThe */
                $modelTaiKhoanThe = new TaiKhoanThe();
                $modelTaiKhoanThe->id = Uuid::uuid();
                $modelTaiKhoanThe->so_tai_khoan = time().StringUtils::randomStringNumber();
                $modelTaiKhoanThe->save();

                /** @var  $modelUserKhachHang */
                $modelUserKhachHang = new UserKhachHang();
                $modelUserKhachHang->id = Uuid::uuid();
                $modelUserKhachHang->khach_hang_id = $modelKhachHang->id;
                $modelUserKhachHang->tai_khoan_id = $modelTaiKhoanThe->id;
                $modelUserKhachHang->username = $modelKhachHang->sdt;
                $modelUserKhachHang->password = Yii::$app->security->generatePasswordHash(123456);
                $modelUserKhachHang->auth_key = Yii::$app->security->generateRandomString();
                $modelUserKhachHang->save();
            }
            $transaction->commit();
            return true;
        } catch (\Exception $e) {
			var_dump($e);die;
            $transaction->rollBack();
        }
        return false;
    }
}