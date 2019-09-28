<?php
/**
 * Created by PhpStorm.
 * User: phamc
 * Date: 4/10/2019
 * Time: 15:49
 */

namespace api\controllers;


use api\models\User\User;
use api\models\User\UserUtil;
use api\models\UserKhachHang\UserKhachHang;
use Yii;
use yii\rest\Controller;
use common\Utilities\SessionUtils;

class UserController extends Controller
{

    private $_result = [
        "status" => 200,
        "data" => null
    ];

    public function verbs()
    {
        return [
            "index" => ["GET", "OPTIONS"],
            "update" => ["POST", "OPTIONS"]
        ];
    }

    /**
     * @return array|string $_result the attributes given by field => value
     */
    public function actionIndex()
    {
        if (SessionUtils::isRoleAdmin()) {
            $modelUser = UserUtil::getListNhanVien();
            if (!empty($modelUser)) {
                $this->_result["data"] = $modelUser;
            }
        } else {
            $this->_result['status'] = 403;
            return $this->_result['data'] = ["message" => "Bạn không có quyền truy cập trang này!"];
        }
        return $this->_result;
    }

    /**
     * @return array $_result
     */

    public function actionUpdate()
    {
        $params = Yii::$app->request->post();
        $modelUser = new User();

        if (SessionUtils::isRoleAdmin()) {
            if (!empty($params["id"])) {
                $modelUser = User::findOne(['id' => $params["id"]]);
            }
            if (!empty($params)) {
                $modelUser->attributes = $params;
                if (UserUtil::saveNhanVien($modelUser)) {
                    $this->_result['data'] = ["message" => "Thành công!"];
                } else {
                    $this->_result['data'] = ["message" => "Thất bại!"];
                }
            }
        } else {
            $this->_result['status'] = 403;
            return $this->_result['data'] = ["message" => "Bạn không có quyền truy cập trang này!"];
        }
        return $this->_result;
    }

    public function actionDelete()
    {
        $params = Yii::$app->request->post();
        $modelUser = new User();
        if (SessionUtils::isRoleAdmin()) {
            if (!empty($params["id"])) {
                $modelUser = User::findOne(['id' => $params["id"]]);
            }
            if (!empty($params)) {
                $modelUser->attributes = $params;
                if (UserUtil::deleteNhanVien($modelUser)) {
                    $this->_result['data'] = ["message" => "Thành công!"];
                } else {
                    $this->_result['data'] = ["message" => "Thất bại!"];
                }
            }
        } else {
            $this->_result['status'] = 403;
            return $this->_result['data'] = ["message" => "Bạn không có quyền truy cập trang này!"];
        }
        return $this->_result;
    }

    public function actionSaveTokenDevice()
    {
        $params = Yii::$app->getRequest()->getBodyParams();
        $model = UserKhachHang::findOne(['id' => $params["id"]]);
        $model->device_token = $params["device_token"];
        $model->update();
        return $this->_result['data'] = [
            'status' => 200
        ];
    }

    public function actionChangePassword()
    {
        $params = Yii::$app->getRequest()->getBodyParams();
        if (!is_null($params["id"])) {
            $model = User::findOne(['id'=>$params["id"]]);
        }
        $model->password = Yii::$app->security->generatePasswordHash($params["password"]);
        $model->auth_key = Yii::$app->security->generateRandomString();
        if ($model->update()) {
            $this->_result["data"] = ["message" => "Thành công"];
            return $this->_result;
        }
        $this->_result["status"] = 404;
        $this->_result["data"] = ["message" => "Thất bại"];
        return $this->_result;
    }


}