<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\Utilities;

/**
 * Description of NumberUtils
 *
 * @author phuocnguyen
 */
class NumberUtils {
    public static function convertNumberToInt($param) {
        return intval(str_replace(",", "", str_replace(".", "", $param)));
    }
    public static function convertNumberToFloat($param) {        
        return floatval(str_replace(",", ".", str_replace(".", "", $param)));
    }
    public static function formatNumberWithDecimal($number = 0,$numberDecimal=2) {
        return number_format($number, $numberDecimal, ",", ".");
    }
    public static function randomNumber($length = 6)
    {
        $randomNumber = '';
        for ($i = 0; $i < $length; $i++) {
            $randomNumber .= rand(0, 9);
        }

        return $randomNumber;
    }
}
