<?php
     error_reporting(0);
     if(!defined('BASEPATH')) exit('No direct script access allowed');
   
     class Users extends CI_Controller
     {

        public function __construct()
        {
          parent::__construct();
          $this->load->model('admin_model');
          $this->load->database();
          $this->load->helper('url');
        }

        public function index()
        {
          $result['users'] = $this->admin_model->get_user_list();

          $this->load->view('administrator/includes/top-header');
          $this->load->view('administrator/includes/header');
          $this->load->view('administrator/includes/sidebar');
          $this->load->view('administrator/users', $result);
          $this->load->view('administrator/includes/footer');
        }

        public function add()
        {
          $this->load->view('administrator/includes/top-header');
          $this->load->view('administrator/includes/header');
          $this->load->view('administrator/includes/sidebar');
          $this->load->view('administrator/adduser');
          $this->load->view('administrator/includes/footer');
        }

        public function edit()
        {
          $id = $this->uri->segment(4);
          $result = $this->admin_model->get_user_data($id);

          if($result)
			{
				$data['users'] =  $result;
			}
		
          $this->load->view('administrator/includes/top-header');
          $this->load->view('administrator/includes/header');
          $this->load->view('administrator/includes/sidebar');
          $this->load->view('administrator/edituser', $data);
          $this->load->view('administrator/includes/footer');
        }

        public function insertuser()
        {
    	  if($_FILES['profile_picture']['name']) 
		  {
		   $filename = time()."_".$_FILES['profile_picture']['name'];
		  }
		  else
		  { 
		  	$filename = ""; 
		  }

		  $data = array(
		  'geek_name'=>$this->input->post('geek_name'),
		  'email'=>$this->input->post('email'),
		  'name'=>$this->input->post('name'),
		  'password'=>md5($this->input->post('password')),
		  'date_of_birth'=>$this->input->post('date_of_birth'),
		  'gender'=> $this->input->post('gender'),
		  'profile_picture'=>$filename,
		  'phone'=>$this->input->post('phone'),
		  'country'=>$this->input->post('country'),
		  'qualification'=>$this->input->post('qualification'),
		  'pass'=>($this->input->post('password')),
		   );
   
		  $target_path = "uploads/";  
		  $target_path = $target_path.basename($filename); 
		
		  move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_path);
		
		 ///////////////////// Model Call /////////////////

		  $query = $this->admin_model->user_insert($data);
		  redirect('admin/users', 'refresh');
        }

        public function updateuser()
        {
        	$id = $this->input->post('id');
			//////// image uploading ////////

			$img = $_FILES['profile_picture']['name'];

			if($img!="")
			{
			    $filename = time()."_".$img;
			    $target_path = "uploads/";  
				$target_path = $target_path.basename($filename); 
				
				move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_path);

				  $data = array(
				  'geek_name'=>$this->input->post('geek_name'),
				  'email'=>$this->input->post('email'),
				  'name'=>$this->input->post('name'),
				  'password'=>md5($this->input->post('password')),
				  'date_of_birth'=>$this->input->post('date_of_birth'),
				  'gender'=> $this->input->post('gender'),
				  'profile_picture'=>$filename,
				  'phone'=>$this->input->post('phone'),
				  'country'=>$this->input->post('country'),
				  'qualification'=>$this->input->post('qualification'),
				  'is_active'=>$this->input->post('is_active')
				   );
			}

			else
			{
				  $data = array(
				  'geek_name'=>$this->input->post('geek_name'),
				  'email'=>$this->input->post('email'),
				  'name'=>$this->input->post('name'),
				  'password'=>md5($this->input->post('password')),
				  'date_of_birth'=>$this->input->post('date_of_birth'),
				  'gender'=> $this->input->post('gender'),
				  'phone'=>$this->input->post('phone'),
				  'country'=>$this->input->post('country'),
				  'qualification'=>$this->input->post('qualification'),
				  'is_active'=>$this->input->post('is_active')
				  );
			}

				 $query = $this->admin_model->update_user($id, $data);
			 	 redirect('admin/users', 'refresh');
        }

        public function deleteuser()
        {
          $id = $this->input->post('id');
          
          $query = $this->admin_model->delete_user($id);
          redirect('admin/users', 'refresh');
        }
     }
  ?>