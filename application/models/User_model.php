<?php
	class User_model extends CI_model
	{
	 
		public function login()
		{
			 // $email = $this->input->post('email');
			  $geek = $this->input->post('geek_name');
			  $pass = $this->input->post('password');
			  
			  $this->db->select('*');
			  $this->db->from('user_master');
			  $this->db->where('geek_name',$geek);
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
		////////////////////////////////////
		public function user_update($id,$data)
		{
          $this->db->where('id', $id);
		  $query = $this->db->update('user_master', $data); 
		  return $query;
		}
		//////////////////////////////////////
	}
?>