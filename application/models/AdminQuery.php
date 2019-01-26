<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminQuery extends CI_model{
	public function userList($table, $criteria){
		if($criteria != '')
	        $this->db->where($criteria);
	    $query = $this->db->get($table);

	    if($query->num_rows() >= 1)
	        return $query->result();
	    else
	        return null;
	}
	public function fetchUserLevel($table, $criteria){
	    if($criteria != '')
	    	$this->db->where($criteria);
	    $query = $this->db->get($table);

	    if($query->num_rows() >= 1)
	        return $query->result();
	    else
	        return null;
	}
	public function addUser($table,$fields){
		$query = $this->db->insert($table, $fields);
	}
	public function ajaxNewLevel($table,$fields){
		$query = $this->db->insert($table, $fields);
	}
	public function updateUser($table, $fields, $criteria){
		$this->db->update($table, $fields, $criteria);
	}
	public function archiveUser($table, $fields, $criteria){
	    $this->db->update($table, $fields, $criteria);
	}
	public function getLastID(){
		$last_id = $this->db->insert_id();
		return $last_id;
	}
	public function fetchDataFilteredNGrouped($table,$where,$group){
		if($where != '')
	    	$this->db->where($where);
		if($group != '')
			$this->db->group_by($group);
	   $query = $this->db->get($table);
	    if($query->num_rows() >= 1)
	        return $query->result();
	    else
	        return null;
	}
	public function gitME(){
		$contactID = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['contactCampaign'] =  $this->Query_progOne->fetchData('tblCampaigns',"contactID = '$contactID' ");
		if(!empty($data['contactCampaign'])){
			$campaignKeyVal;
			 foreach ($data['contactCampaign'] as $key => $value) {
				 $campaign =  $value->campaignName;
				 $campaignTags =  $value->campaignTags;
				 $campaignKeyVal = $value->campaignKeyVal;
				 echo '<i class="'.$campaign.'">'.$campaign.'</i>';
				 echo '<b class="'.$campaign.'">'.$campaignTags.'</b>';
				 $gitModaldatactr =0;
				 foreach ($contactCampaignKeys as $key2 => $value2) {
					 $campaign2 =  $value2->campaignName;
					 $campaignVal = $value2->campaignVal;
					 $campaignKey = $value2->campaignKey;
					 $columnName = $value2->columnName;
					 if($campaignKeyVal == $campaignKey){
						 $gitModaldatactr+=1;
						 echo '<u class="'.$campaign2.'">'.$columnName.'</u>';
						 echo '<small class="'.$campaign2.' getvalSmall'.$gitModaldatactr.$campaign2.'">'.$campaignVal.'</small>';
					 }
				 }
			 }
		}else{
			echo "<div></div>";
		}
	}
}
