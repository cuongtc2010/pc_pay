<?php
/**
 * Created by PhpStorm.
 * User: phuocnguyen
 * Date: 11/03/2018
 * Time: 3:18 PM
 */
namespace common\Utilities;
use api\models\Permission\Permission;
use api\Models\User\User;
use Yii;
class SessionUtils
{
    public static function getUsername() {
        return Yii::$app->user->identity->username;
    }
    public static function getUserId() {
        return Yii::$app->user->identity->id;
    }
    public static function isRoleAdmin() {
        $checkRole = Permission::find()->where(['id'=>Yii::$app->user->identity->quyen_id])->all();
        if($checkRole[0]->ma_quyen == 'ADMIN'){
            return true;
        }
       return false;
    }

}