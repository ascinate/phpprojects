<?php
   error_reporting(0);
   if(!defined('BASEPATH')) exit('No direct script access allowed');

   class Dashboard extends CI_Controller
   {
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
		$this->load->model('user_model');
		$this->load->model('cleaner_model');

        $this->load->library('session');
		$this->load->database();
    }
  
    /**
     * Index Page for this controller.
     */
    public function index()
    {
		if($this->session->userdata('id')=="")
		{
		  redirect('/');
		}
		
		$this->load->view('dashboard');
    }
	
	public function staff()
    {
        $this->load->view('staff-information');
    }
	
	public function safety_awards()
    {
		$this->load->view('includes/header');
		$this->load->view('includes/sidebar');
        $this->load->view('safety-awards');
		$this->load->view('includes/footer');
    }
	
	public function health_wellness()
    {
		$this->load->view('includes/header');
		$this->load->view('includes/sidebar');
        $this->load->view('health-wellness');
		$this->load->view('includes/footer');
    }
	
	public function safety_boot()
    {
		$this->load->view('includes/header');
		$this->load->view('includes/sidebar');
        $this->load->view('safety-boot');
		$this->load->view('includes/footer');
    }
	
	public function training()
    {
	    $this->load->view('includes/header');
		$this->load->view('includes/sidebar');
        $this->load->view('training');
		$this->load->view('includes/footer');
    }
	
	public function users()
    {
		$this->load->view('includes/header');
		$this->load->view('includes/sidebar');
        $this->load->view('users');
		$this->load->view('includes/footer');
    }
	
	public function cleaners()
    {
		$this->load->view('includes/header');
		$this->load->view('includes/sidebar');
        $this->load->view('cleaners');
		$this->load->view('includes/footer');
    }

	public function grouplist()
    {
		$this->load->view('includes/header');
		$this->load->view('includes/sidebar');
        $this->load->view('grouplist');
		$this->load->view('includes/footer');
    }
	
	public function addgroup()
    {
		$this->load->view('includes/header');
		$this->load->view('includes/sidebar');
        $this->load->view('addgroup');
		$this->load->view('includes/footer');
    }
	
	public function adduser()
    {
        $this->load->view('includes/header');
		$this->load->view('includes/sidebar');
		$this->load->view('adduser');
		$this->load->view('includes/footer');
    }
	
	public function insertUser()
	{
	  if($_FILES['fileToUpload']['name']) 
	  {
	   $filename = time()."_".$_FILES['fileToUpload']['name'];
	  }
	  else
	  { $filename = ""; }
		
	  $user=array(
			  'name'=>$this->input->post('name'),
			  'email'=>$this->input->post('email'),
			  'password'=>md5($this->input->post('password')),
			  'photo'=>$filename,
			  'phone'=>$this->input->post('phone'),
			  'description'=>$this->input->post('description'));
 
	  $this->db->select('*');
	  $this->db->from('user_master');
	  $this->db->where('email',$this->input->post('email'));
	  $query=$this->db->get();
	  
	  $terms = $this->input->post('term');
	  
	  if($terms=='Permanent') { $trm = 300; $btrm = 150; }
	  else if($terms=='Term') { $trm = 300; $btrm = 150; }
	  else if($terms=='Seasonal(R)') { $trm = 150; $btrm = 75; }
	  else if($terms=='Seasonal(S)') { $trm = 0; $btrm = 75; }
	 
	  if($query->num_rows()=='')
	  {
		$result = $this->db->insert('user_master', $user);
	
		if($result)
		{
			$target_path = "uploads/";  
			$target_path = $target_path.basename($filename); 
			
			move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_path);
			
			redirect('dashboard/users');  
		}
	  }
	  else
	  {
			redirect('dashboard/adduser/?err=em');  
	  }
	}
	
	public function edituser()
    {
	    $id = $this->uri->segment(3);
		$query = $this->user_model->get_user_data($id);
		
		if($query)
		{
			$data['users'] =  $query;
		}
		
	    $this->load->view('includes/header');
		$this->load->view('includes/sidebar');
	    $this->load->view('edituser',$data);
		$this->load->view('includes/footer');
    }
	
	public function updateUser()
	{
		$id = $this->input->post('id');
		//////// image uploading ////////
		$img = $_FILES['fileToUpload']['name'];
		
		if($img!="")
		{
		    $filename = time()."_".$img;
		    $target_path = "uploads/";  
			$target_path = $target_path.basename($filename); 
			
			move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_path);

			  $userdata = array(
			  'name'=>$this->input->post('name'),
			  'email'=>$this->input->post('email'),
			  'password'=>md5($this->input->post('password')),
			  'photo'=>$filename,
			  'phone'=>$this->input->post('phone'),
			  'description'=>$this->input->post('description')
			  );
		}
		else
		{
			  $userdata = array(
			  'name'=>$this->input->post('name'),
			  'email'=>$this->input->post('email'),
			  'password'=>md5($this->input->post('password')),
			  'phone'=>$this->input->post('phone'),
			  'description'=>$this->input->post('description')
			  );
		}
		
		$query = $this->user_model->update_user($id, $userdata);
		
		redirect('dashboard/users'); 
	}
	
   public function deleteUser()
   {
	   $id = $this->uri->segment(3);
	   $query = $this->user_model->delete_user($id);
	   $this->session->set_flashdata('msg', 'Record deleted successfully.');
	   redirect('dashboard/users'); 
   }

   //////////////////  For Cleaners //////////////////////

    public function addcleaner()
    {
        $this->load->view('includes/header');
		$this->load->view('includes/sidebar');
		$this->load->view('addcleaner');
		$this->load->view('includes/footer');
    }

	public function insertCleaner()
	{
	  if($_FILES['photo']['name']) 
	  {
	   $filename = time()."_".$_FILES['photo']['name'];
	  }
	  else
	  { $filename = ""; }
		
	  $user=array(
			  'name'=>$this->input->post('name'),
			  'email'=>$this->input->post('email'),
			  'password'=>md5($this->input->post('password')),
			  'photo'=>$filename,
			  'phone'=>$this->input->post('phone'),
			  'address'=>$this->input->post('address'),
			  'city'=>$this->input->post('city'),
			  'state'=>$this->input->post('state'),
			  'zipcode'=>$this->input->post('zipcode'),
			  'description'=>$this->input->post('description'));
 
	  $this->db->select('*');
	  $this->db->from('cleaner_master');
	  $this->db->where('email',$this->input->post('email'));
	  $query=$this->db->get();
	  
	  	 
	  if($query->num_rows()=='')
	  {
		$result = $this->db->insert('cleaner_master', $user);
	
		if($result)
		{
			$target_path = "uploads/";  
			$target_path = $target_path.basename($filename); 
			
			move_uploaded_file($_FILES['photo']['tmp_name'], $target_path);
			
			redirect('dashboard/cleaners');  
		}
	  }
	  else
	  {
			redirect('dashboard/addcleaner/?err=em');  
	  }
	}

	public function editcleaner()
    {
	    $id = $this->uri->segment(3);
		$query = $this->cleaner_model->get_user_data($id);
		
		if($query)
		{
			$data['cleaners'] =  $query;
		}
		
	    $this->load->view('includes/header');
		$this->load->view('includes/sidebar');
	    $this->load->view('editcleaner',$data);
		$this->load->view('includes/footer');
    }
	
    public function updateCleaner()
	{
		$id = $this->input->post('id');
		//////// image uploading ////////
		$img = $_FILES['photo']['name'];
		
		if($img!="")
		{
		    $filename = time()."_".$img;
		    $target_path = "uploads/";  
			$target_path = $target_path.basename($filename); 
			
			move_uploaded_file($_FILES['photo']['tmp_name'], $target_path);

			  $userdata = array(
			  'name'=>$this->input->post('name'),
			  'email'=>$this->input->post('email'),
			  'password'=>md5($this->input->post('password')),
			  'photo'=>$filename,
			  'phone'=>$this->input->post('phone'),
			  'address'=>$this->input->post('address'),
			  'city'=>$this->input->post('city'),
			  'state'=>$this->input->post('state'),
			  'zipcode'=>$this->input->post('zipcode'),
			  'description'=>$this->input->post('description')
			  );
		}
		else
		{
			  $userdata = array(
			  'name'=>$this->input->post('name'),
			  'email'=>$this->input->post('email'),
			  'password'=>md5($this->input->post('password')),
			  'phone'=>$this->input->post('phone'),
			  'address'=>$this->input->post('address'),
			  'city'=>$this->input->post('city'),
			  'state'=>$this->input->post('state'),
			  'zipcode'=>$this->input->post('zipcode'),
			  'description'=>$this->input->post('description')
			  );
		}
		
		$query = $this->cleaner_model->update_user($id, $userdata);
		
		redirect('dashboard/cleaners'); 
	}

	public function deleteCleaner()
    {
	   $id = $this->uri->segment(3);
	   $query = $this->cleaner_model->delete_user($id);
	   $this->session->set_flashdata('msg', 'Record deleted successfully.');
	   redirect('dashboard/cleaners'); 
    }

	///////////////////// Groups /////////////////////
	
	public function groupAdd()
	{
		$group = array(
				'group_title' => $this->input->post('group_title'),
				'parent_group' => $this->input->post('parent_group'),
				'description' => $this->input->post('description'));
			
		$query = $this->user_model->insertgroup($group);
		redirect('dashboard/grouplist'); 
	}
	
	public function editgroup()
    {
	    $id = $this->uri->segment(3);
		$query = $this->user_model->get_group_data($id);
		
		if($query)
		{
			$data['groups'] =  $query;
		}
		
	    $this->load->view('includes/header');
		$this->load->view('includes/sidebar');
	    $this->load->view('editgroup',$data);
		$this->load->view('includes/footer');
    }
	
	public function updateGroup()
	{
		$id = $this->input->post('id');
		
		$groupdata = array(
				'group_title' => $this->input->post('group_title'),
				'parent_group' => $this->input->post('parent_group'),
				'description' => $this->input->post('description'));
				
		$query = $this->user_model->update_group($id, $groupdata);
		redirect('dashboard/grouplist'); 
   }
   
   public function deleteGroup()
   {
	   $id = $this->uri->segment(3);
	   $query = $this->user_model->delete_group($id);
	   $this->session->set_flashdata('msg', 'Record deleted successfully.');
	   redirect('dashboard/grouplist'); 
   }
   
   public function rolemanager()
   {
	    $this->load->view('includes/header');
		$this->load->view('includes/sidebar');
	    $this->load->view('rolemanager');
		$this->load->view('includes/footer');
   }
   
   ////////////////////// Staff Updates ///////////////
   
   public function staffupdates()
	{
		$this->load->view('includes/header');
		$this->load->view('includes/sidebar');
		$this->load->view('staffupdates');
		$this->load->view('includes/footer');
	}
	
   public function addstaffupdate()
    {
		$this->load->view('includes/header');
		$this->load->view('includes/sidebar');
		$this->load->view('addstaffupdate');
		$this->load->view('includes/footer');
	}
   
   public function insertstaffupdates()
	{
		$data = array(
			'title' => $this->input->post('title'),
			'description' => $this->input->post('description'),
			'post_date' => date('Y-m-d'));
			
		$query = $this->staff_model->insertstaffupdates($data);
		redirect('dashboard/staffupdates'); 
	}
	
	public function editstaffupdates()
    {
	    $id = $this->uri->segment(3);
		$query = $this->staff_model->get_staff_data($id);
		
		if($query)
		{
			$data['staffs'] =  $query;
		}
		
	    $this->load->view('includes/header');
		$this->load->view('includes/sidebar');
	    $this->load->view('editstaffupdate',$data);
		$this->load->view('includes/footer');
    }
	
	public function updatestaffupdates()
	{
		$id = $this->input->post('id');
		
		$data = array(
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'post_date' => date('Y-m-d'));
				
		$query = $this->staff_model->update_staff($id, $data);
		redirect('dashboard/staffupdates'); 
   }
   
   public function deletestaffupdates()
   {
	   $id = $this->uri->segment(3);
	   $query = $this->staff_model->delete_staff($id);
	   redirect('dashboard/staffupdates'); 
   }
   
   //////////////////////  Policy //////////////////////
   
	public function policy()
	{
		$this->load->view('includes/header');
		$this->load->view('includes/sidebar');
		$this->load->view('policy');
		$this->load->view('includes/footer');
	}
	
    public function addpolicy()
    {
		$this->load->view('includes/header');
		$this->load->view('includes/sidebar');
	    $this->load->view('addpolicy');
		$this->load->view('includes/footer');
    }
   
    public function insertpolicy()
    {
		$filename = time()."_".$_FILES['fileToUpload']['name'];
		$target_path = "uploads/";  
		$target_path = $target_path.basename($filename); 
		
		move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_path);

		$data = array(
			'policy' => $this->input->post('policy'),
			'policy_file' => $filename);
			
		$query = $this->policy_model->insertpolicy($data);
		redirect('dashboard/policy'); 
	}
	
	public function editpolicy()
    {
	    $id = $this->uri->segment(3);
		$query = $this->policy_model->get_policy_data($id);
		
		if($query)
		{
			$data['policys'] =  $query;
		}
		
	    $this->load->view('includes/header');
		$this->load->view('includes/sidebar');
	    $this->load->view('editpolicy',$data);
		$this->load->view('includes/footer');
    }
	
	public function updatepolicy()
	{
		$id = $this->input->post('id');
		$file = $_FILES['fileToUpload']['name'];
		
		if($file!="")
		{
			$filename = time()."_".$_FILES['fileToUpload']['name'];
			$target_path = "uploads/";  
			$target_path = $target_path.basename($filename); 
			
			move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_path);
			
		    $data =  array(
				'policy' => $this->input->post('policy'),
				'policy_file' => $filename);
		}
		else
		{
			$data =  array(
				'policy' => $this->input->post('policy'));
		}
		
		$query = $this->policy_model->update_policy($id, $data);
		redirect('dashboard/policy'); 
   }
   
   public function deletepolicy()
   {
	   $id = $this->uri->segment(3);
	   $query = $this->policy_model->delete_policy($id);
	   redirect('dashboard/policy'); 
   }
   
   /////////////////////// Event //////////////////////////////
      
	public function event()
	{
		$this->load->view('includes/header');
		$this->load->view('includes/sidebar');
		$this->load->view('event');
		$this->load->view('includes/footer');
	}
	
    public function addevent()
    {
		$this->load->view('includes/header');
		$this->load->view('includes/sidebar');
	    $this->load->view('addevent');
		$this->load->view('includes/footer');
    }
   
    public function insertevent()
    {
		$data = array(
			'event_title' => $this->input->post('event_title'),
			'note' => $this->input->post('note'),
			'event_date' => $this->input->post('event_date'));
			
		$query = $this->event_model->insertevent($data);
		redirect('dashboard/event'); 
	}
	
	public function editevent()
    {
	    $id = $this->uri->segment(3);
		$query = $this->event_model->get_event_data($id);
		
		if($query)
		{
			$data['events'] =  $query;
		}
		
	    $this->load->view('includes/header');
		$this->load->view('includes/sidebar');
	    $this->load->view('editevent',$data);
		$this->load->view('includes/footer');
    }
	
	public function updateevent()
	{
		$id = $this->input->post('id');
		$file = $_FILES['fileToUpload']['name'];
		
		$data = array(
			'event_title' => $this->input->post('event_title'),
			'note' => $this->input->post('note'),
			'event_date' => $this->input->post('event_date'));
		
		$query = $this->event_model->update_event($id, $data);
		redirect('dashboard/event'); 
   }
   
   public function deleteevent()
   {
	   $id = $this->uri->segment(3);
	   $query = $this->event_model->delete_event($id);
	   redirect('dashboard/event'); 
   }
   
  //////////////////// Contact /////////////////////
  
    public function contact()
	{
		$this->load->view('includes/header');
		$this->load->view('includes/sidebar');
		$this->load->view('contacts');
		$this->load->view('includes/footer');
	}
	
    public function addcontact()
    {
		$this->load->view('includes/header');
		$this->load->view('includes/sidebar');
	    $this->load->view('addcontact');
		$this->load->view('includes/footer');
    }
   
    public function insertcontact()
    {
		$data = array(
				'name' => $this->input->post('name'),
				'department' => $this->input->post('department'),
				'contact' => $this->input->post('contact'));
			
		$query = $this->user_model->insertcontact($data);
		redirect('dashboard/contact'); 
	}
	
	public function editcontact()
    {
	    $id = $this->uri->segment(3);
		$query = $this->user_model->get_contact_data($id);
		
		if($query)
		{
			$data['contacts'] =  $query;
		}
		
	    $this->load->view('includes/header');
		$this->load->view('includes/sidebar');
	    $this->load->view('editcontact',$data);
		$this->load->view('includes/footer');
    }
	
	public function updatecontact()
	{
		$id = $this->input->post('id');
		$data = array(
				'name' => $this->input->post('name'),
				'department' => $this->input->post('department'),
				'contact' => $this->input->post('contact'));
		
		$query = $this->user_model->update_contact($id, $data);
		redirect('dashboard#!/contact'); 
   }
   
   public function deletecontact()
   {
	   $id = $this->uri->segment(3);
	   $query = $this->user_model->delete_contact($id);
	   redirect('dashboard/contact'); 
   } 
   
   
   //////////////////// Personnel Training ////////////////////
   
		public function addtraining()
		{
			$this->load->view('includes/header');
		    $this->load->view('includes/sidebar');
			$this->load->view('addtraining');
			$this->load->view('includes/footer');
		}
	   
		public function inserttraining()
		{
			$data = array(
					'user_id' => $this->input->post('user_id'),
					'course' => $this->input->post('course'),
					'mandatory_opt' => $this->input->post('mandatory_opt'),
					'due_date' => $this->input->post('due_date'),
					'scheduled_date' => $this->input->post('scheduled_date'),
					'scheduled_time' => $this->input->post('scheduled_time'),
					'venue' => $this->input->post('venue'),
					'status' => $this->input->post('status'),
					'completion_date' => $this->input->post('completion_date'),
					'expiry_date' => $this->input->post('expiry_date'));
				
			$query = $this->user_model->inserttraining($data);
			redirect('dashboard/training'); 
		}
		
		public function edittraining()
		{
			$id = $this->uri->segment(3);
			$query = $this->user_model->get_training_data($id);
			
			if($query)
			{
				$data['trainings'] =  $query;
			}
			
			$this->load->view('includes/header');
			$this->load->view('includes/sidebar');
			$this->load->view('edittraining',$data);
			$this->load->view('includes/footer');
		}
		
		public function updatetraining()
		{
			$id = $this->input->post('id');
			$data = array(
			        'user_id' => $this->input->post('user_id'),
					'course' => $this->input->post('course'),
					'mandatory_opt' => $this->input->post('mandatory_opt'),
					'due_date' => $this->input->post('due_date'),
					'scheduled_date' => $this->input->post('scheduled_date'),
					'scheduled_time' => $this->input->post('scheduled_time'),
					'venue' => $this->input->post('venue'),
					'status' => $this->input->post('status'),
					'completion_date' => $this->input->post('completion_date'),
					'expiry_date' => $this->input->post('expiry_date'));
			
			$query = $this->user_model->update_training($id, $data);
			redirect('dashboard/training'); 
	   }
	   
	   public function deletetraining()
	   {
		   $id = $this->uri->segment(3);
		   $query = $this->user_model->delete_training($id);
		   $this->session->set_flashdata('msg', 'Record deleted successfully.');
		   redirect('dashboard/training'); 
	   } 
	   
	   ////////////////////// Safety Awards ///////////////////////
	   
	   public function addsafety()
		{
			$this->load->view('includes/header');
			$this->load->view('includes/sidebar');
			$this->load->view('addsafetyawardpoints');
			$this->load->view('includes/footer');
		}
	   
		public function insertsafety()
		{
			$data = array(
			        'user_id' => $this->input->post('user_id'),
					'year' => $this->input->post('year'),
					'month' => $this->input->post('month'),
					'point_earn' => $this->input->post('point_earn'),
					'point_deduct' => $this->input->post('point_deduct'),
					'deduction_reason' => $this->input->post('deduction_reason'),
					'point_used' => $this->input->post('point_used'),
					'used_date' => $this->input->post('used_date'),
					'point_used_for' => $this->input->post('point_used_for'));
				
			$query = $this->user_model->insertsafety($data);
			redirect('dashboard/safety_awards'); 
		}
		
		public function editsafety()
		{
			$id = $this->uri->segment(3);
			$query = $this->user_model->get_safety_data($id);
			
			if($query)
			{
				$data['awards'] =  $query;
			}
			
			$this->load->view('includes/header');
			$this->load->view('includes/sidebar');
			$this->load->view('editsafetyawardpoints',$data);
			$this->load->view('includes/footer');
		}
		
		public function updatesafety()
		{
			$id = $this->input->post('id');
			$data = array(
			        'user_id' => $this->input->post('user_id'),
					'year' => $this->input->post('year'),
					'month' => $this->input->post('month'),
					'point_earn' => $this->input->post('point_earn'),
					'point_deduct' => $this->input->post('point_deduct'),
					'deduction_reason' => $this->input->post('deduction_reason'),
					'point_used' => $this->input->post('point_used'),
					'used_date' => $this->input->post('used_date'),
					'point_used_for' => $this->input->post('point_used_for'));
			
			$query = $this->user_model->update_safety($id, $data);
			redirect('dashboard/safety_awards'); 
	   }
	   
	   public function deletesafety()
	   {
		   $id = $this->uri->segment(3);
		   $query = $this->user_model->delete_safety($id);
		   redirect('dashboard/safety_awards'); 
	   }
	   
	   ///////////////// Health & Wellness /////////////
	   
	     public function addhealth()
		{
			$this->load->view('includes/header');
			$this->load->view('includes/sidebar');
			$this->load->view('addhealth');
			$this->load->view('includes/footer');
		}
	   
		public function inserthealth()
		{
			$data = array(
			        'user_id' => $this->input->post('user_id'),
					'year' => $this->input->post('year'),
					'item' => $this->input->post('item'),
					'amount' => $this->input->post('amount'),
					'purchase_date' => $this->input->post('purchase_date'),
					'paid_amount' => $this->input->post('paid_amount'),
					'remarks' => $this->input->post('remarks'));
				
			$query = $this->user_model->inserthealth($data);
			redirect('dashboard/health_wellness'); 
		}
		
		public function edithealth()
		{
			$id = $this->uri->segment(3);
			$query = $this->user_model->get_health_data($id);
			
			if($query)
			{
				$data['awards'] =  $query;
			}
			
			$this->load->view('includes/header');
			$this->load->view('includes/sidebar');
			$this->load->view('edithealth',$data);
			$this->load->view('includes/footer');
		}
		
		public function updatehealth()
		{
			$id = $this->input->post('id');
			$data = array(
			        'user_id' => $this->input->post('user_id'),
					'year' => $this->input->post('year'),
					'item' => $this->input->post('item'),
					'amount' => $this->input->post('amount'),
					'purchase_date' => $this->input->post('purchase_date'),
					'paid_amount' => $this->input->post('paid_amount'),
					'remarks' => $this->input->post('remarks'));
			
			$query = $this->user_model->update_health($id, $data);
			redirect('dashboard/health_wellness'); 
	   }
	   
	   public function deletehealth()
	   {
		   $id = $this->uri->segment(3);
		   $query = $this->user_model->delete_health($id);
		   redirect('dashboard/health_wellness'); 
	   }
	   
	    ///////////////// Safety Boots /////////////
	   
	    public function addboots()
		{
			$this->load->view('includes/header');
			$this->load->view('includes/sidebar');
			$this->load->view('addboots');
			$this->load->view('includes/footer');
		}
	   
		public function insertboot()
		{
			$data = array(
			        'user_id' => $this->input->post('user_id'),
					'year' => $this->input->post('year'),
					'item' => $this->input->post('item'),
					'amount' => $this->input->post('amount'),
					'purchase_date' => $this->input->post('purchase_date'),
					'paid_amount' => $this->input->post('paid_amount'),
					'remarks' => $this->input->post('remarks'));
				
			$query = $this->user_model->insertboot($data);
			redirect('dashboard/safety_boot'); 
	    }
		
		/////////////// Back up ///////////////
		
		public function backup()
		{
		  $this->load->view('includes/header');
		  $this->load->view('includes/sidebar');
		  $this->load->view('backup');
		  $this->load->view('includes/footer');
		}
		
		/////////////// Restore /////////////
		
		public function restore()
		{
		  $this->load->view('includes/header');
		  $this->load->view('includes/sidebar');
		  $this->load->view('restore');
		  $this->load->view('includes/footer');
		}
		
		public function changepassword()
		{
		  $this->load->view('includes/header');
		  $this->load->view('includes/sidebar');
		  $this->load->view('editprofile');
		  $this->load->view('includes/footer');	
		}
   
  }
?>

