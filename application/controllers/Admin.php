<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'third_party/UploadHandler.php';

class Admin extends CI_Controller {
    //functions

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/admin_model');
        $this->load->model('admin/product_model');
        $this->load->library('form_validation');
        $this->load->library('EnumStatus');

        $pageCheck = $this->uri->segment(2);
        //        //echo $pageCheck;
       // die();

        if($pageCheck != ''&& $pageCheck != 'login_validation')
        {
            if($this->session->userdata('Id') == NULL || $this->session->userdata('Email') == NULL)
            {
                redirect(site_url().'admin');
            }
        }


        $lang = $this->uri->segment(1);
        if($lang == 'admin'){
            $lang='en';

            $page = $this->uri->segment(2);
            if($page != 'setLang'){
                $this->session->set_userdata('referred_from', str_replace('/index.php','',current_url()));
            }
        } else {
            $page = $this->uri->segment(3);
            if($page != 'setLang'){
                $this->session->set_userdata('referred_from', str_replace('/index.php','',current_url()));
            }
        }
        $this->lang->load($lang,$lang);
    }

//--------------------------------------------------------------------------------------------------------
    function setLang($lang)
    {
        $previousUrl = $this->session->userdata('referred_from');
        //echo 'previousUrl:'.$previousUrl;
        // echo '<br/>';
        $previousUrl = str_replace(base_url(), '', $previousUrl);
        //echo 'previousUrl:'.$previousUrl;
        //echo '<br/>';
        $previousLang = explode('/', $previousUrl);
        $previousLang = $previousLang[0];
        //echo 'previouslang:' . $previousLang;
        //echo '<br/>';
        //die();

        if ($previousLang != 'admin') {
            if ($lang == 'en') {
                $previousUrl = str_replace($previousLang . '/', '', $previousUrl);
            } else {
                $previousUrl = str_replace($previousLang, $lang, $previousUrl);
            }
        } else {
            if ($lang == 'en') {
                $previousUrl = $previousUrl;
            } else {
                $previousUrl = $lang . '/' . $previousUrl;
            }
        }

        $this->session->set_userdata('lang',$lang);


        $newUrl = base_url().$previousUrl;
        //echo 'baseurl:'.base_url();
        //echo '<br/>';
        //echo 'previousUrl:'.$previousUrl;
        //echo '<br/>';
        //echo 'newUrl:'.$newUrl;
        //die();
        redirect($newUrl);
    }
    function index()
    {
        $data['title'] = 'Admin Login';
        $this->load->view("admin/login");
    }
    function login_validation()
    {
        $this-> form_validation->set_rules('login-email', 'Username', 'required');
        $this->form_validation->set_rules('login-password', 'Password', 'required');
        if($this->form_validation->run())
        {

            $UserEmail = $this->input->post('login-email');
            $UserPassword = $this->input->post('login-password');

            $AdminCheck = $this->admin_model->login($UserEmail, $UserPassword);
            if(count($AdminCheck)> 0)
            {
                if($AdminCheck->Status != 1)
                {
                    $this->session->set_flashdata('Message',$this->lang->line('notActive'));
                    redirect(site_url() . 'admin');

                    return;
                }
                $session_data = array(
                    'Email'     =>     $AdminCheck->Email,
                    'Id'     =>     $AdminCheck->Id,
                    'IP'     =>     $AdminCheck->IP,
                    'LoginDate'=>     $AdminCheck->LoginDate,
                    'FailedDate'=>     $AdminCheck->FailedDate,
                    'Name'=>     $AdminCheck->Name,
                    'Surname'=>     $AdminCheck->Surname,
                    'OS'=>     $AdminCheck->OS,
                    'Browser'=>     $AdminCheck->Browser

                );
                $this->session->set_userdata($session_data);

                redirect(site_url() . 'admin/dashboard');

                //$this->load->view("admin/logout");
            }
            else
            {
                $this->session->set_flashdata('error', $this->lang->line('invalidInfo'));
                redirect(site_url() . 'admin');
            }
        }
        else
        {
            $this->login();
        }
    }
    function dashboard()
    {
        $data = array();
        $data['MetaTitle']='Dashboard';
        $data['MetaDescription']='admin/dashboard';
        $data['View']='admin/dashboard';
        $this->load->view('admin/template', $data);
    }
    function enter(){
        if($this->session->userdata('username') != '')
        {
            echo '<h2>Welcome - '.$this->session->userdata('username').'</h2>';
            echo '<label><a href="'.site_url

                ().'admin/logout">Logout</a></label>';
        }
        else
        {
            redirect(site_url() . 'admin/login');
        }
    }
    function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url() . 'admin');
    }
