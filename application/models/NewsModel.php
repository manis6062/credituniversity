<?php
class NewsModel extends CI_Model
{
    
     function __construct()
       {
            parent::__construct();
            // Your own constructor code
			$this->load->helper('date');
        	$this->load->library('email');
           $this->load->helper('security');

       }
	function countAll($cond)
	{
		$this->db->where($cond);
		$query = $this->db->get("nc_news");
		
		return $query->num_rows();
	}
	function getAllPaginate($cond,$perPage,$offset)
	{
		
		$this->db->select('*');
		$this->db->from('nc_news');
		
		$this->db->where($cond); 
		$this->db->order_by("news_order", "DESC"); 
		$this->db->limit($perPage, $offset);
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
			return $query->result();
		
		return 0;
	}
    
    
    
    // get the administratro details
    function getNewsDetails($id)
    {
    	$query = $this->db->get_where('nc_news', array('news_id' => $id));
    	
    	if($query->num_rows() == 0)
    	{
    		return 0;
    	}
    	else
    	{
    		return $query->row();
    	}
    }
	
	function uniqueUserName($userid,$name)
	{
		$this->db->select('*');
		$this->db->from('ah_user');
		$this->db->where('user_name', $name); 
		$this->db->where_not_in('user_id',$userid);
		
		//$this->db->order_by("company_id","DESC");
		$query = $this->db->get();
		
			return $query->num_rows();
	}
	
	function getAllNews($publish="all")
	{
		if($publish!="all")
		{
			$this->db->where('news_status', 'yes'); 
		}
		$this->db->order_by("news_order","DESC");
		//$this->db->limit($perPage,$offset);
		$query = $this->db->get("nc_news");
		if($query->num_rows() > 0)
			return $query->result();

		return 0;
	}
	function getLatestNews()
	{
		
			$this->db->where('news_status', 'yes'); 
		
		$this->db->order_by("news_order","DESC");
		$this->db->limit(5,0);
		$query = $this->db->get("nc_news");
		if($query->num_rows() > 0)
			return $query->result();

		return 0;
	}
	
	function update($id)
	{
		$today = date("Y-m-d H:i:s");


		$data = array(
                        'news_title' => $this->input->post('news_title'),
			
			'news_brief' => $this->input->post('news_brief'),
			'news_details' => $this->input->post('news_details'),
			'news_date' => $this->input->post('news_date'),
			//'news_order' => $this->input->post('news_order'),
			'news_status' => $this->input->post('news_status'),
			'updt_by'=> $this->session->userdata(USER_ID),
			'updt_dt'=> $today,
			'updt_cnt'=> $this->input->post('updt_cnt')+1,
			
		);

		$this->db->where("news_id",$id);
		$this->db->update('nc_news', $data);
		
		
		
		
           
	}
	
	
	
	function deleteNews($id)
	{
		$this->db->where('news_id', $id);
		$this->db->delete('nc_news');
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		return FALSE;
		
	}
	
	
	
	function insert()
	{
		
		$today = date("Y-m-d H:i:s");


		$data = array(
                        'news_title' => $this->input->post('news_title'),
			'news_brief' => $this->input->post('news_brief'),
			'news_details' => $this->input->post('news_details'),
			
			'news_date' => $this->input->post('news_date'),
			'news_order' =>$this->getMaxNewsOrder()+1 ,
			'news_status' => $this->input->post('news_status'),
			'crtd_by' => $this->session->userdata(USER_ID),
			'crtd_dt'=> $today
			
		);
		$this->db->insert('nc_news', $data);
		$id=$this->db->insert_id();
		
		
		  
		   return $id;   
	}
	 function changehigherorder($id,$order)
	{
		$query = $this->db->query("UPDATE nc_news SET
					news_order =(news_order + 1)
					WHERE news_order =".($order-1));
					
		if($query > 0)
		{
			$this->db->query("UPDATE nc_news SET
					news_order =(news_order - 1)
					WHERE news_id=$id");
		}
	
	}
	function changelowerorder($id,$order)
	{
		
		$query = $this->db->query("UPDATE nc_news  SET
					news_order = (news_order - 1)
					WHERE news_order = ".($order+1));
		if($query > 0)
		{
		$this->db->query("UPDATE nc_news  SET
					news_order = (news_order + 1)
					WHERE news_id = $id");
		}
	}
	
	function getMaxNewsOrder()
	{
		$this->db->select_max('news_order','norder');
		$query = $this->db->get('nc_news');
		if($query->num_rows() > 0)
			{
				 $row = $query->row(); 
				 return $row->norder;
			}

		return 0;
	}
	function updateStatus($id,$value)
	{
		$data = array(
                        'news_status' =>$value
		);

		$this->db->where("news_id",$id);
		$this->db->update('nc_news', $this->security->xss_clean($data));
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		return FALSE;
	}

}
?>