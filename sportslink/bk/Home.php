<?php
   error_reporting(0);
   if(!defined('BASEPATH')) exit('No direct script access allowed');

   class Home extends CI_Controller
   {
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
		$this->load->model('home_model');
		
        $this->load->library('session');
		$this->load->database();
    }

	public function index()
	{
		$this->load->view('front_inc/header');
    $this->load->view('frontent/index');
		$this->load->view('front_inc/footer');
	}
  public function AthleteDetails()
  {
    $this->load->view('front_inc/header');
    $this->load->view('frontent/athlete-details');
    $this->load->view('front_inc/footer1');
  }
  public function viewathlete()
  {
    $this->load->view('front_inc/header');
    $this->load->view('frontent/athletes');
    $this->load->view('front_inc/footer1');
  }
  public function viewshop()
  {
    $this->load->view('front_inc/header');
    $this->load->view('frontent/shop');
    $this->load->view('front_inc/footer1');
  }
	
   public function thankyou()
  {
    $this->load->view('front_inc/header');
    $this->load->view('frontent/thankyou');
    $this->load->view('front_inc/footer1');
  }
   public function thankingyou()
  {
    $this->load->view('front_inc/header');
    $this->load->view('frontent/thankingyou');
    $this->load->view('front_inc/footer1');
  }
   public function myprofile()
  {
    // $this->load->view('front_inc/header1');
    if($this->session->userdata('user_type')=='')
    {
      redirect('/');
    }
    else if($this->session->userdata('user_type')=="Athlete"){
    $this->load->view('frontent/myprofile');
    $this->load->view('front_inc/footer1');
    }
    else{
     $this->load->view('frontent/myprofile2');
     // $this->load->view('front_inc/footer1');
     }
   
  }

  public function myevent()
  {
  	$this->load->view('frontent/myevent');
    $this->load->view('front_inc/footer1');
  }
  
  public function myservices()
  {
    $this->load->view('frontent/myservices');
    $this->load->view('front_inc/footer1');
  }

  public function managebooking()
  {
    $this->load->view('frontent/managebooking');
    $this->load->view('front_inc/footer1');
  }
  public function gallery()
  {
    $this->load->view('frontent/gallery');
    $this->load->view('front_inc/footer1');
  }
    public function mail()
  {
    $this->load->view('front_inc/header');
    $this->load->view('frontent/mail');
    $this->load->view('front_inc/footer1');
  }
  public function athregister()
  {
    $athlete_name=$this->input->post('athlete_name');
    $athlete_email=$this->input->post('athlete_email');
    $athlete_age=$this->input->post('athlete_age');
    $athlete_gender=$this->input->post('athlete_gender');
    $sports=$this->input->post('sports');
    $position=$this->input->post('position');
    $athphone=$this->input->post('athphone');
    $password=$this->input->post('password');

    $ath_qry=$this->db->get_where('athlete_master',array('email'=>$athlete_email))->num_rows();
    $cust_qry=$this->db->get_where('customer_master',array('email'=>$athlete_email))->num_rows();
 
        if($ath_qry>0 || $cust_qry>0)
          {
              $this->session->set_flashdata("email_error","Email Id Already Exist!!");
              redirect('');
          }
          else
          {
              $athlete=array(
              'name'=>$athlete_name,
              'email'=>$athlete_email,
              'age'=>$athlete_age,
              'gender'=>$athlete_gender,
              'sport_name'=>$sports,
              'position'=>$position,
              'phone'=>$athphone,
              'password'=>md5($password),
              'pass'=>$password
              );

                 $status=$this->home_model->add_athelete($athlete);
                 $id=$this->session->userdata('last_id');
                 $id2=str_replace("=","_",$id);
                 $to=$this->input->get('athlete_email');
                $subject = 'Welcome to Sportslink - Account Confirmation';
                $message = '<html>
                      <head>
                        <title>Sportslink - Account Confirmation</title>
                      </head>
                      <body>
                        <p>Sportslink - Account Confirmation</p>
                        <table>
                        <tr>
                          <td>Welcome to Sportslink. You have successfully created your account. <a href="http://ascinate.in/projects/sportslink360/home/thankyou/'.$id2.'" style="text-decoration:none; color: #333;"><span style="color:blue;">Click here</span></a> to login in your profile.</td>
                        </tr>
                        
                        </table>
                      </body>
                      </html>';
                
                // To send HTML mail, the Content-type header must be set
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                // More headers
                $headers .= 'From: <example@rbajsol.com>' . "\r\n";
                // $headers .= 'Cc: '.$email_qry->reg_email. "\r\n";
                
                      
                $mail = mail($to, $subject, $message, $headers);
                $this->session->set_flashdata("reg_succ","Thanks!! Register Successfully..");
                redirect('home/thankyou');
                  
          }
    }


    public function editprofile()
  {
    $athlete_email=$this->input->post('ath_email');
    $athlete_id=$this->input->post('ath_id');
    $detail=$this->db->get_where('athlete_details',array('athlete_id'=>$athlete_id))->row();

            if($_FILES['image']['name']=='')
            {
                $file_name=$detail->profile_picture;
            }
            else
            {
               $upload_dir='upload_image/';
               $temp_error=$_FILES['image']['error'];
               $file_name=time().$_FILES['image']['name'];
               $tmp_name=$_FILES['image']['tmp_name'];
               $file_size=$_FILES['image']['size'];
               move_uploaded_file($tmp_name, $upload_dir.$file_name);
            }

            if($_FILES['video']['name']=='')
            {
                $file_name2=$detail->athlete_videos;
            }
            else
            {
               $upload_dir2='upload_video/';
               $temp_error=$_FILES['video']['error'];
               $file_name2=time().$_FILES['video']['name'];
               $tmp_name2=$_FILES['video']['tmp_name'];
               $file_size=$_FILES['video']['size'];
               move_uploaded_file($tmp_name2, $upload_dir2.$file_name2);
            }
             

              $athlete=array(
              'name'=>$this->input->post('ath_name'),
              'email'=>$this->input->post('ath_email'),
              'age'=>$this->input->post('ath_age'),
              'gender'=>$this->input->post('ath_gender'),
              'sport_name'=>$this->input->post('ath_sports'),
              'position'=>$this->input->post('ath_position'),
              'phone'=>$this->input->post('ath_phone'),
              'password'=>md5($this->input->post('ath_password')),
              'pass'=>$this->input->post('ath_password')
              );

              $athlete_details=array(
                'profile_picture'=>$file_name,
                'athlete_accomplish'=>$this->input->post('ath_accomplish'),
                'athlete_award'=>$this->input->post('ath_award'),
                'athlete_experience'=>$this->input->post('ath_experience'),
                'athlete_workhistory'=>$this->input->post('ath_workhistory'),
                'athlete_website'=>$this->input->post('ath_website'),
                'athlete_videos'=>$file_name2,
                'athlete_articles'=>$this->input->post('ath_article'),
                'athlete_interview_details'=>$this->input->post('ath_interview'),
                'twitter'=>$this->input->post('twitter'),
                'facebook'=>$this->input->post('facebook'),
                'linkedin'=>$this->input->post('linkedin'),
                'instagram'=>$this->input->post('instagram')
              );

                 $status=$this->home_model->update_athelete($athlete,$athlete_details,$athlete_id);
                $this->session->set_flashdata("msg","Thanks!! Updated Successfully..");
                redirect('home/myprofile');
          
    }

    public function editcustomer()
  {
    $customer_id=$this->input->post('cust_id');
    $detail=$this->db->get_where('customer_master',array('id'=>$customer_id))->row();

            if($_FILES['image']['name']=='')
            {
                $file_name=$detail->image;
            }
            else
            {
               $upload_dir='customer_image/';
               $temp_error=$_FILES['image']['error'];
               $file_name=time().$_FILES['image']['name'];
               $tmp_name=$_FILES['image']['tmp_name'];
               $file_size=$_FILES['image']['size'];
               move_uploaded_file($tmp_name, $upload_dir.$file_name);
            }

              $customer=array(
              'name'=>$this->input->post('cust_name'),
              'email'=>$this->input->post('cust_email'),
              'gender'=>$this->input->post('cust_gender'),
              'sports_name'=>$this->input->post('cust_sports'),
              'phone'=>$this->input->post('cust_phone'),
              'image'=>$file_name,
              'password'=>md5($this->input->post('cust_password')),
              'pass'=>$this->input->post('cust_password')
              );

                 $status=$this->home_model->update_customer($customer,$customer_id);
                $this->session->set_flashdata("msg","Thanks!! Updated Successfully..");
                redirect('home/myprofile');
          
    }

     public function custregister()
  {
    $cust_name=$this->input->post('cust_name');
    $cust_email=$this->input->post('cust_email');
    $cust_phone=$this->input->post('cust_phone');
    $cust_gender=$this->input->post('cust_gender');
    $password2=$this->input->post('password2');

    $ath_qry=$this->db->get_where('athlete_master',array('email'=>$cust_email))->num_rows();
    $cust_qry=$this->db->get_where('customer_master',array('email'=>$cust_email))->num_rows();
 
        if($ath_qry>0 || $cust_qry>0)
          {
             $this->session->set_flashdata("email_error2","Email Id Already Exist!!");
          }
          else
          {
              $customer=array(
              'name'=>$cust_name,
              'email'=>$cust_email,
              'gender'=>$cust_gender,
              'password'=>md5($password2),
              'pass'=>$password2,
              'phone'=>$cust_phone
              );

                 $status=$this->home_model->add_customer($customer);
                 $id=$this->session->userdata('last_id');
                 $id2=str_replace("=","_",$id);
                 $to=$this->input->get('cust_email');
                $subject = 'Welcome to Sportslink - Account Confirmation';
                $message = '<html>
                      <head>
                        <title>Sportslink - Account Confirmation</title>
                      </head>
                      <body>
                        <p>Sportslink - Account Confirmation</p>
                        <table>
                        <tr>
                          <td>Welcome to Sportslink. You have successfully created your account. <a href="http://ascinate.in/projects/sportslink360/home/thankingyou/'.$id2.'" style="text-decoration:none; color: #333;"><span style="color:blue;">Click here</span></a> to login in your profile.</td>
                        </tr>
                        
                        </table>
                      </body>
                      </html>';
                
                // To send HTML mail, the Content-type header must be set
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                // More headers
                $headers .= 'From: <example@rbajsol.com>' . "\r\n";
                // $headers .= 'Cc: '.$email_qry->reg_email. "\r\n";
                
                      
                $mail = mail($to, $subject, $message, $headers);
                $this->session->set_flashdata("reg_succ2","Thanks!! Register Successfully..");
                 redirect('home/thankingyou');
                  
          }
    
   
    }
    public function ath_login()
    {
      $ath_email=$this->input->post('ath_email');
      $ath_password=md5($this->input->post('ath_password'));
      $check=$this->db->get_where('athlete_master',array('email'=>$ath_email,'password'=>$ath_password,'status'=>'APPROVED'))->num_rows();
      if($check>0)
      {
        $result=$this->db->get_where('athlete_master',array('email'=>$ath_email,'password'=>$ath_password))->row();
        $this->session->set_userdata('user_id',$result->id);
        $this->session->set_userdata('user_type','Athlete');
        redirect('home/myprofile');
      }
      else
      {
        $this->session->set_flashdata('Error','Wrong User Name or Password!!');
        redirect('home');
      }
    }

    public function cust_login()
    {
      $customer_email=$this->input->post('customer_email');
      $customer_password=md5($this->input->post('customer_password'));
      $check=$this->db->get_where('customer_master',array('email'=>$customer_email,'password'=>$customer_password,'status'=>'APPROVED'))->num_rows();
      if($check>0)
      {
        $result=$this->db->get_where('customer_master',array('email'=>$customer_email,'password'=>$customer_password))->row();
        $this->session->set_userdata('user_id',$result->id);
        $this->session->set_userdata('user_type','Customer');
       redirect('home/myprofile');
      }
      else
      {
       $this->session->set_flashdata('Error2','Wrong User Name or Password!!');
        redirect('home');
      }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/');
    }
 


    public function addextraimage()
    {
      $ath_id=$this->uri->segment(3);
      foreach ($_FILES['athgallery']['tmp_name'] as $key=> $value)
         {
           $upload_dir='athlete_galary/';
               $temp_error=$_FILES['athgallery']['error'][$key];
               $file_name[]=time().$_FILES['athgallery']['name'][$key];
               $tmp_name=$_FILES['athgallery']['tmp_name'][$key];
               $file_size=$_FILES['athgallery']['size'][$key];
               move_uploaded_file($tmp_name, $upload_dir.time().$_FILES['athgallery']['name'][$key]);
         }
            $photos=implode(',', $file_name);
            $qry1=$this->db->get_where('athlete_galary',array('athlete_id'=>$ath_id));
            $qry=$qry1->num_rows();
            $q=$qry1->row();
            if($qry==0)
            {
              $data=array(
              'athlete_id'=>$ath_id,
              'photos'=>$photos
              );
              $res=$this->db->insert('athlete_galary',$data);

            }if($qry!=0){
              if($q->photos!='')
              {
                    $pto=$q->photos;
                    $data=array(
                   'photos'=>$pto.",".$photos,
                  );
              }
              else
              {
                  $data=array(
                   'photos'=>$photos,
                  );
              }
            
            $this->db->where('athlete_id',$ath_id);
            $res=$this->db->update('athlete_galary',$data);
            }
            
            if($res)
            {
              redirect('home/myprofile');
            }
    }





      public function addgalaryimage()
    {
      $ath_id=$this->uri->segment(3);
      foreach ($_FILES['athgallery']['tmp_name'] as $key=> $value)
         {
           $upload_dir='athlete_galary/';
               $temp_error=$_FILES['athgallery']['error'][$key];
               $file_name[]=time().$_FILES['athgallery']['name'][$key];
               $tmp_name=$_FILES['athgallery']['tmp_name'][$key];
               $file_size=$_FILES['athgallery']['size'][$key];
               move_uploaded_file($tmp_name, $upload_dir.time().$_FILES['athgallery']['name'][$key]);
         }
            $photos=implode(',', $file_name);
            $qry1=$this->db->get_where('athlete_galary',array('athlete_id'=>$ath_id));
            $qry=$qry1->num_rows();
            $q=$qry1->row();
            if($qry==0)
            {
              $data=array(
              'athlete_id'=>$ath_id,
              'photos'=>$photos
              );
              $res=$this->db->insert('athlete_galary',$data);

            }if($qry!=0){
              if($q->photos!='')
              {
                    $pto=$q->photos;
                    $data=array(
                   'photos'=>$pto.",".$photos,
                  );
              }
              else
              {
                  $data=array(
                   'photos'=>$photos,
                  );
              }
            
            $this->db->where('athlete_id',$ath_id);
            $res=$this->db->update('athlete_galary',$data);
            }
            
            if($res)
            {
              redirect('home/gallery');
            }
    }





    /////////video part
    public function addextravideo()
    {
      $ath_id=$this->uri->segment(3);
      foreach ($_FILES['videogallery']['tmp_name'] as $key=> $value)
         {
           $upload_dir='athlete_galary/';
               $temp_error=$_FILES['videogallery']['error'][$key];
               $file_name[]=time().$_FILES['videogallery']['name'][$key];
               $tmp_name=$_FILES['videogallery']['tmp_name'][$key];
               $file_size=$_FILES['videogallery']['size'][$key];
               move_uploaded_file($tmp_name, $upload_dir.time().$_FILES['videogallery']['name'][$key]);
         }
            $videos=implode(',', $file_name);
            $qry1=$this->db->get_where('athlete_galary',array('athlete_id'=>$ath_id));
            $qry=$qry1->num_rows();
            $q=$qry1->row();
            if($qry==0)
            {
              $data=array(
              'athlete_id'=>$ath_id,
              'videos'=>$videos
              );
              $res=$this->db->insert('athlete_galary',$data);

            }if($qry!=0){
              if($q->videos!='')
              {
                  $pto=$q->videos;
                  $data=array(
                 'videos'=>$pto.",".$videos,
                  );
              }
              else
              {
                $data=array(
                 'videos'=>$videos,
                  );
              }
            
            $this->db->where('athlete_id',$ath_id);
            $res=$this->db->update('athlete_galary',$data); 
            }
            
            if($res)
            {
              redirect('home/myprofile');
            }
    }



    public function addgalaryvideo()
    {
      $ath_id=$this->uri->segment(3);
      foreach ($_FILES['videogallery']['tmp_name'] as $key=> $value)
         {
           $upload_dir='athlete_galary/';
               $temp_error=$_FILES['videogallery']['error'][$key];
               $file_name[]=time().$_FILES['videogallery']['name'][$key];
               $tmp_name=$_FILES['videogallery']['tmp_name'][$key];
               $file_size=$_FILES['videogallery']['size'][$key];
               move_uploaded_file($tmp_name, $upload_dir.time().$_FILES['videogallery']['name'][$key]);
         }
            $videos=implode(',', $file_name);
            $qry1=$this->db->get_where('athlete_galary',array('athlete_id'=>$ath_id));
            $qry=$qry1->num_rows();
            $q=$qry1->row();
            if($qry==0)
            {
              $data=array(
              'athlete_id'=>$ath_id,
              'videos'=>$videos
              );
              $res=$this->db->insert('athlete_galary',$data);

            }if($qry!=0){
              if($q->videos!='')
              {
                  $pto=$q->videos;
                  $data=array(
                 'videos'=>$pto.",".$videos,
                  );
              }
              else
              {
                $data=array(
                 'videos'=>$videos,
                  );
              }
            
            $this->db->where('athlete_id',$ath_id);
            $res=$this->db->update('athlete_galary',$data); 
            }
            
            if($res)
            {
              redirect('home/gallery');
            }
    }