//---------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------
    function getAdmins()
    {
        $data = array();
        $data['admin'] = $this->admin_model->getAdmins();
        $data['MetaTitle']='Admins';
        $data['MetaDescription']='admin/getAdmins';
        $data['View']='admin/admins';
        $this->load->view('admin/template', $data);
    }
    function Categories()
    {
        $data = array();
        $data['CategoryList'] = $this->product_model->Categories();
        $data['MetaTitle']='Categories';
        $data['MetaDescription']='admin/getCategories';
        $data['View']='admin/categories';
        $this->load->view('admin/template', $data);
    }
    function Products($page = 1)
    {
        $search = $this->input->post('search');
        if($search != '' && $search != null)
        {
            $data = array();
            $data['CurrentPage'] = $page;
            $page = $page - 1;
            $start = ($page * PAGE_LIMIT);
            $productArray = $this->product_model->Products(array(),$start ,PAGE_LIMIT, 'DESC', array('Firma'=> $search));
            $data['Products'] = $productArray['Data'];
            $data['TotalPage'] = ceil($productArray['TotalRecord'] / PAGE_LIMIT);
            $data['Categories'] = $this->product_model->Categories();
            $data['MetaTitle']='Products';
            $data['MetaDescription']='admin/Products';
            $data['View']='admin/Products';
            $this->load->view('admin/template', $data);
        }else{
            $data = array();
            $data['CurrentPage'] = $page;
            $page = $page - 1;
            $start = ($page * PAGE_LIMIT);
            $productArray = $this->product_model->Products(array(),$start);
            $data['Products'] = $productArray['Data'];
            $data['TotalPage'] = ceil($productArray['TotalRecord'] / PAGE_LIMIT);
            $data['Categories'] = $this->product_model->Categories();
            $data['MetaTitle']='Products';
            $data['MetaDescription']='admin/Products';
            $data['View']='admin/Products';
            $this->load->view('admin/template', $data);
        }

    }
    function Contacts()
    {
        $data = array();
        $data['contacts'] = $this->admin_model->Contacts();
        $data['MetaTitle']='Contacts';
        $data['MetaDescription']='admin/Contacts';
        $data['View']='admin/contacts';
        $this->load->view('admin/template', $data);
    }
