-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th10 05, 2019 lúc 10:12 AM
-- Phiên bản máy phục vụ: 10.2.27-MariaDB-cll-lve
-- Phiên bản PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlkhpruc_pc_pay`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dm_khach_hang`
--

CREATE TABLE `dm_khach_hang` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ho_ten` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sdt` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gioi_tinh` bit(1) DEFAULT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `cmnd` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dia_chi` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_delete` bit(1) DEFAULT b'0',
  `created_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'Admin',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'Admin',
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `dm_khach_hang`
--

INSERT INTO `dm_khach_hang` (`id`, `ho_ten`, `sdt`, `gioi_tinh`, `ngay_sinh`, `cmnd`, `email`, `dia_chi`, `is_delete`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
('485fa1c0-e6b2-3f2b-8408-74fef6c77875', 'Phạm Chí Cường', '0918688521', b'0', '1994-09-24', '352173613', 'pham.cuong2409@gmail.com', 'An Giang provice', b'0', 'phamcuong', '2019-04-15 22:00:12', '0918688521', '2019-05-24 03:29:23'),
('5210c1b2-e4dc-30a6-a0e8-3f5ac06f3b36', 'Trần Văn B', '0909321123', b'0', '2019-07-02', '345678932', '', 'Cần Thơ', b'0', 'phamcuong', '2019-07-02 13:35:19', 'phamcuong', '2019-07-02 13:35:19'),
('6692db2e-6891-3871-997d-b3fecebb31c0', 'Trần Văn Cầy', '0909321555', b'0', '1994-09-24', '456321452', '', 'Sài Gòn đẹp lắm sài gòn ơi, Sài Gòn ơi, Sài Gòn ơi', b'0', 'phamcuong', '2019-05-05 16:57:40', 'phamcuong', '2019-05-05 17:14:05'),
('7501d4e9-76c9-35cc-b8d7-f0bef9f6ebad', 'Trần Văn C', '0905557778', b'0', '2019-07-02', '345333123', '', 'Cần Thơ', b'0', 'phamcuong', '2019-07-02 13:38:42', 'phamcuong', '2019-07-02 13:38:42'),
('9633fcc9-414f-3800-a1ae-66e848e5495c', 'Thủy', '0909555432', b'1', '2019-06-29', '555666777', '', 'Đà Lạt', b'0', 'phamcuong', '2019-06-01 00:05:15', 'phamcuong', '2019-06-01 00:08:20'),
('b4a323c3-e75c-311c-abf1-efd199f73823', 'Trần Văn A', '0909777333', b'0', '2019-07-01', '345444123', '', 'Cần Thơ', b'0', 'phamcuong', '2019-07-02 13:30:33', 'phamcuong', '2019-07-02 13:30:33'),
('d082cdd4-f8dc-4eba-b6cd-b862a801aa01', 'Trần Nhựt Minh', '0303858587', b'0', '1993-06-02', '2587412589', 'ggg@gmail.com', 'HCM', b'0', 'Admin', '2019-04-02 00:04:23', 'phamcuong', '2019-06-01 00:09:19'),
('f3b89148-72be-382d-b2b6-297d0c28b87e', 'Hà Anh Tuấn', '09077686499', b'0', '1984-12-17', '546789564', '', 'Ninh Bình', b'0', 'phamcuong', '2019-05-26 12:31:24', 'phamcuong', '2019-06-01 00:11:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoa_don`
--

CREATE TABLE `hoa_don` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ma_hoa_don` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loai_hoa_don` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `khach_hang_id` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nhan_vien_id` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tong_tien` float DEFAULT NULL,
  `is_success` bit(1) DEFAULT b'0',
  `is_huy` bit(1) DEFAULT b'0',
  `is_delete` bit(1) DEFAULT b'0',
  `created_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'Admin',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'Admin',
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hoa_don`
--

INSERT INTO `hoa_don` (`id`, `ma_hoa_don`, `loai_hoa_don`, `khach_hang_id`, `nhan_vien_id`, `tong_tien`, `is_success`, `is_huy`, `is_delete`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
('21d333c2-d8b2-37b2-b991-5c22a7c344b3', '538943075849', 'THE_NAP', '485fa1c0-e6b2-3f2b-8408-74fef6c77875', '6064eb1c-c71a-404e-a0d5-ebc983c5d3d9', 50000, b'1', b'0', b'0', 'phamcuong', '2019-05-18 16:59:27', 'phamcuong', '2019-05-18 16:59:27'),
('36616b78-6dc5-3160-a6cb-05a401541042', 'HD2019_001', 'BAN_HANG', '485fa1c0-e6b2-3f2b-8408-74fef6c77875', '6064eb1c-c71a-404e-a0d5-ebc983c5d3d9', 11100000, b'1', b'0', b'0', 'phamcuong', '2019-05-02 03:14:56', 'phamcuong', '2019-05-02 03:14:56'),
('4126addd-222d-3a72-90f7-611116a291c1', '67652516711', 'THE_NAP', '485fa1c0-e6b2-3f2b-8408-74fef6c77875', '72be3031-7d06-30d8-bd3f-87f721328abe', 100000, b'1', b'0', b'0', '0918688521', '2019-05-24 01:38:58', '0918688521', '2019-05-24 01:38:58'),
('54d367b6-26dc-361a-aafc-bf17a7303f1c', '626649683299', 'THE_NAP', '485fa1c0-e6b2-3f2b-8408-74fef6c77875', '6064eb1c-c71a-404e-a0d5-ebc983c5d3d9', 500000, b'1', b'0', b'0', 'phamcuong', '2019-05-18 15:58:12', 'phamcuong', '2019-05-18 15:58:12'),
('6d2b33f4-336f-3bc5-a15a-77011973ac4b', '626649683299', 'THE_NAP', '485fa1c0-e6b2-3f2b-8408-74fef6c77875', '6064eb1c-c71a-404e-a0d5-ebc983c5d3d9', 500000, b'1', b'0', b'0', 'phamcuong', '2019-05-10 02:09:34', 'phamcuong', '2019-05-10 02:09:34'),
('74f03a08-d00e-32b3-979d-9f707e899380', '67652516711', 'THE_NAP', '485fa1c0-e6b2-3f2b-8408-74fef6c77875', '72be3031-7d06-30d8-bd3f-87f721328abe', 100000, b'1', b'0', b'0', '0918688521', '2019-05-24 01:32:28', '0918688521', '2019-05-24 01:32:28'),
('82ad3f82-5c0f-3640-81ab-854763ae477c', 'HD2019_002', 'BAN_HANG', 'd082cdd4-f8dc-4eba-b6cd-b862a801aa01', '6064eb1c-c71a-404e-a0d5-ebc983c5d3d9', 1500000, b'0', b'0', b'0', 'phamcuong', '2019-05-05 15:02:14', 'phamcuong', '2019-05-05 15:02:14'),
('91876abb-9d30-3a39-a49d-42330513519e', '42172994810', 'THE_NAP', '485fa1c0-e6b2-3f2b-8408-74fef6c77875', '6064eb1c-c71a-404e-a0d5-ebc983c5d3d9', 50000, b'1', b'0', b'0', 'phamcuong', '2019-05-24 00:41:22', 'phamcuong', '2019-05-24 00:41:22'),
('9c4564b0-7bfd-343f-bf57-aaf7a264c057', '538943075849', 'THE_NAP', '485fa1c0-e6b2-3f2b-8408-74fef6c77875', '6064eb1c-c71a-404e-a0d5-ebc983c5d3d9', 50000, b'1', b'0', b'0', 'phamcuong', '2019-05-18 16:56:09', 'phamcuong', '2019-05-18 16:56:09'),
('a25930c8-4ddd-364b-83f0-aae242dc7061', '41652120133', 'THE_NAP', '485fa1c0-e6b2-3f2b-8408-74fef6c77875', '6064eb1c-c71a-404e-a0d5-ebc983c5d3d9', 500000, b'1', b'0', b'0', 'phamcuong', '2019-07-02 13:31:16', 'phamcuong', '2019-07-02 13:31:16'),
('a8ea25cd-f158-310f-b88c-71025f22212e', '07589677256', 'THE_NAP', '485fa1c0-e6b2-3f2b-8408-74fef6c77875', '6064eb1c-c71a-404e-a0d5-ebc983c5d3d9', 200000, b'1', b'0', b'0', 'phamcuong', '2019-07-02 13:35:55', 'phamcuong', '2019-07-02 13:35:55'),
('b2b6acab-f965-38ed-9c90-e23d35a26a9e', '538943075849', 'THE_NAP', '485fa1c0-e6b2-3f2b-8408-74fef6c77875', '6064eb1c-c71a-404e-a0d5-ebc983c5d3d9', 50000, b'0', b'0', b'0', 'phamcuong', '2019-05-18 16:02:57', 'phamcuong', '2019-05-18 16:02:57'),
('b4990d35-0b70-358e-bb19-f14c9e1193fe', '67652516711', 'THE_NAP', '485fa1c0-e6b2-3f2b-8408-74fef6c77875', '72be3031-7d06-30d8-bd3f-87f721328abe', 100000, b'1', b'0', b'0', '0918688521', '2019-05-24 01:29:16', '0918688521', '2019-05-24 01:29:16'),
('b869d0f9-110b-3aec-92db-f8aad33e5910', '56149950103', 'THE_NAP', '485fa1c0-e6b2-3f2b-8408-74fef6c77875', '72be3031-7d06-30d8-bd3f-87f721328abe', NULL, b'1', b'0', b'0', '0918688521', '2019-05-24 01:13:09', '0918688521', '2019-05-24 01:13:09'),
('bce7d69b-8e8d-3b70-b8e0-507b2767ea37', 'HD2019_67652516', 'BAN_HANG', '9633fcc9-414f-3800-a1ae-66e848e5495c', '6064eb1c-c71a-404e-a0d5-ebc983c5d3d9', 4800000, b'0', b'0', b'0', 'phamcuong', '2019-06-01 00:14:30', 'phamcuong', '2019-06-01 00:14:30'),
('d523a748-8bda-3242-b1bd-bbfde3e52ad1', '67652516711', 'THE_NAP', '485fa1c0-e6b2-3f2b-8408-74fef6c77875', '72be3031-7d06-30d8-bd3f-87f721328abe', 100000, b'1', b'0', b'0', '0918688521', '2019-05-24 01:28:37', '0918688521', '2019-05-24 01:28:37'),
('e362162c-eacb-34f0-a212-2eae37464525', '12312312312', 'THE_NAP', '485fa1c0-e6b2-3f2b-8408-74fef6c77875', '6064eb1c-c71a-404e-a0d5-ebc983c5d3d9', 50000, b'1', b'0', b'0', 'phamcuong', '2019-04-18 16:56:57', 'phamcuong', '2019-05-18 16:56:57'),
('f7b5a53a-c7fc-38fe-b299-6c3495bcf0d3', '90573861723', 'THE_NAP', '485fa1c0-e6b2-3f2b-8408-74fef6c77875', '6064eb1c-c71a-404e-a0d5-ebc983c5d3d9', 200000, b'1', b'0', b'0', 'phamcuong', '2019-07-02 13:39:32', 'phamcuong', '2019-07-02 13:39:32'),
('fc6dab24-bba6-39e7-a9f8-6b95596c88d0', '23572263723', 'THE_NAP', '485fa1c0-e6b2-3f2b-8408-74fef6c77875', '6064eb1c-c71a-404e-a0d5-ebc983c5d3d9', 50000, b'1', b'0', b'0', 'phamcuong', '2019-06-26 08:59:08', 'phamcuong', '2019-06-26 08:59:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoa_don_chi_tiet`
--

CREATE TABLE `hoa_don_chi_tiet` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `hoa_don_id` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `san_pham_id` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `the_nap_id` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `so_luong` int(11) DEFAULT NULL,
  `is_delete` bit(1) DEFAULT b'0',
  `created_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'Admin',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'Admin',
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hoa_don_chi_tiet`
--

INSERT INTO `hoa_don_chi_tiet` (`id`, `hoa_don_id`, `san_pham_id`, `the_nap_id`, `so_luong`, `is_delete`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
('18cd2b5e-6679-3438-a9fd-b19c92a311c2', 'd523a748-8bda-3242-b1bd-bbfde3e52ad1', '', 'c746db50-a446-3474-a1df-c35f5e522094', NULL, b'0', '0918688521', '2019-05-24 01:28:37', '0918688521', '2019-05-24 01:28:37'),
('3707f404-c016-33ed-9186-d4ee8bbc58a7', 'e362162c-eacb-34f0-a212-2eae37464525', '', '3243741c-0739-3757-abda-3c489ca8d490', NULL, b'0', 'phamcuong', '2019-05-18 16:56:57', 'phamcuong', '2019-05-18 16:56:57'),
('3bf6eecd-0a9e-3f40-90f3-c43bc5f30406', '82ad3f82-5c0f-3640-81ab-854763ae477c', 'a0090688-72e7-414e-8736-bb4fa3d2fb30', '', 1, b'0', 'phamcuong', '2019-05-05 15:02:14', 'phamcuong', '2019-05-05 15:02:14'),
('43555a21-1ed0-36da-93ef-abda141a7615', 'bce7d69b-8e8d-3b70-b8e0-507b2767ea37', 'a0090688-72e7-414e-8736-bb4fa3d2fb30', '', 2, b'0', 'phamcuong', '2019-06-01 00:14:30', 'phamcuong', '2019-06-01 00:14:30'),
('44e4f14b-e989-3fd7-88fe-1fa968ed48e8', '91876abb-9d30-3a39-a49d-42330513519e', '', '85b96ab8-17d1-34ae-b7c0-791f86c3b76b', NULL, b'0', 'phamcuong', '2019-05-24 00:41:22', 'phamcuong', '2019-05-24 00:41:22'),
('4aee6283-a2bc-3d1d-b41c-0f13294291d9', '21d333c2-d8b2-37b2-b991-5c22a7c344b3', '', 'd74051c4-fa92-37f5-972c-ebc43881e6d6', NULL, b'0', 'phamcuong', '2019-05-18 16:59:27', 'phamcuong', '2019-05-18 16:59:27'),
('7decc9dc-0da5-3064-b03c-f44f6ee1ad04', '36616b78-6dc5-3160-a6cb-05a401541042', 'a0090688-72e7-414e-8736-bb4fa3d2fb30', '', 5, b'0', 'phamcuong', '2019-05-02 03:14:56', 'phamcuong', '2019-05-02 03:14:56'),
('8ffeb124-8f05-34b7-9e36-5ea3295a692f', 'b4990d35-0b70-358e-bb19-f14c9e1193fe', '', 'c746db50-a446-3474-a1df-c35f5e522094', NULL, b'0', '0918688521', '2019-05-24 01:29:16', '0918688521', '2019-05-24 01:29:16'),
('9a3caa1f-75e2-334e-a2ba-69d43f98368a', '4126addd-222d-3a72-90f7-611116a291c1', '', 'c746db50-a446-3474-a1df-c35f5e522094', NULL, b'0', '0918688521', '2019-05-24 01:38:58', '0918688521', '2019-05-24 01:38:58'),
('9c373147-3a0f-3c8c-8617-9316447869b5', '6d2b33f4-336f-3bc5-a15a-77011973ac4b', '', 'c66f3855-8092-37f4-9908-1eb8dcae6272', NULL, b'0', 'phamcuong', '2019-05-10 02:09:34', 'phamcuong', '2019-05-10 02:09:34'),
('9ce027b9-c7f2-3b73-9f40-0ab7428828d0', 'a8ea25cd-f158-310f-b88c-71025f22212e', '', '94274fdd-ad50-3bfc-9052-9d51694c3846', NULL, b'0', 'phamcuong', '2019-07-02 13:35:55', 'phamcuong', '2019-07-02 13:35:55'),
('a3e17623-9baa-3918-829e-6f59a8024b9d', '36616b78-6dc5-3160-a6cb-05a401541042', '3fd9e209-49de-4d79-bac7-d181ac547d7f', '', 2, b'0', 'phamcuong', '2019-05-02 03:14:56', 'phamcuong', '2019-05-02 03:14:56'),
('a97236e9-e286-3b50-b103-ccc3d282727d', 'b2b6acab-f965-38ed-9c90-e23d35a26a9e', '', 'd74051c4-fa92-37f5-972c-ebc43881e6d6', NULL, b'0', 'phamcuong', '2019-05-18 16:02:57', 'phamcuong', '2019-05-18 16:02:57'),
('b001cc93-ed2b-3411-9831-0f3884f61b31', '54d367b6-26dc-361a-aafc-bf17a7303f1c', '', 'c66f3855-8092-37f4-9908-1eb8dcae6272', NULL, b'0', 'phamcuong', '2019-05-18 15:58:12', 'phamcuong', '2019-05-18 15:58:12'),
('b7dc815c-dab8-39af-9cb6-3f68e506a571', 'a25930c8-4ddd-364b-83f0-aae242dc7061', '', '2d3451ca-9128-3a84-aff9-8105abdba30f', NULL, b'0', 'phamcuong', '2019-07-02 13:31:16', 'phamcuong', '2019-07-02 13:31:16'),
('bfc08305-8f27-3b3d-95e6-58dab5349f17', 'fc6dab24-bba6-39e7-a9f8-6b95596c88d0', '', '0472866a-17c1-361c-8e01-e6beb8942e2d', NULL, b'0', 'phamcuong', '2019-06-26 08:59:08', 'phamcuong', '2019-06-26 08:59:08'),
('cafd2590-ff8a-332f-b854-d8b3e3b4138f', '9c4564b0-7bfd-343f-bf57-aaf7a264c057', '', 'd74051c4-fa92-37f5-972c-ebc43881e6d6', NULL, b'0', 'phamcuong', '2019-05-18 16:56:09', 'phamcuong', '2019-05-18 16:56:09'),
('e07da273-838f-3bf6-b1bd-6a0c7c87dac1', '74f03a08-d00e-32b3-979d-9f707e899380', '', 'c746db50-a446-3474-a1df-c35f5e522094', NULL, b'0', '0918688521', '2019-05-24 01:32:28', '0918688521', '2019-05-24 01:32:28'),
('ef24e3f6-55f0-3169-8d56-e9d2d548749d', 'b869d0f9-110b-3aec-92db-f8aad33e5910', '', '739fb873-4d7e-39c6-ae90-bf86ec5a669f', NULL, b'0', '0918688521', '2019-05-24 01:13:09', '0918688521', '2019-05-24 01:13:09'),
('faa646c3-df08-321e-90ca-0203b0de5469', 'bce7d69b-8e8d-3b70-b8e0-507b2767ea37', '3fd9e209-49de-4d79-bac7-d181ac547d7f', '', 1, b'0', 'phamcuong', '2019-06-01 00:14:30', 'phamcuong', '2019-06-01 00:14:30'),
('fffcf284-6618-3285-8fc7-30f0eb91f5ef', 'f7b5a53a-c7fc-38fe-b299-6c3495bcf0d3', '', '2c618b68-86c3-337b-a43c-abf5c9380fa8', NULL, b'0', 'phamcuong', '2019-07-02 13:39:32', 'phamcuong', '2019-07-02 13:39:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lich_su_giao_dich`
--

CREATE TABLE `lich_su_giao_dich` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phan_loai` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hoa_don_id` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trang_thai` bit(1) DEFAULT b'0',
  `is_delete` bit(1) DEFAULT b'0',
  `created_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'Admin',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'Admin',
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quyen`
--

CREATE TABLE `quyen` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ma_quyen` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_quyen` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_delete` bit(1) DEFAULT b'0',
  `created_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'Admin',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'Admin',
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `quyen`
--

INSERT INTO `quyen` (`id`, `ma_quyen`, `ten_quyen`, `is_delete`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
('0da79dd4-33e5-4099-b5f4-28fe3a8fc117', 'NV', 'Nhân viên', b'0', 'Admin', '2019-05-20 21:55:53', 'Admin', '2019-05-20 21:55:53'),
('5f70c881-b318-4e52-817e-3162d584a52d', 'ADMIN', 'Admin', b'0', 'Admin', '2019-04-01 23:15:37', 'Admin', '2019-04-01 23:15:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `san_pham`
--

CREATE TABLE `san_pham` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ma_sp` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_sp` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gia` float DEFAULT NULL,
  `so_luong` int(11) DEFAULT NULL,
  `is_delete` bit(1) DEFAULT b'0',
  `created_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'Admin',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'Admin',
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `san_pham`
--

INSERT INTO `san_pham` (`id`, `ma_sp`, `ten_sp`, `gia`, `so_luong`, `is_delete`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
('3fd9e209-49de-4d79-bac7-d181ac547d7f', 'KT-SSD01', 'SSD Kingston 520GB', 1800000, 100, b'0', 'Admin', '2019-04-16 12:24:53', 'Admin', '2019-04-16 12:24:53'),
('a0090688-72e7-414e-8736-bb4fa3d2fb30', 'SS-SSD', 'SSD Samsung 860 EVO 120GB', 1500000, 30, b'0', 'Admin', '2019-04-02 23:58:12', 'Admin', '2019-04-02 23:58:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tai_khoan_the`
--

CREATE TABLE `tai_khoan_the` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `so_tai_khoan` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `so_du` float DEFAULT NULL,
  `is_active` bit(1) DEFAULT b'1',
  `is_delete` bit(1) DEFAULT b'0',
  `created_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'Admin',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'Admin',
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tai_khoan_the`
--

INSERT INTO `tai_khoan_the` (`id`, `so_tai_khoan`, `so_du`, `is_active`, `is_delete`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
('0ce6179e-60a8-369b-8a80-14ac4f0789a2', '155705026050', 10000, b'1', b'0', 'phamcuong', '2019-05-05 16:57:40', 'phamcuong', '2019-05-05 16:57:40'),
('0f49d4b0-8b44-3d67-90e5-0d25a252f764', '155704968057', 0, b'1', b'0', 'phamcuong', '2019-05-05 16:48:00', 'phamcuong', '2019-05-05 16:48:00'),
('39a75481-822b-34fd-be0f-97070cac5b1c', '156204931917', 0, b'1', b'0', 'phamcuong', '2019-07-02 13:35:19', 'phamcuong', '2019-07-02 13:35:19'),
('3d9ccb98-079c-32a4-bbdb-b3b31b4fa2b6', '156204903391', 0, b'1', b'0', 'phamcuong', '2019-07-02 13:30:33', 'phamcuong', '2019-07-02 13:30:33'),
('47b2492c-9b4e-3d85-b455-1b337a320636', '155705041619', 0, b'1', b'0', 'phamcuong', '2019-05-05 17:00:16', 'phamcuong', '2019-05-05 17:00:16'),
('956cbbb7-c382-34bc-b4e9-255b9feee422', '155705028303', 0, b'1', b'0', 'phamcuong', '2019-05-05 16:58:03', 'phamcuong', '2019-05-05 16:58:03'),
('ae6e68d1-87f1-3c66-9019-756afb912669', '156204952268', 0, b'1', b'0', 'phamcuong', '2019-07-02 13:38:42', 'phamcuong', '2019-07-02 13:38:42'),
('b1957b93-0a71-31c0-9a22-942bff6e4bd9', '155534041253', 2300000, b'1', b'0', 'phamcuong', '2019-04-15 22:00:12', 'phamcuong', '2019-04-15 22:00:12'),
('b59547bd-cc88-3e04-bedb-7c2f0e26af03', '155704920514', 0, b'1', b'0', 'phamcuong', '2019-05-05 16:40:05', 'phamcuong', '2019-05-05 16:40:05'),
('b6374d18-5018-3a8f-a870-5fc974b29056', '155932231656', 0, b'1', b'0', 'phamcuong', '2019-06-01 00:05:16', 'phamcuong', '2019-06-01 00:05:16'),
('c3773647-1a7d-3ab3-b4b5-b65d0aeebf05', '155884868432', 0, b'1', b'0', 'phamcuong', '2019-05-26 12:31:24', 'phamcuong', '2019-05-26 12:31:24'),
('de792d35-f82c-4a11-a2df-1a80bd8fb283', '147856987452', 500000, b'1', b'0', 'Admin', '2019-04-15 21:38:27', 'Admin', '2019-04-15 21:38:27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `the_nap`
--

CREATE TABLE `the_nap` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ma_the` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seri` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menh_gia` float DEFAULT NULL,
  `is_delete` bit(1) DEFAULT b'0',
  `created_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'Admin',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'Admin',
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `the_nap`
--

INSERT INTO `the_nap` (`id`, `ma_the`, `seri`, `menh_gia`, `is_delete`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
('0072e89b-0e15-3edf-8c59-4462da74ac51', '20214420345', '432951', NULL, b'0', '0918688521', '2019-05-24 00:54:14', '0918688521', '2019-05-24 00:54:14'),
('0472866a-17c1-361c-8e01-e6beb8942e2d', '23572263723', '681532', 50000, b'1', '0918688521', '2019-05-24 01:20:01', 'phamcuong', '2019-06-26 08:59:08'),
('0d4f6bde-6484-39e3-9525-267c6623078d', '21115993502', '145254', 15000, b'0', 'phamcuong', '2019-06-01 00:15:34', 'phamcuong', '2019-06-01 00:15:34'),
('12fbc62f-c2a2-3d80-8f28-b6223887fbf6', '13346675455', '181188', NULL, b'0', '0918688521', '2019-05-24 00:51:36', '0918688521', '2019-05-24 00:51:36'),
('1c9fd009-e386-3261-be72-141845759852', 'TN50000', '202495613230', 50000, b'0', 'phamcuong', '2019-04-16 15:35:06', 'phamcuong', '2019-05-05 18:40:30'),
('2c618b68-86c3-337b-a43c-abf5c9380fa8', '90573861723', '203291', 200000, b'1', 'phamcuong', '2019-07-02 13:39:03', 'phamcuong', '2019-07-02 13:39:32'),
('2d3451ca-9128-3a84-aff9-8105abdba30f', '41652120133', '976023', 500000, b'1', 'phamcuong', '2019-07-02 13:31:00', 'phamcuong', '2019-07-02 13:31:16'),
('3243741c-0739-3757-abda-3c489ca8d490', 'TN50000', '12312312312', 50000, b'1', 'phamcuong', '2019-04-15 17:14:12', 'phamcuong', '2019-05-18 16:56:57'),
('38cba0ec-3ee9-418b-b22d-9a1fcb09c609', 'MT1', '53835832354', 50000, b'1', 'Admin', '2019-04-07 15:05:33', 'phamcuong', '2019-04-16 11:06:12'),
('3a2cc03e-2461-3f52-97bc-a70aadd2d2d8', '44082630572', '052572', NULL, b'0', '0918688521', '2019-05-24 00:54:14', '0918688521', '2019-05-24 00:54:14'),
('3df560ab-b6e1-38aa-ab8e-5c195fd2cfbf', '32806762377', '054892', 50000, b'0', '0918688521', '2019-05-24 01:22:08', '0918688521', '2019-05-24 01:22:08'),
('49fa6eaa-e729-3417-a77d-5b9243707ee7', '64864782042', '913432', 50000, b'0', '0918688521', '2019-05-24 01:20:36', '0918688521', '2019-05-24 01:20:36'),
('50c6069f-472d-3aeb-a987-71339f7819a8', '01449323933', '944428', 50000, b'0', '0918688521', '2019-05-24 01:19:31', '0918688521', '2019-05-24 01:19:31'),
('739fb873-4d7e-39c6-ae90-bf86ec5a669f', '56149950103', '039777', NULL, b'1', '0918688521', '2019-05-24 00:54:14', '0918688521', '2019-05-24 01:13:08'),
('792f4a34-f3ca-3f75-a341-c0679450b683', '96968212952', '068669', 50000, b'0', 'phamcuong', '2019-05-24 00:39:13', 'phamcuong', '2019-05-24 00:39:13'),
('85b96ab8-17d1-34ae-b7c0-791f86c3b76b', 'TN50000', '42172994810', 50000, b'1', 'phamcuong', '2019-04-16 15:33:26', 'phamcuong', '2019-05-24 00:41:22'),
('94274fdd-ad50-3bfc-9052-9d51694c3846', '07589677256', '363227', 200000, b'1', 'phamcuong', '2019-07-02 13:35:37', 'phamcuong', '2019-07-02 13:35:55'),
('ae485e15-1df9-34c0-89a0-c78ab46a5d60', '04736137956', '306667', 50000, b'0', '0918688521', '2019-05-24 01:22:20', '0918688521', '2019-05-24 01:22:20'),
('c66f3855-8092-37f4-9908-1eb8dcae6272', 'TN500000', '626649683299', 500000, b'1', 'phamcuong', '2019-05-05 18:39:29', 'phamcuong', '2019-05-18 15:58:12'),
('c746db50-a446-3474-a1df-c35f5e522094', '67652516711', '863495', 100000, b'1', 'phamcuong', '2019-05-24 01:23:01', '0918688521', '2019-05-24 01:38:58'),
('c9400e44-514a-3d3f-afbd-b1729fc2ea69', '92879071909', '953161', 80000, b'0', 'phamcuong', '2019-06-01 00:15:20', 'phamcuong', '2019-06-01 00:15:20'),
('d371da3e-afeb-3388-b218-5482cb16d252', '21292897321', '685472', 50000, b'0', '0918688521', '2019-05-24 01:22:24', '0918688521', '2019-05-24 01:22:24'),
('d74051c4-fa92-37f5-972c-ebc43881e6d6', 'TN50000', '538943075849', 50000, b'1', 'phamcuong', '2019-04-16 15:34:20', 'phamcuong', '2019-05-18 16:59:27'),
('ef423884-a691-3416-9d7e-c99c01fe3da2', 'TN50000', '53258300559', 50000, b'0', 'phamcuong', '2019-04-16 15:32:27', 'phamcuong', '2019-04-16 15:32:27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ho_ten` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gioi_tinh` bit(1) DEFAULT b'0',
  `ngay_sinh` date DEFAULT NULL,
  `sdt` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dia_chi` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `cmnd` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quyen_id` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_delete` bit(1) DEFAULT b'0',
  `created_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'Admin',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'Admin',
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `ho_ten`, `username`, `password`, `auth_key`, `gioi_tinh`, `ngay_sinh`, `sdt`, `dia_chi`, `cmnd`, `email`, `quyen_id`, `is_delete`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
('3397feff-fd4e-3dfc-9f7b-5319deb30575', 'Javi Cà Phêê', 'javi', '$2y$13$GjiMCZa84MjvTCPmiay2HuVavc80iPbSZwqwduWkA4BYj6HxGuJn2', 'CziH1ThOQQjoaiSBDarZANhiMnny8m9u', b'1', '2030-11-01', '01215855558', '205 Huỳnh Cương', '325874125', 'Javicoffee@gmail.com', '0da79dd4-33e5-4099-b5f4-28fe3a8fc117', b'0', 'phamcuong', '2019-04-15 17:24:27', 'phamcuong', '2019-05-21 00:00:00'),
('6064eb1c-c71a-404e-a0d5-ebc983c5d3d9', 'Phạm Cường', 'phamcuong', '$2y$13$GjiMCZa84MjvTCPmiay2HuVavc80iPbSZwqwduWkA4BYj6HxGuJn2', 'CziH1ThOQQjoaiSBDarZANhiMnny8m9u', b'1', '0000-00-00', '01215855552', '', '0352173613', 'phamcuong@gmai.com', '5f70c881-b318-4e52-817e-3162d584a52d', b'0', 'Admin', '2019-03-29 17:02:45', 'phamcuong', '2019-07-02 13:39:52'),
('9a4ca1fa-d967-4518-a839-a2829d438bb0', 'Administrator', 'admin', '$2y$13$GjiMCZa84MjvTCPmiay2HuVavc80iPbSZwqwduWkA4BYj6HxGuJn2', 'CziH1ThOQQjoaiSBDarZANhiMnny8m9u', b'0', '1994-09-24', '0918688521', 'Tan Chau town, An Giang Province', '352173613', 'phamchicuong2903@gmail.com', '5f70c881-b318-4e52-817e-3162d584a52d', b'0', 'Admin', '2019-05-26 12:45:15', 'admin', '2019-05-26 12:45:15'),
('a573636b-d7ec-33aa-87d9-23467e47d084', 'Trâng Huyền Trang', '0909999999', '$2y$13$kikHXUXhjMVHPQXpQmgB9O64rwknhCIt6tcUlvkyOzhfgN1bIqjQu', 'NyPx_X2BSNFyQRi9Kf_a-HhNnVY-0RDR', b'0', '0000-00-00', '0909999999', 'Tây Trúc', '35217444444', 'duongtang@pcpay.com', '0da79dd4-33e5-4099-b5f4-28fe3a8fc117', b'0', 'phamcuong', '2019-05-21 00:08:59', 'phamcuong', '2019-05-21 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_khach_hang`
--

CREATE TABLE `user_khach_hang` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `device_token` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_login` bit(1) DEFAULT b'1',
  `khach_hang_id` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tai_khoan_id` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_delete` bit(1) DEFAULT b'0',
  `created_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'Admin',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'Admin',
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user_khach_hang`
--

INSERT INTO `user_khach_hang` (`id`, `username`, `password`, `auth_key`, `device_token`, `first_login`, `khach_hang_id`, `tai_khoan_id`, `is_delete`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
('12a1bf4a-11e9-44ef-b72f-e2646f37bc4a', 'trannhutminh', '$2y$13$zIVi2/5eRgE58C7OSuXTUOo91wF2uGsNoDb.Ih3VEHx5eikhLNW2C', 'NistXUY1eXiI5cK1oFlrdeNGbegYPr8c', 'ePpoPbNJy8o:APA91bHnjdVtHWJHGllhzb64V56Nv6yVU-NxwQrjsD2v8-fjJxiY-hxJfKprbrtqqQPA_Ay0uThb-FruEZNNiTXHLLDeZ068I5Fyb3He3w658xJMQyD-hn1c6UuUxxuKTkLNPAvn2UMa', b'1', 'd082cdd4-f8dc-4eba-b6cd-b862a801aa01', 'de792d35-f82c-4a11-a2df-1a80bd8fb283', b'0', 'Admin', '2019-04-02 00:04:57', 'trannhutminh', '2019-04-02 00:04:57'),
('72be3031-7d06-30d8-bd3f-87f721328abe', '0918688521', '$2y$13$ojOGAdMcEkrzuXgnnIARvOttn4yJYRSTUYhBJ91nAlA1Zq8ceDuPm', 'IXmGZk7mwJcAixGZHqlw7D_RxERqFNjl', 'f7IH_79ieAo:APA91bFG6MXMGjH9vNGLO2eWoBkhSA7vdt6zcXkt0hJWEUElp_twyTI20Sx6VZJ6Gs8PtL-Bbt3tG6lU0l4yEI7mZiGEyTkEOIjz2VV97yKGQ0-7OHuk32dOOHeHiUDmr-TS1uJfcEEq', b'1', '485fa1c0-e6b2-3f2b-8408-74fef6c77875', 'b1957b93-0a71-31c0-9a22-942bff6e4bd9', b'0', 'phamcuong', '2019-04-15 22:00:13', '0918688521', '2019-04-15 22:00:13'),
('8894ff33-f7a6-3805-9ac4-bc0d518ed685', '00255887755', '$2y$13$b3nN1WbbZe.lfiD8FoRltOTBDC0M4YQXegjwVGlvwAVoro/DPQYQ2', 'ThcuqdEDoJbuZ1iaRplt7JBC3rbWO7jp', NULL, b'1', '6692db2e-6891-3871-997d-b3fecebb31c0', '0ce6179e-60a8-369b-8a80-14ac4f0789a2', b'0', 'phamcuong', '2019-05-05 16:57:41', 'phamcuong', '2019-05-05 16:57:41'),
('8b5d098c-dc12-327d-b66d-87870c839c2e', '0909321123', '$2y$13$Wsm4wou24re9mPLsTKcouu4Cb3RRvd9NT9FEkL1APpH1M3bbP9Zne', 'wYZveHacypgc9YE8NBekZ7pHYVaAy2Zk', '', b'1', '5210c1b2-e4dc-30a6-a0e8-3f5ac06f3b36', '39a75481-822b-34fd-be0f-97070cac5b1c', b'0', 'phamcuong', '2019-07-02 13:35:19', 'phamcuong', '2019-07-02 13:35:19'),
('99f7f97e-b3f5-3250-bcca-c2621bb0a05d', '09077686499', '$2y$13$M47t7YBiSvyS20SDguCuTO3YhJzUwxbOJRojHr6iCX4ZOVo2zonee', '9wzrB16XGPZH4LB7sjgwVQ8LOoMNcoOU', '', b'1', 'f3b89148-72be-382d-b2b6-297d0c28b87e', 'c3773647-1a7d-3ab3-b4b5-b65d0aeebf05', b'0', 'phamcuong', '2019-05-26 12:31:25', 'phamcuong', '2019-05-26 12:31:25'),
('edce2ec7-21f8-363d-b708-853f24cb30c9', '0909555432', '$2y$13$cYO1hUXBpvISBLQv2R3q3OOG6QY/hRDoreDw3IgjW/q1H7XBC3bqa', 'Eko7nKNC7sR5qTcdhjMNPJ15eq86dsAf', '', b'1', '9633fcc9-414f-3800-a1ae-66e848e5495c', 'b6374d18-5018-3a8f-a870-5fc974b29056', b'0', 'phamcuong', '2019-06-01 00:05:16', 'phamcuong', '2019-06-01 00:05:16'),
('ee934dc9-9458-3837-8778-577dd26289f1', '0905557778', '$2y$13$YTOFC/STd7Okl1zCbxGC9e74HhQkukkJdpTR2SJ6VZ5xRs5gOEmR2', 'EErORn1jllAj3DczswKzvondSwdUsaGk', '', b'1', '7501d4e9-76c9-35cc-b8d7-f0bef9f6ebad', 'ae6e68d1-87f1-3c66-9019-756afb912669', b'0', 'phamcuong', '2019-07-02 13:38:43', 'phamcuong', '2019-07-02 13:38:43'),
('f34659bf-05de-34e2-b373-c030262ca306', '0909777333', '$2y$13$auFkrKAtbVK1kuiP8BX8T.rSX8gu4DFbnnehJXTK3yw/GYgKUm5LK', 'rKvaUaER_2PGuZhggz1AtlG70VRa0hEX', '', b'1', 'b4a323c3-e75c-311c-abf1-efd199f73823', '3d9ccb98-079c-32a4-bbdb-b3b31b4fa2b6', b'0', 'phamcuong', '2019-07-02 13:30:34', 'phamcuong', '2019-07-02 13:30:34');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `dm_khach_hang`
--
ALTER TABLE `dm_khach_hang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `hoa_don`
--
ALTER TABLE `hoa_don`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `hoa_don_chi_tiet`
--
ALTER TABLE `hoa_don_chi_tiet`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `lich_su_giao_dich`
--
ALTER TABLE `lich_su_giao_dich`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `quyen`
--
ALTER TABLE `quyen`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tai_khoan_the`
--
ALTER TABLE `tai_khoan_the`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `the_nap`
--
ALTER TABLE `the_nap`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user_khach_hang`
--
ALTER TABLE `user_khach_hang`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
