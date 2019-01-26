<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_query extends CI_model{
	public function companyList($table, $criteria){
	    if($criteria != '')
	    	$this->db->where($criteria);
	    $query = $this->db->get($table);

	    if($query->num_rows() >= 1)
	        return $query->result();
	    else
	        return null;
	}
	public function archiveCompany($table, $fields, $criteria){
		$this->db->update($table, $fields, $criteria);
	}
	public function updateCompany($table, $fields, $criteria){
		$this->db->update($table, $fields, $criteria);
	}
}