//--------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------

    function AddAdmin()
    {
        $data = array();
        $data['MetaTitle']='AddNewAdmin';
        $data['MetaDescription']='admin/AddNewAdmin';
        $data['View']='admin/AddAdmin';

        if(!empty($this->input->post()))
        {
            $this-> form_validation->set_rules('Name', 'Name', 'required|min_length[2]');
            $this->form_validation->set_rules('Email', 'Email', 'required|min_length[4]|is_unique[admins.Email]|valid_email');
            $this->form_validation->set_rules('Password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('Status', 'Status', 'required|min_length[1]');
            $this->form_validation->set_rules('Surname', 'Surname', 'required|min_length[2]');
            $this->form_validation->set_rules('AddedDate', 'AddedDate', 'required|min_length[10]');
            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('MessageType','danger');
                $this->session->set_flashdata('Message', validation_errors());
                $this->load->view('admin/template', $data);
                return;
            }

            $formData=array(
                'Name'=>$this->input->post('Name'),
                'Email'=>$this->input->post('Email'),
                'Password'=>$this->input->post('Password'),
                'Status'=>$this->input->post('Status'),
                'Surname'=>$this->input->post('Surname'),
                'AddedDate'=>$this->input->post('AddedDate')
            );
            $resultArray = $this->admin_model->addAdmin($formData);

            if(isset($resultArray['Errors']) && count($resultArray ['Errors']) > 0){
                $this->session->set_flashdata('MessageType','danger');
                $this->session->set_flashdata('Message',$resultArray['Errors'][0]);
                return;
            } else if(count($resultArray['Data']) > 0) {
                $this->session->set_flashdata('MessageType','success');
                $this->session->set_flashdata('Message',$this->lang->line('adminAddSuccess'));
                redirect(site_url() . 'admin/GetAdmins');
            }

            $this->session->set_flashdata('MessageType','danger');
            $this->session->set_flashdata('Message',$this->lang->line('somethingWentWrong'));
        }

        $this->load->view('admin/template', $data);
    }
    function AddCategories()
    {
        $data = array();
        $data['MetaTitle']='AddCategories';
        $data['categories'] = $this->product_model->Categories();
        $data['MetaDescription']='admin/AddCategories';
        $data['View']='admin/AddCategories';

        if(!empty($this->input->post()))
        {
            $this-> form_validation->set_rules('Name', 'Name', 'required|min_length[2]');
            $this->form_validation->set_rules('AddedDate', 'AddedDate', 'required|min_length[2]');
            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('MessageType','danger');
                $this->session->set_flashdata('Message', validation_errors());
                $this->load->view('admin/template', $data);
                return;
            }
            $formData=array(
                'Name'=>$this->input->post('Name'),
                'AddedDate'=>$this->input->post('AddedDate'),
            );
            $resultArray = $this->admin_model->addCategories($formData);

            if(isset($resultArray['Errors']) && count($resultArray ['Errors']) > 0){
                $this->session->set_flashdata('MessageType','danger');
                $this->session->set_flashdata('Message',$resultArray['Errors'][0]);
                return;
            } else if(count($resultArray['Data']) > 0) {
                $this->session->set_flashdata('MessageType','success');
                $this->session->set_flashdata('Message' , $this->lang->line('categoryAddSuccess'));
                redirect(site_url() . 'admin/Categories');
            }

            $this->session->set_flashdata('MessageType','danger');
            $this->session->set_flashdata('Message', $this->lang->line('somethingWentWrong'));
        }

        $this->load->view('admin/template', $data);
    }
    function AddProduct()
    {
        $data = array();
        $data['MetaTitle']='AddProducts';
        $data['MetaDescription']='admin/AddProducts';
        $data['View']='admin/addProduct';
        $data['CategoryList'] = $this->product_model->Categories();

        if(!empty($this->input->post()))
        {
            $this-> form_validation->set_rules('Firma', 'Firma', 'required|min_length[2]');
            $this->form_validation->set_rules('CategoryId', 'CategoryId');
            $this->form_validation->set_rules('AddedDate', 'AddedDate', 'required|min_length[10]');
            $this->form_validation->set_rules('Power', 'Power', 'required|min_length[1]');
            $this->form_validation->set_rules('SeriNo', 'SeriNo');
            $this->form_validation->set_rules('MotorTipi', 'MotorTipi');
            $this->form_validation->set_rules('Alternator', 'Alternator');
            $this->form_validation->set_rules('AlternatorNo', 'AlternatorNo');
            $this->form_validation->set_rules('Kabin', 'Kabin');
            $this->form_validation->set_rules('YagFiltresi', 'YagFiltresi');
            $this->form_validation->set_rules('YagLitre', 'YagLitre');
            $this->form_validation->set_rules('AntifrizFiltre', 'AntifrizFiltre');
            $this->form_validation->set_rules('MazotFiltresi', 'MazotFiltresi');
            $this->form_validation->set_rules('YakitFiltresi', 'YakitFiltresi');
            $this->form_validation->set_rules('Aku', 'Aku');
            $this->form_validation->set_rules('IsiticiHortumu', 'IsiticiHortumu');
            $this->form_validation->set_rules('KontrolPaneli', 'KontrolPaneli');
            $this->form_validation->set_rules('Rezistans', 'Rezistans');
            $this->form_validation->set_rules('Termostat', 'Termostat');
            $this->form_validation->set_rules('FanKayisi', 'FanKayisi');
            $this->form_validation->set_rules('TamponSarj', 'TamponSarj');
            $this->form_validation->set_rules('Avr', 'Avr');
            $this->form_validation->set_rules('MarsMotoru', 'MarsMotoru');
            $this->form_validation->set_rules('SarjDinamosu', 'SarjDinamosu');
            $this->form_validation->set_rules('YagMusuru', 'YagMusuru');
            $this->form_validation->set_rules('HararetMusuru', 'HararetMusuru');
            $this->form_validation->set_rules('YakitOtomatigi', 'YakitOtomatigi');
            $this->form_validation->set_rules('Turbo', 'Turbo');
            $this->form_validation->set_rules('Devirdaim', 'Devirdaim');
            $this->form_validation->set_rules('Width', 'Width');
            $this->form_validation->set_rules('Height', 'Height');

            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('MessageType','danger');
                $this->session->set_flashdata('Message', validation_errors());
                $this->load->view('admin/template', $data);
                return;
            }

            $formData=array(
                'Firma'=>$this->input->post('Firma'),
                'CategoryId'=>$this->input->post('Marka'),
                'AddedDate'=>$this->input->post('AddedDate'),
                'Power'=>$this->input->post('Power'),
                'SeriNo'=>$this->input->post('SeriNo'),
                'MotorTipi'=>$this->input->post('MotorTipi'),
                'Alternator'=>$this->input->post('Alternator'),
                'AlternatorNo'=>$this->input->post('AlternatorNo'),
                'Kabin'=>$this->input->post('Kabin'),
                'YagFiltresi'=>$this->input->post('YagFiltresi'),
                'YagLitre'=>$this->input->post('YagLitre'),
                'AntifrizFiltre'=>$this->input->post('AntifrizFiltre'),
                'MazotFiltresi'=>$this->input->post('MazotFiltresi'),
                'YakitFiltresi'=>$this->input->post('YakitFiltresi'),
                'Aku'=>$this->input->post('Aku'),
                'IsiticiHortumu'=>$this->input->post('IsiticiHortumu'),
                'KontrolPaneli'=>$this->input->post('KontrolPaneli'),
                'Rezistans'=>$this->input->post('Rezistans'),
                'Termostat'=>$this->input->post('Termostat'),
                'FanKayisi'=>$this->input->post('FanKayisi'),
                'TamponSarj'=>$this->input->post('TamponSarj'),
                'Avr'=>$this->input->post('Avr'),
                'MarsMotoru'=>$this->input->post('MarsMotoru'),
                'SarjDinamosu'=>$this->input->post('SarjDinamosu'),
                'YagMusuru'=>$this->input->post('YagMusuru'),
                'HararetMusuru'=>$this->input->post('HararetMusuru'),
                'YakitOtomatigi'=>$this->input->post('YakitOtomatigi'),
                'Turbo'=>$this->input->post('Turbo'),
                'Devirdaim'=>$this->input->post('Devirdaim'),
                'Width'=>$this->input->post('Width'),
                'Height'=>$this->input->post('Height')
            );
            $resultArray = $this->admin_model->AddProducts($formData);

            if(isset($resultArray['Errors']) && count($resultArray ['Errors']) > 0){
                $this->session->set_flashdata('MessageType','danger');
                $this->session->set_flashdata('Message',$resultArray['Errors'][0]);
                return;
            } else if(count($resultArray['Data']) > 0) {
                $this->session->set_flashdata('MessageType','success');
                $this->session->set_flashdata('Message', $this->lang->line('productAddSuccess'));
                redirect(site_url() . 'admin/Products');
            }

            $this->session->set_flashdata('MessageType','danger');
            $this->session->set_flashdata('Message', $this->lang->line('somethingWentWrong'));
        }

        $this->load->view('admin/template', $data);
    }
    function AddContact()
    {
        $data = array();
        $data['MetaTitle']='addContact';
        $data['MetaDescription']='admin/addContact';
        $data['View']='admin/addContact';

        if(!empty($this->input->post()))
        {
            $this-> form_validation->set_rules('Name', 'Name', 'required|min_length[2]');
            $this->form_validation->set_rules('PhoneNumber', 'PhoneNumber');
            $this->form_validation->set_rules('Mail', 'Mail', 'required|min_length[2]');
            $this->form_validation->set_rules('Price', 'Price', 'required|min_length[1]');

            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('MessageType','danger');
                $this->session->set_flashdata('Message', validation_errors());
                $this->load->view('admin/template', $data);
                return;
            }

            $formData=array(
                'Name'=>$this->input->post('Name'),
                'PhoneNumber'=>$this->input->post('PhoneNumber'),
                'Mail'=>$this->input->post('Mail'),
                'Price'=>$this->input->post('Price'),
            );
            $resultArray = $this->admin_model->AddContacts($formData);

            if(isset($resultArray['Errors']) && count($resultArray ['Errors']) > 0){
                $this->session->set_flashdata('MessageType','danger');
                $this->session->set_flashdata('Message',$resultArray['Errors'][0]);
                return;
            } else if(count($resultArray['Data']) > 0) {
                $this->session->set_flashdata('MessageType','success');
                $this->session->set_flashdata('Message', $this->lang->line('productAddSuccess'));
                redirect(site_url() . 'admin/Contacts');
            }

            $this->session->set_flashdata('MessageType','danger');
            $this->session->set_flashdata('Message', $this->lang->line('somethingWentWrong'));
        }

        $this->load->view('admin/template', $data);
    }
