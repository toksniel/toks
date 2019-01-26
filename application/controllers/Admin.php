<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
		{
			parent::__construct();
			date_default_timezone_set("Asia/Manila");
			if($this->session->has_userdata('userSession')){
			}else{
				redirect(base_url() . 'Home','refresh');
			}
			$this->load->model('AdminQuery');
			$this->load->model('Query_progOne');
			$userID	 = $this->session->userdata['userSession']['user_ID'];
			$userG = $this->session->userdata['userSession']['user_groupId'];
			$url2 = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
			if($userG!=1 ){
				if( $url2 =="changePass" || $url2 =="perUserEdit" || $url2 == "uploadimg" || $url2 == "ajaxChangePass" || $url2 == "ajaxPerUserEdit"){
					
				}else{
					redirect(base_url() . 'Welcome/','refresh');
				}
			}
		}
	public function index(){
		$this->home();
	}
	public function home(){
		$data['userList'] = $this->AdminQuery->userList('tblUsers',"recStat=1");
		$this->load->view('reusable/header');
		$this->load->view('reusable/sidebar');
		$this->load->view('superAdmin/adminDashboard',$data);
		$this->load->view('reusable/footer');
	}
	public function userLevelMaster(){
		$data['userLevel'] = $this->AdminQuery->fetchUserLevel('tblUserLevels' ,"");
		//$data['userLevel2'] = $this->Query_progOne->fetchData('tblUserLevels',"userParentID = userLevelChildUID GROUP BY userParentID ASC");
		$this->load->view('reusable/header');
		$this->load->view('reusable/sidebar');
		$this->load->view('superAdmin/userLevel',$data);
		$this->load->view('reusable/footer');
	}
	public function dash(){
		$this->load->view('reusable/header');
		$this->load->view('reusable/sidebar');
		$this->load->view('contents/dashboard');
		$this->load->view('reusable/footer');
	}
	public function addUserLevel(){
		$data['childID'] = $this->AdminQuery->fetchUserLevel('tblUserLevels',"");
		$this->load->view('reusable/header');
		$this->load->view('reusable/sidebar');
		$this->load->view('superAdmin/createUserLevel',$data);
		$this->load->view('reusable/footer');
	}
	public function newUser(){
		$data['userLevel'] = $this->AdminQuery->fetchUserLevel('tblUserLevels',"");
		$data['roleList'] = $this->Query_progOne->fetchData('tblRole_list',"");
		$this->load->view('reusable/header');
		$this->load->view('reusable/sidebar');
		$this->load->view('superAdmin/addUser', $data);
		$this->load->view('reusable/footer');
	}
	public function editUser(){
		$userID = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['roleList'] = $this->Query_progOne->fetchData('tblRole_list',"");
		$data['editData'] = $this->AdminQuery->fetchUserLevel('tblUsers',"uniqueId='$userID' ");
		$data['userLevel'] = $this->AdminQuery->fetchUserLevel('tblUserLevels',"");
		$this->load->view('reusable/header');
		$this->load->view('reusable/sidebar');
		$this->load->view('superAdmin/editUser', $data);
		$this->load->view('reusable/footer');
	}
	public function perUserEdit(){
		$userID = $this->session->userdata['userSession']['user_ID'];
		$data['editData'] = $this->AdminQuery->fetchUserLevel('tblUsers',"uniqueId='$userID' ");
		$this->load->view('reusable/header');
		$this->load->view('reusable/sidebar');
		$this->load->view('superAdmin/perUserEdit', $data);
		$this->load->view('reusable/footer');
	}
	public function changePass(){
		$userID = $this->session->userdata['userSession']['user_ID'];
		$data['editData'] = $this->AdminQuery->fetchUserLevel('tblUsers',"uniqueId='$userID' ");
		$this->load->view('reusable/header');
		$this->load->view('reusable/sidebar');
		$this->load->view('superAdmin/changePass', $data);
		$this->load->view('reusable/footer');
	}
	public function listUser(){
		$data['userList'] = $this->AdminQuery->userList('tblUsers',"recStat=1");
		$this->load->view('reusable/header');
		$this->load->view('reusable/sidebar');
		$this->load->view('superAdmin/userList',$data);
		$this->load->view('reusable/footer');
	}
	public function ajaxUser(){
		$this->load->model('AdminQuery');
		$this->AdminQuery->addUser('tblUsers',$fields);
	}
	public function ajaxNewUser(){
		$this->load->model('AdminQuery');
		$userName = $this->input->get('ajaxUserName');
		$userLastName = $this->input->get('ajaxUserLname');
		$userFirstName = $this->input->get('ajaxUserFname');
		$userJobDesc = $this->input->get('ajaxUserJob');
		$userPass = $this->input->get('ajaxUserPass');
		$userGroupID = $this->input->get('ajaxuserGroup');
		$cgroupUserLevel = $this->input->get('ajaxcgroupUserLevel');
		$userStatus = $this->input->get('ajaxUserStatus');
		$userPass =md5($userPass);
		$userEmail =  $this->input->get('ajaxEmail');
		$sytemRole = $this->input->get('ajaxRole');
		$fields= $arryFields = array(
			'userName'=> $userName,
			'userLastName'=> $userLastName,
			'userFirstName'=> $userFirstName,
			'userJobDesc' => $userJobDesc,
			'userPass' => $userPass,
			'userGroupID'=>$userGroupID,
			'cgroupUserLevel'=>$cgroupUserLevel,
			'cgroupUserStatus'=> $userStatus,
			'userEmail' => $userEmail,
			'sytemRole' => $sytemRole
		);
		$this->AdminQuery->addUser('tblUsers',$fields);
	}
	public function ajaxNewLevel(){
		$g =   $this->input->get('ajaxGID');
		echo $g.'hehehe';
		$this->load->model('AdminQuery');
			$userLevel = $this->input->get('ajaxuserLevel');
			$newLevelID = $this->input->get('ajaxnewLevelID');
			$fields=$arrayFields = array(
				'userParentID'=>$newLevelID,
				'levelname'=>$userLevel
			);
		if($g ==0){
			$this->AdminQuery->ajaxNewLevel('tblUserLevels',$fields);
			$forID = $this->Query_progOne->fetchData('tblUserLevels',"1 = '1' ORDER BY userLevelChildUID DESC LIMIT 1");
			$idqwe = $forID[0]->userParentID;
			$levelPK = $forID[0]->userLevelChildUID;
			if ($idqwe == 0){
				$fields=$arrayFields = array(
					'userParentID' => $levelPK
				);
				$this->Query_progOne->changeData('tblUserLevels',$fields,"userLevelChildUID = '$levelPK' ");
			}
		}else{
			$this->Query_progOne->changeData('tblUserLevels',$fields,"userLevelChildUID = '$g' ");
		}
	}
	public function ajaxArchiveUser(){
		$userID=$this->input->get('ajaxID');
		$fields = $arrayFields =array(
			'recStat'=> 0
		);
		$this->AdminQuery->archiveUser('tblUsers',$fields,"uniqueId='$userID'");
	}
	public function ajaxEditUser(){
		$this->load->model('AdminQuery');
		$userID = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$userName = $this->input->get('ajaxUserName');
		$userLastName = $this->input->get('ajaxUserLname');
		$userFirstName = $this->input->get('ajaxUserFname');
		$userJobDesc = $this->input->get('ajaxUserJob');
		//$userPass = $this->input->get('ajaxUserPass');
		$userGroupID = $this->input->get('ajaxuserGroup');
		$cgroupUserLevel = $this->input->get('ajaxcgroupUserLevel');
		$userStatus = $this->input->get('ajaxUserStatus');
		$userEmail = $this->input->get('ajaxEmail');
		$userRole = $this->input->get('ajaxRole');
		//$userPass =md5($userPass);
		$fields= $arryFields = array(
			'userName'=> $userName,
			'userLastName'=> $userLastName,
			'userFirstName'=> $userFirstName,
			'userJobDesc' => $userJobDesc,
			//'userPass' => $userPass,
			'userGroupID'=>$userGroupID,
			'cgroupUserLevel'=>$cgroupUserLevel,
			'cgroupUserStatus'=> $userStatus,
			'userEmail' => $userEmail,
			'sytemRole' => $userRole
		);
		$this->AdminQuery->updateUser('tblUsers',$fields,"uniqueId='$userID'");
	}
	public function ajaxPerUserEdit(){
		$this->load->model('AdminQuery');
		$userID = $this->session->userdata['userSession']['user_ID'];
		$userName = $this->input->get('ajaxUserName');
		$userLastName = $this->input->get('ajaxUserLname');
		$userFirstName = $this->input->get('ajaxUserFname');
		$userJobDesc = $this->input->get('ajaxUserJob');
		$userEmail =  $this->input->get('ajaxEmail');
		$fields= $arryFields = array(
			'userName'=> $userName,
			'userLastName'=> $userLastName,
			'userFirstName'=> $userFirstName,
			'userJobDesc' => $userJobDesc,
			'userEmail' => $userEmail
		);
		$this->AdminQuery->updateUser('tblUsers',$fields,"uniqueId='$userID'");
	}
	public function ajaxChangePass(){
		$this->load->model('AdminQuery');
		$userID = $this->session->userdata['userSession']['user_ID'];
		$hiddenUserPass =$this->input->get('ajaxhiddenUserPass');
		$oldPass =$this->input->get('ajaxoldPass');
		$userPass1 = $this->input->get('ajaxuserPass1');
		$hash = md5($oldPass);
		$hash2 = md5($userPass1);
		if($hiddenUserPass != $hash){
			$message = "Wrong Current Password";
			echo $message;
		}
		else{
		$fields= $arryFields = array(
			'userPass'=> $hash2,
		);
		$this->AdminQuery->updateUser('tblUsers',$fields,"uniqueId='$userID'");
		$message = "Successfuly update password";
		echo $message;
		$this->output->delete_cache();
		}
	}
	public function uploadimg(){
		ini_set('memory_limit', '1050M' );
		  $this->load->model('Query_progOne');
		$config['upload_path'] = base_url()."assets/uploads/";
		$config['allowed_types'] = 'jpeg|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '2024';
		$config['max_height']  = '1168';
		$this->load->library('upload', $config);
		$dir = "assets/uploads/"; // chjange path
		$url =  $this->uri->segment(3); // Admin/function/url/eventname
		$url =  preg_replace('/\s+/', '', $url);
		$url = "assets/uploads/user".$url; // new folder
		$contactID =  $this->uri->segment(4);
		$this->load->library('ftp','upload');
		$sesuserID = $this->session->userdata['userSession']['user_ID'];
		$ul_url =  $this->Query_progOne->getone("tblUsers"," uniqueId = '$sesuserID' ", "userProfPic");
		$ul_url = str_replace(base_url(),"",$ul_url);
	
			
			$ictr = 0;
		
			$ictr = '';
			$url =  $this->uri->segment(3); // Admin/function/url/eventname
			$url =  preg_replace('/\s+/', '', $url);
			$date = date("mdy");
			$time = date("hisa");
			$url = $time.$ictr.$date.$url;
			$url = "assets/uploads/".$url; // new folder
			$namerImg = "";
			$namerImg = $_FILES["image"]["name"];
			$namerImg =  preg_replace('/\s+/', '', $namerImg);
			$namerImg = 'user-'.$sesuserID.$time.$ictr.$date.$namerImg;

			$path = $_FILES['image']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);

			$namerImg = $time.$ictr.$date.'user.'.$ext;

			$path = $_FILES['image']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			$dir = "assets/uploads/user/";


			$ictr = '-'.$sesuserID.'x'.rand(11,99).'-';
			$namerImg = $time.$ictr.$date.'user.'.$ext;

			$url =$dir. $namerImg;	
		

			$allowedExts = array("gif", "jpeg", "jpg", "png");
			//($_FILES["file"]["size"] < 20000) && 
			if (in_array( strtolower($ext), $allowedExts)){
				if(file_exists($ul_url)){
					unlink($ul_url);
				}
				
					move_uploaded_file($_FILES["image"]["tmp_name"], $dir. $namerImg);
					$fields = array(
					'userProfPic' => $url,
					'uniqueId' => $sesuserID
					); //url
						$this->Query_progOne->changeData('tblUsers',$fields,"uniqueId = '$sesuserID'"); //update renamed
		
					$image_info = getimagesize($dir.$namerImg);
		
					$url = $dir.$namerImg;
					$image_width = $image_info[0];
					$image_height = $image_info[1];
					$extension = image_type_to_extension($image_info[2]);
					$extension = strtolower($extension);
					$path_parts = pathinfo($url);
					$nam = $path_parts['basename'];
					$dir = $path_parts['dirname'];
		
					$mansi =  $this->uri->segment(5);
					$dev = $this->uri->segment(6);
					
						$this->patatIOS($url,$extension,$nam,$dir,$mansi);
			}else{
				echo 'File not Supported! ';
			}


		

		
	}
	public function patatIOS($url,$extension,$nam,$dir,$oreo){
		
		ini_set('memory_limit', '1050M' );
		$date = date(".m.d.y.");
			$time = date("h.i.s.a.");
		$rotatorC = 0;
		$pepsiman = $oreo;
		$im = $url;
		$str_rule = $nam;
		$str_rec = $dir;
		$tgid=$extension;
		$tgid  = strtolower($tgid);	

			if($tgid==".png"){
				//$im = imagecreatefrompng($im);
				$image = imagecreatefrompng($im);
			}elseif($tgid ==".jpeg"){
				//$im = imagecreatefromjpeg($im);
				$image = imagecreatefromjpeg($im);
			}elseif($tgid ==".jpg"){
				//$im = imagecreatefromjpg($im);
				$image = imagecreatefromjpg($im);
				
			}elseif($tgid ==".gif"){
				//$im = imagecreatefromgif($im);
				$image = imagecreatefromgif($im);
			}

			switch ($pepsiman) {
				case 3:
					$rotatorC+= 180;
					if($tgid==".png"){
						$transparency = imagecolorallocatealpha( $image,0,0,0,127 );
		
						$image = imagerotate($image, $rotatorC, $transparency, 0);
						imagealphablending( $image, false );
						imagesavealpha( $image, true );
					}else{
						$image = imagerotate($image, $rotatorC, 0);
					}
				
					break;
	
				case 6:
				$rotatorC+= -90;
				if($tgid==".png"){
					$transparency = imagecolorallocatealpha( $image,0,0,0,127 );
	
					$image = imagerotate($image, $rotatorC, $transparency, 0);
					imagealphablending( $image, false );
					imagesavealpha( $image, true );
				}else{
					$image = imagerotate($image, $rotatorC, 0);
				}
			
					break;
	
				case 8:
				$rotatorC+= 90;
				if($tgid==".png"){
					$transparency = imagecolorallocatealpha( $image,0,0,0,127 );
	
					$image = imagerotate($image, $rotatorC, $transparency, 0);
					imagealphablending( $image, false );
					imagesavealpha( $image, true );
				}else{
					$image = imagerotate($image, $rotatorC, 0);
				}
			
					break;
				default : 	
				$rotatorC+= 0;
				if($tgid==".png"){
					$transparency = imagecolorallocatealpha( $image,0,0,0,127 );
	
					$image = imagerotate($image, $rotatorC, $transparency, 0);
					imagealphablending( $image, false );
					imagesavealpha( $image, true );
				}else{
					$image = imagerotate($image, $rotatorC, 0);
				}
			
					break;
			}
			
			

			if($tgid==".png"){
				imagepng($image, $dir.'/'.$str_rule );
			}elseif($tgid ==".jpeg"){
				imagejpeg($image, $dir.'/'.$str_rule );
			}elseif($tgid ==".jpg"){
				imagejpg($image, $dir.'/'.$str_rule  );
			}elseif($tgid ==".gif"){
				imagegif($image, $dir.'/'.$str_rule );
			}

			imagedestroy($image);
			


			//echo $rotatorC;
			echo "Image Successfuly Uploaded.<br><br>";
			echo '<img src="'.base_url().$url.'?ts=a'.$date.$time.'" class="csIMG2">';
	}


	public function roles(){
		$data['userLevel'] = $this->AdminQuery->fetchUserLevel('tblRole_list',"");
		$data['modList'] =$this->Query_progOne->fetchData('tblUserAccess_List'," 1='1' Group BY accessGroup ORDER BY accessGroup"); 
		$this->load->view('reusable/header');
		$this->load->view('reusable/sidebar');
		$this->load->view('superAdmin/userRoles',$data);
		$this->load->view('reusable/footer');
	}
	public function editaccess(){
		$roleID = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		$data['accessList'] = $this->Query_progOne->fetchData('tblUserAccess_List'," 1='1' Group BY accessGroup ORDER BY accessGroup");
		$data['accessList2'] = $this->Query_progOne->fetchData('tblUserAccess_List'," 1='1' ORDER BY accessCode");
		$data['access_m_role'] = $this->Query_progOne->fetchData('tblAccess_Roles,tblUserAccess_List'," ar_rrID = '$roleID' AND 
		role_accessID = uaID ");
		$data['roleInfo'] = $this->Query_progOne->fetchData('tblRole_list'," rrID='$roleID' ");
		$this->load->view('reusable/header');
		$this->load->view('reusable/sidebar');
		$this->load->view('superAdmin/accessgranter_edit',$data);
		$this->load->view('reusable/footer');
	}
	public function useraccess(){
		$userID = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['accessList'] = $this->Query_progOne->fetchData('tblUserAccess_List'," 1='1' Group BY accessGroup ORDER BY accessGroup");
		$data['accessList2'] = $this->Query_progOne->fetchData('tblUserAccess_List'," 1='1' ORDER BY accessCode");
		//$data['userInfo'] = $this->Query_progOne->fetchData('tblUsers'," uniqueId='$userID' ");
		$this->load->view('reusable/header');
		$this->load->view('reusable/sidebar');
		$this->load->view('superAdmin/accessgranter',$data);
		$this->load->view('reusable/footer');
	}
	public function role_access1(){
		$roleEE_ID = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$rolename = $this->input->post('xmlRR');
		if($roleEE_ID != 0 ){
			$fields = array(					
				'rr_name' => $rolename
			);			
			$this->Query_progOne->changeData('tblRole_list',$fields,"rrID = '$roleEE_ID' ");
			$this->Query_progOne->deleteData('tblAccess_Roles',"ar_rrID = '$roleEE_ID' ");
			echo $roleEE_ID;
		}else{
			$fields = array(					
				'rr_name' => $rolename
			);			
			$this->Query_progOne->createData('tblRole_list',$fields);
			$forID = $this->Query_progOne->fetchData('tblRole_list',"rr_name = '$rolename' ORDER BY rrID DESC LIMIT 1");
			echo $forID[0]->rrID;
		}
	}
	public function role_access2(){
		$roleEE_ID = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		$rolename = $this->input->post('xmlRR');
		$accessID = $this->input->post('xmlAA');
		$fields = array(					
			'ar_rrID' => $rolename,
			'role_accessID' => $accessID
		);
		$this->Query_progOne->createData('tblAccess_Roles',$fields);
	}
	public function role_rem_noragrets(){
		$roleEE_ID = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$this->Query_progOne->deleteData('tblRole_list',"rrID = '$roleEE_ID' ");
		$this->Query_progOne->deleteData('tblAccess_Roles',"ar_rrID = '$roleEE_ID' ");
	}
	public function group_rem_noragrets(){
		$roleEE_ID = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$this->Query_progOne->deleteData('tblUserLevels',"userLevelChildUID = '$roleEE_ID' ");
	}
	public function editGroup(){
		$id = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['childID'] = $this->AdminQuery->fetchUserLevel('tblUserLevels',"");
		$data['saved'] = $this->AdminQuery->fetchUserLevel('tblUserLevels',"userLevelChildUID = '$id' ");
		$this->load->view('reusable/header');
		$this->load->view('reusable/sidebar');
		$this->load->view('superAdmin/createUserLevel',$data);
		$this->load->view('reusable/footer');
	}
	public function newmod(){	
		$accessGroup = $this->input->post('modname');
		$data['czx'] = $this->Query_progOne->fetchData('tblUserAccess_List',"accessGroup = '$accessGroup' ");
		if(empty($data['czx'])){
			$fields = array(					
				'accessGroup' => $accessGroup,
				'displayName' => 'Read only',
				'accessCode' => 7
			);			
			$this->Query_progOne->createData('tblUserAccess_List',$fields);
			////-------------------------------------------------------------
			$fields2 = array(					
				'accessGroup' => $accessGroup,
				'displayName' => 'Read and Write',
				'accessCode' => 77
			);	
			$this->Query_progOne->createData('tblUserAccess_List',$fields2);
			////-------------------------------------------------------------
			$fields3 = array(					
				'accessGroup' => $accessGroup,
				'displayName' => 'Full Access',
				'accessCode' => 777
			);	
			$this->Query_progOne->createData('tblUserAccess_List',$fields3);
		}
	}
}
//                                                                                                                                                                                                                      