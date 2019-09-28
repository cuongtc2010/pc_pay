<?php
/**
 * Created by PhpStorm.
 * User: phamc
 * Date: 3/29/2019
 * Time: 16:22
 */

namespace api\models\User;


use api\models\Permission\Permission;
use api\models\UserKhachHang\UserKhachHang;
use common\Utilities\DatetimeUtils;
use common\Utilities\SessionUtils;
use Firebase\JWT\JWT;
use Yii;
use yii\base\Exception;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\IdentityInterface;


/**
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property string $ho_ten
 * @property string $dia_chi
 * @property bool $gioi_tinh
 * @property string $sdt
 * @property string $ngay_sinh
 * @property string $cmnd
 * @property string $email
 * @property string $quyen_id
 * @property bool $is_delete
 * @property string $updated_at
 * @property string $updated_by
 * @property string $created_by
 * @property string $created_at
 */
class User extends ActiveRecord implements IdentityInterface
{
    private static $_instance = null;

    public static function getInstance()
    {
        if (null === static::$_instance) {
            static::$_instance = new static();
        }
        return static::$_instance;
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), []);
    }

    public static function tableName()
    {
        return '{{user}}';
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        try {
            $decoded = JWT::decode($token, Yii::$app->params['encryptToken'], ['HS256']);
            $model = static::findIdentity($decoded->data->id);
            if (!$model){
                $model = UserKhachHang::findIdentity($decoded->data->id);
            }
            return $model;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'is_delete' => 0]);
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function rules()
    {
        $rule = [
            ['username', 'required', 'message' => 'Username không được bỏ trống'],
            ['password', 'trim'],
            ['auth_key', 'trim'],
            ['ho_ten', 'required', 'message' => 'Tên không được trống'],
            ['dia_chi', 'trim'],
            ['gioi_tinh', 'default', 'value' => 0],
            ['sdt', 'trim'],
            ['ngay_sinh', 'trim'],
            ['cmnd', 'trim'],
            ['email', 'trim'],
            ['quyen_id', 'trim'],
            ['is_delete', 'default', 'value' => 0],
            ['created_at', 'default', 'value' => DatetimeUtils::getCurrentDatetime()],
            ['updated_at', 'default', 'value' => DatetimeUtils::getCurrentDatetime()],
            ['created_by', 'default', 'value' => SessionUtils::getUsername()],
            ['updated_by', 'default', 'value' => SessionUtils::getUsername()]
        ];
        return $rule;
    }

    public function attributeLabels()
    {
        return [
            'username' => "Tên đăng nhập",
            'ho_ten' => "Họ tên",
            'sdt' => "Số điện thoại",
            'password' => "Mật khẩu",
            'dia_chi' => "Địa chỉ",
            'gioi_tinh' => "Giới tính",
            'ngay_sinh' => "Ngày sinh",
            'cmnd' => "CMND",
            'quyen_id' => "Quyền",
            'email' => "Email",
        ];
    }

    public function getToken()
    {
        $tokenId = base64_encode(random_bytes(32));
        $issuedAt = time();
        $notBefore = $issuedAt + 0;
        $expire = $notBefore + 86400; // 1 day | 1800: 30 minutes

        $data = [
            'iss' => Yii::$app->params['baseUrlApi'],
            'iat' => $issuedAt,
            'jti' => $tokenId,
            'nbf' => $notBefore,
            'exp' => $expire,
            'data' => [
                'id' => $this->getId()
            ]
        ];
        return JWT::encode($data, Yii::$app->params['encryptToken'], 'HS256');

    }

    public function getRefreshToken()
    {
        $tokenId = base64_encode(random_bytes(32));
        $issuedAt = time();
        $notBefore = $issuedAt + 0;
        $expire = $notBefore + 604800; // 1 week

        $data = [
            'iss' => Yii::$app->params['baseUrlApi'],
            'iat' => $issuedAt,
            'jti' => $tokenId,
            'nbf' => $notBefore,
            'exp' => $expire,
            'data' => [
                'id' => $this->getId()
            ]
        ];

        return JWT::encode($data, Yii::$app->params['encryptToken'], 'HS256');
    }

    public function getProfileToken()
    {
        /** @var $modelPermission Permission*/
        $modelPermission = Permission::find()->select(["ma_quyen"])->where(['id' => $this->quyen_id])->one();
        return [
            'user_id' => $this->getId(),
            'username' => $this->username,
            'quyen' => $modelPermission->ma_quyen,
            'email' => $this->email,
            'ho_ten' => $this->ho_ten,
            'sdt' => $this->sdt,
            'dia_chi' => $this->dia_chi,
            'cmnd' => $this->cmnd,
            'gioi_tinh' => $this->gioi_tinh,
            'ngay_sinh' => DatetimeUtils::formatDate($this->ngay_sinh),
            'quyen_id' => $this->quyen_id
        ];
    }
    public function getPermission()
    {
        return $this->hasOne(Permission::className(),['id'=>'quyen_id']);
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                try {
                    $this->auth_key = \Yii::$app->security->generateRandomString();
                } catch (Exception $e) {
                }
            }
            return true;
        }
        return false;
    }
}