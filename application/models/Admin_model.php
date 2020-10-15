<?php
	class Admin_model extends CI_model
	{
		public function login()
		{
		  $email = $this->input->post('email');
		  $pass = $this->input->post('password');
		  
		  $this->db->select('*');
		  $this->db->from('admin_master');
		  $this->db->where('email',$email);
		  $this->db->where('password',$pass);
	  
		  if($query=$this->db->get())
		  {
			 return $query->result_array();
		  }

		  else
		  {
			return false;
		  }
		 
		}

		public function user_insert($data)
		{
			$query = $this->db->insert('user_master',$data);
			$lastid = $this->db->insert_id();
			
			if($lastid!="") {
			$newinsert =  $this->db->insert('notification_master',array('user_id'=>$lastid));
			}
		}

		public function get_user_list()
		{
			$query=$this->db->query("select * from `user_master`");
			return $query->result();
		}

		public function get_user_data($id)
		{
			$this->db->select('*');
			$this->db->from('user_master');
			$this->db->where('id', $id);
			$query = $this->db->get();
			return $query->result();
		}

		public function update_user($id, $data)
		{
			$this->db->where('id', $id);
			$query = $this->db->update('user_master', $data); 
		}

		public function delete_user($id)
		{
			$this->db->where('id', $id);
			$query = $this->db->delete('user_master'); 
		}

		////////////////////// Category //////////////////////


		public function cat_insert($data)
		{
			$query = $this->db->insert('category_master',$data);
		}

		public function get_cat_list()
		{
			$query=$this->db->query("select * from `category_master` order by ordering");
			return $query->result();
		}

		public function get_cat_data($id)
		{
			$this->db->select('*');
			$this->db->from('category_master');
			$this->db->where('id', $id);
			$query = $this->db->get();
			return $query->result();
		}

		public function update_cat($id, $data)
		{
			$this->db->where('id', $id);
			$query = $this->db->update('category_master', $data); 
		}

		public function delete_cat($id)
		{
			$this->db->where('id', $id);
			$query = $this->db->delete('category_master'); 
		}

		////////////////////// Sub Category //////////////////////

		public function subcat_insert($data)
		{
			$query = $this->db->insert('sub_category_master',$data);
		}

		public function get_subcat_list()
		{
			$query=$this->db->query("select * from `sub_category_master`");
			return $query->result();
		}

		public function get_subcat_data($id)
		{
			$this->db->select('*');
			$this->db->from('sub_category_master');
			$this->db->where('id', $id);
			$query = $this->db->get();
			return $query->result();
		}

		public function update_subcat($id, $data)
		{
			$this->db->where('id', $id);
			$query = $this->db->update('sub_category_master', $data); 
		}

		public function delete_subcat($id)
		{
			$this->db->where('id', $id);
			$query = $this->db->delete('sub_category_master'); 
		}


		////////////////////// Sub Sub Category //////////////////////

		public function subsubcat_insert($data)
		{
			$query = $this->db->insert('sub_sub_category_master',$data);
		}

		public function get_subsubcat_list()
		{
			$query=$this->db->query("select * from `sub_sub_category_master` order by `cat_id`");
			return $query->result();
		}

		public function get_subsubcat_data($id)
		{
			$this->db->select('*');
			$this->db->from('sub_sub_category_master');
			$this->db->where('id', $id);
			$query = $this->db->get();
			return $query->result();
		}

		public function update_subsubcat($id, $data)
		{
			$this->db->where('id', $id);
			$query = $this->db->update('sub_sub_category_master', $data); 
		}

		public function delete_subsubcat($id)
		{
			$this->db->where('id', $id);
			$query = $this->db->delete('sub_sub_category_master'); 
		}

		/////////////////////////////// Topic ////////////////////////////

		public function topic_insert($data)
		{
			$query = $this->db->insert('topics_master',$data);
		}

		public function get_topic_list()
		{
			$query=$this->db->query("select * from `topics_master`");
			return $query->result();
		}

		public function get_topic_data($id)
		{
			$this->db->select('*');
			$this->db->from('topics_master');
			$this->db->where('id', $id);
			$query = $this->db->get();
			return $query->result();
		}

		public function update_topic($id, $data)
		{
			$this->db->where('id', $id);
			$query = $this->db->update('topics_master', $data); 
		}

		public function delete_topic($id)
		{
			$this->db->where('id', $id);
			$query = $this->db->delete('topics_master'); 
		}
		///////////////////////
		public function get_list($topic)
		{
			
			$this->db->order_by('id','desc');
			$this->db->like('topics',$topic);
			$query=$this->db->get('questions_master');
			return $query->result();
		}
	    ////////////////////////////////////
		public function get_search_list($topic)
		{
		    $this->db->order_by('id','desc');
			$this->db->like('topics',$topic);
			$query=$this->db->get('questions_master');
			if($query->num_rows()!=0)
			{
			return $query->result();	
			}
			if($query->num_rows()==0)
			{
			$sub_id=$this->db->get_where('sub_sub_category_master',array('sub_sub_category_name'=>$topic))->row();
			$this->db->order_by('id','desc');
			$query2=$this->db->get_where('questions_master',array('sub_sub_cat_id'=>$sub_id->id));
			return $query2->result();	
			}
			
			
		}
	}
?>