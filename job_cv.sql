-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 17, 2015 at 06:39 PM
-- Server version: 5.5.28-log
-- PHP Version: 5.4.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `job_cv`
--

-- --------------------------------------------------------

--
-- Table structure for table `job_admin`
--

CREATE TABLE IF NOT EXISTS `job_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `level` int(11) NOT NULL DEFAULT '0',
  `block_admin` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `job_admin`
--

INSERT INTO `job_admin` (`admin_id`, `email`, `password`, `fname`, `lname`, `level`, `block_admin`) VALUES
(3, 'admin@yahoo.com', '4badaee57fed5610012a296273158f5f', 'عبدالسلام', 'سالم', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `job_cert`
--

CREATE TABLE IF NOT EXISTS `job_cert` (
  `cert_id` int(11) NOT NULL AUTO_INCREMENT,
  `cert_name` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`cert_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `job_cert`
--

INSERT INTO `job_cert` (`cert_id`, `cert_name`, `user_id`) VALUES
(6, 'شهادة قيادة الحاسوب', 183);

-- --------------------------------------------------------

--
-- Table structure for table `job_city`
--

CREATE TABLE IF NOT EXISTS `job_city` (
  `city_id` int(20) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(100) NOT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `job_city`
--

INSERT INTO `job_city` (`city_id`, `city_name`) VALUES
(1, 'طرابلس'),
(2, 'بنغازي'),
(3, 'ترهونة'),
(4, 'بني وليد'),
(5, 'مصراته'),
(6, 'طبرق'),
(7, 'غريان'),
(8, 'الزاوية'),
(9, 'سبها');

-- --------------------------------------------------------

--
-- Table structure for table `job_company`
--

CREATE TABLE IF NOT EXISTS `job_company` (
  `comp_id` int(30) NOT NULL AUTO_INCREMENT,
  `comp_name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city_id` int(11) NOT NULL DEFAULT '1',
  `count_emp` int(1) NOT NULL,
  `comp_type_id` int(10) NOT NULL DEFAULT '1',
  `start_comp` varchar(20) NOT NULL,
  `size_comp` varchar(4) NOT NULL,
  `domain_id` int(11) NOT NULL DEFAULT '1',
  `comp_desc` text NOT NULL,
  `image` varchar(60) NOT NULL,
  `phone` int(20) NOT NULL,
  `block_admin` int(11) NOT NULL DEFAULT '0',
  `url` varchar(150) NOT NULL,
  PRIMARY KEY (`comp_id`),
  KEY `city_id` (`city_id`),
  KEY `comp_type_id` (`comp_type_id`),
  KEY `domain_id` (`domain_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `job_company`
--

INSERT INTO `job_company` (`comp_id`, `comp_name`, `address`, `city_id`, `count_emp`, `comp_type_id`, `start_comp`, `size_comp`, `domain_id`, `comp_desc`, `image`, `phone`, `block_admin`, `url`) VALUES
(39, 'العالمية', 'الهضبة الخضراء', 3, 0, 1, '2015', '', 1, 'الشركة تقوم ببرمجة منظومات وتصميم مواقع وتطبيقات للهاتف المحمول', '74.png', 92754662, 0, 'goodcomp@yahoo.com'),
(40, 'رؤيا', '', 1, 0, 1, '', '', 1, '', '76.jpeg', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `job_comp_type`
--

CREATE TABLE IF NOT EXISTS `job_comp_type` (
  `comp_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `comp_type_name` varchar(60) NOT NULL,
  PRIMARY KEY (`comp_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `job_comp_type`
--

INSERT INTO `job_comp_type` (`comp_type_id`, `comp_type_name`) VALUES
(1, 'القطاع الخاص'),
(2, 'القطاع العام');

-- --------------------------------------------------------

--
-- Table structure for table `job_description`
--

CREATE TABLE IF NOT EXISTS `job_description` (
  `emp_id` int(30) NOT NULL,
  `desc_id` int(20) NOT NULL AUTO_INCREMENT,
  `job_name` varchar(100) NOT NULL,
  `job_desc` text NOT NULL,
  `job_skilles` text NOT NULL,
  `city_id` int(11) NOT NULL DEFAULT '1',
  `domain_id` int(30) NOT NULL,
  `type_id` int(5) NOT NULL DEFAULT '1',
  `salary_id` int(6) NOT NULL DEFAULT '1',
  `job_num` int(20) NOT NULL DEFAULT '1',
  `exp_min` int(20) NOT NULL,
  `exp_max` int(20) NOT NULL,
  `edt_id` int(10) NOT NULL DEFAULT '1',
  `age_min` int(20) NOT NULL,
  `age_max` int(20) NOT NULL,
  `job_gender` varchar(3) NOT NULL DEFAULT 'n',
  `nat_id` int(20) NOT NULL DEFAULT '1',
  `job_start` date NOT NULL,
  `job_end` date NOT NULL,
  `hide_comp` int(5) NOT NULL,
  `view_desc` int(20) NOT NULL,
  `health_status` int(11) NOT NULL DEFAULT '1',
  `status_id` int(11) NOT NULL DEFAULT '1',
  `is_active` int(1) NOT NULL DEFAULT '0',
  `comp_active` int(1) NOT NULL DEFAULT '0',
  `specialty` varchar(150) NOT NULL,
  `exp_level` int(10) NOT NULL DEFAULT '1',
  `see_it` int(11) NOT NULL,
  PRIMARY KEY (`desc_id`),
  KEY `city_id` (`city_id`),
  KEY `domain_id` (`domain_id`),
  KEY `type_id` (`type_id`),
  KEY `salary_id` (`salary_id`),
  KEY `nat_id` (`nat_id`),
  KEY `edt_id` (`edt_id`),
  KEY `exp_level` (`exp_level`),
  KEY `status_id` (`status_id`),
  KEY `emp_id` (`emp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `job_description`
--

INSERT INTO `job_description` (`emp_id`, `desc_id`, `job_name`, `job_desc`, `job_skilles`, `city_id`, `domain_id`, `type_id`, `salary_id`, `job_num`, `exp_min`, `exp_max`, `edt_id`, `age_min`, `age_max`, `job_gender`, `nat_id`, `job_start`, `job_end`, `hide_comp`, `view_desc`, `health_status`, `status_id`, `is_active`, `comp_active`, `specialty`, `exp_level`, `see_it`) VALUES
(74, 21, 'مهندس برمجيات', 'ستسند لهذه الوظيفة عدة وظائف اهمها برمجة السيرفير الخاص بالشركة والدعم الفني لباقي قطاعات الشركة', 'يجب أن يكون ليبي الجنسية\r\nيجب أن يكون بدراية بلغة برمجة السي شارب \r\nيجب ان يستطيع ان يعمل في مجموعة وان يكون متفهم ويستطيع حل المشاكل', 1, 10, 1, 1, 2, 0, 0, 7, 18, 60, 'n', 1, '2015-01-11', '2015-06-14', 0, 0, 1, 1, 0, 0, '', 2, 32),
(74, 22, 'مهندس شبكات', 'يستطيع ان يقوم بعمل كافة التوصيلات المتعلقة بالشركة والشركات الاخري وكل الشركات', 'لاتوجد حاليا', 2, 12, 2, 10, 3, 2, 5, 8, 24, 33, 'm', 2, '2015-01-12', '2015-07-16', 0, 0, 1, 1, 0, 0, '', 5, 52),
(74, 23, 'مدير مبيعات', 'سيتم شرحها عند الحصول علي موظف', 'ان يكون مهتم بالمبيعات', 2, 12, 1, 10, 2, 2, 7, 6, 18, 24, 'm', 2, '2015-01-12', '2015-06-05', 0, 0, 1, 1, 0, 1, '', 5, 13),
(76, 24, 'مصمم معماري', 'مهندس معماري ', 'كل مهارات التصميم باالاتوكاد والتصميم الورقي\r\nيجيد اللغة الروسية', 2, 12, 2, 11, 1, 0, 0, 7, 0, 0, 'm', 2, '2015-01-12', '2015-08-07', 0, 0, 1, 1, 0, 0, '', 1, 15);

-- --------------------------------------------------------

--
-- Table structure for table `job_desc_save`
--

CREATE TABLE IF NOT EXISTS `job_desc_save` (
  `save_id` int(11) NOT NULL AUTO_INCREMENT,
  `seeker_id` int(11) NOT NULL,
  `desc_id` int(11) NOT NULL,
  PRIMARY KEY (`save_id`),
  KEY `desc_id` (`desc_id`),
  KEY `seeker_id` (`seeker_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `job_domain`
--

CREATE TABLE IF NOT EXISTS `job_domain` (
  `domain_id` int(30) NOT NULL AUTO_INCREMENT,
  `domain_name` varchar(35) NOT NULL,
  PRIMARY KEY (`domain_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `job_domain`
--

INSERT INTO `job_domain` (`domain_id`, `domain_name`) VALUES
(1, 'محاسبة/أقتصاد'),
(3, 'غيرذالك'),
(10, 'تقنية معلومات'),
(12, 'هندسة معمارية'),
(13, 'هندسة'),
(14, 'اداب'),
(15, 'مبيعات'),
(16, 'تعليم/تدريس');

-- --------------------------------------------------------

--
-- Table structure for table `job_ed`
--

CREATE TABLE IF NOT EXISTS `job_ed` (
  `edt_id` int(10) NOT NULL DEFAULT '1',
  `domain_id` int(15) NOT NULL,
  `univ` varchar(45) NOT NULL,
  `avg` varchar(10) NOT NULL,
  `start_date` varchar(10) NOT NULL,
  `end_date` varchar(10) NOT NULL,
  `user_id` int(15) NOT NULL,
  `specialty` varchar(100) NOT NULL,
  `ed_id` int(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ed_id`),
  KEY `domain_id` (`domain_id`),
  KEY `edt_id` (`edt_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=72 ;

--
-- Dumping data for table `job_ed`
--

INSERT INTO `job_ed` (`edt_id`, `domain_id`, `univ`, `avg`, `start_date`, `end_date`, `user_id`, `specialty`, `ed_id`) VALUES
(7, 1, 'جامعة الجبل الغربي كلية الأقتصاد', '65', '2005', '2010', 141, 'محاسبة', 59),
(7, 12, 'جامعة طرابلس كلية الهندسة', '', '2012', '2016', 92, 'هندسة معمارية', 60),
(8, 10, 'جامعة مصراته', '85', '2008', '2013', 145, 'علوم حاسب', 61),
(7, 3, 'جامعة مصراته كلية العوم', '', '2002', '2006', 145, 'حاسب ألي', 62),
(6, 13, 'مدرسة الازدهار', '', '2005', '2010', 188, 'علوم هندسية', 63),
(7, 1, 'جامعة ناصر كلية الأقتصاد', '78', '2010', '2014', 187, 'محاسبة ادارية', 64),
(7, 10, 'جامعة القاهرة', '', '2001', '2007', 180, 'شبكات', 66),
(6, 13, 'جامعة طرابلس كلية الهندسة', '', '2006', '2010', 181, 'هندسة عامة', 67),
(9, 10, 'جامعة بنغازي', '', '2005', '2009', 182, 'ذكاء اصطناعي', 68),
(8, 10, 'جامعة مصراته', '88', '2000', '2004', 182, 'هندسة برمجيات', 69),
(7, 10, 'جامعة طرابلس كلية العلوم', '', '2005', '2009', 183, 'علوم حاسب', 70),
(7, 1, 'جامعة طرابلس كلية الهندسة', '', '2012', '2017', 184, 'اقتصاد مالي', 71);

-- --------------------------------------------------------

--
-- Table structure for table `job_ed_type`
--

CREATE TABLE IF NOT EXISTS `job_ed_type` (
  `edt_id` int(10) NOT NULL AUTO_INCREMENT,
  `edt_name` varchar(100) NOT NULL,
  PRIMARY KEY (`edt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `job_ed_type`
--

INSERT INTO `job_ed_type` (`edt_id`, `edt_name`) VALUES
(6, 'ثانوي/دبلوم متوسط'),
(7, 'بكالوريس/دبلوم عالي'),
(8, 'ماجستير'),
(9, 'دكتوراه');

-- --------------------------------------------------------

--
-- Table structure for table `job_employer`
--

CREATE TABLE IF NOT EXISTS `job_employer` (
  `emp_id` int(30) NOT NULL AUTO_INCREMENT,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date_register` datetime NOT NULL,
  `is_active` int(1) NOT NULL,
  `activation` varchar(100) NOT NULL,
  `comp_id` int(30) NOT NULL,
  `last_seen` date NOT NULL,
  `count_in` int(20) NOT NULL,
  `level` int(2) NOT NULL DEFAULT '0',
  `block` int(11) NOT NULL DEFAULT '0',
  `block_admin` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`emp_id`,`email`),
  KEY `comp_id` (`comp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=77 ;

--
-- Dumping data for table `job_employer`
--

INSERT INTO `job_employer` (`emp_id`, `fname`, `lname`, `email`, `password`, `date_register`, `is_active`, `activation`, `comp_id`, `last_seen`, `count_in`, `level`, `block`, `block_admin`) VALUES
(74, 'عصام', 'عمااد', 'it5t@yahoo.com', '4badaee57fed5610012a296273158f5f', '2015-01-11 19:55:37', 2, '51a6a9c39bb6cf035f211f0abcc0f58e', 39, '2015-05-13', 20, 1, 0, 0),
(75, 'حميد', 'القرقوطي', 'iteet@yahoo.com', '4badaee57fed5610012a296273158f5f', '2015-01-11 20:16:04', 2, '8fea7e49dabd72d501ff206745cf3ddb', 39, '0000-00-00', 0, 0, 0, 0),
(76, 'مصعب', 'عامر', 'ro@yahoo.com', '4badaee57fed5610012a296273158f5f', '2015-01-12 17:19:01', 2, '2401360c487b013c9c2ccb0a8ba15783', 40, '2015-01-12', 2, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `job_emp_save`
--

CREATE TABLE IF NOT EXISTS `job_emp_save` (
  `emp_id` int(11) NOT NULL,
  `seeker_id` int(11) NOT NULL,
  `emp_save_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`emp_save_id`),
  KEY `emp_id` (`emp_id`),
  KEY `seeker_id` (`seeker_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `job_exp`
--

CREATE TABLE IF NOT EXISTS `job_exp` (
  `exp_id` int(20) NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `state` int(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `domain_id` int(11) NOT NULL,
  `exp_name` varchar(100) NOT NULL,
  `exp_comp` varchar(100) NOT NULL,
  `exp_desc` text NOT NULL,
  PRIMARY KEY (`exp_id`),
  KEY `domain_id` (`domain_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `job_exp`
--

INSERT INTO `job_exp` (`exp_id`, `start_date`, `end_date`, `state`, `user_id`, `domain_id`, `exp_name`, `exp_comp`, `exp_desc`) VALUES
(21, '2011-10-01', '2015-01-11', 1, 92, 3, 'مصورة', 'النجم الساطع', 'خبيرة في تصوير وفي التحكم في إضاءة قااعات التصوير'),
(22, '2012-11-01', '2015-01-11', 1, 145, 3, 'محاضرة', 'جامعة مصراته', '1 - وضعت هيكلية للمواد التي ستدرس في الكلية\r\n2 - قمت بتغيير طريقة التنزيل من الطريقة اليديوية الي الألية وكانت كلية أول كلية في ليبيا تقوم بذالك'),
(23, '2007-10-01', '2012-08-01', 0, 145, 10, 'مدربه', 'مركز النصر للحاسوب', ''),
(24, '2007-10-01', '2015-01-12', 1, 187, 15, 'مدير مبيعات', 'الفرجاني للمواد المنزلية', '');

-- --------------------------------------------------------

--
-- Table structure for table `job_exp_type`
--

CREATE TABLE IF NOT EXISTS `job_exp_type` (
  `exp_type_id` int(10) NOT NULL AUTO_INCREMENT,
  `exp_type_name` varchar(100) NOT NULL,
  PRIMARY KEY (`exp_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `job_exp_type`
--

INSERT INTO `job_exp_type` (`exp_type_id`, `exp_type_name`) VALUES
(1, 'طالب / متدرب'),
(2, 'حديث التخرج'),
(5, 'متوسط الخبرة'),
(6, 'مدير تنفيذي');

-- --------------------------------------------------------

--
-- Table structure for table `job_goal`
--

CREATE TABLE IF NOT EXISTS `job_goal` (
  `goal_id` int(11) NOT NULL AUTO_INCREMENT,
  `goal_name` varchar(150) NOT NULL,
  `goal_text` text NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`goal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `job_hobby`
--

CREATE TABLE IF NOT EXISTS `job_hobby` (
  `hobby_id` int(11) NOT NULL AUTO_INCREMENT,
  `hobby_name` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`hobby_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `job_hobby`
--

INSERT INTO `job_hobby` (`hobby_id`, `hobby_name`, `user_id`) VALUES
(6, 'الشطرنج  - كرة القدم', 178),
(7, 'تصوير', 92),
(8, 'الكارطة - كرة القدم', 141),
(9, 'المطالعه', 145);

-- --------------------------------------------------------

--
-- Table structure for table `job_info`
--

CREATE TABLE IF NOT EXISTS `job_info` (
  `info_id` int(11) NOT NULL AUTO_INCREMENT,
  `info_name` varchar(200) NOT NULL,
  `info_date` varchar(6) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`info_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `job_info`
--

INSERT INTO `job_info` (`info_id`, `info_name`, `info_date`, `user_id`) VALUES
(3, 'مشرف قسم هندسة البرمجيات في اتحاد طلبة كلية تقنية المعلومات', '2014', 178),
(4, 'حائزة علي جائزة التصوير المدرسي', '2010', 92),
(5, 'حاصل علي الترتيب الاول في مسابقة كرة قدم علي مستوي طرابلس', '2009', 183),
(6, 'رئيس اتحاد طلبة الكلية في جامعة طرابلس', '2008', 183),
(7, 'مشارك في مسابقة تك بروجيكت', '2012', 178),
(8, 'مصمم مجلة آيتيتات العدد الأول الصادرة عن اتحاد طلبة كلية تقنية المعلومات', '2012', 178);

-- --------------------------------------------------------

--
-- Table structure for table `job_lang`
--

CREATE TABLE IF NOT EXISTS `job_lang` (
  `lang_name` varchar(50) NOT NULL,
  `lang_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`lang_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `job_lang`
--

INSERT INTO `job_lang` (`lang_name`, `lang_id`) VALUES
('العربية', 7),
('الأنجليزية', 8),
('الفرنسية', 9);

-- --------------------------------------------------------

--
-- Table structure for table `job_lang_seeker`
--

CREATE TABLE IF NOT EXISTS `job_lang_seeker` (
  `user_id` int(11) NOT NULL,
  `lang_id` int(20) NOT NULL,
  `level_id` int(11) NOT NULL,
  PRIMARY KEY (`lang_id`,`user_id`),
  KEY `level_id` (`level_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `job_lang_seeker`
--

INSERT INTO `job_lang_seeker` (`user_id`, `lang_id`, `level_id`) VALUES
(188, 8, 1),
(188, 7, 2),
(178, 8, 2),
(141, 9, 2),
(92, 7, 3),
(141, 7, 3),
(145, 7, 3),
(178, 7, 3),
(183, 7, 3),
(145, 8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `job_level`
--

CREATE TABLE IF NOT EXISTS `job_level` (
  `level_id` int(11) NOT NULL AUTO_INCREMENT,
  `level_name` varchar(60) NOT NULL,
  PRIMARY KEY (`level_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `job_level`
--

INSERT INTO `job_level` (`level_id`, `level_name`) VALUES
(1, 'مبتدئ'),
(2, 'متوسط'),
(3, 'محترف');

-- --------------------------------------------------------

--
-- Table structure for table `job_nat`
--

CREATE TABLE IF NOT EXISTS `job_nat` (
  `nat_id` int(11) NOT NULL AUTO_INCREMENT,
  `nat_name` varchar(50) NOT NULL,
  PRIMARY KEY (`nat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `job_nat`
--

INSERT INTO `job_nat` (`nat_id`, `nat_name`) VALUES
(1, 'لا أفضلية'),
(2, 'ليبي'),
(3, 'مصري'),
(4, 'تونسي'),
(5, 'جزائري');

-- --------------------------------------------------------

--
-- Table structure for table `job_ref`
--

CREATE TABLE IF NOT EXISTS `job_ref` (
  `ref_id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_name` varchar(200) NOT NULL,
  `ref_email` varchar(80) NOT NULL,
  `ref_phone` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ref_adj` varchar(100) NOT NULL,
  PRIMARY KEY (`ref_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `job_ref`
--

INSERT INTO `job_ref` (`ref_id`, `ref_name`, `ref_email`, `ref_phone`, `user_id`, `ref_adj`) VALUES
(2, 'رضوان حسين', 'erudwan@yahoo.com', '0923333333', 178, 'رئيس قسم هندسة البرمجيات'),
(3, 'خليفة', 'ماعنداش', '09272231', 187, 'صاحب المحل');

-- --------------------------------------------------------

--
-- Table structure for table `job_salary`
--

CREATE TABLE IF NOT EXISTS `job_salary` (
  `salary_id` int(20) NOT NULL AUTO_INCREMENT,
  `salary_name` varchar(50) NOT NULL,
  PRIMARY KEY (`salary_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `job_salary`
--

INSERT INTO `job_salary` (`salary_id`, `salary_name`) VALUES
(1, 'غير محدد'),
(8, '0-500'),
(9, '1000-1500'),
(10, '1500-3000'),
(11, '3000-5000'),
(12, '5000-10000');

-- --------------------------------------------------------

--
-- Table structure for table `job_seeker`
--

CREATE TABLE IF NOT EXISTS `job_seeker` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `birth_day` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date_register` datetime NOT NULL,
  `is_active` int(1) NOT NULL,
  `activation` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `city_id` int(30) NOT NULL DEFAULT '1',
  `address` varchar(40) NOT NULL,
  `nat_id` int(11) NOT NULL DEFAULT '2',
  `last_seen` varchar(30) NOT NULL,
  `count_in` int(20) NOT NULL,
  `health_status` int(11) NOT NULL DEFAULT '1',
  `image` varchar(50) NOT NULL,
  `warning_active` int(11) NOT NULL DEFAULT '0',
  `hide_cv` int(11) NOT NULL DEFAULT '0',
  `block_admin` int(11) NOT NULL DEFAULT '0',
  `see_it` int(11) NOT NULL,
  `goal_text` text NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `city_id` (`city_id`),
  KEY `nat_id` (`nat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=192 ;

--
-- Dumping data for table `job_seeker`
--

INSERT INTO `job_seeker` (`user_id`, `fname`, `lname`, `birth_day`, `gender`, `email`, `password`, `date_register`, `is_active`, `activation`, `phone`, `city_id`, `address`, `nat_id`, `last_seen`, `count_in`, `health_status`, `image`, `warning_active`, `hide_cv`, `block_admin`, `see_it`, `goal_text`) VALUES
(92, 'ساره', 'محمد', '1993-01-08', 'f', 'sarah@yahoo.com', '4badaee57fed5610012a296273158f5f', '2015-02-02 00:24:11', 0, '4a87214f9aa0197d4f220e1d4b9d775c', '09555555', 2, '', 2, '2015-01-12', 58, 1, '92.jpeg', 0, 0, 0, 7828, ''),
(141, 'أحمدد', 'سعد', '1985-01-08', 'm', 'itt@yahoo.com', '4badaee57fed5610012a296273158f5f', '2014-08-24 14:43:34', 0, '177c24f6e61e09abb1e5545927589b61', '09222222223', 1, 'الهضبة الخضراء', 2, '2015-02-27', 204, 1, '141.jpeg', 0, 0, 0, 452, ''),
(145, 'عائشه', 'أحمد', '1984-01-03', 'f', 'aisha@yahoo.com', '4badaee57fed5610012a296273158f5f', '2014-11-01 16:15:11', 0, '5608797653e747e563282439b153ceac', '092485555', 2, '', 2, '2015-01-12', 67, 1, '145.jpeg', 0, 0, 0, 16903, ''),
(165, 'عبدالسلام ', 'سالم', '1987-01-18', 'm', 'fatima@yahoo.com', '4badaee57fed5610012a296273158f5f', '2014-11-16 14:22:27', 0, 'd265b01ccd516e25ad1c8fbc96e345b7', '', 1, '', 3, '2014-12-08', 5, 1, '165.jpeg', 0, 0, 0, 72, ''),
(178, 'عبدالرؤوف', 'قريرة', '1992-01-17', '', 'it110t@yahoo.com', '4badaee57fed5610012a296273158f5f', '2015-01-11 19:00:57', 0, '265fd298f9e1a322269654f1659a6506', '0927223001', 1, 'الهضبة الخضراء', 2, '2015-05-13', 16, 1, '', 0, 0, 0, 32, ''),
(180, 'مروة', 'فتحي', '1986-08-17', 'm', 'marwa@yahoo.com', '4badaee57fed5610012a296273158f5f', '2015-01-11 18:37:11', 0, '5a9d6da7e3b7891c290d859d41293efa', '', 2, '', 3, '2015-01-12', 1, 1, '', 0, 0, 0, 0, ''),
(181, 'ضياء', 'العامري', '1988-01-08', 'm', 'dia@yahoo.com', '4badaee57fed5610012a296273158f5f', '2014-08-24 14:43:34', 0, '177c24f6e61e09abb1e5545927589b61', '09222222223', 5, 'الهضبة ', 2, '2015-01-12', 203, 1, '181.png', 0, 0, 0, 451, ''),
(182, 'رامي', 'جمعة', '1985-01-08', 'm', 'rami@yahoo.com', '4badaee57fed5610012a296273158f5f', '2014-08-24 14:43:34', 0, '177c24f6e61e09abb1e5545927589b61', '09222222223', 2, 'الهضبة الخضراء', 2, '2015-01-12', 205, 1, '182.jpeg', 0, 0, 0, 453, ''),
(183, 'رياض', 'حسن', '1973-01-08', 'm', 'ryad@yahoo.com', '4badaee57fed5610012a296273158f5f', '2015-02-02 00:24:11', 0, '4a87214f9aa0197d4f220e1d4b9d775c', '09555555', 1, '', 2, '2015-01-12', 58, 1, '183.jpeg', 0, 0, 0, 7830, ''),
(184, 'حاتم ', 'الصبراتي', '1995-01-08', 'm', 'hatim@yahoo.com', '4badaee57fed5610012a296273158f5f', '2015-02-02 00:24:11', 0, '4a87214f9aa0197d4f220e1d4b9d775c', '09555555', 1, '', 2, '2015-01-12', 58, 1, '184.jpeg', 0, 0, 0, 7842, ''),
(186, 'ساره', 'محمد', '1993-01-08', 'f', 'kaled@yahoo.com', '4badaee57fed5610012a296273158f5f', '2015-02-02 00:24:11', 0, '4a87214f9aa0197d4f220e1d4b9d775c', '09555555', 2, '', 2, '2015-01-11', 57, 1, '92.jpeg', 0, 0, 0, 7826, ''),
(187, 'صلاح', 'محمد', '1984-01-16', 'm', 'salah@yahoo.com', '4badaee57fed5610012a296273158f5f', '2015-02-02 00:24:11', 0, '4a87214f9aa0197d4f220e1d4b9d775c', '09555555', 3, '', 2, '2015-01-12', 60, 1, '187.jpeg', 0, 0, 0, 7853, 'لدي الرغبة في أن أعمل لحساب شركة كبيرة في مجال بيع مواد المنزلية، نظراً لأنني مهتم بالمبيعات بشكل كبير جدا '),
(188, 'موده', 'سالم', '1993-01-08', 'f', 'mawada@yahoo.com', '4badaee57fed5610012a296273158f5f', '2015-02-02 00:24:11', 0, '4a87214f9aa0197d4f220e1d4b9d775c', '09555555', 1, '', 2, '2015-01-12', 58, 1, '', 0, 0, 0, 7829, ''),
(189, 'أحمد', 'الفزاني', '1961-01-17', 'm', 'ahmed@yahoo.com', '4badaee57fed5610012a296273158f5f', '2015-01-11 18:37:11', 0, '5a9d6da7e3b7891c290d859d41293efa', '', 9, '', 2, '2015-01-12', 1, 1, '179.jpeg', 0, 0, 0, 3, ''),
(190, 'myname', 'myaddress', '2015-01-05', 'm', 'ahmefdd@yahoo.com', '4badaee57fed5610012a296273158f5f', '2015-01-05 06:13:14', 0, '', '', 1, '', 2, '', 1, 1, '', 0, 0, 0, 0, ''),
(191, 'myname', 'myaddress', '0000-00-00', '', '', '', '0000-00-00 00:00:00', 0, '', '', 1, '', 2, '', 0, 1, '', 0, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `job_seeker_req`
--

CREATE TABLE IF NOT EXISTS `job_seeker_req` (
  `req_id` int(11) NOT NULL AUTO_INCREMENT,
  `seeker_id` int(11) NOT NULL,
  `req_date` date NOT NULL,
  `desc_id` int(11) NOT NULL,
  PRIMARY KEY (`req_id`),
  KEY `desc_id` (`desc_id`),
  KEY `seeker_id` (`seeker_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;

--
-- Dumping data for table `job_seeker_req`
--

INSERT INTO `job_seeker_req` (`req_id`, `seeker_id`, `req_date`, `desc_id`) VALUES
(53, 141, '2015-01-11', 21),
(54, 92, '2015-01-12', 24),
(55, 92, '2015-01-12', 21),
(56, 178, '2015-01-12', 24),
(57, 182, '2015-01-12', 23),
(58, 182, '2015-01-12', 21),
(59, 182, '2015-01-12', 22),
(60, 187, '2015-01-12', 24),
(61, 187, '2015-01-12', 22),
(62, 187, '2015-01-12', 23),
(63, 141, '2015-01-12', 22),
(64, 145, '2015-01-12', 21),
(65, 145, '2015-01-12', 24);

-- --------------------------------------------------------

--
-- Table structure for table `job_seeker_save`
--

CREATE TABLE IF NOT EXISTS `job_seeker_save` (
  `save_id` int(50) NOT NULL AUTO_INCREMENT,
  `seeker_id` int(20) NOT NULL,
  `emp_id` int(20) NOT NULL,
  PRIMARY KEY (`save_id`),
  KEY `seeker_id` (`seeker_id`),
  KEY `emp_id` (`emp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `job_seeker_save`
--

INSERT INTO `job_seeker_save` (`save_id`, `seeker_id`, `emp_id`) VALUES
(3, 184, 74);

-- --------------------------------------------------------

--
-- Table structure for table `job_skilles`
--

CREATE TABLE IF NOT EXISTS `job_skilles` (
  `skilles_id` int(10) NOT NULL AUTO_INCREMENT,
  `skilles_name` varchar(50) NOT NULL,
  `user_id` int(10) NOT NULL,
  `level_id` int(10) NOT NULL,
  PRIMARY KEY (`skilles_id`),
  KEY `level_id` (`level_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `job_skilles`
--

INSERT INTO `job_skilles` (`skilles_id`, `skilles_name`, `user_id`, `level_id`) VALUES
(7, 'صيانة الحاسوب', 178, 3),
(8, 'التصوير', 92, 3),
(9, 'الأنترنت', 92, 2),
(10, 'البرامج المكتبية', 92, 3),
(11, 'لغة الفيجوال بيسك', 145, 2),
(12, 'ادارة مشاريع', 145, 2),
(13, 'حل المشاكل', 188, 2),
(14, 'تصميم قواعد البيانات', 178, 3),
(15, 'برمجة بإستخدام لغة PHP', 178, 2),
(16, 'CSS3,HTML5,JS', 178, 2),
(17, 'برمجة بإستخدام c#.NET', 178, 2),
(18, 'تصميم واجهات المستخدم', 178, 3);

-- --------------------------------------------------------

--
-- Table structure for table `job_status`
--

CREATE TABLE IF NOT EXISTS `job_status` (
  `status_id` int(5) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(30) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `job_status`
--

INSERT INTO `job_status` (`status_id`, `status_name`) VALUES
(1, 'دوام كامل'),
(2, 'دوام جزئي');

-- --------------------------------------------------------

--
-- Table structure for table `job_train`
--

CREATE TABLE IF NOT EXISTS `job_train` (
  `train_id` int(11) NOT NULL AUTO_INCREMENT,
  `train_name` varchar(100) NOT NULL,
  `train_comp` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`train_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `job_train`
--

INSERT INTO `job_train` (`train_id`, `train_name`, `train_comp`, `user_id`) VALUES
(6, 'تصوير فوتوغرافي', 'معهد المصورين لتصوير', 92);

-- --------------------------------------------------------

--
-- Table structure for table `job_type`
--

CREATE TABLE IF NOT EXISTS `job_type` (
  `type_id` int(20) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(50) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `job_type`
--

INSERT INTO `job_type` (`type_id`, `type_name`) VALUES
(1, 'موظف'),
(2, 'تعاقد'),
(3, 'متدرب'),
(4, 'تطوع');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `job_cert`
--
ALTER TABLE `job_cert`
  ADD CONSTRAINT `job_cert_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `job_seeker` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_cert_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `job_seeker` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_company`
--
ALTER TABLE `job_company`
  ADD CONSTRAINT `job_company_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `job_city` (`city_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_company_ibfk_2` FOREIGN KEY (`comp_type_id`) REFERENCES `job_comp_type` (`comp_type_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_company_ibfk_3` FOREIGN KEY (`domain_id`) REFERENCES `job_domain` (`domain_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `job_description`
--
ALTER TABLE `job_description`
  ADD CONSTRAINT `job_description_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `job_employer` (`emp_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_description_ibfk_10` FOREIGN KEY (`emp_id`) REFERENCES `job_employer` (`emp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `job_description_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `job_city` (`city_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_description_ibfk_3` FOREIGN KEY (`domain_id`) REFERENCES `job_domain` (`domain_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_description_ibfk_4` FOREIGN KEY (`type_id`) REFERENCES `job_type` (`type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_description_ibfk_5` FOREIGN KEY (`salary_id`) REFERENCES `job_salary` (`salary_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_description_ibfk_6` FOREIGN KEY (`nat_id`) REFERENCES `job_nat` (`nat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_description_ibfk_7` FOREIGN KEY (`edt_id`) REFERENCES `job_ed_type` (`edt_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_description_ibfk_8` FOREIGN KEY (`exp_level`) REFERENCES `job_exp_type` (`exp_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_description_ibfk_9` FOREIGN KEY (`status_id`) REFERENCES `job_status` (`status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `job_desc_save`
--
ALTER TABLE `job_desc_save`
  ADD CONSTRAINT `job_desc_save_ibfk_1` FOREIGN KEY (`desc_id`) REFERENCES `job_description` (`desc_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_desc_save_ibfk_2` FOREIGN KEY (`seeker_id`) REFERENCES `job_seeker` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `job_ed`
--
ALTER TABLE `job_ed`
  ADD CONSTRAINT `job_ed_ibfk_1` FOREIGN KEY (`domain_id`) REFERENCES `job_domain` (`domain_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_ed_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `job_seeker` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_ed_ibfk_3` FOREIGN KEY (`edt_id`) REFERENCES `job_ed_type` (`edt_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_ed_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `job_seeker` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_employer`
--
ALTER TABLE `job_employer`
  ADD CONSTRAINT `job_employer_ibfk_1` FOREIGN KEY (`comp_id`) REFERENCES `job_company` (`comp_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_employer_ibfk_2` FOREIGN KEY (`comp_id`) REFERENCES `job_company` (`comp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `job_employer_ibfk_3` FOREIGN KEY (`comp_id`) REFERENCES `job_company` (`comp_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_emp_save`
--
ALTER TABLE `job_emp_save`
  ADD CONSTRAINT `job_emp_save_ibfk_1` FOREIGN KEY (`seeker_id`) REFERENCES `job_seeker` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_emp_save_ibfk_2` FOREIGN KEY (`emp_id`) REFERENCES `job_employer` (`emp_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_emp_save_ibfk_3` FOREIGN KEY (`seeker_id`) REFERENCES `job_seeker` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_exp`
--
ALTER TABLE `job_exp`
  ADD CONSTRAINT `job_exp_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `job_seeker` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_exp_ibfk_2` FOREIGN KEY (`domain_id`) REFERENCES `job_domain` (`domain_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_exp_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `job_seeker` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_hobby`
--
ALTER TABLE `job_hobby`
  ADD CONSTRAINT `job_hobby_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `job_seeker` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_hobby_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `job_seeker` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_info`
--
ALTER TABLE `job_info`
  ADD CONSTRAINT `job_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `job_seeker` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_info_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `job_seeker` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_lang_seeker`
--
ALTER TABLE `job_lang_seeker`
  ADD CONSTRAINT `job_lang_seeker_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `job_seeker` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_lang_seeker_ibfk_2` FOREIGN KEY (`level_id`) REFERENCES `job_level` (`level_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_lang_seeker_ibfk_3` FOREIGN KEY (`lang_id`) REFERENCES `job_lang` (`lang_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_lang_seeker_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `job_seeker` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_ref`
--
ALTER TABLE `job_ref`
  ADD CONSTRAINT `job_ref_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `job_seeker` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `job_seeker`
--
ALTER TABLE `job_seeker`
  ADD CONSTRAINT `job_seeker_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `job_city` (`city_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_seeker_ibfk_2` FOREIGN KEY (`nat_id`) REFERENCES `job_nat` (`nat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `job_seeker_req`
--
ALTER TABLE `job_seeker_req`
  ADD CONSTRAINT `job_seeker_req_ibfk_1` FOREIGN KEY (`seeker_id`) REFERENCES `job_seeker` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_seeker_req_ibfk_2` FOREIGN KEY (`desc_id`) REFERENCES `job_description` (`desc_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_seeker_req_ibfk_3` FOREIGN KEY (`seeker_id`) REFERENCES `job_seeker` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_seeker_save`
--
ALTER TABLE `job_seeker_save`
  ADD CONSTRAINT `job_seeker_save_ibfk_1` FOREIGN KEY (`seeker_id`) REFERENCES `job_seeker` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_seeker_save_ibfk_2` FOREIGN KEY (`emp_id`) REFERENCES `job_employer` (`emp_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `job_skilles`
--
ALTER TABLE `job_skilles`
  ADD CONSTRAINT `job_skilles_ibfk_1` FOREIGN KEY (`level_id`) REFERENCES `job_level` (`level_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_skilles_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `job_seeker` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `job_skilles_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `job_seeker` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_train`
--
ALTER TABLE `job_train`
  ADD CONSTRAINT `job_train_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `job_seeker` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
