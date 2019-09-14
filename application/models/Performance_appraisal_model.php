<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
* Filename: Performance_appraisal_model.php
* Filepath: models / performance_appraisal_model.php
* Edited by: Saddam
*/
class Performance_appraisal_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    // Get all performance evaluations, recently added.
	public function get_performance_evaluation($limit, $offset) {
	  $this->db->select('performance_evaluation.*,
	  							ucpo_data.id,
	  							ucpo_data.name,
	  							ucpo_data.position,
	  							ucpo_data.cnic_name,
	  							ucpo_data.province,
	  							ucpo_data.district,
	  							ucpo_data.tehsil,
	  							ucpo_data.uc,
	  							ucpo_data.join_date,
	  							peo_data.peo_id,
	  							peo_data.peo_name,
	  							peo_data.peo_cnic');
	  $this->db->from('performance_evaluation');
	  $this->db->join('ucpo_data', 'performance_evaluation.employee_id = ucpo_data.id');
	  $this->db->join('peo_data', 'ucpo_data.cnic_peo = peo_data.peo_cnic');
	  $this->db->limit($limit, $offset);
	  return $this->db->get()->result();
	}
	// Count evaluations.
	public function count_evaluations(){
		return $this->db->from('performance_evaluation')->count_all_results();
	}

	// Get employees for evalution's dropdown.
	public function get_employees(){
		$this->db->select('employee_id, first_name, last_name');
		$this->db->from('xin_employees');
		return $this->db->get()->result();
	}
	// Add performance evaluation data to the database, general and PTPP holder's different skills.
	public function add($data){

		$this->db->insert('performance_evaluation', $data);

		if ($this->db->affected_rows() > 0) {

			return true;

		} else {

			return false;

		}

	}
	// Get employee for PTPP evaluation recently inserted.
	public function ptpp_employees(){
		$this->db->select('performance_evaluation.eval_id,
									performance_evaluation.employee_id as emp_id,
									performance_evaluation.created_at');
		$this->db->from('performance_evaluation');
		// $this->db->join('xin_employees', 'performance_evaluation.employee_id = xin_employees.employee_id');
		$this->db->order_by('performance_evaluation.created_at', 'DESC');
		return $this->db->get()->result();
	}
	// Add data to the database, remarks by the PTPP holder.
	public function add_ptpp_remarks($data){
		$this->db->insert('ptpp_remarks', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	// Display PTPP holders' remarks
	public function get_ptpp_remarks($id=''){
		$this->db->select('ptpp_remarks.remark_id,
									ptpp_remarks.employee_id,
									ptpp_remarks.remarks,
									ptpp_remarks.signature,
									ptpp_remarks.created_at');
		$this->db->from('ptpp_remarks');
		// $this->db->join('xin_employees', 'ptpp_remarks.employee_id = xin_employees.employee_id');
		$this->db->where('ptpp_remarks.employee_id', $id);
		return $this->db->get()->row();
	}
	// Add data to database, remarks the second level supervisor. (Assessment result).
	public function add_sec_level_remarks($data){
		$this->db->insert('sec_level_sup_remarks', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	// Display second level supervisors' remarks. (Assessment result).
	public function get_sec_level_remarks($id = ''){
		$this->db->select('sec_level_sup_remarks.sec_remark_id, 
							sec_level_sup_remarks.employee_id,
							sec_level_sup_remarks.assessment_result,
							sec_level_sup_remarks.signature,
							sec_level_sup_remarks.created_at');
		$this->db->from('sec_level_sup_remarks');
		// $this->db->join('xin_employees', 'sec_level_sup_remarks.employee_id = xin_employees.employee_id');
		$this->db->where('sec_level_sup_remarks.employee_id', $id);
		return $this->db->get()->row();
	}
	

	// Function to Delete selected record from table

	public function delete_record($id){

		$this->db->where('eval_id', $id);

		$this->db->delete('performance_evaluation');

		

	}

	

	// Function to update record in table

	public function update_record($data, $id){

		$this->db->where('eval_id', $id);

		if( $this->db->update('performance_evaluation',$data)) {

			return true;

		} else {

			return false;

		}		

	}
	/* ------------------------------------------------------------------------------- */
	// Form data submission for TCSP.
	// Count all evaluations.
	public function count_tcsp(){
		return $this->db->from('tcsp_evaluations')->count_all_results();
	}
	// Get all evaluations previously made.
	public function get_tcsp_evaluations($limit = '', $offset = ''){
		$this->db->select('tcsp_evaluations.*,
		  							ucpo_data.id,
		  							ucpo_data.name,
		  							ucpo_data.position,
		  							ucpo_data.cnic_name,
		  							ucpo_data.province,
		  							ucpo_data.district,
		  							ucpo_data.tehsil,
		  							ucpo_data.uc,
		  							ucpo_data.join_date,
		  							ac_data.ac_id,
		  							ac_data.ac_name,
		  							ac_data.ac_cnic');
	   $this->db->from('tcsp_evaluations');
	   $this->db->join('ucpo_data', 'tcsp_evaluations.employee_id = ucpo_data.id');
	   $this->db->join('ac_data', 'ucpo_data.cnic_ac = ac_data.ac_cnic');
	   $this->db->limit($limit, $offset);
	   return $this->db->get()->result();
	}
	// Insert data into the database, TCSP form data.
	public function insert_tcsp_evaluations($data){
		$this->db->insert('tcsp_evaluations', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	// Get TCSP employees to list them in the dropdown for TCSP remarks.
	public function tcsp_employees(){
		$this->db->select('tcsp_evaluations.evalu_id,
									tcsp_evaluations.employee_id as empl_id,
									tcsp_evaluations.created_at,
									ucpo_data.id,
									ucpo_data.name,
									ucpo_data.cnic_name,
									ucpo_data.cnic_ac');
		$this->db->from('tcsp_evaluations');
		$this->db->join('ucpo_data', 'tcsp_evaluations.employee_id = ucpo_data.id');
		$this->db->where('ucpo_data.cnic_ac', $this->session->userdata('ac_cnic'));
		return $this->db->get()->result();
	}
	// Get remarks by TCSP.
	public function get_tcsp_remarks($id=''){
		$this->db->select('tcsp_remarks.remarks_id,
									tcsp_remarks.employee_id,
									tcsp_remarks.remarks,
									tcsp_remarks.signature,
									tcsp_remarks.created_at');
		$this->db->from('tcsp_remarks');
		// $this->db->join('xin_employees', 'tcsp_remarks.employee_id = xin_employees.employee_id');
		$this->db->where('employee_id', $id);
		return $this->db->get()->row();
	}
	// Save TCSP remarks to the database.
	public function add_tcsp_remarks($data){
		$this->db->insert('tcsp_remarks', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	// Get Second level TCSP remarks.
	public function get_sec_level_tcsp($id=''){
		$this->db->select('sec_level_tcsp_remarks.sec_tcsp_rem_id,
							sec_level_tcsp_remarks.employee_id,
							sec_level_tcsp_remarks.assessment_result,
							sec_level_tcsp_remarks.signature,
							sec_level_tcsp_remarks.created_at');
		$this->db->from('sec_level_tcsp_remarks');
		// $this->db->join('xin_employees', 'sec_level_tcsp_remarks.employee_id = xin_employees.employee_id');
		$this->db->where('employee_id', $id);
		return $this->db->get()->row();
	}
	// Save second level tcsp remarks to the database.
	public function add_sec_level_tcsp($data){
		$this->db->insert('sec_level_tcsp_remarks', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}


}

?>