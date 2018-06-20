<?php
session_start();
class MapView extends CI_Controller{
	public function __construct() {
		parent::__construct();
		$this->load->helper('setting');
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('Data_Model');
	}

	public function map_view(){
		
		$userinfo['userinfo']=(array)$_SESSION['userData'];
		
		if(isset($userinfo['userinfo']) && $userinfo['userinfo'] != ''){
	        	$user=$userinfo['userinfo'];
	        	$userid='';
	        	if(isset($user['id']) && $user['id'] !=''){
	        		$userid=$user['id'];
	        	}
	        	$local_user=0;
	        	if(isset($user['local_user']) && $user['local_user'] !=''){
	        		$local_user=$user['local_user'];
	        	}
	        	$query=$this->db->query("SELECT COUNT(*) AS count FROM users WHERE googleid ='".$userid."' AND local_user='0'");		        	
	        	$check_user = $query->result();
				$check_user=json_decode(json_encode($check_user), True);
	        	
	        	if(isset($check_user[0]['count']) && $check_user[0]['count'] == 0 && $local_user != 1){
	        		$email='';
	        		if(isset($user['email'])){
	        			$email=$user['email'];
	        		}

	        		$insert_data=array('email' => $email,
							'displayname' => $user['displayName'],
							'googleid' => $userid,
							'image' => '',
							'username' => '',
							'login_flag' => '1',
							'remote_add' => $_SERVER['REMOTE_ADDR']
								);
					$insert_result=$this->Data_Model->insert('users',$insert_data);
	        		$this->load->view('header',$userinfo);
	        		$this->load->view('map_view',$userinfo);
	        	}else{
		        	$query=$this->db->query("SELECT login_flag,remote_add FROM users WHERE googleid ='".$userid."' OR username ='".$user['displayName']."'");
		        	$check_login = $query->result();
					$check_login=json_decode(json_encode($check_login), True);

					if($check_login[0]['login_flag'] == 0){
			        	$login_query="UPDATE users SET login_flag = 1,remote_add='".$_SERVER['REMOTE_ADDR']."' WHERE googleid ='".$userid."' OR username ='".$user['displayName']."'";
			        	$this->db->query($login_query);
			        	$this->load->view('header',$userinfo);
						$this->load->view('map_view',$userinfo);
					}elseif($_SERVER['REMOTE_ADDR'] == $check_login[0]['remote_add'] && $check_login[0]['login_flag'] == 1){
						$this->load->view('header',$userinfo);
						$this->load->view('map_view',$userinfo);
					}else{
						header('Location: ' . filter_var(base_url()."index.php", FILTER_SANITIZE_URL));
					}		
	        	}        	
	        }else{
	        	$this->load->view('login');	
	        }

		}

		public function get_cities(){
	
			$city_query = $this->db->query("SELECT state,city_name AS area,REPLACE(latitude,' N','') AS lat,REPLACE(longitude,' E','') AS longi,'Red' AS color FROM statelist ORDER BY city_name"); 
			$city_data1 = $city_query->result();
			$dropdown_data['city_records']=$city_data1;

			$state_query	=  $this->db->query("SELECT state  AS area,REPLACE(latitude,' N','') AS lat,REPLACE(longitude,' E','') AS longi,'blue' AS color FROM statelist GROUP BY state ORDER BY state"); 
			$state_data1 = $state_query->result();
			$dropdown_data['state_records']=$state_data1;

			echo json_encode($dropdown_data);exit;
		}

	
}
?>