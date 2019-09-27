<?php
class product_model extends CI_Model
{
//-------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------------

    public function Categories($categoryWhere = array()){
        if(count($categoryWhere) > 0)
        {
            $this->db->where($categoryWhere);
        }
        $this->db->order_by('Id', 'ASC');
        $query = $this->db->get('makineler');
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return array();
        }
    }

    public function Products($productWhere = array(), $start = 0, $limit = PAGE_LIMIT, $sort = 'DESC', $like = array() ){

        $returnArray=array();
        $CategoryList = $this->Categories();

        if(count($productWhere) > 0)
        {
            $this->db->where($productWhere);
        }

        if(count($like) > 0)
        {
            $this->db->like($like);
        }

        $this->db->order_by('Id', $sort);

        $this->db->limit($limit , $start);
        $query = $this->db->get('products');
        if($query->num_rows() > 0)
        {
            $productList = $query->result();


            foreach ($productList as $product){
                $product->CategoryTitle = 'No Category';
                foreach ($CategoryList as $category){
                    if($product->CategoryId == $category->Id)
                    {
                        $product->CategoryTitle = $category->Name;
                        break;
                    }
                }
                $returnArray[] = $product;
            }

            if(count($productWhere) > 0) {
                $this->db->where($productWhere);
            }

            if(count($like) > 0)
            {
                $this->db->like($like);
            }

            $query = $this->db->get('products');
            $totalCount = $query->num_rows();

            return array('TotalRecord'=>$totalCount, 'Data'=>$returnArray);
        }
        else
        {
            return array('TotalRecord'=> 0, 'Data'=> array());
        }
    }
    
    public function ProductsImage($productWhere = array()){

        if(count($productWhere) > 0)
        {
            $this->db->where($productWhere);
        }
        $this->db->order_by('Id', 'DESC');
        $query = $this->db->get('productsimage');
        if($query->num_rows() > 0)
        {
            $productList = $query->result();

            return $productList;
        }
        else
        {
            return array();
        }
    }
}