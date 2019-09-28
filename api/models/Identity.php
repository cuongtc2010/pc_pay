<?php
/**
 * Created by PhpStorm.
 * User: phamc
 * Date: 4/20/2019
 * Time: 21:19
 */

namespace api\models;


use api\models\User\User;
use api\models\UserKhachHang\UserKhachHang;
use yii\web\IdentityInterface;
use Firebase\JWT\JWT;
use Yii;
use yii\base\InvalidCallException;

final class Identity implements IdentityInterface
{
    const TYPE_EMPLOYEER = 'employeer';
    const TYPE_CUSTOMER = 'customer';
    const ALLOWED_TYPES = [self::TYPE_EMPLOYEER, self::TYPE_CUSTOMER];

    private $_id;
    private $_authkey;
    private $_password;


    public static function findIdentity($id)
    {
        $model = User::find()->where(['id' => $id, 'is_delete' => 0])->one();
        if (!$model) {
            $model = UserKhachHang::find()->where(['id' => $id, 'is_delete' => 0])->one();
        }

        if (!$model) {
            return false;
        }
        if ($model instanceof User) {
            $type = self::TYPE_EMPLOYEER;
        } else {
            $type = self::TYPE_CUSTOMER;
        }

        /*$identity = new Identity();
        $identity->_id = $model->id;
        $identity->_authkey = $model->auth_key;
        $identity->_password = $model->password;*/
        return $model;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        try {
            $decoded = JWT::decode($token, Yii::$app->params['encryptToken'], ['HS256']);

            if (!$decoded) {
                return null;
            }

            return static::findIdentity($decoded->data->id);
        } catch (\Exception $e) {
            return null;
        }
        return null;
    }

    public function validatePassword($password)
    {
        return password_verify($password, $this->_password);
    }

    public static function findByUsername($username)
    {
        $model = User::find()->where(['username' => $username, 'is_delete' => 0])->one();

        if (!$model) {
            $model = UserKhachHang::find()->where(['username' => $username, 'is_delete' => 0])->one();
        }
        var_dump($model);die;
        if (!$model) {
            return false;
        }

        if ($model instanceof User) {
            $type = self::TYPE_EMPLOYEER;
        } else {
            $type = self::TYPE_CUSTOMER;
        }

        /*$identity = new Identity();
        $identity->_id = $model->id;
        $identity->_authkey = $model->auth_key;
        $identity->_password = $model->password;*/
        return $model;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getAuthKey()
    {
        return $this->_authkey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

}