<?php
/**
 * Created by PhpStorm.
 * User: phamc
 * Date: 4/16/2019
 * Time: 12:51
 */

namespace api\models\ThongKe;

use Yii;

class ThongKeUtil
{
    /**
     * @return array
     * @throws \yii\db\Exception
     */
    public static function soluongSanPham()
    {
        $sql = "SELECT san_pham.id, san_pham.ten_sp, san_pham.gia, san_pham.so_luong, IFNULL(ban_ra.so_luong_ban_ra,0) AS so_luong_ban_ra, (san_pham.so_luong - IFNULL(ban_ra.so_luong_ban_ra,0)) AS con_lai
                FROM san_pham
                LEFT JOIN (SELECT san_pham.id ,san_pham.ten_sp,  SUM(hoa_don_chi_tiet.so_luong) AS so_luong_ban_ra
                    FROM hoa_don_chi_tiet 
                    JOIN san_pham ON san_pham.id = hoa_don_chi_tiet.san_pham_id
                    WHERE san_pham_id <> ''
                    GROUP BY san_pham_id) ban_ra ON ban_ra.id = san_pham.id";

        $listSanPham = Yii::$app->db->createCommand($sql)->queryAll();

        return $listSanPham;
    }

    /**
     * @return array
     * @throws \yii\db\Exception
     */
    public static function topKhachHang()
    {
        $sql = "SELECT dm_khach_hang.id, dm_khach_hang.ho_ten, dm_khach_hang.sdt, dm_khach_hang.email, SUM(tong_tien) AS tong_tien_su_dung
                FROM hoa_don
                JOIN dm_khach_hang ON dm_khach_hang.id = hoa_don.khach_hang_id
                GROUP BY khach_hang_id";

        $listKhachHang = Yii::$app->db->createCommand($sql)->queryAll();

        return $listKhachHang;
    }

    public static function thongkeDoanhThuThang($year = null)
    {
        if (is_null($year)) {
            $year = date('Y',time());
        }

        $sql = "SELECT MONTH(created_at) AS thang,SUM(tong_tien) AS doanh_thu
                FROM hoa_don
                WHERE is_huy = 0 AND YEAR(created_at) = $year
                GROUP BY thang
                ORDER BY thang";

        $listDoanhThu = Yii::$app->db->createCommand($sql)->queryAll();

        return $listDoanhThu;
    }

    public static function thongkeDoanhThuNam()
    {
        $sql = "SELECT YEAR(created_at) AS nam,SUM(tong_tien) AS doanh_thu
                FROM hoa_don
                WHERE is_huy = 0
                GROUP BY nam
                ORDER BY nam";

        $listDoanhThu = Yii::$app->db->createCommand($sql)->queryAll();

        return $listDoanhThu;
    }
}