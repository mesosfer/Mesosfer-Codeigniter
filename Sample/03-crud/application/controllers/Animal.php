<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Animal extends CI_Controller {

	private $client = null;
	private $appId = 'YOUR-APPID';
	private $appKey = 'YOUR-APPKEY';
	private $bucketName = 'Animal';
	
	function __construct()
	{
	   parent::__construct();
	   $this->client = new \GuzzleHttp\Client();
	}

	public function index()
	{
		$respAuth = $this->client->request('GET', 'https://api.mesosfer.com/api/v2/data/bucket/'.$this->bucketName, [
		    'headers' => ['Authorization' => 'Bearer '.$this->session->userdata('access_token'), 'X-Mesosfer-AppId' => $this->appId, 'X-Mesosfer-AppKey' => $this->appKey]
		]);

		$bodyAuth = (string) $respAuth->getBody();
		$auth = json_decode($bodyAuth);

		$data['animals'] = $auth->results;
		$this->load->view('pages/animal/view',$data);
	}

	public function create()
	{
		$this->load->view('pages/animal/create');
	}

	public function store()
	{
		$name = $this->input->post('name');
		$foot = $this->input->post('foot');
		$metadata = array('metadata' => array('name' => $name, 'foot' => $foot));

		$respAuth = $this->client->request('POST', 'https://api.mesosfer.com/api/v2/data/bucket/'.$this->bucketName, [
		    'json'    => $metadata,
		    'headers' => ['Authorization' => 'Bearer '.$this->session->userdata('access_token'), 
		    'X-Mesosfer-AppId' => $this->appId, 'X-Mesosfer-AppKey' => $this->appKey]
		]);

		$bodyAuth = (string) $respAuth->getBody();
		$auth = json_decode($bodyAuth);

		redirect('animal');
	}

	public function edit($id)
	{
		$respAuth = $this->client->request('GET', 'https://api.mesosfer.com/api/v2/data/bucket/'.$this->bucketName.'/'.$id, [
		    'headers' => ['Authorization' => 'Bearer '.$this->session->userdata('access_token'), 'X-Mesosfer-AppId' => $this->appId, 'X-Mesosfer-AppKey' => $this->appKey]
		]);

		$bodyAuth = (string) $respAuth->getBody();
		$auth = json_decode($bodyAuth);	

		$data['animal'] = $auth->result;
		$this->load->view('pages/animal/edit',$data);
	}

	public function update($id)
	{
		$name = $this->input->post('name');
		$foot = $this->input->post('foot');
		$metadata = array('metadata' => array('name' => $name, 'foot' => $foot));

		$respAuth = $this->client->request('PUT', 'https://api.mesosfer.com/api/v2/data/bucket/'.$this->bucketName."/".$id, [
		    'json'    => $metadata,
		    'headers' => ['Authorization' => 'Bearer '.$this->session->userdata('access_token'), 
		    'X-Mesosfer-AppId' => $this->appId, 'X-Mesosfer-AppKey' => $this->appKey]
		]);

		$bodyAuth = (string) $respAuth->getBody();
		$auth = json_decode($bodyAuth);

		redirect('animal');
	}
}