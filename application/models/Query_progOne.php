<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Query_progOne extends CI_Model {
	public function fetchQuery($str){
		$query = $this->db->query($str);
		if($query->num_rows() >= 1)
	        return $query->result();
	    else
	        return null;
	}
	public function fetchSorted($table, $criteria,$column,$sort){
	    if($criteria != '')
	    	$this->db->where($criteria);
	    $this->db->order_by($column,$sort);
	    $query = $this->db->get($table);

	    if($query->num_rows() >= 1)
	        return $query->result();
	    else
	        return null;
	}
	public function fetchMYdaddy($selector,$table,$criteria){
		$this->db->select($selector);
		if($criteria != '')
			$this->db->where($criteria);
		$query = $this->db->get($table);

		if($query->num_rows() >= 1)
			return $query->result();
		else
			return null;
	}
	public function fetchData($table, $criteria){
	    if($criteria != '')
	    	$this->db->where($criteria);
	    $query = $this->db->get($table);

	    if($query->num_rows() >= 1)
	        return $query->result();
	    else
	        return null;
	}
	public function createData($table, $fields){
	    $this->db->insert($table, $fields);
	}
	public function changeData($table, $fields, $criteria){
	    $this->db->update($table, $fields, $criteria);
	}
	public function deleteData($table, $criteria){
	    $this->db->delete($table, $criteria);
	}
	public function countData($table, $criteria){
		if($criteria != '')
	    	$this->db->where($criteria);
	    return $this->db->count_all_results($table);
	}
	public function fetchDataPaginized($limit, $start, $table, $criteria){
		if($criteria != '')
	    	$this->db->where($criteria);
	    $this->db->limit($limit, $start);
	    $query = $this->db->get($table);
	    if($query->num_rows() >= 1)
	        return $query->result();
	    else
	        return null;
	}
	public function fetchDataLimited($limit,$table,$criteria,$field,$sortType){
		if($criteria != '')
	    $this->db->where($criteria);
	    $this->db->limit($limit);
	    $this->db->order_by($field,$sortType);
	    $query = $this->db->get($table);
	    if($query->num_rows() >= 1)
	        return $query->result();
	    else
	        return null;
	}
	public function fetchDataGrouped($table,$group){
		if($group != '')
			$this->db->group_by($group);
	   $query = $this->db->get($table);
	    if($query->num_rows() >= 1)
	        return $query->result();
	    else
	        return null;
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
	public function fetchDataFilteredNGroupedSorted($table,$where,$group,$column,$sort){
		if($where != '')
	    	$this->db->where($where);
				$this->db->order_by($column,$sort);
		if($group != '')
			$this->db->group_by($group);
	   $query = $this->db->get($table);
	    if($query->num_rows() >= 1)
	        return $query->result();
	    else
	        return null;
	}
	public function getone($table,$criteria,$returner){
		if($criteria != '')
		$this->db->where($criteria);
		$query = $this->db->get($table);
		if($query->num_rows() >= 1){
			$ret = $query->result();
			return $ret[0]->$returner;
		}
		else{
			return 0;
		}
	}
	public function checkAccess($systemRole,$accessGroup){
	
		$this->db->where("ar_rrID = '$systemRole' AND 
		role_accessID = uaID AND accessGroup ='$accessGroup'
		");
		$query = $this->db->get("tblAccess_Roles,tblUserAccess_List");

		if($query->num_rows() >= 1){
			$ret = $query->result();
			return $ret[0]->accessCode;
		}
		else{
			return 0;
		}
	}
}
//                                              