<?php
/**
 * Created by PhpStorm.
 * User: phamc
 * Date: 4/10/2019
 * Time: 22:31
 */

namespace api\models\ThongTinCaNhan;


use yii\db\ActiveRecord;
use common\Utilities\DatetimeUtils;
use common\Utilities\SessionUtils;

class ThongTinNhanVien extends ActiveRecord
{
    public static function tableName()
    {
        return '{{user}}';
    }

    public function rules()
    {
        return [
            ['username', 'trim'],
            ['password', 'trim'],
            ['auth_key', 'trim'],
            ['ho_ten', 'trim'],
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
    }
}