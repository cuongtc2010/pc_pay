<?php
/**
 * Created by PhpStorm.
 * User: phamc
 * Date: 4/2/2019
 * Time: 23:42
 */

namespace api\models\ChiTietHoaDon;


class ChiTietHoaDonUtil extends ChiTietHoaDon
{
    public static function getChiTietHoaDon($id)
    {
        $modelChiTietHoaDon = ChiTietHoaDon::find()
                            ->select(['san_pham.ten_sp','san_pham.gia','hoa_don_chi_tiet.so_luong'])
                            ->joinWith("sanpham",false,"INNER JOIN")
                            ->where(['hoa_don_id'=>$id])
                            ->asArray()
                            ->all();
        return $modelChiTietHoaDon;
    }
}