//--------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------
    function UpdateCategory($categoryId){
        $data = array();
        $data['AdminDetail'] = $this->product_model->Categories(array('Id'=> $categoryId));
        $data['MetaTitle']='UpdateCategory';
        $data['MetaDescription']='admin/UpdateCategory';
        $data['View']='admin/UpdateCategory';

        if(!empty($this->input->post()))
        {$this-> form_validation->set_rules('Title', 'Title', 'required|min_length[2]');
            $this->form_validation->set_rules('Description', 'Description', 'required|min_length[4]');
            $this->form_validation->set_rules('Status', 'Status', 'required|min_length[1]');
            $this->form_validation->set_rules('AddedDate', 'AddedDate', 'required|min_length[8]');
            $this->form_validation->set_rules('UpdatedDate', 'UpdatedDate', 'required|min_length[8]');
            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('MessageType','danger');
                $this->session->set_flashdata('Message', validation_errors());
                $this->load->view('admin/template', $data);
                return;
            }

            $formData=array(
                'Title'=>$this->input->post('Title'),
                'Description'=>$this->input->post('Description'),
                'Status'=>$this->input->post('Status'),
                'AddedDate'=>$this->input->post('AddedDate'),
                'UpdatedDate'=>$this->input->post('UpdatedDate')
            );

            $whereData = array('Id' =>$categoryId);
            $resultArray = $this->admin_model->UpdateCategory($whereData,$formData);

            if(isset($resultArray['Errors']) && count($resultArray ['Errors']) > 0){
                $this->session->set_flashdata('MessageType','danger');
                $this->session->set_flashdata('Message',$resultArray['Errors'][0]);
                return;
            } else if(count($resultArray['Data']) > 0) {
                $this->session->set_flashdata('MessageType','success');
                $this->session->set_flashdata('Message', $this->lang->line('categoryUpdateSuccess'));
                redirect(site_url() . 'admin/UpdateCategory/'.$categoryId);
            }

            $this->session->set_flashdata('MessageType','danger');
            $this->session->set_flashdata('Message', $this->lang->line('somethingWentWrong'));
        }

        $this->load->view('admin/template', $data);
    }
    function UpdateAdmin($adminId){
        $data = array();
        $data['AdminDetail'] = $this->admin_model->getAdmins(array('Id'=> $adminId));
        $data['MetaTitle']='UpdateAdmin';
        $data['MetaDescription']='admin/UpdateAdmin';
        $data['View']='admin/UpdateAdmin';

        if(!empty($this->input->post()))
        {
            $this-> form_validation->set_rules('Name', 'Name', 'required|min_length[2]');
            $this->form_validation->set_rules('Email', 'Email', 'required|min_length[4]|valid_email');
            $this->form_validation->set_rules('Password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('Status', 'Status', 'required|min_length[1]');
            $this->form_validation->set_rules('Surname', 'Surname', 'required|min_length[2]');
            $this->form_validation->set_rules('AddedDate', 'AddedDate', 'required|min_length[6]');
            $this->form_validation->set_rules('LoginDate', 'LoginDate', 'required|min_length[6]');
            $this->form_validation->set_rules('FailedDate', 'FailedDate', 'required|min_length[6]');
            $this->form_validation->set_rules('UpdatedDate', 'UpdatedDate', 'required|min_length[6]');
            $this-> form_validation->set_rules('Browser', 'Browser', 'required|min_length[2]');
            $this-> form_validation->set_rules('IP', 'IP', 'required|min_length[4]');
            $this-> form_validation->set_rules('OS', 'OS', 'required|min_length[2]');
            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('MessageType','danger');
                $this->session->set_flashdata('Message', validation_errors());
                $this->load->view('admin/template', $data);
                return;
            }

            $formData=array(
                'Name'=>$this->input->post('Name'),
                'Email'=>$this->input->post('Email'),
                'Password'=>$this->input->post('Password'),
                'Status'=>$this->input->post('Status'),
                'Surname'=>$this->input->post('Surname'),
                'AddedDate'=>$this->input->post('AddedDate'),
                'LoginDate'=>$this->input->post('LoginDate'),
                'FailedDate'=>$this->input->post('FailedDate'),
                'UpdatedDate'=>$this->input->post('UpdatedDate'),
                'IP'=>$this->input->post('IP'),
                'Browser'=>$this->input->post('Browser'),
                'OS'=>$this->input->post('OS')
            );

            $whereData = array('Id' =>$adminId);
            $resultArray = $this->admin_model->UpdateAdmin($whereData,$formData);

            if(isset($resultArray['Errors']) && count($resultArray ['Errors']) > 0){
                $this->session->set_flashdata('MessageType','danger');
                $this->session->set_flashdata('Message',$resultArray['Errors'][0]);
                return;
            } else if(count($resultArray['Data']) > 0) {
                $this->session->set_flashdata('MessageType','success');
                $this->session->set_flashdata('Message',$this->lang->line('adminUpdateSuccess'));
                redirect(site_url() . 'admin/UpdateAdmin/'.$adminId);
            }

            $this->session->set_flashdata('MessageType','danger');
            $this->session->set_flashdata('Message', $this->lang->line('somethingWentWrong'));
        }

        $this->load->view('admin/template', $data);
    }
    function UpdateProduct($productId){
        $data = array();
        $productArray = $this->product_model->Products(array('Id'=> $productId));
        $data['CategoryList'] = $this->product_model->Categories();
        $data['ProductDetail'] = $productArray['Data'];
        $data['MetaTitle']='UpdateProduct';
        $data['MetaDescription']='admin/UpdateProduct';
        $data['View']='admin/UpdateProduct';

        if(!empty($this->input->post()))
        {
            $this-> form_validation->set_rules('Firma', 'Firma','required');
            $this-> form_validation->set_rules('CategoryId', 'CategoryId','required');
            $this-> form_validation->set_rules('Power', 'Power','required');
            $this-> form_validation->set_rules('SeriNo', 'SeriNo','required');
            $this-> form_validation->set_rules('MotorTipi', 'MotorTipi','required');
            $this-> form_validation->set_rules('Alternator', 'Alternator','required');
            $this-> form_validation->set_rules('AlternatorNo', 'AlternatorNo','required');
            $this-> form_validation->set_rules('Kabin', 'Kabin','required');
            $this-> form_validation->set_rules('AddedDate', 'AddedDate','required');
            $this-> form_validation->set_rules('YagFiltresi', 'YagFiltresi','required');
            $this-> form_validation->set_rules('YagLitre', 'YagLitre','required');
            $this-> form_validation->set_rules('AntifrizFiltre', 'AntifrizFiltre','required');
            $this-> form_validation->set_rules('MazotFiltresi', 'MazotFiltresi','required');
            $this-> form_validation->set_rules('YakitFiltresi', 'YakitFiltresi','required');
            $this-> form_validation->set_rules('Aku', 'Aku','required');
            $this-> form_validation->set_rules('IsiticiHortumu', 'IsiticiHortumu','required');
            $this-> form_validation->set_rules('KontrolPaneli', 'KontrolPaneli','required');
            $this-> form_validation->set_rules('Rezistans', 'Rezistans','required');
            $this-> form_validation->set_rules('Termostat', 'Termostat','required');
            $this-> form_validation->set_rules('FanKayisi', 'FanKayisi','required');
            $this-> form_validation->set_rules('TamponSarj', 'TamponSarj','required');
            $this-> form_validation->set_rules('Avr', 'Avr','required');
            $this-> form_validation->set_rules('MarsMotoru', 'MarsMotoru','required');
            $this-> form_validation->set_rules('SarjDinamosu', 'SarjDinamosu','required');
            $this-> form_validation->set_rules('YagMusuru', 'YagMusuru','required');
            $this-> form_validation->set_rules('HararetMusuru', 'HararetMusuru','required');
            $this-> form_validation->set_rules('YakitOtomatigi', 'YakitOtomatigi','required');
            $this-> form_validation->set_rules('Turbo', 'Turbo','required');
            $this-> form_validation->set_rules('Devirdaim', 'Devirdaim','required');
            $this-> form_validation->set_rules('Width', 'Width','required');
            $this-> form_validation->set_rules('Height', 'Height','required');

            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('MessageType','danger');
                $this->session->set_flashdata('Message', validation_errors());
                $this->load->view('admin/template', $data);
                return;
            }

            $formData=array(
                'Firma'=>$this->input->post('Firma'),
                'CategoryId'=>$this->input->post('CategoryId'),
                'Power'=>$this->input->post('Power'),
                'SeriNo'=>$this->input->post('SeriNo'),
                'MotorTipi'=>$this->input->post('MotorTipi'),
                'Alternator'=>$this->input->post('Alternator'),
                'AlternatorNo'=>$this->input->post('AlternatorNo'),
                'Kabin'=>$this->input->post('Kabin'),
                'AddedDate'=>$this->input->post('AddedDate'),
                'YagFiltresi'=>$this->input->post('YagFiltresi'),
                'YagLitre'=>$this->input->post('YagLitre'),
                'AntifrizFiltre'=>$this->input->post('AntifrizFiltre'),
                'MazotFiltresi'=>$this->input->post('MazotFiltresi'),
                'YakitFiltresi'=>$this->input->post('YakitFiltresi'),
                'Aku'=>$this->input->post('Aku'),
                'IsiticiHortumu'=>$this->input->post('IsiticiHortumu'),
                'KontrolPaneli'=>$this->input->post('KontrolPaneli'),
                'Rezistans'=>$this->input->post('Rezistans'),
                'Termostat'=>$this->input->post('Termostat'),
                'FanKayisi'=>$this->input->post('FanKayisi'),
                'TamponSarj'=>$this->input->post('TamponSarj'),
                'Avr'=>$this->input->post('Avr'),
                'MarsMotoru'=>$this->input->post('MarsMotoru'),
                'SarjDinamosu'=>$this->input->post('SarjDinamosu'),
                'YagMusuru'=>$this->input->post('YagMusuru'),
                'HararetMusuru'=>$this->input->post('HararetMusuru'),
                'YakitOtomatigi'=>$this->input->post('YakitOtomatigi'),
                'Turbo'=>$this->input->post('Turbo'),
                'Devirdaim'=>$this->input->post('Devirdaim'),
                'Width'=>$this->input->post('Width'),
                'Height'=>$this->input->post('Height')
            );

            $whereData = array('Id' =>$productId);
            $resultArray = $this->admin_model->UpdateProduct($whereData,$formData);

            if(isset($resultArray['Errors']) && count($resultArray ['Errors']) > 0){
                $this->session->set_flashdata('MessageType','danger');
                $this->session->set_flashdata('Message',$resultArray['Errors'][0]);
                redirect(site_url() . 'admin/Products');
                return;
            } else if(count($resultArray['Data']) > 0) {
                $this->session->set_flashdata('MessageType','success');
                $this->session->set_flashdata('Message', $this->lang->line('productUpdateSuccess'));
                redirect(site_url() . 'admin/Products');
            }

            $this->session->set_flashdata('MessageType','danger');
            $this->session->set_flashdata('Message', $this->lang->line('somethingWentWrong'));
        }

        $this->load->view('admin/template', $data);
    }
