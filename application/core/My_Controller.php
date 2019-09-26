<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $lang=$this->uri->segment(1);
        $this->lang->load($lang,$lang);
    }
}