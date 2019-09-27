<?php
class admin_model extends CI_Model
{
    function login($username, $password)
    {
        $AdminIP = $this->input->ip_address();
        $AdminOS= getOS();
        $AdminBrowser= getBrowser();
        $AdminDate = date('Y-m-d- H:i:s');
        $this->db->where('Email', $username);
        $this->db->where('Password', $password);
        $this->db->limit(1);
        $query = $this->db->get('admins');
        if($query->num_rows() > 0)
        {
            $AdminCheck = $query->row();

            $this->db->where('Id', $AdminCheck->Id);
            $UpdateData = array(
                'LoginDate' =>$AdminDate,
                'IP' =>$AdminIP,
                'OS' =>$AdminOS,
                'Browser' =>$AdminBrowser
            );
            $this->db->update('admins', $UpdateData);

            $AdminCheck->LoginDate = $AdminDate;
            $AdminCheck->IP = $AdminIP;
            $AdminCheck->OS = $AdminOS;
            $AdminCheck->Browser = $AdminBrowser;

            return $AdminCheck;
        }
        else
        {
            $this->db->where('Email', $username);
            $this->db->limit(1);
            $query = $this->db->get('admins');
            if($query->num_rows() > 0) {
                $this->db->where('Email', $username);
                $UpdateData = array(
                    'FailedDate' =>date('Y-m-d- H:i:s'),
                    'IP' =>$AdminIP,
                    'OS' =>$AdminOS,
                    'Browser' =>$AdminBrowser
                );
            }
            return array();
        }

    }
    // ---------------------UPDATE ADMIN-------------------------------------------------------------------------------
    public function getAdmins($adminWhere = array()){
        if(count($adminWhere) > 0)
        {
            $this->db->where($adminWhere);
        }
        $this->db->order_by('Id', 'DESC');
        $query = $this->db->get('admins');
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return array();
        }
    }


    public function Contacts($contactWhere = array()){
        if(count($contactWhere) > 0)
        {
            $this->db->where($contactWhere);
        }
        $this->db->order_by('Id', 'DESC');
        $query = $this->db->get('contacts');
        if($query->num_rows() > 0)
        {
            return $query->Result();
        }
        else
        {
            return array();
        }
    }

    // ---------------------UPDATE ADMIN-------------------------------------------------------------------------------
    public function getImages($categoryWhere = array()){
        if(count($categoryWhere) > 0)
        {
            $this->db->where($categoryWhere);
        }
        $this->db->order_by('Id', 'DESC');
        $query = $this->db->get('productsimage');
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return array();
        }
    }
    // ---------------------UPDATE ADMIN-------------------------------------------------------------------------------
    function addAdmin($formData)
    {
        $resultArray = array(
            'Errors' => array(),
            'Data' => array()
        );

        $adminCheck = $this->getAdmins(array('Email'=>$formData['Email']));
        if(count($adminCheck)>0)
        {
            $resultArray['Errors'] = array($this->lang->line('emailInUse'));
            return $resultArray;
        }

        $insertData = array(
            'Name'=>$formData['Name'],
            'Email'=>$formData['Email'],
            'Password'=>$formData['Password'],
            'Status'=>$formData['Status'],
            'Surname'=>$formData['Surname'],
            'AddedDate'=>$formData['AddedDate'],
            'UpdatedDate'=>'0000-00-00 00:00:00',
            'LoginDate'=>'0000-00-00 00:00:00',
            'IP'=>'0.0.0.0',
            'OS'=>'Unknown',
            'Browser'=>'Unknown',
            'FailedDate'=>'0000-00-00 00:00:00'
        );

        $this->db->insert('admins',$insertData);
        $insertResult = ($this->db->affected_rows() != 1) ? false : true;
        if($insertResult == true) {
            $resultArray['Data'] = $this->getAdmins(array('Email'=>$formData['Email']));
        } else {
            $resultArray['Errors'] = array($this->lang->line('adminCantAdded'));
        }
        return $resultArray;
    }
    // ---------------------UPDATE ADMIN-------------------------------------------------------------------------------
    function addContacts($formData)
    {
        $resultArray = array(
            'Errors' => array(),
            'Data' => array()
        );

        $insertData = array(
            'Name'=>$formData['Name'],
            'PhoneNumber'=>$formData['PhoneNumber'],
            'Mail'=>$formData['Mail'],
            'Price'=>$formData['Price'],
            'AddedDate'=>date('Y-m-d')
        );

        $this->db->insert('contacts',$insertData);
        $insertResult = ($this->db->affected_rows() != 1) ? false : true;
        if($insertResult == true) {
            $resultArray['Data'] = $this->Contacts(array('Name'=>$formData['Name']));
        } else {
            $resultArray['Errors'] = array($this->lang->line('adminCantAdded'));
        }
        return $resultArray;
    }
    // ---------------------UPDATE ADMIN-------------------------------------------------------------------------------
    function addCategories($formData)
    {
        $resultArray = array(
            'Errors' => array(),
            'Data' => array()
        );

        $insertData = array(
            'Name'=>$formData['Name'],
            'AddedDate'=>$formData['AddedDate'],
            'Status'=>1
        );

        $this->db->insert('makineler',$insertData);
        $insertResult = ($this->db->affected_rows() != 1) ? false : true;
        if($insertResult == true) {
            $resultArray['Data'] = $this->product_model->Categories(array('Name'=>$formData['Name']));
        } else {
            $resultArray['Errors'] = array($this->lang->line('categoryCantAdded'));
        }
        return $resultArray;
    }

    // ---------------------AddProducts-------------------------------------------------------------------------------
    function AddProducts($formData = array())
    {
        $resultArray = array(
            'Errors' => array(),
            'Data' => array()
        );

        $insertData = array(
            'Firma'=>$formData['Firma'],
            'CategoryId'=>$formData['CategoryId'],
            'AddedDate'=>date('Y-m-d'),
            'Power'=>$formData['Power'],
            'SeriNo'=>$formData['SeriNo'],
            'MotorTipi'=>$formData['MotorTipi'],
            'Alternator'=>$formData['Alternator'],
            'AlternatorNo'=>$formData['AlternatorNo'],
            'Kabin'=>$formData['Kabin'],
            'YagFiltresi'=>$formData['YagFiltresi'],
            'YagLitre'=>$formData['YagLitre'],
            'AntifrizFiltre'=>$formData['AntifrizFiltre'],
            'MazotFiltresi'=>$formData['MazotFiltresi'],
            'YakitFiltresi'=>$formData['YakitFiltresi'],
            'Aku'=>$formData['Aku'],
            'IsiticiHortumu'=>$formData['IsiticiHortumu'],
            'KontrolPaneli'=>$formData['KontrolPaneli'],
            'Rezistans'=>$formData['Rezistans'],
            'Termostat'=>$formData['Termostat'],
            'FanKayisi'=>$formData['FanKayisi'],
            'TamponSarj'=>$formData['TamponSarj'],
            'Avr'=>$formData['Avr'],
            'MarsMotoru'=>$formData['MarsMotoru'],
            'SarjDinamosu'=>$formData['SarjDinamosu'],
            'YagMusuru'=>$formData['YagMusuru'],
            'HararetMusuru'=>$formData['HararetMusuru'],
            'YakitOtomatigi'=>$formData['YakitOtomatigi'],
            'Turbo'=>$formData['Turbo'],
            'Devirdaim'=>$formData['Devirdaim'],
            'Width'=>$formData['Width'],
            'Height'=>$formData['Height']
        );

        $this->db->insert('products',$insertData);
        $insertResult = ($this->db->affected_rows() != 1) ? false : true;
        if($insertResult == true) {
            $resultArray['Data'] = $this->product_model->Products(array('Firma'=>$formData['Firma']));
        } else {
            $resultArray['Errors'] = array($this->lang->line('productCantAdded'));
        }
        return $resultArray;
    }

    // ---------------------UPDATE ADMIN-------------------------------------------------------------------------------

    function UpdateAdmin($whereData ,$formData)
    {
        $resultArray = array(
            'Errors' => array(),
            'Data' => array()
        );

        $adminCheck = $this->getAdmins(array('Email'=>$formData['Email']));
         if(count($adminCheck)>0)
         {
             if($adminCheck[0]->Id != $whereData['Id']){
                 $resultArray['Errors'] = array($this->lang->line('emailInUse'));
                 return $resultArray;
             }
         }else
             {
                 $resultArray['Errors'] = array($this->lang->line('unknownUser'));
                 return $resultArray;
         }

        $updateData = array(
            'Name'=>$formData['Name'],
            'Email'=>$formData['Email'],
            'Password'=>$formData['Password'],
            'Status'=>$formData['Status'],
            'Surname'=>$formData['Surname'],
            'AddedDate'=>$formData['AddedDate'],
            'UpdatedDate'=>$formData['UpdatedDate'],
            'LoginDate'=>$formData['LoginDate'],
            'IP'=>$formData['IP'],
            'OS'=>$formData['OS'],
            'Browser'=>$formData['Browser'],
            'FailedDate'=>$formData['FailedDate']
        );

        $this->db->where($whereData);
        $this->db->update('admins',$updateData);
        $updateResult = ($this->db->affected_rows() != 1) ? false : true;
        if($updateResult == true) {
            $resultArray['Data'] = $this->getAdmins(array('Id'=>$whereData['Id']));
        } else {
            $resultArray['Errors'] = array($this->lang->line('adminCantUpdated'));
        }
        return $resultArray;
    }

    // ---------------------UPDATE ADMIN-------------------------------------------------------------------------------

    function UpdateCategory($whereData ,$formData)
    {
        $resultArray = array(
            'Errors' => array(),
            'Data' => array()
        );

        $adminCheck = $this->product_model->Categories(array('Title'=>$formData['Title']));
        if(count($adminCheck)>0)
        {
            if($adminCheck[0]->Id != $whereData['Id']){
                $resultArray['Errors'] = array($this->lang->line('categoryInUse'));
                return $resultArray;
            }
        }else
        {
            $resultArray['Errors'] = array($this->lang->line('unknownCategory'));
            return $resultArray;
        }

        $updateData = array(
            'Title'=>$formData['Title'],
            'Description'=>$formData['Description'],
            'Status'=>$formData['Status'],
            'AddedDate'=>$formData['AddedDate'],
            'UpdatedDate'=>$formData['UpdatedDate']
        );

        $this->db->where($whereData);
        $this->db->update('categories',$updateData);
        $updateResult = ($this->db->affected_rows() != 1) ? false : true;
        if($updateResult == true) {
            $resultArray['Data'] = $this->product_model->Categories(array('Id'=>$whereData['Id']));
        } else {
            $resultArray['Errors'] = array($this->lang->line('categoryCantUpdated'));
        }
        return $resultArray;
    }

    // ---------------------UPDATE ADMIN-------------------------------------------------------------------------------

    function UpdateProduct($whereData ,$formData)
    {
        $resultArray = array(
            'Errors' => array(),
            'Data' => array()
        );

        $updateData = array(
            'Firma'=>$formData['Firma'],
            'CategoryId'=>$formData['CategoryId'],
            'Power'=>$formData['Power'],
            'SeriNo'=>$formData['SeriNo'],
            'MotorTipi'=>$formData['MotorTipi'],
            'Alternator'=>$formData['Alternator'],
            'AlternatorNo'=>$formData['AlternatorNo'],
            'Kabin'=>$formData['Kabin'],
            'AddedDate'=>$formData['AddedDate'],
            'YagFiltresi'=>$formData['YagFiltresi'],
            'YagLitre'=>$formData['YagLitre'],
            'AntifrizFiltre'=>$formData['AntifrizFiltre'],
            'MazotFiltresi'=>$formData['MazotFiltresi'],
            'YakitFiltresi'=>$formData['YakitFiltresi'],
            'Aku'=>$formData['Aku'],
            'IsiticiHortumu'=>$formData['IsiticiHortumu'],
            'KontrolPaneli'=>$formData['KontrolPaneli'],
            'Rezistans'=>$formData['Rezistans'],
            'Termostat'=>$formData['Termostat'],
            'FanKayisi'=>$formData['FanKayisi'],
            'TamponSarj'=>$formData['TamponSarj'],
            'Avr'=>$formData['Avr'],
            'MarsMotoru'=>$formData['MarsMotoru'],
            'SarjDinamosu'=>$formData['SarjDinamosu'],
            'YagMusuru'=>$formData['YagMusuru'],
            'HararetMusuru'=>$formData['HararetMusuru'],
            'YakitOtomatigi'=>$formData['YakitOtomatigi'],
            'Turbo'=>$formData['Turbo'],
            'Devirdaim'=>$formData['Devirdaim'],
            'Width'=>$formData['Width'],
            'Height'=>$formData['Height']
        );

        $this->db->where($whereData);
        $this->db->update('products',$updateData);
        $updateResult = ($this->db->affected_rows() != 1) ? false : true;
        if($updateResult == true) {
            $resultArray['Data'] = $this->product_model->Products(array('Id'=>$whereData['Id']));
        } else {
            $resultArray['Errors'] = array($this->lang->line('productCantUpdated'));
        }
        return $resultArray;
    }

    //-----------------------------------------------------------------------------------------------------------------
    function DeleteAdmin($whereData){

        $resultArray = array(
            'Errors' => array(),
            'Data' => array()
        );
        $this->db->where($whereData);
        $this->db->delete('admins');
        $deleteResult = ($this->db->affected_rows() != 1) ? false : true;
        if($deleteResult == true) {
            $resultArray['Data'] = array('ok');
        } else {
            $resultArray['Errors'] = array($this->lang->line('adminCantDeleted'));
        }

        return $resultArray;
    }
