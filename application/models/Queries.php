<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Queries extends CI_model{

	public function getAllRecord($table, $criteria){
	    if($criteria != '')
	        $this->db->where($criteria);
	    $query = $this->db->get($table);
	    if($query->num_rows() >= 1)
	        return $query->result();
	    else
	        return null;
	}
	public function getProcedure(){
		$query = $this->db->query('CALL `getContact`()');
		return $query->result();
	}
	public function saveContact($table,$fields){
		$query = $this->db->insert($table, $fields);
	}
	public function getCountry(){
		$query = $this->db->query('SELECT * FROM tblAddCountry');
		return $query->result();
	}
	public function getLastID(){
		$last_id = $this->db->insert_id();
		return $last_id;
	}
	public function searchTags($userSearch, $table){
		$this->db->select('tagCloudDesc');
		$this->db->like('tagCloudDesc', $userSearch);
		$query = $this->db->get($table);
		$row_set = array();
		if($query->num_rows() > 0){
			foreach ($query->result_array() as $row){
			   $row_set[] = htmlentities(stripslashes($row['tagCloudDesc']));
			}
		}
		return $row_set;
	}
	public function searchCompany($userSearch, $table){
		$this->db->select('compName');
		$this->db->like('compName', $userSearch);
		$query = $this->db->get($table);
		$row_set = array();
		if($query->num_rows() > 0){
			foreach ($query->result_array() as $row){
			   $row_set[] = htmlentities(stripslashes($row['compName']));
			}
		}
		return $row_set;
	}
	public function campaignDrop($table, $criteria){
		   if($criteria != '')
	        $this->db->where($criteria);
	    $query = $this->db->get($table);

	    if($query->num_rows() >= 1)
	        return $query->result();
	    else
	        return null;
	}
	public function campaignAPI($table, $criteria){
		 if($criteria != '')
	        $this->db->where($criteria);
	    $query = $this->db->get($table);

	    if($query->num_rows() >= 1)
	        return $query->result();
	    else
	        return null;
	}
	public function csvSQL(){
		$mySql = " SELECT *,COUNT(keyValID) as Cz  FROM tblCampaign_KeyValue WHERE campaignKey LIKE '$field%' GROUP BY columnName ORDER BY  columnName DESC";
	}
	public function csvSQL1(){
		$mySql = " SELECT *,COUNT(keyValID) as Cz  FROM tblCampaign_KeyValue WHERE campaignKey LIKE '$field%' GROUP BY columnName   ORDER BY  columnName DESC";
	}
	public function activityLogFetch($table,$criteria){
		 if($criteria != '')
	        $this->db->where($criteria);
	    $query = $this->db->get($table);

	    if($query->num_rows() >= 1)
	        return $query->result();
	    else
	        return null;
	}
	public function campaign_Query($table,$criteria){
		if($criteria != '')
				 $this->db->where($criteria);
		$query = $this->db->get($table);

		if($query->num_rows() >= 1)
			return $query->result();
		else
			return null;
	}
	public function searchContactActivity($userSearch,$table){
		$this->db->select('contFirstName');
		//$this->db->query("SELECT CONT(contFirstName,' ',contMiddleName,' ',contLastName)AS fullName FROM tblContContacts WHERE fullname LIKE '..' ");
		$this->db->like('contFirstName', $userSearch);
		$query = $this->db->get($table);
		$row_set = array();
		if($query->num_rows() > 0){
			foreach ($query->result_array() as $row){
				 $row_set[] = htmlentities(stripslashes($row['contFirstName']));
			}
		}
		return $row_set;
	}
	public function saveActivity(){
		$this->db->insert($table, $fields);
	}
}
