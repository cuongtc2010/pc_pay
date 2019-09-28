<?php
namespace common\Utilities;
use Yii;
class MessageUtils {
    public static function showMessage($result, $message = '') {
        if ($result) {
            Yii::$app->session->setFlash('success', empty($message) ? 'Cập nhật thành công' : $message);
            return true;
        } else {
            Yii::$app->session->setFlash('error', empty($message) ? 'Lỗi, vui lòng kiểm tra lại thông tin' : $message);
            return false;
        }
    }

}
