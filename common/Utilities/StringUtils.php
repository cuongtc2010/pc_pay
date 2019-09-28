<?php
/**
 * Created by PhpStorm.
 * User: phuocnguyen
 * Date: 11/03/2018
 * Time: 3:33 PM
 */

namespace common\Utilities;


class StringUtils
{
    public static function isEmpty($str)
    {
        return is_null($str) && empty($str);
    }

    public static function convertStringDecimalToInt($decimal){
        $result = intval(str_replace(',', '', $decimal));
        return (float)$result;
    }

    public static function stringValueOf($object, $field, $valueType='string')
    {
        $defaultValue = "";
        if($valueType=="int"){
            $defaultValue = 0;
        }
        if ($object == null) {
            return $defaultValue;
        }
        if (!isset($object[$field])) {
            return $defaultValue;
        }
        return $object[$field];
    }
    public static function stringExplode($style,$valueString){
        if(!empty($valueString)){
            $stringArray = explode($style,trim($valueString,"/"));
            return $stringArray[0];
        }
        return ["default"];
    }

    public static function  randomStringNumber($length = 6)
    {
        $randomNumber = '';
        for ($i = 0; $i < $length; $i++) {
            $randomNumber .= rand(0, 9);
        }

        return $randomNumber;
    }

    public static function vn_to_str($str){

        $unicode = array(

            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',

            'd'=>'đ',

            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',

            'i'=>'í|ì|ỉ|ĩ|ị',

            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',

            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',

            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',

            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

            'D'=>'Đ',

            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',

            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',

        );

        foreach($unicode as $nonUnicode=>$uni){

            $str = preg_replace("/($uni)/i", $nonUnicode, $str);

        }
        $str = str_replace(' ','_',$str);

        return $str;

    }
}