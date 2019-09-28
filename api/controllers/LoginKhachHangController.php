<?php
/**
 * Created by PhpStorm.
 * User: phamc
 * Date: 4/18/2019
 * Time: 13:30
 */

namespace api\controllers;


use api\models\UserKhachHang\LoginFormKhachHang;
use api\models\UserKhachHang\UserKhachHang;
use Firebase\JWT\JWT;
use Yii;
use yii\base\InvalidConfigException;
use yii\rest\Controller;

class LoginKhachHangController extends Controller
{
    private $_result = [
        'status' => 200,
        'data' => null
    ];

    protected function verbs()
    {
        return [
            'login' => ['POST', 'OPTIONS'],
            'refresh' => ['POST', 'OPTIONS']
        ];
    }
    public function actionLogin()
    {
        $model = new LoginFormKhachHang();
        try {
            $model->load(Yii::$app->getRequest()->getBodyParams(), '');

        } catch (InvalidConfigException $e) {
            $this->_result['status'] = 401;
            return $this->_result;
        }
        if ($model->login()) {
            /* @var $userIdentity \api\models\UserKhachHang\UserKhachHang */
            $userIdentity = Yii::$app->user->identity;
            $this->_result['status'] = 200;
            $this->_result['data'] = [
                'token' => $userIdentity->getToken(),
                'refresh_token' => $userIdentity->getRefreshToken(),
                'profile' => $userIdentity->getProfileToken()
            ];
            return $this->_result;
        }
        $model->validate();
        foreach ($model->errors as $attr => $errors) {
            $this->_result['errors'][$attr] = $errors;
        }

        $this->_result['status'] = 404;
        return $this->_result;
    }

    public function actionRefresh()
    {
        try {
            $params = Yii::$app->getRequest()->getBodyParams();
        } catch (InvalidConfigException $e) {
            $this->_result['status'] = 401;
            return $this->_result;
        }
        if (!isset($params['token'])) {
            $this->_result['status'] = 401;
            return $this->_result;
        }
        try {
            $token = JWT::decode($params['token'], Yii::$app->params['encryptToken'], ['HS256']);
        } catch(\Exception $e) {
            $this->_result['status'] = 401;
            return $this->_result;
        }

        if (!isset($token->data->id)) {
            $this->_result['status'] = 401;
            return $this->_result;
        }

        /* @var $model \api\models\UserKhachHang\UserKhachHang */
        $userIdentity = UserKhachHang::findIdentity($token->data->id);
        if ($userIdentity == null) {
            $this->_result['status'] = 401;
            return $this->_result;
        }

        $this->_result['status'] = 200;
        $this->_result['data'] = [
            'token' => $userIdentity->getToken(),
            'refresh_token' => $userIdentity->getRefreshToken(),
            'profile' => $userIdentity->getProfileToken()
        ];
        return $this->_result;
    }
}