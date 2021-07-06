-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- โฮสต์: localhost
-- เวลาในการสร้าง: 
-- รุ่นของเซิร์ฟเวอร์: 5.5.32
-- รุ่นของ PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- ฐานข้อมูล: `wfm`
-- 

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `department`
-- 

CREATE TABLE `department` (
  `dept_id` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `dept_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- dump ตาราง `department`
-- 

INSERT INTO `department` VALUES ('10000', 'ฝ่ายทรัพยากรมนุษย์');
INSERT INTO `department` VALUES ('11100', 'แผนกบุคคล');
INSERT INTO `department` VALUES ('11110', 'หน่วยว่าจ้าง');
INSERT INTO `department` VALUES ('11120', 'หน่วยค่าจ้าง');
INSERT INTO `department` VALUES ('11130', 'หน่วยงานกฎหมายและประสานงานราชการ');
INSERT INTO `department` VALUES ('11140', 'หน่วยงานประชาสัมพันธ์');
INSERT INTO `department` VALUES ('11200', 'แผนกฝึกอบรม');
INSERT INTO `department` VALUES ('11210', 'หน่วยฝึกอบรม');
INSERT INTO `department` VALUES ('13000', 'ส่วนธุรการ');
INSERT INTO `department` VALUES ('13100', 'แผนกธุรการ');
INSERT INTO `department` VALUES ('13133', 'ทีมซ่อมบำรุง');
INSERT INTO `department` VALUES ('13200', 'แผนกโครงสร้าง&งานระบบ');
INSERT INTO `department` VALUES ('13210', 'หน่วยโยธา');
INSERT INTO `department` VALUES ('13220', 'หน่วยซ่อมบำรุงเครื่องปรับอากาศ');
INSERT INTO `department` VALUES ('20000', 'ฝ่ายพาณิชย์');
INSERT INTO `department` VALUES ('21000', 'ส่วนสารสนเทศ');
INSERT INTO `department` VALUES ('21100', 'แผนกโปรแกรมและวิเคราะห์ระบบ');
INSERT INTO `department` VALUES ('21200', 'แผนกโอเปอร์เรเตอร์');
INSERT INTO `department` VALUES ('21210', 'หน่วยโอเปอร์เรเตอร์');
INSERT INTO `department` VALUES ('21300', 'แผนกบริหารระบบ');
INSERT INTO `department` VALUES ('21310', 'หน่วยบริหารระบบ');
INSERT INTO `department` VALUES ('22000', 'ส่วนจัดซื้อ');
INSERT INTO `department` VALUES ('22100', 'แผนกจัดซื้อในประเทศ');
INSERT INTO `department` VALUES ('22110', 'หน่วยจัดซื้อในประเทศ');
INSERT INTO `department` VALUES ('22200', 'แผนกจัดซื้อต่างประเทศ');
INSERT INTO `department` VALUES ('22210', 'หน่วยจัดซื้อต่างประเทศ');
INSERT INTO `department` VALUES ('23000', 'ส่วนการเงิน');
INSERT INTO `department` VALUES ('23100', 'แผนกการเงิน');
INSERT INTO `department` VALUES ('24000', 'ส่วนบัญชี');
INSERT INTO `department` VALUES ('24100', 'แผนกบัญชีทั่วไป');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `tb_borrow`
-- 

CREATE TABLE `tb_borrow` (
  `br_id` int(10) NOT NULL AUTO_INCREMENT,
  `br_no` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `emp_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `dept_id` int(5) NOT NULL,
  `emp_tel` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `br_date` date NOT NULL,
  `remark` text COLLATE utf8_unicode_ci NOT NULL,
  `emp_resp` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `resp_date` date NOT NULL,
  `resp_assign` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `br_return` date NOT NULL,
  `br_approve` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `br_apptxt` text COLLATE utf8_unicode_ci NOT NULL,
  `br_status` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `ret_emp` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ret_date` date NOT NULL,
  `ret_assign` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ret_realdate` date NOT NULL,
  `ret_status` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`br_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `tb_borrow`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `tb_borrow_dtl`
-- 

CREATE TABLE `tb_borrow_dtl` (
  `br_dtlid` int(10) NOT NULL AUTO_INCREMENT,
  `br_no` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mat_no` varchar(18) COLLATE utf8_unicode_ci NOT NULL,
  `prd_order` varchar(18) COLLATE utf8_unicode_ci NOT NULL,
  `ret_status` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`br_dtlid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `tb_borrow_dtl`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `tb_documents`
-- 

CREATE TABLE `tb_documents` (
  `doc_id` int(10) NOT NULL AUTO_INCREMENT,
  `doc_no` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prd_order` varchar(18) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mat_no` varchar(18) COLLATE utf8_unicode_ci DEFAULT NULL,
  `plant` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_accept` date DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `short_text` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `doc_period` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `doc_status` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`doc_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=38920 ;

-- 
-- dump ตาราง `tb_documents`
-- 

INSERT INTO `tb_documents` VALUES (1, 'A001', '30104345', '40021759', '1000', '2013-01-07', '2012-12-28', 'PURE CARE BY BSC MAKE UP EYESHADOW#P0', '3', '');
INSERT INTO `tb_documents` VALUES (2, 'A002', '30104343', '40021757', '1000', '2013-01-07', '2012-12-28', 'PURE CARE BY BSC MAKE UP EYESHADOW#N1', '3', '');
INSERT INTO `tb_documents` VALUES (3, 'A003', '30104350', '40013216', '1000', '2013-01-07', '2012-12-28', 'ELISEES BUTTERFLY FINISH POWDER SPF25#C2', '3', '');
INSERT INTO `tb_documents` VALUES (4, 'A004', '30104346', '40021760', '1000', '2013-01-07', '2012-12-28', 'PURE CARE BY BSC MAKE UP EYESHADOW#P3', '3', '');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `tb_guser`
-- 

CREATE TABLE `tb_guser` (
  `g_id` int(5) NOT NULL AUTO_INCREMENT,
  `g_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`g_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- 
-- dump ตาราง `tb_guser`
-- 

INSERT INTO `tb_guser` VALUES (1, 'พนักงาน');
INSERT INTO `tb_guser` VALUES (2, 'ผู้อนุมัติ');
INSERT INTO `tb_guser` VALUES (3, 'ผู้ดูแลระบบ');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `tb_setting`
-- 

CREATE TABLE `tb_setting` (
  `sett_id` int(5) NOT NULL AUTO_INCREMENT,
  `sett_status` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sett_qr` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`sett_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- 
-- dump ตาราง `tb_setting`
-- 

INSERT INTO `tb_setting` VALUES (1, 'on', 'off');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `tb_user`
-- 

CREATE TABLE `tb_user` (
  `user_id` char(4) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstname` char(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` char(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dept_id` int(5) DEFAULT NULL,
  `g_id` int(5) NOT NULL,
  `avartar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `u_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `u_tel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- dump ตาราง `tb_user`
-- 

INSERT INTO `tb_user` VALUES ('1234', '1234', 'มนัสวิน', 'แสนคำ', 21100, 3, '', '', '');
INSERT INTO `tb_user` VALUES ('1000', '1234', 'ทดสอบ', 'ระบบ', 11100, 1, '', '', '');
INSERT INTO `tb_user` VALUES ('2000', '1234', 'พอล', 'วอล์คเกอร์', 21100, 2, '', '', '');
