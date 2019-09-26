<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/front_model');
        $this->load->model('admin/product_model');
        $this->load->library('form_validation');
        $this->load->library('EnumStatus');

        $lang = $this->uri->segment(1);
        if($lang != 'tr'){
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


    function setLang($lang)
    {
        //echo base_url();
        //echo '<br/>';

        $previousUrl = $this->session->userdata('referred_from');
        //echo 'previousUrl:'.$previousUrl;
        // echo '<br/>';
        $previousUrl = str_replace(base_url(), '', $previousUrl);
        $previousUrl = str_replace(rtrim(base_url(),'/'), '', $previousUrl);

        //echo 'previousUrl:'.$previousUrl;
        //echo '<br/>';
        $previousLang = explode('/', $previousUrl);
        $previousLang = $previousLang[0];
        //echo 'previouslang:' . $previousLang;
       // echo '<br/>';

        if ($previousLang == 'tr' || $previousLang == 'en') {
            if ($lang == 'en') {
                $previousUrl = str_replace($previousLang . '/', '', $previousUrl);
                $previousUrl = str_replace($previousLang, '', $previousUrl);
                echo 'xx';
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

        $newUrl = base_url();
        if(base_url() != $previousUrl)
        {
            $newUrl .= $previousUrl;
        }
        //echo 'baseurl:'.base_url();
       // echo '<br/>';
       //echo 'previousUrl:'.$previousUrl;
       // echo '<br/>';
        //echo 'newUrl:'.$newUrl;
        //die();
        redirect($newUrl);
    }

	public function index($page = 1)
	{
        $data = array();
	    $data['CurrentPage'] = $page;
	    $page = $page - 1;
        $start = ($page * PAGE_LIMIT);
        $productArray = $this->product_model->Products(array(),$start);
        $data['Products'] = $productArray['Data'];
        $data['TotalPage'] = ceil($productArray['TotalRecord'] / PAGE_LIMIT);
        $data['Categories'] = $this->product_model->Categories();
        $data['ProductsImage'] = $this->product_model->ProductsImage();
        $data['View']='front/home';
        $this->load->view('front/template', $data);
	}

    function ProductDetails($productId)
    {
        $data = array();
        $productArray = $this->product_model->Products(array('Id'=> $productId));

        if(count($productArray['Data']) == 0)
        {
            $data['ProductDetails'] = array();
        }else{
            $data['ProductDetails'] = $productArray['Data'][0];
        }
        $data['Categories'] = $this->product_model->Categories();


        if(count($productArray['Data']) == 0)
        {
            $data['RelatedProducts'] = array();
        }else{
            $RelatedProducts = $this->product_model->Products(array('CategoryId'=>$data['ProductDetails']->CategoryId),0,3,'RANDOM');
            $data['RelatedProducts'] = $RelatedProducts['Data'];
        }

        $data['MetaTitle']='ProductDetails';
        $data['MetaDescription']='front/productDetails';
        $data['View']='front/ProductDetails';
        $this->load->view('front/template', $data);
    }
//-------------------------------------------------------------------------------------------------------------------
    function About()
    {
        $data = array();
        $data['Categories'] = $this->product_model->Categories();
        $data['MetaTitle']='About';
        $data['MetaDescription']='front/about';
        $data['View']='front/about';
        $this->load->view('front/template', $data);
    }

    //---------------------------------------------------------------------------------------------------------------
    function Contact()
    {
        $data = array();
        $data['Categories'] = $this->product_model->Categories();
        $data['MetaTitle']='Contact';
        $data['MetaDescription']='front/contact';
        $data['View']='front/contact';
        if(!empty($this->input->post()))
        {
            $this-> form_validation->set_rules('Name', 'Name', 'required|min_length[2]');
            $this->form_validation->set_rules('Mail', 'Mail', 'required|min_length[4]');
            $this->form_validation->set_rules('PhoneNumber', 'PhoneNumber', 'required|min_length[1]');
            $this->form_validation->set_rules('Message', 'Message', 'required|min_length[2]');
            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('MessageType','danger');
                $this->session->set_flashdata('Message', validation_errors());
                $this->load->view('front/template', $data);
                return;
            }
            $formData=array(
                'Name'=>$this->input->post('Name'),
                'Mail'=>$this->input->post('Mail'),
                'PhoneNumber'=>$this->input->post('PhoneNumber'),
                'Message'=>$this->input->post('Message'),
                'ProductId'=>$this->input->post('ProductId'),
            );
            $resultArray = $this->front_model->addContact($formData);

            if(isset($resultArray['Errors']) && count($resultArray ['Errors']) > 0){
                $this->session->set_flashdata('MessageType','danger');
                $this->session->set_flashdata('Message',$resultArray['Errors'][0]);
                return;
            } else if(count($resultArray['Data']) > 0) {
                $this->session->set_flashdata('MessageType','success');
                $this->session->set_flashdata('Message' , $this->lang->line('contactAddSuccess'));
                redirect(site_url() . 'front/contact');
            }

            $this->session->set_flashdata('MessageType','danger');
            $this->session->set_flashdata('Message', $this->lang->line('somethingWentWrong'));
        }

        $this->load->view('front/template', $data);
    }

    public function CategoryList($categoryId, $page = 1)
    {
        $data = array();
        $data['CurrentPage'] = $page;
        $page = $page - 1;
        $start = ($page * PAGE_LIMIT);
        $productArray = $this->product_model->Products(array('CategoryId'=> $categoryId),$start);
        $data['Categories'] = $this->product_model->Categories();
        $data['ProductsImage'] = $this->product_model->ProductsImage();
        $data['Products'] = $productArray['Data'];
        $data['TotalPage'] = ceil($productArray['TotalRecord'] / PAGE_LIMIT);
        $data['CategoryId'] = $categoryId;

        $data['CategoryTitle'] = '';
        foreach ($data['Categories'] as $row)
        {
            if($row->Id == $categoryId)
            {
                $data['CategoryTitle'] = $row->Title;
                break;
            }
        }
        $data['MetaTitle']='CategoryList';
        $data['MetaDescription']='front/CategoryList';
        $data['View']='front/categories';
        $this->load->view('front/template', $data);
    }


    public function Search($keyword, $page = 1)
    {
        $data = array();
        $data['CurrentPage'] = $page;
        $page = $page - 1;
        $start = ($page * PAGE_LIMIT);
        $productArray = $this->product_model->Products(array(),$start ,PAGE_LIMIT, 'DESC', array('Title'=> $keyword));

        $data['Categories'] = $this->product_model->Categories();
        $data['ProductsImage'] = $this->product_model->ProductsImage();
        $data['Products'] = $productArray['Data'];
        $data['TotalPage'] = ceil($productArray['TotalRecord'] / PAGE_LIMIT);
        $data['Keyword'] = $keyword;

        $data['MetaTitle']='Search';
        $data['MetaDescription']='front/Search';
        $data['View']='front/search';
        $this->load->view('front/template', $data);
    }
}
