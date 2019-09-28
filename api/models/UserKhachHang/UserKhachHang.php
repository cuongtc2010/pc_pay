<?php
/**
 * Created by PhpStorm.
 * User: phamc
 * Date: 4/6/2019
 * Time: 23:09
 */

namespace api\models\UserKhachHang;


use api\models\KhachHang\KhachHang;
use api\models\TaiKhoanThe\TaiKhoanThe;
use common\Utilities\DatetimeUtils;
use common\Utilities\SessionUtils;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\helpers\ArrayHelper;
use Yii;
use Firebase\JWT\JWT;


/**
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property string $device_token
 * @property string $khach_hang_id
 * @property string $tai_khoan_id
 * @property bool $first_login
 * @property bool $is_delete
 * @property string $updated_at
 * @property string $updated_by
 * @property string $created_by
 * @property string $created_at
 */

class UserKhachHang extends ActiveRecord implements IdentityInterface
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
        return "{{user_khach_hang}}";
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        try {
            $decoded = JWT::decode($token, Yii::$app->params['encryptToken'], ['HS256']);
            return static::findIdentity($decoded->data->id);
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
        return [
            ['username', 'trim'],
            ['password', 'trim'],
            ['auth_key', 'trim'],
            ['device_token', 'trim'],
            ['khach_hang_id', 'trim'],
            ['tai_khoan_id', 'trim'],
            ['first_login', 'default', 'value' => 1],
            ['is_delete', 'default', 'value' => 0],
            ['created_at', 'default', 'value' => DatetimeUtils::getCurrentDatetime()],
            ['updated_at', 'default', 'value' => DatetimeUtils::getCurrentDatetime()],
            ['created_by', 'default', 'value' => SessionUtils::getUsername()],
            ['updated_by', 'default', 'value' => SessionUtils::getUsername()]
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
        $modelKhachHang = UserKhachHang::find()
            ->select(['dm_khach_hang.email', 'dm_khach_hang.ho_ten', 'dm_khach_hang.sdt','dm_khach_hang.dia_chi','dm_khach_hang.cmnd','dm_khach_hang.gioi_tinh','dm_khach_hang.ngay_sinh', 'tai_khoan_the.so_tai_khoan', 'tai_khoan_the.so_du'])
            ->joinWith('khachhang', false, 'INNER JOIN')
            ->joinWith('taikhoanthe',false,'INNER JOIN')
            ->where(["dm_khach_hang.id"=>$this->khach_hang_id])
            ->asArray()
            ->one();
        return [
            'user_id' => $this->getId(),
            'username' => $this->username,
            'so_tai_khoan' => $modelKhachHang["so_tai_khoan"],
            'so_du' => (float)$modelKhachHang["so_du"],
            'email' => $modelKhachHang["email"],
            'ho_ten' => $modelKhachHang["ho_ten"],
            'sdt' => $modelKhachHang["sdt"],
            'dia_chi' => $modelKhachHang["dia_chi"],
            'cmnd' => $modelKhachHang["cmnd"],
            'gioi_tinh' => (boolean)$modelKhachHang["gioi_tinh"],
            'ngay_sinh' => DatetimeUtils::formatDate($modelKhachHang["ngay_sinh"])
        ];
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

    public function getKhachhang(){
        return $this->hasOne(KhachHang::className(),["id"=>"khach_hang_id"]);
    }

    public function getTaikhoanthe(){
        return $this->hasOne(TaiKhoanThe::className(),["id"=>"tai_khoan_id"]);
    }

}