//--------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------
    function DeleteAdmin($adminId){
        $whereData = array('Id' =>$adminId);
        $resultArray = $this->admin_model->DeleteAdmin($whereData);
        if(isset($resultArray['Errors']) && count($resultArray ['Errors']) > 0){
            $this->session->set_flashdata('MessageType','danger');
            $this->session->set_flashdata('Message',$resultArray['Errors'][0]);
            return;
        } else if(count($resultArray['Data']) > 0) {
            $this->session->set_flashdata('MessageType','success');
            $this->session->set_flashdata('Message', $this->lang->line('deleteAdmin'));
            redirect(site_url() . 'admin/GetAdmins');
        }

        $this->session->set_flashdata('MessageType','danger');
        $this->session->set_flashdata('Message', $this->lang->line('somethingWentWrong'));

        redirect(site_url() . 'admin/GetAdmins');
    }
    function DeleteCategory($categoryId){
        $whereData = array('Id' =>$categoryId);
        $resultArray = $this->admin_model->DeleteCategory($whereData);
        if(isset($resultArray['Errors']) && count($resultArray ['Errors']) > 0){
            $this->session->set_flashdata('MessageType','danger');
            $this->session->set_flashdata('Message',$resultArray['Errors'][0]);
            return;
        } else if(count($resultArray['Data']) > 0) {
            $this->session->set_flashdata('MessageType','success');
            $this->session->set_flashdata('Message', $this->lang->line('deleteCategory'));
            redirect(site_url() . 'admin/Categories');
        }

        $this->session->set_flashdata('MessageType','danger');
        $this->session->set_flashdata('Message' , $this->lang->line('somethingWentWrong'));

        redirect(site_url() . 'admin/Categories');
    }
    function DeleteProduct($productId){
        $whereData = array('Id' =>$productId);
        $resultArray = $this->admin_model->DeleteProduct($whereData);
        if(isset($resultArray['Errors']) && count($resultArray ['Errors']) > 0){
            $this->session->set_flashdata('MessageType','danger');
            $this->session->set_flashdata('Message',$resultArray['Errors'][0]);
            return;
        } else if(count($resultArray['Data']) > 0) {
            $this->session->set_flashdata('MessageType','success');
            $this->session->set_flashdata('Message',$this->lang->line('deleteProduct'));
            redirect(site_url() . 'admin/Products');
        }

        $this->session->set_flashdata('MessageType','danger');
        $this->session->set_flashdata('Message' , $this->lang->line('somethingWentWrong'));

        redirect(site_url() . 'admin/Products');
    }
    function DeleteContact($contactId){
        $whereData = array('Id' =>$contactId);
        $resultArray = $this->admin_model->DeleteContact($whereData);
        if(isset($resultArray['Errors']) && count($resultArray ['Errors']) > 0){
            $this->session->set_flashdata('MessageType','danger');
            $this->session->set_flashdata('Message',$resultArray['Errors'][0]);
            return;
        } else if(count($resultArray['Data']) > 0) {
            $this->session->set_flashdata('MessageType','success');
            $this->session->set_flashdata('Message', $this->lang->line('deleteContact'));
            redirect(site_url() . 'admin/Contacts');
        }

        $this->session->set_flashdata('MessageType','danger');
        $this->session->set_flashdata('Message' , $this->lang->line('somethingWentWrong'));

        redirect(site_url() . 'admin/Contacts');
    }
