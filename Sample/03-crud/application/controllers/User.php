<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	private $client = null;
	private $appId = 'YOUR-APPID';
	private $appKey = 'YOUR-APPKEY';

	function __construct()
	{
	   parent::__construct();
	   $this->client = new \GuzzleHttp\Client();
	}

	public function register()
	{
	   $this->load->view('pages/register');
	}

	public function signup()
	{
	   $firstname = $this->input->post('firstname');
	   $lastname = $this->input->post('lastname');
	   $email = $this->input->post('email');
	   $password = $this->input->post('password');

	   $respAuth = $this->client->request('POST', 'https://api.mesosfer.com/api/v2/users', ['json' => ['firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'password' => $password],'headers' => ['X-Mesosfer-AppId' => $this->appId, 'X-Mesosfer-AppKey' => $this->appKey]
	   ]);


	    $bodyAuth = (string) $respAuth->getBody();
		$auth = json_decode($bodyAuth);
		echo "<pre>";
		var_dump($auth);
		echo "</pre>";
	}

	public function login()
	{
		if ($this->session->userdata('logged_in') === TRUE){
			redirect('animal');
		}
		$this->load->view('pages/login');
	}

	public function signin()
	{	
		$email = $this->input->post('email');
		$password =  $this->input->post('password');

		try{

		    $respAuth = $this->client->request('POST', 'https://api.mesosfer.com/api/v2/users/signin', [
				    'json'    => ['email' => $email, 'password' => $password],
				    'headers' => ['X-Mesosfer-AppId' => $this->appId, 'X-Mesosfer-AppKey' => $this->appKey]
			]);

			$bodyAuth = (string) $respAuth->getBody();
			$auth = json_decode($bodyAuth);

			$session = array(
			    'logged_in' => TRUE,
			    'access_token' => $auth->accessToken
			);
			$this->session->set_userdata($session);
			redirect('animal');

		}
		catch (Exception $e) {
				
	        $response = $e->getResponse();
	    	$responseBodyAsString = $response->getBody()->getContents();
	    	$errorMessage = json_decode($responseBodyAsString);
			$this->session->set_flashdata('error_message', $errorMessage->error->error);
			redirect('user/login');
		}
	}

	public function signout()
	{
	    $this->session->sess_destroy();
	    redirect('user/login');
	}
}