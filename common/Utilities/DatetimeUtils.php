<?php
/**
 * Created by PhpStorm.
 * User: phuocnguyen
 * Date: 11/03/2018
 * Time: 3:20 PM
 */

namespace common\Utilities;


class DatetimeUtils
{
    public static function getCurrentDate($format = 'Y-m-d')
    {
        return date($format);
    }

    public static function getCurrentDatetime($format = 'Y-m-d H:i:s')
    {
        return date($format);
    }

    public static function formatDate($date, $format = 'd/m/Y')
    {
        return date($format, strtotime($date));
    }

    public static function convertStringToDate($str) {
        $result = null;
        if (!is_null($str) && !empty($str)) {
            $arrDate = explode('/', $str);
            if (count($arrDate) > 0) {
                $day = isset($arrDate[0]) ? $arrDate[0] : 01;
                $month = isset($arrDate[1]) ? $arrDate[1] : 01;
                $year = isset($arrDate[2]) ? $arrDate[2] : 1900;
                $result = $year . "-" . $month . "-" . $day;
            }
        }
        return $result;
    }
    public static function convertStringDateTimeToDate($str){
        $result = null;
        if(!is_null($str) && !empty($str)){
            $arrDate = explode(' ', $str);
            $result = $arrDate[0];
        }
        return $result;
    }
}