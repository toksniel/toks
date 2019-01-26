<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller {
	public $access =  0;
	public $groupID = 0;
	public $readonly = 7;
	public $readandwrite = 77;
	public $fullaccess = 777;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Query_progOne');
		$this->load->model('Queries');
		if($this->session->has_userdata('userSession')){
			$sesuserID = $this->session->userdata['userSession']['user_ID'];
			$systemRole = $this->Query_progOne->getone("tblUsers"," uniqueId = '$sesuserID' ", "sytemRole");
			$this->groupID = $this->Query_progOne->getone("tblUsers"," uniqueId = '$sesuserID' ", "userGroupID");
			$this->access = $this->Query_progOne->checkAccess($systemRole,'Contacts');
		}else{
			redirect(base_url() . 'Home','refresh');
		}
		//	$this->access = $this->Query_progOne->checkAccess('systemRolvariable','which module? ex. Contacts') ;
	}
	public function index()
	{
		$this->dashboard();
	}
	public function logIn(){
		if($this->session->has_userdata('userSession')) {
			redirect(base_url() . 'Welcome/home');
		}else{
			$this->load->view('reusable/header');
			$this->load->view('contents/login');
			$this->load->view('reusable/foot');
		}
	}
	public function dashboard(){
		$this->load->model('Queries');
		$this->load->helper('download');

		$data['countCont'] = $this->Queries->getAllRecord('tblContContacts',"recStat = '1'");
		$data['totalContacts'] = count($data['countCont']);
		$data['countInq'] = $this->Queries->getAllRecord('tblInquiry_main',"inqStatus = '1'");
		$data['totalInq'] = count($data['countInq']);
		$this->load->view('reusable/header');
		$this->load->view('reusable/sidebar');
		$this->load->view('contents/dashboard',$data);
		$this->load->view('reusable/footer');
	}
	public function msger(){
		$data['as'] = $this->access;
		$this->load->view('reusable/header');
		$this->load->view('reusable/sidebar');
		$this->load->view('dashhome/board', $data);
		$this->load->view('reusable/footer');
	}
	public function home(){
		if( ( $this->access >= $this->readonly ) || ( $this->groupID <= 2 ) ){
			if($this->session->has_userdata('userSession')){
				$contStatus =  ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
				$this->load->model('Queries');
				$data['somedata']= "";
				$sesuserID = $this->session->userdata['userSession']['user_ID'];
				$sesgroupID = $this->session->userdata['userSession']['user_groupId'];
				//$data['arrayData'] = $this->Queries->getGroupProd($sesgroupID, $sesuserID);
				$this->load->model('Query_progOne');
				$data['dropFilter'] = $this->Query_progOne->fetchSorted("tblBarrierdroplist","dropCat = 'filter'","dropName","asc");
				if($sesgroupID <= 2){
					if($contStatus===0){
						$data['arrayData'] =
							$this->Query_progOne->fetchData("tblContContacts","
							recStat = 1 ORDER BY contUID
							"
							);
					}else{
						if($contStatus == 1 ){
							$except_str="";
							$except_these = $this->Query_progOne->fetchData("tblContContacts,tblContContacts_group","tblContContacts.contUID = tblContContacts_group.contactID

							AND tblContContacts.recStat = 1
							GROUP BY tblContContacts.contUID,tblContContacts_group.contactID");

							if(!empty($except_these)){
							
								foreach($except_these as $key2 => $valEx){
									$except_str .= " AND tblContContacts.contUID != ".$valEx->contUID."  ";
								}
							}
						
							$data['arrayData'] =
							$this->Query_progOne->fetchData("tblContContacts","
							recStat = 1 ".$except_str."
							
							"
							);
						}else{
							$data['arrayData'] =
							$this->Query_progOne->fetchData("tblContContacts","
							recStat = 1 AND contType = '$contStatus' ORDER BY contUID
							"
							);
						}
					
					}
					$data['contPhones'] = $this->Query_progOne->fetchData("tblContPhones","
					phoneContType = 'Contact' ORDER BY   defaultFlag,phoneContID,phoneUID
					"
					);
					$data['contMail'] = $this->Query_progOne->fetchData("tblContEmails","
					emailContType = 'Contact' ORDER BY   defaultFlag,emailContID,emailUID
					"
					);
					$data['contComp'] = $this->Query_progOne->fetchData("tblContCompanies,tblContCompMerge","
					tblContCompanies.compUID = tblContCompMerge.compUID ORDER BY   defaultFlag,contUID,tblContCompMerge.compUID
					"
					);
					$data['contactGroup'] = $this->Query_progOne->fetchData("tblContContacts_group","");
					$data['contactTags'] =  $this->Query_progOne->fetchData('tblContTag,tblContTagCloud',"tagCloudID = contCloudTagID AND tagContType='Contact' ");
				}else{
					$qstring="";
					$data['suber'] =
					$this->Query_progOne->
					fetchDataFilteredNGrouped("tblUserLevels",
						"userLevelChildUID ='$sesgroupID' OR `userParentID` = '$sesgroupID'",
						"userLevelChildUID");
					if(!empty($data['suber'])){
						foreach ($data['suber'] as $key => $value) {
							$qstring .= " OR userParentID = ".$value->userLevelChildUID;
						}
						$data['suber'] =
						$this->Query_progOne->
						fetchDataFilteredNGrouped("tblUserLevels",
							"userLevelChildUID ='$sesgroupID' OR `userParentID` = '$sesgroupID' ".$qstring,
							"userLevelChildUID");
					}
					$qstring="";
					if(!empty($data['suber'])){
						foreach ($data['suber'] as $key => $value) {
							$qstring .= " OR parentID = ".$value->userLevelChildUID;
						}
						$data['suber'] =
						$this->Query_progOne->
						fetchDataFilteredNGrouped("tblContContacts_group",
							"groupID ='$sesgroupID' OR `parentID` = '$sesgroupID' ".$qstring,
							"contactID");
					}
					$qstring="";
					if(!empty($data['suber'])){
						$qstring = "";
						foreach ($data['suber'] as $key => $value) {
							$qstring .= " OR contUID = ".$value->contactID;
						}
						if($contStatus===0){
							$data['arrayData'] =$this->Query_progOne->
								fetchDataFilteredNGroupedSorted("tblContContacts",
									"( (contCreated ='$sesuserID') OR (`contAssigned` = '$sesuserID') ".$qstring." )
									AND recStat = 1
								",
									"contUID","contUID ","desc");
						}else{

							if($contStatus == 1 ){
								$except_str="";
								$except_these = $this->Query_progOne->fetchData("tblContContacts,tblContContacts_group","tblContContacts.contUID = tblContContacts_group.contactID

								AND tblContContacts.recStat = 1
								GROUP BY tblContContacts.contUID,tblContContacts_group.contactID");

								if(!empty($except_these)){
								
									foreach($except_these as $key2 => $valEx){
										$except_str .= " AND tblContContacts.contUID != ".$valEx->contUID."  ";
									}
								}
								
								$data['arrayData'] =$this->Query_progOne->
								fetchDataFilteredNGroupedSorted("tblContContacts",
									"( (contCreated ='$sesuserID') OR (`contAssigned` = '$sesuserID') ".$qstring." )
									AND recStat = 1 ".$except_str."
								",
									"contUID","contUID ","desc");

							}else{
								$data['arrayData'] =$this->Query_progOne->
								fetchDataFilteredNGroupedSorted("tblContContacts",
									"( (contCreated ='$sesuserID') OR (`contAssigned` = '$sesuserID') ".$qstring." )
									AND recStat = 1 AND contType = '$contStatus'
								",
									"contUID","contUID ","desc");
							}
							
						}
					}
					$data['contPhones'] = $this->Query_progOne->fetchData("tblContPhones","
					phoneContType = 'Contact' ORDER BY   defaultFlag,phoneContID,phoneUID
					"
					);
					$data['contMail'] = $this->Query_progOne->fetchData("tblContEmails","
					emailContType = 'Contact' ORDER BY   defaultFlag,emailContID,emailUID
					"
					);
					$data['contComp'] = $this->Query_progOne->fetchData("tblContCompanies,tblContCompMerge","
					tblContCompanies.compUID = tblContCompMerge.compUID ORDER BY   defaultFlag,contUID,tblContCompMerge.compUID
					"
					);
					$data['contactGroup'] = $this->Query_progOne->fetchData("tblContContacts_group","");
					$data['contactTags'] =  $this->Query_progOne->fetchData('tblContTag,tblContTagCloud',"tagCloudID = contCloudTagID AND tagContType='Contact' ");
				}//end
				$data['dropValue'] = $this->Queries->getAllRecord('tblActivityDropdwon','dropFlagID = 6');
				$this->load->view('reusable/header');
				$this->load->view('reusable/sidebar');
				$this->load->view('contents/dashboard', $data);
				$this->load->view('reusable/footer');
			}else{
			  redirect(base_url() . 'Welcome/logIn');
			}
		}else{
			$this->msger();
		}
	}
	public function home2(){
		if( ( $this->access >= $this->readonly ) || ( $this->groupID <= 2 ) ){
			if($this->session->has_userdata('userSession')){
				$contStatus =  ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
				$this->load->model('Queries');
				$data['somedata']= "";
				$sesuserID = $this->session->userdata['userSession']['user_ID'];
				$sesgroupID = $this->session->userdata['userSession']['user_groupId'];
				//$data['arrayData'] = $this->Queries->getGroupProd($sesgroupID, $sesuserID);
				$this->load->model('Query_progOne');
				$data['dropFilter'] = $this->Query_progOne->fetchSorted("tblBarrierdroplist","dropCat = 'filter'","dropName","asc");
				if($sesgroupID <= 2){
					if($contStatus===0){
						$data['arrayData'] =
							$this->Query_progOne->fetchData("tblContContacts","
							recStat = 1 ORDER BY contUID
							"
							);
					}else{
						$data['arrayData'] =
							$this->Query_progOne->fetchData("tblContContacts","
							recStat = 1 AND contType = '$contStatus' ORDER BY contUID
							"
							);
					}
					$data['contPhones'] = $this->Query_progOne->fetchData("tblContPhones","
					phoneContType = 'Contact' ORDER BY   defaultFlag,phoneContID,phoneUID
					"
					);
					$data['contMail'] = $this->Query_progOne->fetchData("tblContEmails","
					emailContType = 'Contact' ORDER BY   defaultFlag,emailContID,emailUID
					"
					);
					$data['contComp'] = $this->Query_progOne->fetchData("tblContCompanies,tblContCompMerge","
					tblContCompanies.compUID = tblContCompMerge.compUID ORDER BY   defaultFlag,contUID,tblContCompMerge.compUID
					"
					);
					$data['contactTags'] =  $this->Query_progOne->fetchData('tblContTag,tblContTagCloud',"tagCloudID = contCloudTagID AND tagContType='Contact' ");
				}else{
					$qstring="";
					$data['suber'] =
					$this->Query_progOne->
					fetchDataFilteredNGrouped("tblUserLevels",
						"userLevelChildUID ='$sesgroupID' OR `userParentID` = '$sesgroupID'",
						"userLevelChildUID");
					if(!empty($data['suber'])){
						foreach ($data['suber'] as $key => $value) {
							$qstring .= " OR userParentID = ".$value->userLevelChildUID;
						}
						$data['suber'] =
						$this->Query_progOne->
						fetchDataFilteredNGrouped("tblUserLevels",
							"userLevelChildUID ='$sesgroupID' OR `userParentID` = '$sesgroupID' ".$qstring,
							"userLevelChildUID");
					}
					$qstring="";
					if(!empty($data['suber'])){
						foreach ($data['suber'] as $key => $value) {
							$qstring .= " OR parentID = ".$value->userLevelChildUID;
						}
						$data['suber'] =
						$this->Query_progOne->
						fetchDataFilteredNGrouped("tblContContacts_group",
							"groupID ='$sesgroupID' OR `parentID` = '$sesgroupID' ".$qstring,
							"contactID");
					}
					$qstring="";
					if(!empty($data['suber'])){
						$qstring = "";
						foreach ($data['suber'] as $key => $value) {
							$qstring .= " OR contUID = ".$value->contactID;
						}
						if($contStatus===0){
							$data['arrayData'] =$this->Query_progOne->
								fetchDataFilteredNGroupedSorted("tblContContacts",
									"( (contCreated ='$sesuserID') OR (`contAssigned` = '$sesuserID') ".$qstring." )
									AND recStat = 1
								",
									"contUID","contUID ","desc");
						}else{
							$data['arrayData'] =$this->Query_progOne->
								fetchDataFilteredNGroupedSorted("tblContContacts",
									"( (contCreated ='$sesuserID') OR (`contAssigned` = '$sesuserID') ".$qstring." )
									AND recStat = 1 AND contType = '$contStatus'
								",
									"contUID","contUID ","desc");
						}
					}
					$data['contPhones'] = $this->Query_progOne->fetchData("tblContPhones","
					phoneContType = 'Contact' ORDER BY   defaultFlag,phoneContID,phoneUID
					"
					);
					$data['contMail'] = $this->Query_progOne->fetchData("tblContEmails","
					emailContType = 'Contact' ORDER BY   defaultFlag,emailContID,emailUID
					"
					);
					$data['contComp'] = $this->Query_progOne->fetchData("tblContCompanies,tblContCompMerge","
					tblContCompanies.compUID = tblContCompMerge.compUID ORDER BY   defaultFlag,contUID,tblContCompMerge.compUID
					"
					);
					$data['contactTags'] =  $this->Query_progOne->fetchData('tblContTag,tblContTagCloud',"tagCloudID = contCloudTagID AND tagContType='Contact' ");
				}//end
				$data['dropValue'] = $this->Queries->getAllRecord('tblActivityDropdwon','dropFlagID = 6');
				if(!empty($data['arrayData'])){
					$contactIDprev=0;
					foreach ($data['arrayData'] as $key => $value) {
					$stringer = 'CT'.sprintf("%04d",$value->contUID) .'';
					$stringer = str_replace(' ', '', $stringer);
					$contactID = $value->contUID;
					echo '<tr onclick="htflags=\'dynlist\';">';
						echo '<td><input type="checkbox"  name="dynlistCB" id="dyfiltCB'.$value->contUID.'" class="form-control dynlistCB" value="'.$value->contUID.'" ></td>';
						echo '<td onclick="sprint('."'".$stringer." : ".$value->contFirstName."',".$value->contUID."".')" data-toggle="modal" data-id="32" data-target="#modalContact" >CT'. sprintf("%04d",$value->contUID) .'</td>';
						echo '<td onclick="sprint('."'".$stringer." : ".$value->contFirstName."',".$value->contUID."".')" data-toggle="modal" data-id="32" data-target="#modalContact" >' . $value->contFirstName .' '.$value->contMiddleName. ' ' .$value->contLastName .' </td>';
						if($contactID != $contactIDprev){
						if(!empty($data['contMail'])){
							$nonono1 = true;
							$mail  = 0;
							foreach ($data['contMail'] as $key3 => $value3) {
							$emailCunt = $value3->emailContID;

							if($contactID == $emailCunt && $nonono1 == true){
								echo '<td onclick="sprint('."'".$stringer." : ".$value->contFirstName."',".$value->contUID."".')" data-toggle="modal" data-id="32" data-target="#modalContact" >' .$value3->emailAddress.' </td>';
								$nonono1 = false;
								$mail++;
							}else{
								//echo '<td></td>';
							}
							}
							$nonono1= false;
							if($nonono1 == false && $mail==0){
							echo '<td onclick="sprint('."'".$stringer." : ".$value->contFirstName."',".$value->contUID."".')" data-toggle="modal" data-id="32" data-target="#modalContact" ></td>';
							}
						}
						if(!empty($data['contPhones'])){
							$nonono2 = true;
							$phone = 0;
							foreach ($data['contPhones'] as $key2 => $value2) {
							$phoneCont = $value2->phoneContID;

							if($contactID == $phoneCont && $nonono2 == true){
								echo '<td onclick="sprint('."'".$stringer." : ".$value->contFirstName."',".$value->contUID."".')" data-toggle="modal" data-id="32" data-target="#modalContact" >' . $value2->phoneCode .' '.$value2->phoneNumber.'</td>';
								$nonono2 = false;
								$phone ++;
							}else{
								//echo '<td></td>';
							}
							}
							$nonono2 = false;
							if($nonono2 == false && $phone == 0){
							echo '<td onclick="sprint('."'".$stringer." : ".$value->contFirstName."',".$value->contUID."".')" data-toggle="modal" data-id="32" data-target="#modalContact" ></td>';
							}
						}
						if(!empty($data['contComp'])){
							$nono33 = true;
							$comp = 0;
							foreach ($data['contComp'] as $key4 => $value4) {
							$compContact = $value4->contUID;

							if($contactID == $compContact && $nono33 == true){
								//echo '<td onclick="sprint('."'".$stringer." : ".$value->contFirstName."',".$value->contUID."".')" data-toggle="modal" data-id="32" data-target="#modalContact" >' . $value4->contcompPosition.' <br><i><small> '.$value4->compName.'</small></i></td>';
								$nono33 = false;
								$comp++;
							}else{
								//echo '<td></td>';
							}
							}
							$nono33 = false;
							if($nono33 == false && $comp ==0){
							//echo '<td onclick="sprint('."'".$stringer." : ".$value->contFirstName."',".$value->contUID."".')" data-toggle="modal" data-id="32" data-target="#modalContact" ></td>';
							}
						}
						if(!empty($data['contactTags'])){
							$nono35 = true;
							$tags = 0;
							foreach($data['contactTags'] as $key55 => $value55){
								$tagContact = $value55->tagContID;

								if($contactID == $tagContact && $nono35==true){
								//echo '<td hidden>'.$value55->tagCloudDesc.'</td>';
								$nono35 = false;
								$tags++;
								}else{

								}
							}
							$nono35 = false;
							if($nono35 == false && $tags ==0){
								//echo '<td hidden></td>';
							}

							}
						}
						$contactIDprev = $value->contUID;
						// echo '<td>' .$value->emailAddress.' </td>';
						// echo '<td>' . $value->phoneCode .' '.$value->phoneNumber.' </td>';
						// echo '<td>' . $value->contcompPosition .', '.$value->compName.' </td>';
					echo '</tr>';
					}
				}
			}else{
			  echo 'Permission Denied';
			}
		}else{
			echo 'Permission Denied';
		}
	}
	public function loaderIQ2(){
		$data['contactCompany']=  $this->Query_progOne->
								fetchData('tblContCompanies',
								"");
		if(!empty($data['contactCompany'])){
			foreach ($data['contactCompany'] as $key => $value) {
			 echo '
			 <tr>
			 	 <td>
				  '.$value->compUID.'
				 </td>
				 <td>
					 '.$value->compName.'
				 </td>
				 <td>
					 <button class="btn btn-xs btn-default paper" onclick="chooser('."'".$value->compUID."'".')" data-dismiss="modal">+
					 </button>
				 </td>
			 </tr>
			 ';
			}
		}
	}
	public function loadData(){
		if( ( $this->access >= $this->readandwrite ) || ( $this->groupID <= 2 ) ){
				$this->load->model('Query_progOne');
				$sesgroupID = $this->session->userdata['userSession']['user_groupId'];
				if($sesgroupID <= 2){
					$data['grouplist'] = $this->Query_progOne->fetchSorted("tblUserLevels","","levelname","ASC");
					$data['userlist'] =  $this->Query_progOne->fetchdata("tblUsers","");
				}else{
					$strq = "SELECT t2.userLevelChildUID,t2.levelname,t2.userParentID  FROM tblUserLevels AS t1, tblUserLevels AS t2
					WHERE (t1.userLevelChildUID = '$sesgroupID' OR t1.userParentID ='$sesgroupID')
					AND t1.userLevelChildUID = t2.userParentID
					";
					$qstring="";
					$qstring2="";
					$data['suber'] =  $this->Query_progOne->fetchQuery($strq);
					if(!empty($data['suber'])){
						foreach ($data['suber'] as $key => $value) {
							$qstring .= " OR t2.userParentID = ".$value->userLevelChildUID;
							$qstring2 .= " OR userGroupID =".$value->userLevelChildUID." ";
						}
					}
					$strq = $strq.$qstring." GROUP BY t2.userLevelChildUID ORDER BY t2.levelname ASC";
					$data['userlist'] = $this->Query_progOne->fetchdata("tblUsers","userGroupID = '$sesgroupID' ".$qstring2."");
					$data['quser'] = "SELECT * FROM tblUsers WHERE userGroupID = '$sesgroupID' ".$qstring2;
					$data['grouplist'] = $this->Query_progOne->fetchQuery($strq);

					if(empty($data['grouplist'])){
						$data['grouplist'] = $this->Query_progOne->fetchdata("tblUserLevels","userLevelChildUID ='$sesgroupID' ");
						$data['userlist'] = $this->Query_progOne->fetchdata("tblUsers","userGroupID ='$sesgroupID' ");
					}
				}
				$this->load->model('Queries');
				$sessgroupID = $this->session->userdata['userSession']['user_groupId'];
				$data['dropVal'] = $this->Queries->getAllRecord('tblCampaign_dropdown','');
				$data['column']= $this->Queries->campaignAPI('tblCampaign_customFields', '');
				$data['dropVal2'] = $this->Queries->getAllRecord('tblActivityDropdwon','dropFlagID = 3');
				$data['dropVal3'] = $this->Queries->getAllRecord('tblActivityDropdwon','dropFlagID = 6');
				$data['dropVal5'] = $this->Queries->getAllRecord('tblActivityDropdwon','dropFlagID = 5');
				$data['dropVal4'] = $this->Queries->getAllRecord('tblActivityDropdwon','dropFlagID = 4');
				$data['comps'] = $this->Queries->getAllRecord('tblContCompanies ', 'compRecstat="1" ORDER BY compName ASC');
				$data['arrayCountry'] = $this->Queries->getCountry();

				$this->load->view('reusable/header');
				$this->load->view('reusable/sidebar');
				$this->load->view('contents/createContactContents/mainPage',$data);
				$this->load->view('reusable/footer');

		}else{
			$this->home();
		}
	}
	public function loaderIQ(){
		if($this->session->has_userdata('userSession')){
			$this->load->model('Queries');
			$data['somedata']="";
			$sesuserID = $this->session->userdata['userSession']['user_ID'];
			$sesgroupID = $this->session->userdata['userSession']['user_groupId'];
			//$data['arrayData'] = $this->Queries->getGroupProd($sesgroupID, $sesuserID);
			$this->load->model('Query_progOne');
			$data['dropFilter'] = $this->Query_progOne->fetchSorted("tblBarrierdroplist","dropCat = 'filter'","dropName","asc");
			if($sesgroupID <= 2){
				$data['arrayData'] =
				$this->Query_progOne->fetchDataFilteredNGroupedSorted("tblContContacts ",
					"recStat = 1
					"
					,"tblContContacts.contUID","tblContContacts.contUID",'desc');
			}else{
				$qstring="";
				$data['suber'] =
				$this->Query_progOne->
				fetchDataFilteredNGrouped("tblUserLevels",
					"userLevelChildUID ='$sesgroupID' OR `userParentID` = '$sesgroupID'",
					"userLevelChildUID");
				if(!empty($data['suber'])){
					foreach ($data['suber'] as $key => $value) {
						$qstring .= " OR userParentID = ".$value->userLevelChildUID;
					}
					$data['suber'] =
					$this->Query_progOne->
					fetchDataFilteredNGrouped("tblUserLevels",
						"userLevelChildUID ='$sesgroupID' OR `userParentID` = '$sesgroupID' ".$qstring,
						"userLevelChildUID");
				}
				$qstring="";
				if(!empty($data['suber'])){
					foreach ($data['suber'] as $key => $value) {
						$qstring .= " OR parentID = ".$value->userLevelChildUID;
					}
					$data['suber'] =
					$this->Query_progOne->
					fetchDataFilteredNGrouped("tblContContacts_group",
						"groupID ='$sesgroupID' OR `parentID` = '$sesgroupID' ".$qstring,
						"contactID");
				}
				$qstring="";
				if(!empty($data['suber'])){
					$qstring = "";
					foreach ($data['suber'] as $key => $value) {
						$qstring .= " OR contUID = ".$value->contactID;
					}
					$data['arrayData'] =
					$this->Query_progOne->
					fetchDataFilteredNGroupedSorted("tblContContacts",
						"( (contCreated ='$sesuserID') OR (`contAssigned` = '$sesuserID') ".$qstring." )
						AND recStat = 1
					",
						"contUID","contUID ","desc");
				}
			}//end
			if(!empty($data['arrayData'])){
				foreach ($data['arrayData'] as $key => $value) {
					echo "<tr>";
					echo '<td>CT'.sprintf('%04d', $value->contUID).'</td>';
					echo '<td>'.$value->contFirstName.' '.$value->contLastName.'</td>';
					echo '<td ><button class="btn btn-xs roundedRec paper" onClick="chooser('."'".$value->contUID."'".')" data-dismiss="modal">+ </button></td>';
					echo "</tr>";
				}
			}
		}else{
          redirect(base_url() . 'Welcome/logIn');
        }
	}
	public function ajaxContactAdd(){
		$this->load->model('Queries');
		$contLastName = $this->input->get('ajaxLastName');
		$contFirstName = $this->input->get('ajaxFirstName');
		$contMiddleName = $this->input->get('ajaxMiddleName');
		$contPrefix = $this->input->get('ajaxPrefix');
		$contSuffix = $this->input->get('ajaxSuffix');
		$contSource = $this->input->get('ajaxSource');

		$contAssigned = $this->input->get('ajaxAssigned');
		$contTypeR =  $this->input->get('ajaxContRType');
		$contCreated =  $this->session->userdata['userSession']['user_ID'];
		$fields = $arrayName = array(
			'contLastName' => $contLastName,
			'contFirstName' => $contFirstName,
			'contMiddleName' => $contMiddleName,
			'contPrefix' => $contPrefix,
			'contSuffix' => $contSuffix,
			'contSource' => $contSource,
			'contType' => $contTypeR,
			'contCreated' => $contCreated,
			'contAssigned' => $contAssigned

		);
		$this->Queries->saveContact('tblContContacts',$fields);
	}
	public function ajaxContactChange($contactID){
		$this->load->model('Queries');
		$contLastName = $this->input->get('ajaxLastName');
		$contFirstName = $this->input->get('ajaxFirstName');
		$contMiddleName = $this->input->get('ajaxMiddleName');
		$contPrefix = $this->input->get('ajaxPrefix');
		$contSuffix = $this->input->get('ajaxSuffix');
		$contSource = $this->input->get('ajaxSource');
		$contJobDescription = $this->input->get('ajaxJobDescription');
		$contAssigned = $this->input->get('ajaxAssigned');
		$contTypeR =  $this->input->get('ajaxContRType');
		$fields = $arrayName = array(
			'contLastName' => $contLastName,
			'contFirstName' => $contFirstName,
			'contMiddleName' => $contMiddleName,
			'contPrefix' => $contPrefix,
			'contSuffix' => $contSuffix,
			'contJobDesc' => $contJobDescription,
			'contSource' => $contSource,
			'contType' => $contTypeR,
			'contAssigned' => $contAssigned
		);
		$this->Query_progOne->changeData('tblContContacts',$fields,"contUID = '$contactID' ");
	}
	public function ajaxAddressChange($lastInsID,$flag){
		$this->load->model('Queries');
		$fieldsAdd = array(
			'addContType' => $flag,
			'addContID' => $lastInsID,
			'addRegionID' => $this->input->get('ajaxRegion'),
			'addDistrict' => $this->input->get('ajaxDistrict'),
			'addCity' => $this->input->get('ajaxCity'),
			'addTown' => $this->input->get('ajaxTown'),
			'addStreet' => $this->input->get('ajaxStreet'),
			'addBldg' => $this->input->get('ajaxBldg'),
			'addZip' => $this->input->get('ajaxZip')
		);
		$this->Query_progOne->changeData('tblContAddress',$fieldsAdd,"addContID = '$lastInsID' AND addContType ='Contact' ");
	}
	public function ajaxAddressAdd($lastInsID,$flag){
		$this->load->model('Queries');
		$fieldsAdd = array(
			'addContType' => $flag,
			'addContID' => $lastInsID,
			'addRegionID' => $this->input->get('ajaxRegion'),
			'addDistrict' => $this->input->get('ajaxDistrict'),
			'addCity' => $this->input->get('ajaxCity'),
			'addTown' => $this->input->get('ajaxTown'),
			'addStreet' => $this->input->get('ajaxStreet'),
			'addBldg' => $this->input->get('ajaxBldg'),
			'addZip' => $this->input->get('ajaxZip')
		);
		$this->Queries->saveContact('tblContAddress',$fieldsAdd);
	}
	public function ajaxPhoneAdd($lastID,$flag){
		$this->load->model('Queries');
		$arrPhoneCode = json_decode($this->input->get('ajaxArrPhoneCode'));
		$arrPhoneVal = json_decode($this->input->get('ajaxArrPhone'));
		$arrPhoneLabel = json_decode($this->input->get('ajaxArrPhoneLbl'));
		$phoneSize = sizeof($arrPhoneCode);
		$integerIDs = array_map('intval', explode(',', $arrPhoneVal));
		for($x = 0; $x < $phoneSize; $x++){
			$phoneCode = $arrPhoneCode[$x];
			$phoneVal = $integerIDs[$x];
			$phoneLabel = $arrPhoneLabel[$x];
			if($phoneVal != "" || $phoneLabel !=""){
			$fieldsAdd = array(
				'phoneContType' => $flag,
				'phoneContID' => $lastID,
				'phoneNumber' => $phoneVal,
				'phoneLabel' => $phoneLabel,
				'phoneCode' => $phoneCode
			);
				$this->Queries->saveContact('tblContPhones',$fieldsAdd);
			}
		}
	}
	public function ajaxEmailAdd($lastID,$flag){
		$this->load->model('Queries');
		$arrEmailVal = json_decode($this->input->get('ajaxArrEmail'));
		$arrEmailLabel = json_decode($this->input->get('ajaxArrEmailLbl'));
		$emailSize = sizeof($arrEmailVal);
		for($x = 0; $x < $emailSize; $x++){
			$emailVal = $arrEmailVal[$x];
			$emailLabel = $arrEmailLabel[$x];
			$fieldsAdd = array(
				'emailContType' => $flag,
				'emailContID' => $lastID,
				'emailAddress' => $emailVal,
				'emailLabel' => $emailLabel
			);
			if($emailVal != ""){
					$this->Queries->saveContact('tblContEmails',$fieldsAdd);
			}
		}
	}
	public function ajaxURLAdd($lastID,$flag){
		$this->load->model('Queries');
		$arrURLVal = json_decode($this->input->get('ajaxArrURL'));
		$arrURLLabel = json_decode($this->input->get('ajaxArrURLLbl'));
		$URLSize = sizeof($arrURLVal);
		for($x = 0; $x < $URLSize; $x++){
			$URLVal = $arrURLVal[$x];
			$URLLabel = $arrURLLabel[$x];
			$fieldsAdd = array(
				'urlContType' => $flag,
				'urlContID' => $lastID,
				'urlAddress' => $URLVal,
				'urlLabel' => $URLLabel
			);
			if($URLVal != ""){
				$this->Queries->saveContact('tblContURL',$fieldsAdd);
			}
		}
	}
	public function ajaxSavingTags($contId){
		$this->load->model('Queries');
		$arrTags = json_decode($this->input->get('ajaxAllTags'));
		$allTagsSize = sizeof($arrTags);
		if($allTagsSize > 0){
			foreach ($arrTags as $tagVal) {
				$existingTag = 0;
				$data['cloudTag'] = $this->Queries->getAllRecord('tblContTagCloud', '');
				foreach ($data['cloudTag'] as $key => $value) {
					$eachTagVal = strtolower($value->tagCloudDesc);
					//tag exists
					if(strtolower($tagVal) == $eachTagVal){
						$existingTag = 1;
						$tagID = $value->contCloudTagID;
						$contTagFields = array(
							'tagContType' => $this->input->get('ajaxContType'),
							'tagContID' => $contId,
							'tagCloudID' => $tagID
						);
						$this->Queries->saveContact('tblContTag', $contTagFields);
					}
				}
				//not existing tag
				if($existingTag == 0){
					if($tagVal != ""){
						$contCloudField = array(
							'tagCloudDesc' => $tagVal
						);
						$this->Queries->saveContact('tblContTagCloud', $contCloudField);
						$insertedTagID = $this->Queries->getLastID();
						$contTagFields = array(
							'tagContType' => 'Contact',
							'tagContID' => $contId,
							'tagCloudID' => $insertedTagID
						);
						$this->Queries->saveContact('tblContTag', $contTagFields);
					}
				}
			}
		}
	}
	public function ajaxSavingContacts(){
		if( ( $this->access >= $this->readandwrite ) || ( $this->groupID <= 2 ) ){
			$this->load->model('Queries');
			$contactID = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			if($contactID == 0){
				$this->ajaxContactAdd();
				$contactID = $this->Queries->getLastID();
				$flag = $this->input->get('ajaxContType');
				$this->ajaxAddressAdd($contactID,$flag);
				$this->ajaxPhoneAdd($contactID,$flag);
				$this->ajaxEmailAdd($contactID,$flag);
				$this->ajaxURLAdd($contactID,$flag);
				$this->ajaxSavingTags($contactID);
			}else{
				$contactID = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
				$flag = $this->input->get('ajaxContType');
				$this->ajaxContactChange($contactID);
				$this->ajaxAddressChange($contactID,$flag);
				$this->ajaxPhoneAdd($contactID,$flag);
				$this->ajaxURLAdd($contactID,$flag);
				$this->ajaxEmailAdd($contactID,$flag);
				$this->ajaxSavingTags($contactID);
			}
		}
	}
	public function ajaxSavingComppppp(){
		$sesuserID = $this->session->userdata['userSession']['user_ID'];
		$systemRole = $this->Query_progOne->getone("tblUsers"," uniqueId = '$sesuserID' ", "sytemRole");
		$this->access = $this->Query_progOne->checkAccess($systemRole,'Company') ;

		if( ( $this->access >= $this->readandwrite ) || ( $this->groupID <= 2 ) ){
			$this->load->model('Queries');
			$companyID =  ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$flag = $this->input->get('ajaxContType');
			$this->ajaxAddressAdd($companyID,$flag);
			$this->ajaxPhoneAdd($companyID,$flag);
			$this->ajaxEmailAdd($companyID,$flag);
			$this->ajaxURLAdd($companyID,$flag);
		}
	}
	public function ajaxSavingCompany(){
		$sesuserID = $this->session->userdata['userSession']['user_ID'];
		$systemRole = $this->Query_progOne->getone("tblUsers"," uniqueId = '$sesuserID' ", "sytemRole");
		$this->access = $this->Query_progOne->checkAccess($systemRole,'Company') ;

		if( ( $this->access >= $this->readandwrite ) || ( $this->groupID <= 2 ) ){
			$this->load->model('Queries');
			$this->ajaxSaveComp();
			$companyID = $this->Queries->getLastID();
			$flag = $this->input->get('ajaxContType');
			$this->ajaxAddressAdd($companyID,$flag);
			$this->ajaxPhoneAdd($companyID,$flag);
			$this->ajaxEmailAdd($companyID,$flag);
			$this->ajaxURLAdd($companyID,$flag);
		}
	}
	public function ajaxSaveComp(){
		$this->load->model('Queries');
		$compName = $this->input->get('ajaxCompName');
		$compType = $this->input->get('ajaxCompType');
		$compIndustry = $this->input->get('ajaxCompIndustry');
		$fields = $arrayName = array(
			'compName' => $compName,
			'compType' => $compType,
			'compIndustry' => $compIndustry
		);
		$this->Queries->saveContact('tblContCompanies',$fields);
	}
	public function ajaxGetRegion(){
		$this->load->model('Queries');
		$criteria = array(
			'countryFID' => $this->input->get('ajaxCountryVal')
			);
		$data['countryRS'] = $this->Queries->getAllRecord('tblAddRegion',$criteria);
		echo json_encode($data['countryRS']);
	}
	public function ajaxGetTags(){
		$this->load->model('Queries');
		$searchKey = $this->input->get('term');
		$data['searchRes'] = $this->Queries->searchTags($searchKey, 'tblContTagCloud');
		echo json_encode($data['searchRes']);
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url() . 'Home','refresh');
	}
	public function logouter(){
		$this->session->sess_destroy();
	}
	public function getGroupUser($userGroupID){
		$this->load->model('Queries');
		$data['allGroupUsers'] = $this->Queries->getGroupUserProd($userGroupID);
	}
	public function campaignsCSV(){
		$this->load->model('Queries');
		$data['dropVal'] = $this->Queries->getAllRecord('tblCampaignDropdown',$criteria);
		$data['campaignList'] = $this->Queries->getAllRecord('tblCampaigns',$criteria);
		$this->load->view('reusable/header');
		$this->load->view('reusable/sidebar');
		$this->load->view('getResponse/csv', $data);
		$this->load->view('reusable/footer');
	}
	public function quotationMain(){
		$this->load->view('reusable/header');
		$this->load->view('reusable/sidebar');
		$this->load->view('quotation/quotationList');
		$this->load->view('reusable/footer');
	}
	public function template(){
		$this->load->model('Queries');
		$sessgroupID = $this->session->userdata['userSession']['user_groupId'];
		$data['dropVal'] = $this->Queries->getAllRecord('tblCampaignDropdown','');
		$data['dropVal2'] = $this->Queries->getAllRecord('tblActivityDropdwon','dropFlagID = 3');
		$data['dropVal3'] = $this->Queries->getAllRecord('tblActivityDropdwon','dropFlagID = 6');
		$data['dropVal5'] = $this->Queries->getAllRecord('tblActivityDropdwon','dropFlagID = 5');
		$data['dropVal4'] = $this->Queries->getAllRecord('tblActivityDropdwon','dropFlagID = 4');
		$data['column']= $this->Queries->campaignAPI('tblCampaign_customFields', '');
		$data['arrayUsersGroup'] = $this->Queries->getGroupUserProd2($sessgroupID);
		$data['arrayCountry'] = $this->Queries->getCountry();
		$this->load->view('reusable/header');
		$this->load->view('reusable/sidebar');
		$this->load->view('contents/createContactContents/mainPage', $data);
		$this->load->view('reusable/footer');
	}
	public function ajaxActivityLogSave(){
		$this->load->model('Queries');
		$commentPost = $this->input->get('ajaxComment');
		$datePost = $this->input->get('ajaxDate');
		$userPost = $this->session->userdata['userSession']['user_ID'];
		$contactPost = $this->input->get('ajaxContactID');
		$recStat = 1;
		$fields = array(
			'commentText' => $commentPost,
			'date' => $datePost,
			'userID' => $userPost,
			'contactID' => $contactPost,
			'recStat' => $recStat
		);
		$this->Queries->activityLogSave('tblActivityLog',$fields);
	}
	public function view_contact(){
		$contactID = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['check'] = $this->Query_progOne->fetchData('tblContContacts',"contUID = '$contactID' ");
		if($contactID>0 && !empty($data['check']) && $this->session->has_userdata('userSession')){
			$sesgroupID = $this->session->userdata['userSession']['user_groupId'];
			if($sesgroupID <= 2){
				$data['grouplist'] = $this->Query_progOne->fetchSorted("tblUserLevels","","levelname","ASC");
				$data['userlist'] =  $this->Query_progOne->fetchdata("tblUsers","");
			}else{
				$strq = "SELECT t2.userLevelChildUID,t2.levelname,t2.userParentID  FROM tblUserLevels AS t1, tblUserLevels AS t2
				WHERE (t1.userLevelChildUID = '$sesgroupID' OR t1.userParentID ='$sesgroupID')
				AND t1.userLevelChildUID = t2.userParentID
				";
				$qstring="";
				$qstring2="";
				$data['suber'] =  $this->Query_progOne->fetchQuery($strq);
				if(!empty($data['suber'])){
					foreach ($data['suber'] as $key => $value) {
						$qstring .= " OR t2.userParentID = ".$value->userLevelChildUID;
						$qstring2 .= " OR userGroupID =".$value->userLevelChildUID." ";
					}
				}
				$strq = $strq.$qstring." GROUP BY t2.userLevelChildUID ORDER BY t2.levelname ASC";
				$data['userlist'] = $this->Query_progOne->fetchdata("tblUsers","userGroupID = '$sesgroupID' ".$qstring2."");
				$data['quser'] = "SELECT * FROM tblUsers WHERE userGroupID = '$sesgroupID' ".$qstring2;
				$data['grouplist'] = $this->Query_progOne->fetchQuery($strq);
				if(empty($data['grouplist'])){
					$data['grouplist'] = $this->Query_progOne->fetchdata("tblUserLevels","userLevelChildUID ='$sesgroupID' ");
					$data['userlist'] = $this->Query_progOne->fetchdata("tblUsers","userGroupID ='$sesgroupID' ");
				}
			}
			$data['hehe'] = 0;
			$data['contactDetail'] =  $this->Query_progOne->fetchData('tblContContacts',"contUID = '$contactID' ");
			$data['contactAddress'] =  $this->Query_progOne->fetchData('tblContAddress',"addContID = '$contactID' ");
			$data['contactCountry'] = $this->Query_progOne->fetchDataFilteredNGrouped('tblContAddress,tblAddRegion',"addContID = '$contactID' AND addRegionID = regionID ","countryFID");
			foreach ($data['contactCountry'] as $key => $value) {
				 $varcountry = $value->countryFID;
			}
			$data['contactCountry'] = $varcountry;
			$data['contactphonecode']= $this->Query_progOne->fetchDataFilteredNGrouped('tblContPhones',"phoneContID = '$contactID' ","phoneCode");
			foreach ($data['contactphonecode'] as $key => $value) {
				$varphonecode = $value->phoneCode;
			}
			$data['contactphonecode'] = $varphonecode;
			$data['contactRegionlist'] =  $this->Query_progOne->fetchData('tblAddRegion',"countryFID = '$varcountry'");
			$data['contactCompany']=  $this->Query_progOne->fetchData('tblContCompanies,tblContCompMerge',"contUID = '$contactID' AND tblContCompanies.compUID = tblContCompMerge.compUID");
			$data['contactPhone'] =  $this->Query_progOne->fetchData('tblContPhones',"phoneContID = '$contactID'  ORDER BY defaultFlag ASC ");
			$data['contactEmail'] =  $this->Query_progOne->fetchData('tblContEmails',"emailContID = '$contactID' ORDER BY defaultFlag ASC ");
			$data['contactURL'] = $this->Query_progOne->fetchData('tblContURL',"urlContID = '$contactID' ");
			$data['contactTags'] =  $this->Query_progOne->fetchData('tblContTag,tblContTagCloud',"tagContID = '$contactID' AND tagCloudID = contCloudTagID");
			$data['contactCampaign'] =  $this->Query_progOne->fetchData('tblCampaigns',"contactID = '$contactID' ");
			$this->load->model('Queries');
			$sessgroupID = $this->session->userdata['userSession']['user_groupId'];
			$data['dropVal'] = $this->Query_progOne->fetchdata("tblCampaign_dropdown",'');
			$data['column']= $this->Queries->campaignAPI('tblCampaign_customFields', '');
			$data['arrayUsersGroup'] = $this->Queries->getGroupUserProd2($sessgroupID);
			$data['arrayCountry'] = $this->Queries->getCountry();
			foreach ($data['contactDetail'] as $key => $value) {
				echo '<div class="form-group row">';
				echo '<div class="col-sm-12">';
				echo $value->contFirstName.' '.$value->contMiddleName.' '.$value->contLastName;
				echo '</div>';
				echo '</div>';
			}
		}else{
			echo 'ERROR';
		}
	}
	public function importToGoogle(){
		header('Content-Type: application/json');
		$uuID = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			//$data['fetching'] = $this->Query_progOne->fetchdata('tblContURL,tblContEmails,tblContPhones,tblContTagCloud,tblContTag,tblContContacts,tblContAddress,tblContCompanies,tblContCompMerge',"tblContContacts.contUID ='$uuID' AND tblContContacts.contUID = tblContEmails.emailContID AND tblContContacts.contUID = tblContPhones.phoneContID AND tblContCompanies.compUID = tblContCompMerge.compUID AND tblContContacts.contUID = tblContCompMerge.contUID AND tblContAddress.addContID = tblContContacts.contUID AND emailContType = 'Contact' AND phoneContType = 'Contact' AND addContType = 'Contact' AND urlContType = 'Contact' AND urlContID = '$uuID' AND tagContID = '$uuID' AND tagCloudID = contCloudTagID AND tagContType ='Contact' LIMIT 1");
			//----------------------------------tblContacts--------------------------------------------
			$data['fetching']=$contacts = $this->Query_progOne->fetchData('tblContContacts',"contUID = '$uuID' ");
			$lastName ="";
			$firstName = "";
			$preName = "";
			$sufName = "";
			if(!empty($contacts)){
				foreach ($contacts as $key => $value) {
					$lastName .= $value->contLastName;
					$firstName .= $value->contFirstName;
					$preName .= $value->contPrefix;
					$sufName .= $value->contSuffix;
				}
			}
			//---------------------------------tblEmails--------------------------------------------
			$data['fetching']=$contEmail = $this->Query_progOne->fetchData('tblContEmails',"emailContID = '$uuID' AND emailContType = 'Contact'  ORDER BY defaultFlag ASC ");
			$emails = "";
			$eLabel = "";
			if(!empty($contEmail)){
				foreach ($contEmail as $key => $value) {
					$emails .= $value->emailAddress;
					$eLabel .= $value->emailLabel;
				}
			}
			//----------------------------------tblAddress----------------------------------------
			$data['fetching']=$address =  $this->Query_progOne->fetchData('tblContAddress',"addContID = '$uuID' AND addContType ='Contact'");
			$district = "";
			$city = "";
			if(!empty($address)){
				foreach ($address as $key => $value) {
					$district .= $value->addDistrict;
					$city .= $value->addCity;
				}
			}
			//----------------------------------tblTags--------------------------------------------
			$ctr = 0;
			$data['fetching']=$contactTags =  $this->Query_progOne->fetchData('tblContTag,tblContTagCloud',"tagContID = '$uuID' AND tagCloudID = contCloudTagID AND tagContType = 'Contact' ");
			$tags123 = "";
			if(!empty($contactTags)){
				foreach($contactTags as $key2 => $value2){
					$tags123 .= $value2->tagCloudDesc.', ';
				}
			}
			//----------------------------------tblPhones--------------------------------------------
			$data['fetching']=$contactPhone= $this->Query_progOne->fetchData('tblContPhones',"phoneContID = '$uuID' AND phoneContType ='Contact'");
			$varphonecode ="";
			$labelP = "";
			$data['fetching1'] =$cont= count($data['fetching']);
			$x=0;
			if(!empty($contactPhone)){
				foreach ($contactPhone as $key => $value) {
					$x++;
					$varphonecode .= $value->phoneCode.$value->phoneNumber;
					$labelP .=$value->phoneLabel;
					$strsss .= '{"value":"'.$varphonecode.'", "type":"'.$labelP.'"}';
				}
			}
			//-----------------------------------tblCompany------------------------------------------
			$data['fetching']=$companies= $this->Query_progOne->fetchData('tblContCompanies,tblContCompMerge',"contUID = '$uuID' AND tblContCompanies.compUID = tblContCompMerge.compUID");
			$compName = "";
			$jobDesc="";
			if(!empty($companies)){
				foreach ($companies as $key => $value) {
					$compName .= $value->compName;
					$jobDesc .= $value->contcompPosition;
				}
			}
					echo json_encode(array(
					'givenName' => "$firstName",
					'familyName'=> "$lastName",
					"honorificPrefix"=> "$preName",
					"honorificSuffix"=>"$sufName",
					'emailAddresses'=>"$emails",
					'phoneNumbers' => "$varphonecode",
					'streetAddress' => "$district",
					'city' => "$city",
					'jobDescription' => "$jobDesc",
					'company' => "$compName",
					'biographies' =>"$tags123",
					'id' =>"$uuID",
					'plabel'=>"$labelP",
					'elabel'=>"$eLabel"
				));

	}
}
//                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           