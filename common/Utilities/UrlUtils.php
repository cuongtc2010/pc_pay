<?php
/**
 * Created by PhpStorm.
 * User: phuocnguyen
 * Date: 11/03/2018
 * Time: 5:29 PM
 */

namespace common\Utilities;

use Yii;
use yii\helpers\Url;

class UrlUtils
{
    public static function goUrl($url = '', $scheme = false)
    {
        if (is_array($url)) {
            $url["key"] = Yii::$app->session->id;
        }
        return Url::to($url, $scheme);
    }

    public static function getBaseUrl()
    {
        return Yii::getAlias('@web');
    }

    public static function isUrlExist($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($code == 200) {
            $status = true;
        } else {
            $status = false;
        }
        curl_close($ch);
        return $status;
    }
}