//--------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------

    function ProductsImage($ProductId){
        $data['MetaTitle']='ProductsImage';
        $data['MetaDescription']='admin/ProductsImage';
        $data['View']='admin/ProductsImage';
        $data['ImageList'] = $this->product_model->ProductsImage(array('ProductId'=>$ProductId));
        $data['ProductId'] = $ProductId;
        $this->load->view('admin/template', $data);
    }
    function AddProductImage($productId){

        if($_SERVER['REQUEST_METHOD'] != 'POST')
        {
            json_output(500,array('error'=>1));
        }

        if(!isset($_FILES))
        {
            json_output(500,array('error'=>2));
        }
        elseif (count($_FILES) == 0)
        {
            json_output(500,array('error'=>4));
        }


        $productArray = $this->product_model->Products(array('Id'=> $productId));
        $title= $productArray['Data'][0]->Title;

        $uploadedFiles = upload_files($title, $_FILES['file']);
        if($uploadedFiles == false )
        {
            json_output(500,array('error'=>3));
        }



        $formData=array(
            'Image'=>$uploadedFiles,
            'ProductId'=>$productId,
            'Status'=>'1',
            'Main'=>'0',
            'AddedDate'=>date('Y-m-d- H:i:s')
        );
        $resultArray = $this->admin_model->AddProductImage($formData);

        if(isset($resultArray['Errors']) && count($resultArray ['Errors']) > 0){
            $this->session->set_flashdata('MessageType','danger');
            $this->session->set_flashdata('Message',$resultArray['Errors'][0]);
            json_output(500,array());

            return;
        } else if(count($resultArray['Data']) > 0) {
            $this->session->set_flashdata('MessageType','success');
            $this->session->set_flashdata('Message', $this->lang->line('productAddSuccess'));
            json_output(200,array());


        }
        $this->session->set_flashdata('MessageType','danger');
        $this->session->set_flashdata('Message', $this->lang->line('somethingWentWrong'));
        json_output(500,array('error'=>4));
    }
    function DeleteProductImage($productId, $productImageId){
        $whereData = array('Id' =>$productImageId);
        $resultArray = $this->admin_model->DeleteProductImage($whereData);
        if(isset($resultArray['Errors']) && count($resultArray ['Errors']) > 0){
            $this->session->set_flashdata('MessageType','danger');
            $this->session->set_flashdata('Message',$resultArray['Errors'][0]);
            return;
        } else if(count($resultArray['Data']) > 0) {
            $this->session->set_flashdata('MessageType','success');
            $this->session->set_flashdata('Message',$this->lang->line('deleteProduct'));
            redirect(site_url() . 'admin/Products');
        }

        $this->session->set_flashdata('MessageType','danger');
        $this->session->set_flashdata('Message' , $this->lang->line('somethingWentWrong'));

        redirect(site_url() . 'admin/ProductImage/'.$productId);
    }
//--------------------------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------------

}