<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//memanggil file base untuk melakukan penurunan
require_once 'application/controllers/base/base.php';


class telkom extends base

{
	// function Telkom(){
	// 	parent::Controller();
	// }
	
	public function index(){
		// echo base_url('application/libraries');

		// include the OAuth library.        
        include_once APPPATH . "libraries/oauth/library/OAuthStore.php";
        include_once APPPATH . "libraries/oauth/library/OAuthServer.php";
        include_once APPPATH . "libraries/oauth/library/OAuthRequester.php";

        // print_r($this->session->all_userdata());
        // Get the id of the current user (must be an int)
        $user_id = $this->session->userdata('id_user');
        // Initiate the store.
        // $options = array('server' => $this->db->hostname, 'username' => $this->db->username, 'password' => $this->db->password, 'database' => $this->db->database);
        // $store   = OAuthStore::instance('PDO', $options);

        // Telkom id
        $consumer_key = 'bestapp266'; // fill with your public key 
        $consumer_secret = '2AXO4'; // fill with your secret key
        $server_uri = "http://sandbox.appprime.net"; // fill with the url for the oauth service
        $request_uri = "http://sandbox.appprime.net/TemanDev/rest/RequestToken/";
        // $authorize_uri = "https://www.google.com/accounts/OAuthAuthorizeToken";
        $access_uri = "http://sandbox.appprime.net/TemanDev/rest/AccessToken/";


         // The server description
        $server_data = array(
            'consumer_key' => $consumer_key,
            'consumer_secret' => $consumer_secret,
            'server_uri' => $server_uri,
            'signature_methods' => array('HMAC-SHA1', 'PLAINTEXT'),
            'request_token_uri' => $request_uri,
            // 'authorize_uri' => $authorize_uri,
            'access_token_uri' => $access_uri
        );
        //store
        OAuthStore::instance("PDO", $server_data);

        try
        {
        //  STEP 1:  If we do not have an OAuth token yet, go get one
        	$getAuthTokenParams = null;
        // get a request token
        	echo 'fetch request token..';
        	$tokenResultParams = OAuthRequester::requestRequestToken($consumer_key, 0, $getAuthTokenParams);
        	echo 'request token = '.$tokenResultParams["token"];
        	echo '';
        //  STEP 2:  Get an access token
        	try {
        		OAuthRequester::requestAccessToken($consumer_key, $tokenResultParams["token"], 0, 'POST');
        	}
        	catch (OAuthException2 $e)
        	{
        		var_dump($e);
        		return;
        	}        

        // make the docs request.
        	$urlAPI = $server_uri.'/TemanDev/rest/sendEmail/';
        	$opt = array(CURLOPT_HTTPHEADER=>;array('Content-Type: application/json'));
        	$body = '{"sendEmail":{"to":"efendiandriyas@gmail.com","subject":"TEST","content":"Tes send email"}}';        
        	$request = new OAuthRequester($urlAPI,'POST',$tokenResultParams,$body);
        	echo 'execute api..';
        	$result = $request->doRequest(0,$opt);
        	if ($result['code'] == 200) {
        		echo $result['body'];
        	}
        	else {
        		echo 'Error: '.$result['code'];
        	}
        }
        catch(OAuthException2 $e) {
        	echo "OAuthException:  " . $e->getMessage();
        	var_dump($e);
        }

		echo "andriyas";
	}
}