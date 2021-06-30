<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Version_301 extends CI_Migration
{
    public function __construct()
    {
        parent::__construct();
    }

    public function up()
    {
        $this->db->query("ALTER TABLE `branch` ADD `teacher_restricted` tinyint(1) DEFAULT '1' AFTER `grd_default_password`;");
    }
}