//-----------------------------------------------------------------------------------------------------------------
    function DeleteCategory($whereData){

        $resultArray = array(
            'Errors' => array(),
            'Data' => array()
        );

        if(isset($whereData['Id']))
        {
            $this->db->where('CategoryId', $whereData['Id']);
            $UpdateData = array(
                'CategoryId' =>0
            );
            $this->db->update('products', $UpdateData);
        }

        $this->db->where($whereData);
        $this->db->delete('categories');
        $deleteResult = ($this->db->affected_rows() != 1) ? false : true;
        if($deleteResult == true) {
            $resultArray['Data'] = array('ok');
        } else {
            $resultArray['Errors'] = array($this->lang->line('categoryCantDeleted'));
        }

        return $resultArray;
    }
//-----------------------------------------------------------------------------------------------------------------
    function DeleteProduct($whereData){

        $resultArray = array(
            'Errors' => array(),
            'Data' => array()
        );

        if(isset($whereData['Id']))
        {
            $this->db->where('ProductId', $whereData['Id']);
            $UpdateData = array(
                'ProductId' =>0
            );
            $this->db->update('contacts', $UpdateData);
        }
        $this->db->where($whereData);
        $this->db->delete('products');
        $deleteResult = ($this->db->affected_rows() != 1) ? false : true;
        if($deleteResult == true) {
            $resultArray['Data'] = array('ok');
        } else {
            $resultArray['Errors'] = array($this->lang->line('productCantDeleted'));
        }

        return $resultArray;
    }
    //-----------------------------------------------------------------------------------------------------------------
    function DeleteContact($whereData){

        $resultArray = array(
            'Errors' => array(),
            'Data' => array()
        );

        $this->db->where($whereData);
        $this->db->delete('contacts');
            $deleteResult = ($this->db->affected_rows() != 1) ? false : true;
        if($deleteResult == true) {
            $resultArray['Data'] = array('ok');
        } else {
            $resultArray['Errors'] = array($this->lang->line('productCantDeleted'));
        }

        return $resultArray;
    }

    function DeleteProductImage($whereData){
        $resultArray = array(
            'Errors' => array(),
            'Data' => array()
        );

        //$path = "posters/orj/"

        $this->db->where($whereData);
        $this->db->delete('productsimage');
        $deleteResult = ($this->db->affected_rows() != 1) ? false : true;
        if($deleteResult == true) {
            $resultArray['Data'] = array('ok');
        } else {
            $resultArray['Errors'] = array($this->lang->line('productCantDeleted'));
        }

        return $resultArray;
    }

    function AddProductImage($formData)
    {
        $resultArray = array(
            'Errors' => array(),
            'Data' => array()
        );

        $insertData = array(
            'Image'=>$formData['Image'],
            'ProductId'=>$formData['ProductId'],
            'Status'=>$formData['Status'],
            'Main'=>$formData['Main'],
            'AddedDate'=>$formData['AddedDate']
        );

        $this->db->insert('productsimage',$insertData);
        $insertResult = ($this->db->affected_rows() != 1) ? false : true;
        if($insertResult == true) {
            $resultArray['Data'] = $this->product_model->ProductsImage(array('Image'=>$formData['Image']));
        } else {
            $resultArray['Errors'] = array($this->lang->line('categoryCantAdded'));
        }
        return $resultArray;
    }
}