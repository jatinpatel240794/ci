<?php
session_start();

class Login extends CI_Controller {
public $user = "";
public $userData ="";

public function __construct() {

	parent::__construct();
	$this->load->helper('setting');
	$this->load->database();
}

public function index() {
	$data=$this->url_service();
	$this->load->view('header', $data);
	$this->load->view('login', $data);
}

public function url_service(){
	
	include_once APPPATH . "../vendor/google/apiclient/src/Google/Client.php";
	include_once APPPATH . "../vendor/google/apiclient-services/src/Google/Service/Oauth2.php";

	$client_id = CLIENT_ID;
	$client_secret = CLIENT_SECRET;
	$redirect_uri = base_url().'index.php';
	$simple_api_key = CLIENT_REDIRECT_URL;

	// Create Client Request to access Google API
	$client = new Google_Client();
	$client->setApplicationName("PHP Google OAuth Login Example");
	$client->setClientId($client_id);
	$client->setClientSecret($client_secret);
	$client->setRedirectUri($redirect_uri);
	$client->setDeveloperKey($simple_api_key);
	$client->addScope("https://www.googleapis.com/auth/userinfo.email");
	$client->setScopes(array(Google_Service_Plus::PLUS_ME));
	
	$objOAuthService = new Google_Service_Oauth2($client);
	$plus = new Google_Service_Plus($client);
	if (isset($_GET['code'])) {
		$client->authenticate($_GET['code']);
		$_SESSION['access_token'] = $client->getAccessToken();
		header('Location: ' . filter_var($redirect_uri."/mapview/map_view", FILTER_SANITIZE_URL));
	}

	if ($client->getAccessToken()) {
		$me = $plus->people->get('me');
        $data['userData'] = (array)$me;
        $_SESSION['access_token'] = $client->getAccessToken();
		$_SESSION['userData'] = $me;
	} else {
		$authUrl = $client->createAuthUrl();
		$data['authUrl'] = $authUrl;
	}
	return $data;
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

public function logout() {
	$logout_data=array('login_flag' => 0,
						'remote_add' => $_SERVER['REMOTE_ADDR']);
	$where_condition="googleid ='".$_REQUEST['id']."' or username = '".$_REQUEST['username']."'";
	$update=$this->Data_Model->update('users',$logout_data,$where_condition);
	unset($_SESSION['access_token']);	
	session_destroy();
	header('Location: ' . filter_var(base_url()."index.php", FILTER_SANITIZE_URL));
}



}
?>