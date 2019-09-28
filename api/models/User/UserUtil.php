<?php
/**
 * Created by PhpStorm.
 * User: phamc
 * Date: 3/29/2019
 * Time: 16:38
 */

namespace api\models\User;


use common\Utilities\DatetimeUtils;
use common\Utilities\SessionUtils;
use Faker\Provider\Uuid;
use Yii;

class UserUtil extends User
{

    /**
     * @return array $modelUser.
     */
    public static function getListNhanVien(){
        $modelUser = User::find()
            ->select(['user.id', 'ho_ten', 'username', 'gioi_tinh', 'ngay_sinh', 'sdt', 'dia_chi', 'cmnd', 'email', 'quyen_id' ,'quyen.ten_quyen'])
            ->joinWith('permission', false, 'INNER JOIN')
            ->where(["user.is_delete"=>0])
            ->asArray()
            ->all();
        return $modelUser;
    }

    /**
     * @param $modelUser
     * @return bool
     */
    public static function saveNhanVien($modelUser){
        $transaction = Yii::$app->db->beginTransaction();
        try {
            /** @var $modelUser User */
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
//                $modelUser->ngay_sinh = DatetimeUtils::convertStringToDate($modelUser->ngay_sinh);
                $modelUser->updated_by = SessionUtils::getUsername();
                $modelUser->updated_at = DatetimeUtils::getCurrentDatetime();
                $modelUser->save(true,$params);
            }else{
                $modelUser->id = Uuid::uuid();
//                $modelUser->ngay_sinh = DatetimeUtils::convertStringToDate($modelUser->ngay_sinh);
                $modelUser->username = $modelUser->sdt;
                $modelUser->password = Yii::$app->security->generatePasswordHash(123456);
                $modelUser->auth_key = Yii::$app->security->generateRandomString();
                $modelUser->save();
            }
            $transaction->commit();
            return true;
        } catch (\Exception $errorException) {
            $transaction->rollBack();
        }
        return false;
    }

    /**
     *
     *
     * @var $modelUser User
     * @return bool
     * @throws \Throwable
     */
    public static function deleteNhanVien($modelUser)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            /** @var $modelUser User */
            if (!is_null($modelUser->id)) {
                $modelUser->is_delete = 1;
                $modelUser->updated_at = DatetimeUtils::getCurrentDate();
                $modelUser->updated_by = SessionUtils::getUsername();
                $modelUser->update();
            }
            $transaction->commit();
            return true;
        } catch (\Exception $errorException) {
            $transaction->rollBack();
        }
        return false;
    }
}