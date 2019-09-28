<?php
/**
 * Created by PhpStorm.
 * User: phamc
 * Date: 4/11/2019
 * Time: 20:30
 */

namespace api\models\ThongTinCaNhan;

use Yii;
class ThongTinNhanVienUtil extends ThongTinNhanVien
{
    /**
     * @param $modelUser
     * @return bool
     * @throws \yii\db\Exception
     */
    public static function saveThongTinCaNhan($modelUser){
        $transaction = Yii::$app->db->beginTransaction();
        try {
            /**@var $modelUser ThongTinNhanVien */
            if (!is_null($modelUser->id)) {
                $params = array(
                    "ho_ten",
                    "gioi_tinh",
                    "ngay_sinh",
                    "sdt",
                    "dia_chi",
                    "cmnd",
                    "email",
                    "quyen_id",
                    "updated_by",
                    "updated_at",
                );
                $modelUser->save(true,$params);
            }
            $transaction->commit();
            return true;
        } catch (\ErrorException $errorException) {
            $transaction->rollBack();
        }
        return false;
    }
}