<?php
/**
 * Created by PhpStorm.
 * User: phamc
 * Date: 4/1/2019
 * Time: 23:32
 */
namespace  api\models\HoaDon;
use api\models\KhachHang\KhachHang;
use common\Utilities\DatetimeUtils;
use common\Utilities\SessionUtils;
use yii\db\ActiveRecord;

/**
 * HoaDon Model
 * @property string $ma_hoa_don
 * @property string $loai_hoa_don
 * @property string $khach_hang_id
 * @property string $nhan_vien_id
 * @property float $tong_tien
 * @property bool $is_success
 * @property bool $is_huy
 * @property bool $is_delete
 * @property string $updated_at
 * @property string $updated_by
 * @property string $created_by
 * @property string $created_at
 */

class HoaDon extends ActiveRecord
{

    public static function tableName()
    {
        return '{{hoa_don}}';
    }

    public function rules()
    {
        return [
            ['ma_hoa_don', "trim"],
            ['loai_hoa_don', "trim"],
            ['khach_hang_id', "trim"],
            ['nhan_vien_id', "trim"],
            ['tong_tien', "trim"],
            ['is_success','default','value'=>0],
            ['is_huy','default','value'=>0],
            ['is_delete','default','value'=>0],
            ['created_at','default','value'=>DatetimeUtils::getCurrentDatetime()],
            ['updated_at','default','value'=>DatetimeUtils::getCurrentDatetime()],
            ['created_by','default','value'=>SessionUtils::getUsername()],
            ['updated_by','default','value'=>SessionUtils::getUsername()]
        ];
    }
    public function getKhachhang()
    {
        return $this->hasOne(KhachHang::className(),['id'=>'khach_hang_id']);
    }
}
