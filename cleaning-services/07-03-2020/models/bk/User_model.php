<?php
class User_model extends CI_model
{
 
public function register_user($user)
{
  $this->db->insert('user_master', $user);
}
 
public function login_user()
{
  $email = $this->input->post('email');
  $pass = md5($this->input->post('password'));
  
  $this->db->select('*');
  $this->db->from('user_master');
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

public function email_check($email)
{
  $this->db->select('*');
  $this->db->from('user_master');
  $this->db->where('email',$email);
  $query=$this->db->get();
 
  if($query->num_rows()>0)
  {
    return false;
  }
  else
  {
    return true;
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
	
	$terms = $this->input->post('term');
		
	 if($terms=='Permanent') { $trm = 300; $btrm = 150; }
	 else if($terms=='Term') { $trm = 300; $btrm = 150; }
	 else if($terms=='Seasonal(R)') { $trm = 300; $btrm = 75; }
	 else if($terms=='Seasonal(S)') { $trm = 0; $btrm = 75; }
	
	if($query)
	{
	 for($x=date('Y'); $x<=date('Y')+2; $x++)
	 {
		$arr2 = array('available_amt' => $trm);
		$query3 = $this->db->update('helth_points', $arr2, array('user_id'=>$id, 'year'=>$x));
		//echo $this->db->last_query(); exit();
		
		$arr4 = array('available_amt' => $btrm);
		$query4 = $this->db->update('boot_points', $arr4, array('user_id'=>$id, 'year'=>$x));
	 }
	}

}

public function delete_user($id)
{
	$this->db->where('id', $id);
	$query = $this->db->delete('user_master'); 
	
	if($query)
	{
		$this->db->where('user_id', $id);
	    $this->db->delete('safety_awards'); 
		
		$this->db->where('user_id', $id);
	    $this->db->delete('safety_award_points'); 
		
		$this->db->where('user_id', $id);
	    $this->db->delete('health_wellness'); 
		
		$this->db->where('user_id', $id);
	    $this->db->delete('helth_points'); 
		
		$this->db->where('user_id', $id);
	    $this->db->delete('safety_boots');
		
		$this->db->where('user_id', $id);
	    $this->db->delete('boot_points');
		
		$this->db->where('user_id', $id);
	    $this->db->delete('personnel_training');
	}
}

/////////////////// Group /////////////////////

public function insertgroup($group)
{
    $this->db->insert('group_master', $group);
	$lastId =  $this->db->insert_id();
	
	if($lastId)
	{
	  	$this->db->insert('role_master', array('group_id'=>$lastId, 'sector'=>'Staff Information', 'privilege'=>'N'));
		$this->db->insert('role_master', array('group_id'=>$lastId, 'sector'=>'Safety Awards', 'privilege'=>'N'));
		$this->db->insert('role_master', array('group_id'=>$lastId, 'sector'=>'Health & Wellness', 'privilege'=>'N'));
		$this->db->insert('role_master', array('group_id'=>$lastId, 'sector'=>'Boots Allowance', 'privilege'=>'N'));
		$this->db->insert('role_master', array('group_id'=>$lastId, 'sector'=>'Personnel Training', 'privilege'=>'N'));
	}
}

public function get_group_data($id)
{
	$this->db->select('*');
	$this->db->from('group_master');
	$this->db->where('id', $id);
	$query = $this->db->get();
	return $query->result();
}

public function update_group($id, $data)
{
	$this->db->where('id', $id);
	$this->db->update('group_master', $data); 
}

public function delete_group($id)
{
	$this->db->where('id', $id);
	$this->db->delete('group_master'); 
}
////////////////// End Group /////////////////

////////////////// Contact //////////////////

public function insertcontact($user)
{
  $this->db->insert('contact_master', $user);
}

public function get_contact_data($id)
{
	$this->db->select('*');
	$this->db->from('contact_master');
	$this->db->where('id', $id);
	$query = $this->db->get();
	return $query->result();
}

public function update_contact($id, $data)
{
	$this->db->where('id', $id);
	$this->db->update('contact_master', $data); 
	echo $this->db->last_query();
}

public function delete_contact($id)
{
	$this->db->where('id', $id);
	$this->db->delete('contact_master'); 
}

/////////////////// Training //////////////////

public function inserttraining($user)
{
  $this->db->insert('personnel_training', $user);
}

public function get_training_data($id)
{
	$this->db->select('*');
	$this->db->from('personnel_training');
	$this->db->where('id', $id);
	$query = $this->db->get();
	return $query->result();
}

public function update_training($id, $data)
{
	$this->db->where('id', $id);
	$this->db->update('personnel_training', $data); 
}

public function delete_training($id)
{
	$this->db->where('id', $id);
	$this->db->delete('personnel_training'); 
}

/////////////////// Safety Awards //////////////////

public function insertsafety($user)
{
  $this->db->insert('safety_awards', $user);
}

public function get_safety_data($id)
{
	$this->db->select('*');
	$this->db->from('safety_awards');
	$this->db->where('id', $id);
	$query = $this->db->get();
	return $query->result();
}

public function update_safety($id, $data)
{
	$this->db->where('id', $id);
	$this->db->update('safety_awards', $data); 
}

public function delete_safety($id)
{
	$this->db->where('id', $id);
	$this->db->delete('safety_awards'); 
}

/////////////////// Health & Wellness //////////////////

public function inserthealth($user)
{
  $this->db->insert('health_wellness', $user);
}

public function get_health_data($id)
{
	$this->db->select('*');
	$this->db->from('health_wellness');
	$this->db->where('id', $id);
	$query = $this->db->get();
	return $query->result();
}

public function update_health($id, $data)
{
	$this->db->where('id', $id);
	$this->db->update('health_wellness', $data); 
}

public function delete_health($id)
{
	$this->db->where('id', $id);
	$this->db->delete('health_wellness'); 
}

/////////////////// Health & Wellness //////////////////

public function insertboot($user)
{
  $this->db->insert('safety_boots', $user);
}

}
?>