//My Post start here...

public function blogpost()
{
  $upload_dir='blog_image/';
           $temp_error=$_FILES['image']['error'];
           $file_name=time().$_FILES['image']['name'];
           $tmp_name=$_FILES['image']['tmp_name'];
           $file_size=$_FILES['image']['size'];
           move_uploaded_file($tmp_name, $upload_dir.$file_name);

           $post=array(
        'category'=>$this->input->post('category'),
        'athlete_id'=>$this->input->post('athlete_id'),
        'title'=>$this->input->post('title'),
        'desc'=>$this->input->post('details'),
        'image'=>$file_name
        );

           $status=$this->home_model->add_blogpost($post);
           if($status==true)
           {
            $this->session->set_flashdata('msg',"Post Inserted Successfully");
           }
           else
           {
            $this->session->set_flashdata('msg',"Sorry Something Occurs Wrong!!!");
           }
           
            redirect('home/myprofile'); 
}


   public function editpost()
   {
   		$postid=$this->input->post('postid');
   		$keyid=$this->input->post('keyid');

   		if($_FILES['image_'.$keyid]['name']=='')
   		{
   			$this->db->where('id',$postid);
   			$p=$this->db->get('blog_post')->row();
   			$file_name=$p->image;
   		}
   		else
   		{
   			$upload_dir='blog_image/';
           $temp_error=$_FILES['image_'.$keyid]['error'];
           $file_name=time().$_FILES['image_'.$keyid]['name'];
           $tmp_name=$_FILES['image_'.$keyid]['tmp_name'];
           $file_size=$_FILES['image_'.$keyid]['size'];
           move_uploaded_file($tmp_name, $upload_dir.$file_name);
   		}
   		

           $post=array(
        'category'=>$this->input->post('category_'.$keyid),
        'title'=>$this->input->post('title_'.$keyid),
        'desc'=>$this->input->post('details_'.$keyid),
        'image'=>$file_name
        );

            $status=$this->home_model->update_blogpost($post,$postid);
           if($status==true)
           {
            $this->session->set_flashdata('msg',"Post Updated Successfully");
           }
           else
           {
            $this->session->set_flashdata('msg',"Sorry Something Occurs Wrong!!!");
           }
           
            redirect('home/myprofile');

   }

   public function delete_post($id)
   {
   		$this->db->where('id',$id);
   		if($this->db->delete('blog_post'))
   		{
   			$this->session->set_flashdata('msg',"Post Deleted Successfully");
   			redirect('home/myprofile');
   		}
   		else
   		{
   			$this->session->set_flashdata('msg',"Sorry Something Occurs Wrong!!!");
   			redirect('home/myprofile');
   		}
   }

   //////My event start here.....

   public function insertevent()
   {
   			$upload_dir='event_image/';
           $temp_error=$_FILES['image']['error'];
           $file_name=time().$_FILES['image']['name'];
           $tmp_name=$_FILES['image']['tmp_name'];
           $file_size=$_FILES['image']['size'];
           move_uploaded_file($tmp_name, $upload_dir.$file_name);

              $upload_dir2='event_video/';
           $temp_error2=$_FILES['video']['error'];
           $file_name2=time().$_FILES['video']['name'];
           $tmp_name2=$_FILES['video']['tmp_name'];
           $file_size2=$_FILES['video']['size'];
           move_uploaded_file($tmp_name2, $upload_dir2.$file_name2);

           $post=array(
        'athlete_id'=>$this->input->post('athlete_id'),
        'event_name'=>$this->input->post('title'),
        'event_details'=>$this->input->post('details'),
        'event_place'=>$this->input->post('place'),
        'image'=>$file_name,
        'video'=>$file_name2,
        'price'=>$this->input->post('price'),
        'date'=>$this->input->post('date'),
        'start_time'=>$this->input->post('start_time'),
        'end_time'=>$this->input->post('end_time')
        );

           $status=$this->home_model->add_event($post);
           if($status==true)
           {
            $this->session->set_flashdata('msg',"Event Inserted Successfully");
           }
           else
           {
            $this->session->set_flashdata('msg',"Sorry Something Occurs Wrong!!!");
           }
           
            redirect('home/myevent'); 
   }


   public function editevent()
   {
   		$postid=$this->input->post('postid');
   		$keyid=$this->input->post('keyid');

   		if($_FILES['image_'.$keyid]['name']=='')
   		{
   			$this->db->where('id',$postid);
   			$p=$this->db->get('athlete_events')->row();
   			$file_name=$p->image;
   		}
   		else
   		{
   			$upload_dir='event_image/';
           $temp_error=$_FILES['image_'.$keyid]['error'];
           $file_name=time().$_FILES['image_'.$keyid]['name'];
           $tmp_name=$_FILES['image_'.$keyid]['tmp_name'];
           $file_size=$_FILES['image_'.$keyid]['size'];
           move_uploaded_file($tmp_name, $upload_dir.$file_name);
   		}

        if($_FILES['video_'.$keyid]['name']=='')
      {
        $this->db->where('id',$postid);
        $p=$this->db->get('athlete_events')->row();
        $file_name2=$p->video;
      }
      else
      {
        $upload_dir2='event_video/';
           $temp_error2=$_FILES['video_'.$keyid]['error'];
           $file_name2=time().$_FILES['video_'.$keyid]['name'];
           $tmp_name2=$_FILES['video_'.$keyid]['tmp_name'];
           $file_size2=$_FILES['video_'.$keyid]['size'];
           move_uploaded_file($tmp_name2, $upload_dir2.$file_name2);
      }
   		
        $post=array(
        'event_name'=>$this->input->post('title_'.$keyid),
        'event_details'=>$this->input->post('details_'.$keyid),
        'event_place'=>$this->input->post('place_'.$keyid),
        'image'=>$file_name,
        'video'=>$file_name2,
        'price'=>$this->input->post('price_'.$keyid),
        'date'=>$this->input->post('date_'.$keyid),
        'start_time'=>$this->input->post('start_time_'.$keyid),
        'end_time'=>$this->input->post('end_time_'.$keyid)
        );

            $status=$this->home_model->update_event($post,$postid);
           if($status==true)
           {
            $this->session->set_flashdata('msg',"Event Updated Successfully");
           }
           else
           {
            $this->session->set_flashdata('msg',"Sorry Something Occurs Wrong!!!");
           }
           
            redirect('home/myevent');

   }


    public function delete_event($id)
   {
   		$this->db->where('id',$id);
   		if($this->db->delete('athlete_events'))
   		{
   			$this->session->set_flashdata('msg',"Event Deleted Successfully");
   			redirect('home/myevent');
   		}
   		else
   		{
   			$this->session->set_flashdata('msg',"Sorry Something Occurs Wrong!!!");
   			redirect('home/myevent');
   		}
   }

   ////My service start here...

   public function insertservice()
   {
        if($_FILES['multiimage']['name'][0]!='')
      {
        foreach ($_FILES['multiimage']['tmp_name'] as $key=> $value)
         {
           $upload_dir='service_image/';
               $temp_error=$_FILES['multiimage']['error'][$key];
               $file_name[]=time().$_FILES['multiimage']['name'][$key];
               $tmp_name=$_FILES['multiimage']['tmp_name'][$key];
               $file_size=$_FILES['multiimage']['size'][$key];
               move_uploaded_file($tmp_name, $upload_dir.time().$_FILES['multiimage']['name'][$key]);
         }
            $photos=implode(',', $file_name);
      }
      else
      {
        $photos="";
      }

        $upload_dir='service_image/';
           $temp_error=$_FILES['image']['error'];
           $file_name=time().$_FILES['image']['name'];
           $tmp_name=$_FILES['image']['tmp_name'];
           $file_size=$_FILES['image']['size'];
           move_uploaded_file($tmp_name, $upload_dir.$file_name);

           $post=array(
        'athlete_id'=>$this->input->post('athlete_id'),
        'service_name'=>$this->input->post('service_name'),
        'service_details'=>$this->input->post('details'),
        'long_details'=>$this->input->post('long_details'),
        'image'=>$file_name,
        'multiple_image'=>$photos,
        'service_price'=>$this->input->post('price'),
        'service_hours'=>$this->input->post('hour')
        );

           $status=$this->home_model->add_service($post);
           if($status==true)
           {
            $this->session->set_flashdata('msg',"Service Inserted Successfully");
           }
           else
           {
            $this->session->set_flashdata('msg',"Sorry Something Occurs Wrong!!!");
           }
           
            redirect('home/myservices'); 
   }



   public function editservice()
   {
    $file_name2=array();
      $postid=$this->input->post('postid');
      $keyid=$this->input->post('keyid');

      if($_FILES['image_'.$keyid]['name']=='')
      {
        $this->db->where('id',$postid);
        $p=$this->db->get('athlete_services')->row();
        $file_name=$p->image;
      }
      else
      {
        $upload_dir='service_image/';
           $temp_error=$_FILES['image_'.$keyid]['error'];
           $file_name=time().$_FILES['image_'.$keyid]['name'];
           $tmp_name=$_FILES['image_'.$keyid]['tmp_name'];
           $file_size=$_FILES['image_'.$keyid]['size'];
           move_uploaded_file($tmp_name, $upload_dir.$file_name);
      }

        if($_FILES['multiimage_'.$keyid]['name'][0]!='')
      {
        foreach ($_FILES['multiimage_'.$keyid]['tmp_name'] as $key=> $value)
         {
           $upload_dir='service_image/';
               $temp_error=$_FILES['multiimage_'.$keyid]['error'][$key];
               $file_name2[]=time().$_FILES['multiimage_'.$keyid]['name'][$key];
               $tmp_name=$_FILES['multiimage_'.$keyid]['tmp_name'][$key];
               $file_size=$_FILES['multiimage_'.$keyid]['size'][$key];
               move_uploaded_file($tmp_name, $upload_dir.time().$_FILES['multiimage_'.$keyid]['name'][$key]);
         }
            $photos=implode(',', $file_name2);
            $s=$this->db->get_where('athlete_services',array('id'=>$postid))->row();
            $pic=$s->multiple_image.",".$photos;
      }
      else
      {

        $s=$this->db->get_where('athlete_services',array('id'=>$postid))->row();
        $pic=$s->multiple_image;
      }
      
        $post=array(
        'service_name'=>$this->input->post('service_name_'.$keyid),
        'service_details'=>$this->input->post('details_'.$keyid),
        'long_details'=>$this->input->post('long_details_'.$keyid),
        'image'=>$file_name,
        'multiple_image'=>$pic,
        'service_price'=>$this->input->post('price_'.$keyid),
        'service_hours'=>$this->input->post('hour_'.$keyid)
        );

            $status=$this->home_model->update_service($post,$postid);
           if($status==true)
           {
            $this->session->set_flashdata('msg',"Services Updated Successfully");
           }
           else
           {
            $this->session->set_flashdata('msg',"Sorry Something Occurs Wrong!!!");
           }
           
            redirect('home/myservices');

   }

   public function delete_services($id)
   {
      $this->db->where('id',$id);
      if($this->db->delete('athlete_services'))
      {
        $this->session->set_flashdata('msg',"Services Deleted Successfully");
        redirect('home/myservices');
      }
      else
      {
        $this->session->set_flashdata('msg',"Sorry Something Occurs Wrong!!!");
        redirect('home/myservices');
      }
   }


   public function dltserviceimg()
  {
    $id=$this->uri->segment(3);
    $index_key=$this->uri->segment(4);
    $pp=$this->db->get_where('athlete_services',array('id'=>$id))->row();
    $images=explode(',', $pp->multiple_image);
    unset($images[$index_key]);
    $picture=implode(',', $images);
    $this->db->where('id', $id);
    $this->db->set('multiple_image',$picture);
      $query=$this->db->update('athlete_services'); 
     if($query==true)
     {
      redirect('home/myservices');
     }
  
  }



  }
?>