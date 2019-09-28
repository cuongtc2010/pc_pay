<?php
/**
 * Created by PhpStorm.
 * User: phamc
 * Date: 4/2/2019
 * Time: 23:44
 */

namespace api\models\SanPham;


class SanPhamUtil extends SanPham
{
    /**
     * @return mixed
     */
    public static function getListSanPham(){
     $modelSanPham = SanPham::find()->where(["is_delete"=>0])->all();
     return $modelSanPham;
 }
}