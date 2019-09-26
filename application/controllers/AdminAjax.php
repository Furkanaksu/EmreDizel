<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AdminAjax extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/admin_model');
        $this->load->model('admin/product_model');
        $this->load->library('form_validation');
        $this->load->library('EnumStatus');

        $pageCheck = $this->uri->segment(2);
        //echo $pageCheck;
        // die();

        if ($pageCheck != '' && $pageCheck != 'login_validation') {
            if ($this->session->userdata('Id') == NULL || $this->session->userdata('Email') == NULL) {
                redirect(site_url() . 'admin');
            }
        }

    }

    function DetailContact($contactId)
    {
        $whereData = array('Id' =>$contactId);
        $resultArray = $this->admin_model->Contacts($whereData);
        if(count($resultArray) == 0)
        {
            json_output(200, array());
        }

        json_output(200, $resultArray[0]);
    }
}