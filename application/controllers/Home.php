<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct()
	{
			parent::__construct();
			error_reporting(0);
			$this->load->model('Query_progOne');
	}		
    public function index()
	{
		$this->logIn();
	}
	public function logIn(){

		if($this->session->has_userdata('userSession')){
			redirect(base_url() . 'Welcome/home');
		}else{
			$this->load->view('reusable/header');
			$this->load->view('contents/login');
			$this->load->view('reusable/foot');
		}
    }
    public function verifyLogIn(){

		$this->load->model('Queries');
		$usPas = $this->input->post('loginPassword');
		$maskedPass = md5($usPas);
		$criteria = array(
			'userName' => $this->input->post('loginUsername'),
			'userPass' => $maskedPass,
			'recStat' => '1'
			);
		$data['resultSet'] = $this->Queries->getAllRecord('tblUsers',$criteria);
		$arraySize = count($data['resultSet']);
		if($arraySize > 0){
			$userID = $data['resultSet'][0]->uniqueId;
			$userName = $data['resultSet'][0]->userFirstName . ' ' . $data['resultSet'][0]->userLastName;
			$userPos = $data['resultSet'][0]->userJobDesc;
			$userGroupId = $data['resultSet'][0]->userGroupID;
			$userImgurl = $data['resultSet'][0]->userProfPic;
			$sRole = $data['resultSet'][0]->sytemRole;
			$recStat = $data['resultSet'][0]->recStat;
			$userSes = array(
				'user_ID' => $userID,
				'user_WholeName' => $userName,
				'user_pos' => $userPos,
				'user_groupId' => $userGroupId,
				'user_profpic' =>$userImgurl,
				'user_sRole' => $sRole,
				'recStat' => 1
			);
			$this->session->set_userdata('userSession', $userSes);
			redirect(base_url() . 'Welcome');
		}
		else{
			redirect(base_url() . 'Home/logIn','refresh');
		}
	}
	public function vs(){
		if($this->session->has_userdata('userSession')){
			echo '<script>window.location.replace("dashboard.html");</script>';
		}else{
			echo 'Null';
		}
	}
	public function verifyLogIn2(){
		header('Content-Type: application/json');
		$this->load->model('Queries');
		$usPas = $this->input->post('loginPassworder');
		$uss = $this->input->post('loginUsernamer');
		$usPas2 = $usPas;
		$maskedPass = md5($usPas);
		$criteria = array(
			'userName' => $uss,
			'userPass' => $maskedPass,
			'recStat' => '1'
			);
		$data['resultSet'] = $this->Query_progOne->fetchData('tblUsers',"userName = '$uss' AND userPass ='$maskedPass'");
		$arraySize = count($data['resultSet']);
		if(!empty($data['resultSet'])){
			$userID = $data['resultSet'][0]->uniqueId;
			$userName = $data['resultSet'][0]->userFirstName . ' ' . $data['resultSet'][0]->userLastName;
			$userPos = $data['resultSet'][0]->userJobDesc;
			$userGroupId = $data['resultSet'][0]->userGroupID;
			$userImgurl = $data['resultSet'][0]->userProfPic;
			$ppw = $data['resultSet'][0]->userPass;
			$sRole = $data['resultSet'][0]->sytemRole;
			$recStat = $data['resultSet'][0]->recStat;
			$userSes = array(
				'user_ID' => $userID,
				'user_WholeName' => $userName,
				'user_pos' => $userPos,
				'user_groupId' => $userGroupId,
				'user_profpic' =>$userImgurl,
				'user_sRole' => $sRole,
				'recStat' => 1
			);
			
			echo json_encode(array(
				'xid' => "$userID",
				'xname'=> "$userName",
				'xpos'=>"$userPos",
				'xgroup' => "$userGroupId",
				'ximg' => "$userImgurl",
				'xrole' => "$sRole",
				'xuurl' => "dashboard.html",
				'xstat' => "success"
			));
			$this->session->set_userdata('userSession', $userSes);
			
		}
		else{
			
			echo json_encode(array(
				'xstat' => "error",
				'response' => 'error'
			));
		}
	}

}
//                                                                                                                                                                                                                                                                                                                                                                                                                                                                   