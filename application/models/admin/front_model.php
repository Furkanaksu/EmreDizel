<?php
class front_model extends CI_Model
{
    public function Contacts($categoryWhere = array()){
        if(count($categoryWhere) > 0)
        {
            $this->db->where($categoryWhere);
        }
        $this->db->order_by('Id', 'ASC');
        $query = $this->db->get('contacts');
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return array();
        }
    }



    //---------------------------------------------------------------------------------------------------------------

    function AddContact($formData = array())
    {
        $resultArray = array(
            'Errors' => array(),
            'Data' => array()
        );

        $insertData = array(
            'Name'=>$formData['Name'],
            'Mail'=>$formData['Mail'],
            'ProductId'=>$formData['ProductId'],
            'PhoneNumber'=>$formData['PhoneNumber'],
            'AddedDate'=>'0000-00-00 00:00:00',
            'Message'=>$formData['Message'],
            'Price'=>'0',
            'Ip'=>'1.1.1.1',
            'Status'=>'1',

        );
        $this->db->insert('contacts',$insertData);
        $insertResult = ($this->db->affected_rows() != 1) ? false : true;
        if($insertResult == true) {
            $resultArray['Data'] = $this->Contacts(array('Mail'=>$formData['Mail']));
        } else {
            $resultArray['Errors'] = array($this->lang->line('contactCantAdded'));
        }
        return $resultArray;
    }
}