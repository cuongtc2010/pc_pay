<?php
/**
 * Created by PhpStorm.
 * User: phamc
 * Date: 4/7/2019
 * Time: 14:56
 */

namespace api\models\TheNap;


use common\Utilities\DatetimeUtils;
use common\Utilities\SessionUtils;
use common\Utilities\StringUtils;
use Faker\Provider\Uuid;
use Yii;

class TheNapUtil extends TheNap
{
    /**
     * @return array $modelTheNap.
     */
    public static function getListTheNap(){
        $modelTheNap = TheNap::find()->where(["is_delete"=>0])->all();
        return $modelTheNap;
    }

    /**
     * @param object $modelTheNap the attributes given by field => value.
     * @return boolean whether the saving succeeded.
     */
    public static function saveTheNap($modelTheNap)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            /** @var $modelTheNap TheNap */
            if (!is_null($modelTheNap->id)) {
                $params = array(
                    "menh_gia",
                    "updated_by",
                    "updated_at",
                );
                $modelTheNap->updated_by = SessionUtils::getUsername();
                $modelTheNap->updated_at = DatetimeUtils::getCurrentDatetime();
                $modelTheNap->save(true,$params);
            }else{
                $modelTheNap->id = Uuid::uuid();
                $modelTheNap->ma_the = StringUtils::randomStringNumber(12);
                $modelTheNap->seri = StringUtils::randomStringNumber(6);
                $modelTheNap->save();
            }
            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
        }
        return false;
    }
}