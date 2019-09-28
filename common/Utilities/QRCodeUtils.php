<?php
/**
 * Created by PhpStorm.
 * User: phamc
 * Date: 12/6/2018
 * Time: 0:54
 */

namespace common\Utilities;
use application\models\User\UserUtil;
use application\models\UserKhachHang\UserKhachHang;
use Endroid\QrCode\QrCode;
use Yii;

class QRCodeUtils
{
    public static function genQRCodeForUserCustomer($idUser){
        try{
            $modelUser = UserKhachHang::findOne($idUser);
            if(!empty($modelUser)){
                $loginInfor = array();
                //$loginInfor["host"] = "http://".gethostbyname(gethostname()). "/panda_crm_head/" . StringUtils::stringExplode("/",Yii::$app->request->baseUrl) . "/mobile";
                $loginInfor["host"] = Yii::getAlias('@web'). "/honda/tamanh" ; //get địa chỉ ip host
                $loginInfor["topic_fcm"] = Yii::$app->params["firebaseTopic"];
                $loginInfor["token"] = UserUtil::getToken($idUser);
                $qrCode = new QrCode(json_encode($loginInfor));
                $qrCode->setSize(200);
                return $qrCode;
            }
            return "";
        }catch (\Exception $e){

        }
    }
}