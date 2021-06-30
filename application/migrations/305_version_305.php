<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Version_305 extends CI_Migration
{
    public function __construct()
    {
        parent::__construct();
    }

    public function up()
    {
        $this->db->query("ALTER TABLE `global_settings` ADD `preloader_backend` tinyint(1) DEFAULT '1' AFTER `cron_secret_key`;");
        $this->db->query("ALTER TABLE `live_class` ADD `live_class_method` tinyint(1) DEFAULT '1' AFTER `id`;");
        $this->db->query("ALTER TABLE `live_class` ADD `own_api_key` tinyint(1) DEFAULT '0' AFTER `meeting_password`;");
        $this->db->query("ALTER TABLE `live_class` ADD `duration` int(11) DEFAULT '0' AFTER `own_api_key`;");
        $this->db->query("ALTER TABLE `live_class` ADD `bbb` longtext NOT NULL AFTER `duration`;");
        $this->db->query("ALTER TABLE `live_class` ADD `status` tinyint(1) DEFAULT '0' AFTER `created_by`;");
        $this->db->query("ALTER TABLE `live_class_config` ADD `bbb_salt_key` varchar(355) DEFAULT NULL AFTER `zoom_api_secret`;");
        $this->db->query("ALTER TABLE `live_class_config` ADD `bbb_server_base_url` varchar(355) DEFAULT NULL AFTER `bbb_salt_key`;");
        $this->db->query("ALTER TABLE `live_class_config` ADD `staff_api_credential` tinyint(1) NOT NULL DEFAULT '0' AFTER `bbb_server_base_url`;");
        $this->db->query("ALTER TABLE `live_class_config` ADD `student_api_credential` tinyint(1) NOT NULL DEFAULT '0' AFTER `staff_api_credential`;");
        $this->db->query("INSERT INTO `permission` (`id`, `module_id`, `name`, `prefix`, `show_view`, `show_add`, `show_edit`, `show_delete`, `created_at`) VALUES
		 (129, 19, 'Live Class Reports', 'live_class_reports', 1, 0, 0, 0, '2020-03-31 09:46:30');");
		$this->db->query("CREATE TABLE IF NOT EXISTS `live_class_reports` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `live_class_id` int(11) NOT NULL,
						  `student_id` int(11) NOT NULL,
						  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
						  PRIMARY KEY (`id`)
						) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
		$this->db->query("CREATE TABLE IF NOT EXISTS `zoom_own_api` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `user_type` tinyint(1) NOT NULL,
						  `user_id` int(11) NOT NULL,
						  `zoom_api_key` varchar(255) NOT NULL,
						  `zoom_api_secret` varchar(255) NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    }
}
