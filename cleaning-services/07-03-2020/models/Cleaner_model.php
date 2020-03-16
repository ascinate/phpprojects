<?php
class Cleaner_model extends CI_model
{
 
public function register_user($user)
{
  $this->db->insert('cleaner_master', $user);
}
 
public function login_user()
{
  $email = $this->input->post('email');
  $pass = md5($this->input->post('password'));
  
  $this->db->select('*');
  $this->db->from('cleaner_master');
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
  $this->db->from('cleaner_master');
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
	$this->db->from('cleaner_master');
	$this->db->where('id', $id);
	$query = $this->db->get();
	return $query->result();
}

public function update_user($id, $data)
{
	$this->db->where('id', $id);
	$query = $this->db->update('cleaner_master', $data); 
}

public function delete_user($id)
{
	$this->db->where('id', $id);
	$query = $this->db->delete('cleaner_master'); 
}

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

}
?>