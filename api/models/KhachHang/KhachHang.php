<?php
/**
 * Created by PhpStorm.
 * User: phamc
 * Date: 4/1/2019
 * Time: 23:47
 */

namespace api\models\KhachHang;

use common\Utilities\DatetimeUtils;
use common\Utilities\SessionUtils;
use yii\db\ActiveRecord;

/**
 * @property mixed $ho_ten
 * @property string $dia_chi
 * @property bool $gioi_tinh
 * @property string $user_khach_hang_id
 * @property string $ngay_sinh
 * @property string $email
 * @property string $cmnd
 * @property string $sdt
 * @property bool $is_delete
 * @property string $updated_at
 * @property string $updated_by
 * @property string $created_by
 * @property string $created_at
 */

class KhachHang extends ActiveRecord
{
    public static function tableName()
    {
        return "{{dm_khach_hang}}";
    }
    public function rules()
    {
        $rule = [
            ['ho_ten', 'trim'],
            ['dia_chi', 'trim'],
            ['gioi_tinh', 'default', 'value' => 0],
            ['sdt', 'trim'],
            ['cmnd', 'trim'],
            ['ngay_sinh', 'trim'],
            ['email', 'trim'],
            ['is_delete', 'default', 'value' => 0],
            ['created_at', 'default', 'value' => DatetimeUtils::getCurrentDatetime()],
            ['updated_at', 'default', 'value' => DatetimeUtils::getCurrentDatetime()],
            ['created_by', 'default', 'value' => SessionUtils::getUsername()],
            ['updated_by', 'default', 'value' => SessionUtils::getUsername()]
        ];
        return $rule;
    }
}