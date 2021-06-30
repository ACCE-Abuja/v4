<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Version_400 extends CI_Migration
{
    public function __construct()
    {
        parent::__construct();
    }

    public function up()
    {
        $this->db->query("CREATE TABLE IF NOT EXISTS `front_cms_admitcard` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `page_title` varchar(255) DEFAULT NULL,
						  `templete_id` int(11) NOT NULL,
						  `banner_image` varchar(255) DEFAULT NULL,
						  `description` text NOT NULL,
						  `meta_description` text NOT NULL,
						  `meta_keyword` text NOT NULL,
						  `branch_id` int(11) NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;");
		$this->db->query("INSERT INTO `front_cms_admitcard` (`id`, `page_title`, `templete_id`, `banner_image`, `description`, `meta_description`, `meta_keyword`, `branch_id`) VALUES
						(1, 'Admit Card', 1, 'admit_card1.jpg', '', 'Ramom - School Management System With CMS', 'Ramom Admit Card Page', 1);");
						
        $this->db->query("CREATE TABLE IF NOT EXISTS `front_cms_certificates` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `page_title` varchar(255) DEFAULT NULL,
						  `banner_image` varchar(255) DEFAULT NULL,
						  `description` text NOT NULL,
						  `meta_description` text NOT NULL,
						  `meta_keyword` text NOT NULL,
						  `branch_id` int(11) NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;");
		$this->db->query("INSERT INTO `front_cms_certificates` (`id`, `page_title`, `banner_image`, `description`, `meta_description`, `meta_keyword`, `branch_id`) VALUES
						(1, 'Certificates', 'certificates1.jpg', '', 'Ramom - School Management System With CMS', 'Ramom Admit Card Page', 1);");
        $this->db->query("CREATE TABLE IF NOT EXISTS `front_cms_exam_results` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `page_title` varchar(255) DEFAULT NULL,
						  `grade_scale` tinyint(1) NOT NULL,
						  `attendance` tinyint(1) NOT NULL,
						  `banner_image` varchar(255) DEFAULT NULL,
						  `description` text NOT NULL,
						  `meta_description` text NOT NULL,
						  `meta_keyword` text NOT NULL,
						  `branch_id` int(11) NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;");
		$this->db->query("INSERT INTO `front_cms_exam_results` (`id`, `page_title`, `grade_scale`, `attendance`, `banner_image`, `description`, `meta_description`, `meta_keyword`, `branch_id`) VALUES
						(1, 'Exam Results', 1, 1, 'exam_results1.jpg', '', 'Ramom - School Management System With CMS', 'Ramom Admit Card Page', 1);");
						
        $this->db->query("CREATE TABLE IF NOT EXISTS `front_cms_gallery` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `page_title` varchar(255) DEFAULT NULL,
						  `banner_image` varchar(255) DEFAULT NULL,
						  `meta_description` text NOT NULL,
						  `meta_keyword` text NOT NULL,
						  `branch_id` int(11) NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;");
		$this->db->query("INSERT INTO `front_cms_gallery` (`id`, `page_title`, `banner_image`, `meta_description`, `meta_keyword`, `branch_id`) VALUES
						(1, 'Gallery', 'gallery1.jpg', 'Ramom - School Management System With CMS', 'Ramom Gallery  Page', 1);");
						
        $this->db->query("CREATE TABLE IF NOT EXISTS `front_cms_gallery_category` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `name` varchar(255) NOT NULL,
						  `branch_id` int(11) NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
						
        $this->db->query("CREATE TABLE IF NOT EXISTS `front_cms_gallery_content` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `title` varchar(255) NOT NULL,
						  `alias` varchar(255) NOT NULL,
						  `description` varchar(255) NOT NULL,
						  `thumb_image` varchar(255) NOT NULL,
						  `date` date NOT NULL,
						  `category_id` int(11) NOT NULL,
						  `added_by` int(11) NOT NULL,
						  `file_type` varchar(255) NOT NULL,
						  `elements` longtext NOT NULL,
						  `show_web` tinyint(4) NOT NULL DEFAULT '0',
						  `branch_id` int(11) NOT NULL,
						  `created_at` date NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
						
        $this->db->query("CREATE TABLE IF NOT EXISTS `front_cms_menu_visible` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `name` varchar(100) DEFAULT NULL,
						  `menu_id` int(11) NOT NULL,
						  `parent_id` varchar(11) DEFAULT NULL,
						  `ordering` varchar(20) DEFAULT NULL,
						  `invisible` tinyint(2) NOT NULL DEFAULT '1',
						  `branch_id` int(11) NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=InnoDB DEFAULT CHARSET=utf8;");


        $this->db->query("INSERT INTO `permission` (`id`, `module_id`, `name`, `prefix`, `show_view`, `show_add`, `show_edit`, `show_delete`, `created_at`) VALUES
		(130, 16, 'Fees Revert', 'fees_revert', 0, 0, 0, 1, '2020-03-31 15:46:30');");
		
        $this->db->query("INSERT INTO `permission` (`id`, `module_id`, `name`, `prefix`, `show_view`, `show_add`, `show_edit`, `show_delete`, `created_at`) VALUES
		(131, 22, 'Frontend Gallery', 'frontend_gallery', 1, 1, 1, 1, '2020-03-31 15:46:30');");
		
        $this->db->query("INSERT INTO `permission` (`id`, `module_id`, `name`, `prefix`, `show_view`, `show_add`, `show_edit`, `show_delete`, `created_at`) VALUES
		(132, 22, 'Frontend Gallery Category', 'frontend_gallery_category', 1, 1, 1, 1, '2020-03-31 15:46:30');");
		
		$this->db->query("INSERT INTO `sms_api` (`id`, `name`) VALUES (6, 'smscountry');");
		
		$this->db->query("INSERT INTO `front_cms_menu` (`id`, `title`, `alias`, `ordering`, `parent_id`, `open_new_tab`, `ext_url`, `ext_url_address`, `publish`, `system`, `branch_id`, `created_at`) VALUES
						(8, 'Pages', 'pages', 8, 0, 0, 1, '#', 1, 1, 0, '2019-08-09 12:18:54'),
						(9, 'Admit Card', 'admit_card', 9, 8, 0, 0, '', 1, 1, 0, '2021-03-16 04:24:32'),
						(10, 'Exam Results', 'exam_results', 10, 8, 0, 0, '', 1, 1, 0, '2021-03-16 04:24:32'),
						(11, 'Certificates', 'certificates', 11, 8, 0, 0, '', 1, 1, 0, '2021-03-21 12:04:44'),
						(12, 'Gallery', 'gallery', 7, 0, 0, 0, '', 1, 1, 0, '2021-03-21 12:04:44');");

		$this->db->query("UPDATE `front_cms_menu` SET `ordering`=9 WHERE `id`=7");
    }
}
