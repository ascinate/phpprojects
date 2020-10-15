<?php
     if(!defined('BASEPATH')) exit('No direct script access allowed');
   
     class Dashboard extends CI_Controller
     {

        public function __construct()
        {
          parent::__construct();
          $this->load->database();
          $this->load->helper('url');
		  $this->load->library('session');
        }

        public function index()
        {
		  $this->load->view('administrator/inc/header');
		  $this->load->view('administrator/inc/sidebar');
          $this->load->view('administrator/dashboard');
		  $this->load->view('administrator/inc/footer');
        }
		
		public function users()
        {
		  $this->load->view('administrator/inc/header');
		  $this->load->view('administrator/inc/sidebar');
          $this->load->view('administrator/users');
		  $this->load->view('administrator/inc/footer');
        }
		
		public function adduser()
        {
		  $this->load->view('administrator/inc/header');
		  $this->load->view('administrator/inc/sidebar');
          $this->load->view('administrator/adduser');
		  $this->load->view('administrator/inc/footer');
        }
		
	 }
?>