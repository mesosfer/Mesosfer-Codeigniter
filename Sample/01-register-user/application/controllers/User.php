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
}