<?php
session_start();
class Register extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}
	public function index() {
		$this->load->view('header');
		$this->load->view('register');
	}

	public function insert_user() {
		$query=$this->db->query("SELECT count(*) AS count FROM users WHERE username ='".$_REQUEST['username']."'");
		$check_duplicate = $query->result();
		$check_duplicate = json_decode(json_encode($check_duplicate), True);

		if($check_duplicate[0]['count'] > 0){
			$data['message']=$_REQUEST['username']." is already exist in the system.";
			$this->load->view('header');
			$this->load->view('register',$data);
		}else{

			$insert_data=array('email' => $_REQUEST['email'],
							'username' => $_REQUEST['username'],
							'password' => $_REQUEST['pwd'],
							'googleid' => '0',
							'displayname' => $_REQUEST['username'],
							'remote_add' => $_SERVER['REMOTE_ADDR'],
							'local_user' => '1'	
								);
			$insert_result=$this->Data_Model->insert('users',$insert_data);
  			header('Location: ' . filter_var(base_url()."index.php", FILTER_SANITIZE_URL));
	    }
	}

	public function check_validation() {
			$username=$password=0;
			if(isset($_REQUEST['username']) && isset($_REQUEST['password'])){
				$username=$_REQUEST['username'];
				$password=$_REQUEST['password'];
			}
			$query=$this->db->query("SELECT COUNT(*) AS count FROM users WHERE username ='".$username."' AND password ='".$password."'");

			$check_cred = $query->result();
			$check_cred = json_decode(json_encode($check_cred), True);
			// print_r($check_cred);
			if($check_cred[0]['count'] == '0'){
				echo $return = 'invalid';
  								
			}else{	
				$query=$this->db->query("SELECT username,username AS displayName,email,login_flag,googleid,local_user FROM users WHERE username ='".$username."' AND password ='".$password."'");
				$check_cred = $query->result();
				$check_cred = json_decode(json_encode($check_cred), True);
				$data['userData']	= $check_cred;
				unset($_SESSION['userData']);
				$_SESSION['userData'] = $data['userData']['0'];
				echo $return = 'success';
  									
			}
	}

}