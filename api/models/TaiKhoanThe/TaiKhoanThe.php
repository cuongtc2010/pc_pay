<?php
/**
 * Created by PhpStorm.
 * User: phamc
 * Date: 4/15/2019
 * Time: 21:02
 */

namespace api\models\TaiKhoanThe;


use yii\db\ActiveRecord;
use common\Utilities\DatetimeUtils;
use common\Utilities\SessionUtils;


/**
 * @property string $so_tai_khoan
 * @property string $so_du
 * @property bool $is_active
 * @property bool $is_delete
 * @property string $updated_at
 * @property string $updated_by
 * @property string $created_by
 * @property string $created_at
 */
class TaiKhoanThe extends ActiveRecord
{
    public static function tableName()
    {
        return "{{tai_khoan_the}}";
    }

    public function rules()
    {
        return [
            ["so_tai_khoan", "trim"],
            ["so_du", "default", 'value' => 0],
            ["is_active", 'default', 'value' => 1],
            ['is_delete', 'default', 'value' => 0],
            ['created_at', 'default', 'value' => DatetimeUtils::getCurrentDatetime()],
            ['updated_at', 'default', 'value' => DatetimeUtils::getCurrentDatetime()],
            ['created_by', 'default', 'value' => SessionUtils::getUsername()],
            ['updated_by', 'default', 'value' => SessionUtils::getUsername()]
        ];
    }
}