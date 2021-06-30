<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Version_405 extends CI_Migration
{
    public function __construct()
    {
        parent::__construct();
    }

    public function up()
    {
        
		$this->db->query("ALTER TABLE `payment_config` ADD `stripe_publishiable` varchar(255) DEFAULT NULL AFTER `stripe_secret`;");
		$this->db->query("ALTER TABLE `payment_config` ADD `sslcz_store_id` varchar(255) DEFAULT NULL AFTER `razorpay_status`;");
		$this->db->query("ALTER TABLE `payment_config` ADD `sslcz_store_passwd` varchar(255) DEFAULT NULL AFTER `sslcz_store_id`;");
		$this->db->query("ALTER TABLE `payment_config` ADD `sslcommerz_sandbox` tinyint(1) DEFAULT NULL AFTER `sslcz_store_passwd`;");
		$this->db->query("ALTER TABLE `payment_config` ADD `sslcommerz_status` tinyint(1) DEFAULT NULL AFTER `sslcommerz_sandbox`;");
		
		$this->db->query("ALTER TABLE `payment_config` ADD `jazzcash_merchant_id` varchar(255) DEFAULT NULL AFTER `sslcommerz_status`;");
		$this->db->query("ALTER TABLE `payment_config` ADD `jazzcash_passwd` varchar(255) DEFAULT NULL AFTER `jazzcash_merchant_id`;");
		$this->db->query("ALTER TABLE `payment_config` ADD `jazzcash_integerity_salt` varchar(255) DEFAULT NULL AFTER `jazzcash_passwd`;");
		$this->db->query("ALTER TABLE `payment_config` ADD `jazzcash_sandbox` tinyint(1) DEFAULT NULL AFTER `jazzcash_integerity_salt`;");
		$this->db->query("ALTER TABLE `payment_config` ADD `jazzcash_status` tinyint(1) DEFAULT NULL AFTER `jazzcash_sandbox`;");
		
		$this->db->query("ALTER TABLE `payment_config` ADD `midtrans_client_key` varchar(255) DEFAULT NULL AFTER `jazzcash_status`;");
		$this->db->query("ALTER TABLE `payment_config` ADD `midtrans_server_key` varchar(255) DEFAULT NULL AFTER `midtrans_client_key`;");
		$this->db->query("ALTER TABLE `payment_config` ADD `midtrans_sandbox` tinyint(1) DEFAULT NULL AFTER `midtrans_server_key`;");
		$this->db->query("ALTER TABLE `payment_config` ADD `midtrans_status` tinyint(1) DEFAULT NULL AFTER `midtrans_sandbox`;");
		
		$this->db->query("TRUNCATE TABLE `payment_types`;");
		$this->db->query("INSERT INTO `payment_types` (`id`, `name`, `branch_id`, `timestamp`) VALUES
						(1, 'Cash', 0, '2019-07-27 18:12:21'),
						(2, 'Card', 0, '2019-07-27 18:12:31'),
						(3, 'Cheque', 0, '2019-12-21 10:07:59'),
						(4, 'Bank Transfer', 0, '2019-12-21 10:08:36'),
						(5, 'Other', 0, '2019-12-21 10:08:45'),
						(6, 'Paypal', 0, '2019-12-21 10:08:45'),
						(7, 'Stripe', 0, '2019-12-21 10:08:45'),
						(8, 'PayUmoney', 0, '2019-12-21 10:08:45'),
						(9, 'Paystack', 0, '2019-12-21 10:08:45'),
						(10, 'Razorpay', 0, '2019-12-21 10:08:45'),
						(11, 'SSLcommerz', 0, '2021-05-21 10:08:45'),
						(12, 'Jazzcash', 0, '2021-05-21 10:08:45'),
						(13, 'Midtrans', 0, '2021-05-21 10:08:45');");
						
						
		$cms_home = $this->db->get("front_cms_home")->result_array();
		if (count($cms_home) > 0) {
			foreach ($cms_home as $item) {
				$this->db->where('id', $item['id']);
				$this->db->update("front_cms_home", array('active' => 1));
			}
		}
		
		$this->db->query("INSERT INTO `permission` (`module_id`, `name`, `prefix`, `show_view`, `show_add`, `show_edit`, `show_delete`, `created_at`) VALUES (6, 'Teacher Timetable', 'teacher_timetable', 1, 0, 0, 0, '2021-03-31 09:46:30');");
		
		$this->db->query("ALTER TABLE `front_cms_admission` ADD `terms_conditions_title` varchar(255) DEFAULT NULL AFTER `page_title`;");
		$this->db->query("ALTER TABLE `front_cms_admission` ADD `terms_conditions_description` varchar(255) DEFAULT NULL AFTER `terms_conditions_title`;");
		$this->db->query("ALTER TABLE `front_cms_admission` ADD `fee_elements` text AFTER `terms_conditions_description`;");
		
		$this->db->query("ALTER TABLE `online_admission` ADD `payment_status` tinyint(1) NOT NULL DEFAULT '0' AFTER `status`;");
		$this->db->query("ALTER TABLE `online_admission` ADD `payment_amount` decimal(18,2) NOT NULL AFTER `payment_status`;");
		$this->db->query("ALTER TABLE `online_admission` ADD `payment_details` longtext NOT NULL AFTER `payment_amount`;");
		
		$this->db->query("TRUNCATE TABLE `email_templates`;");
		$this->db->query("INSERT INTO `email_templates` (`id`, `name`, `tags`) VALUES
						(1, 'account_registered', '{institute_name}, {name}, {login_username}, {password}, {user_role}, {login_url}'),
						(2, 'forgot_password', '{institute_name}, {username}, {email}, {reset_url}'),
						(3, 'change_password', '{institute_name}, {name}, {email}, {password}'),
						(4, 'new_message_received', '{institute_name}, {recipient}, {message}, {message_url}'),
						(5, 'payslip_generated', '{institute_name}, {username}, {month_year}, {payslip_url}'),
						(6, 'award', '{institute_name}, {winner_name}, {award_name}, {gift_item}, {award_reason}, {given_date}'),
						(7, 'leave_approve', '{institute_name}, {applicant_name}, {start_date}, {end_date}, {comments}'),
						(8, 'leave_reject', '{institute_name}, {applicant_name}, {start_date}, {end_date}, {comments}'),
						(9, 'advance_salary_approve', '{institute_name}, {applicant_name}, {deduct_motnh}, {amount}, {comments}'),
						(10, 'advance_salary_reject', '{institute_name}, {applicant_name}, {deduct_motnh}, {amount}, {comments}'),
						(11, 'apply_online_admission', '{institute_name}, {admission_id}, {applicant_name}, {applicant_mobile}, {class}, {section}, {apply_date}, {payment_url}, {admission_copy_url}, {paid_amount}'),
						(12, 'student_admission', '{institute_name}, {academic_year}, {admission_date}, {admission_no}, {roll}, {category}, {student_name}, {student_mobile}, {class}, {section}, {login_username}, {password}, {login_url}');");
						
        $config_path = APPPATH . 'config/config.php';
        $config_file = file_get_contents($config_path);
        $config_file = trim($config_file);
		$config_file = str_replace("\$config['csrf_protection'] == TRUE && isset(\$_SERVER['REQUEST_URI']) && strpos(\$_SERVER['REQUEST_URI'],'feespayment/') !== FALSE", "\$config['csrf_protection'] == TRUE && isset(\$_SERVER['REQUEST_URI']) && (strpos(\$_SERVER['REQUEST_URI'],'feespayment/') !== FALSE || strpos(\$_SERVER['REQUEST_URI'],'admissionpayment/') !== FALSE)", $config_file);
		$handle = fopen($config_path, 'w+');
		@chmod($config_path, 0777);
		fwrite($handle, $config_file);
		fclose($handle);
    }
}
