<?php
/**
 * Created by PhpStorm.
 * User: phamc
 * Date: 4/18/2019
 * Time: 14:03
 */

namespace api\models\UserKhachHang;


use api\models\Identity;
use yii\base\Model;
use Yii;

class LoginFormKhachHang extends Model
{
    public $username;
    public $password;
    public $rememberMe = false;
    public $verifyCode;
    private $_user = false;
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['password', 'validatePassword']
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                Yii::$app->session->set('_user_login_fail', Yii::$app->session->get('_user_login_fail', 0) + 1);
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a User using the provided username and password.
     *
     * @return boolean whether the User is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            $user = $this->getUser();
            $user->updated_by = $this->username;
            $user->save(false);
            return Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
        }

        return false;
    }

    /**
     * Check if captcha is required.
     *
     * @return boolean whether the user try to login more than 3 times
     */
    public function getCaptchaRequired()
    {
        //return Yii::$app->session->get('_user_login_fail', 0) >= 3;
        return false;
    }

    /**
     * Finds UserKhachHang by [[username]]
     *
     * @return UserKhachHang|null
     */
    public function getUser()
    {
        if ($this->_user == false) {
            $this->_user = UserKhachHang::findByUsername($this->username);
        }
        return $this->_user;
    }
}