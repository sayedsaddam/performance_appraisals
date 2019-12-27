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
							peo_data.peo_cnic,
							ac_data.ac_id,
							ac_data.ac_name,
							ac_data.ac_cnic');
	  $this->db->from('performance_evaluation');
	  $this->db->join('ucpo_data', 'performance_evaluation.employee_id = ucpo_data.id', 'left');
	  $this->db->join('peo_data', 'ucpo_data.cnic_peo = peo_data.peo_cnic', 'left');
	  $this->db->join('ac_data', 'ucpo_data.cnic_ac = ac_data.ac_cnic', 'left');
	  $this->db->where('ucpo_data.cnic_peo', $this->session->userdata('peo_cnic'));
	  $this->db->or_where('ucpo_data.cnic_ac', $this->session->userdata('ac_cnic'));
	  $this->db->limit($limit, $offset);
	  $query = $this->db->get();
	  return $query->result();
	}
	// Get data for admin.
	public function get_performance_evaluation_admin($limit, $offset) {
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
							peo_data.peo_cnic,
							ac_data.ac_id,
							ac_data.ac_name,
							ac_data.ac_cnic');
	  $this->db->from('performance_evaluation');
	  $this->db->join('ucpo_data', 'performance_evaluation.employee_id = ucpo_data.id');
	  $this->db->join('peo_data', 'ucpo_data.cnic_peo = peo_data.peo_cnic');
	  $this->db->join('ac_data', 'ucpo_data.cnic_ac = ac_data.ac_cnic', 'left');
	  $this->db->limit($limit, $offset);
	  $query = $this->db->get();
	  return $query->result();
	}
	// Count evaluations.
	public function count_evaluations(){
		return $this->db->from('performance_evaluation')->count_all_results();
	}
	// Get UCPO's by ID.
	public function get_by_id($eval_id){
		$this->db->select('rollback_comment');
		$this->db->from('performance_evaluation');
		$this->db->where('eval_id', $eval_id);
		return $this->db->get()->row();
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
	// Update performance evaluation if Rolled back.
	public function update_rolled_back($employee_id = '', $data = ''){
		$this->db->where('employee_id', $employee_id);
		$this->db->update('performance_evaluation', $data);
		return true;
	}
	// Get employees for UCPO's recently evaluated.
	public function ptpp_employees(){
		$this->db->select('performance_evaluation.eval_id,
							performance_evaluation.employee_id as emp_id,
							performance_evaluation.created_at,
							ucpo_data.id,
							ucpo_data.name,
							ucpo_data.cnic_name');
		$this->db->from('performance_evaluation');
		$this->db->join('ucpo_data', 'performance_evaluation.employee_id = ucpo_data.id', 'left');
		$this->db->where('ucpo_data.cnic_name', $this->session->userdata('ucpo_cnic'));
		$this->db->where('employee_id NOT IN(SELECT employee_id FROM ptpp_remarks)');
		$query = $this->db->get();
		return $query->result();
	}
	// Get employees for AC to evaluate. (UCPO's.)
	public function get_ptpp(){
		$this->db->select('ptpp_remarks.remark_id,
									ptpp_remarks.employee_id,
									ucpo_data.id,
									ucpo_data.name,
									ucpo_data.cnic_name,
									ac_data.ac_id,
									ac_data.ac_cnic');
		$this->db->from('ptpp_remarks');
		$this->db->join('ucpo_data', 'ptpp_remarks.employee_id = ucpo_data.id', 'left');
		$this->db->join('ac_data', 'ucpo_data.cnic_ac = ac_data.ac_cnic', 'left');
		$this->db->where('ucpo_data.cnic_ac', $this->session->userdata('ac_cnic'));
		$this->db->where('employee_id NOT IN(SELECT employee_id FROM sec_level_sup_remarks)');
		$this->db->group_by('ucpo_data.id');
		$query = $this->db->get();
		return $query->result();
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
									ptpp_remarks.comment,
									ptpp_remarks.created_at');
		$this->db->from('ptpp_remarks');
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
	// Get address for the selected employee (On Change function). [UCPO's].
	public function get_address_ucpos($id){
		$this->db->select('id, province, district, tehsil, uc');
		$this->db->from('ucpo_data');
		$this->db->where('id', $id);
		return $this->db->get()->row();
	}
	// Get address the selected employee (On change function). [TCSP's].
	public function get_address_tcsps($id){
		$this->db->select('id, province, district, tehsil, uc, cnic_name');
		$this->db->from('tcsp_data');
		$this->db->where('id', $id);
		return $this->db->get()->row();
	}
	// Get previously added UCPO's form attributes.
	public function get_previously_added($id = ''){ // UCPO's data...
		$this->db->select('*');
		$this->db->from('performance_evaluation');
		$this->db->where('employee_id', $this->uri->segment(3));
		$this->db->limit(1);
		return $this->db->get()->row();
	}
	// Get previously added TCSP's form attributes.
	public function get_previously_added_tcsps($id = ''){ // TCSP's data...
		$this->db->select('*');
		$this->db->from('tcsp_evaluations');
		$this->db->where('employee_id', $this->uri->segment(3));
		$this->db->limit(1);
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
		  							tcsp_data.id,
		  							tcsp_data.name,
		  							tcsp_data.position,
		  							tcsp_data.cnic_name,
		  							tcsp_data.province,
		  							tcsp_data.district,
		  							tcsp_data.tehsil,
		  							tcsp_data.uc,
		  							tcsp_data.join_date,
		  							peo_data.peo_id,
		  							peo_data.peo_name,
		  							peo_data.peo_cnic,
		  							ac_data.ac_id,
		  							ac_data.ac_name,
		  							ac_data.ac_cnic');
	    $this->db->from('tcsp_evaluations');
	    $this->db->join('tcsp_data', 'tcsp_evaluations.employee_id = tcsp_data.id', 'left');
	    $this->db->join('peo_data', 'tcsp_data.cnic_peo = peo_data.peo_cnic', 'left');
	    $this->db->join('ac_data', 'tcsp_data.cnic_ac = ac_data.ac_cnic', 'left');
	    $this->db->where(array('tcsp_data.cnic_peo'=> $this->session->userdata('peo_cnic')));
	    $this->db->or_where(array('tcsp_data.cnic_ac'=> $this->session->userdata('ac_cnic')));
	    $this->db->limit($limit, $offset);
	    $query = $this->db->get();
	    return $query->result();
	}
	// Get for admin
	public function get_tcsp_evaluations_admin($limit = '', $offset = ''){
		$this->db->select('tcsp_evaluations.*,
		  							tcsp_data.id,
		  							tcsp_data.name,
		  							tcsp_data.position,
		  							tcsp_data.cnic_name,
		  							tcsp_data.province,
		  							tcsp_data.district,
		  							tcsp_data.tehsil,
		  							tcsp_data.uc,
		  							tcsp_data.join_date,
		  							peo_data.peo_id,
		  							peo_data.peo_name,
		  							peo_data.peo_cnic,
		  							ac_data.ac_id,
		  							ac_data.ac_name,
		  							ac_data.ac_cnic');
	    $this->db->from('tcsp_evaluations');
	    $this->db->join('tcsp_data', 'tcsp_evaluations.employee_id = tcsp_data.id', 'left');
	    $this->db->join('peo_data', 'tcsp_data.cnic_peo = peo_data.peo_cnic', 'left');
	    $this->db->join('ac_data', 'tcsp_data.cnic_ac = ac_data.ac_cnic', 'left');
	    $this->db->limit($limit, $offset);
	    $query = $this->db->get();
	    return $query->result();
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
	// Get TCSP's by ID.
	public function get_tcsp_by_id($evalu_id){
		$this->db->select('evalu_id, rollback_comment');
		$this->db->from('tcsp_evaluations');
		$this->db->where('evalu_id', $evalu_id);
		return $this->db->get()->row();
	}
	// Update TCSP evaluations if rolled back.
	public function update_tcsp_rolled_back($employee_id = '', $data = ''){
		$this->db->where('employee_id', $employee_id);
		$this->db->update('tcsp_evaluations', $data);
		return true;
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
		$this->db->where('employee_id NOT IN(SELECT employee_id FROM tcspp_remarks)');
		return $this->db->get()->result();
	}
	// Get employees for AC to evaluate. (TCSP's.)
	public function get_tcsps(){
		$this->db->select('tcsp_evaluations.evalu_id,
									tcsp_evaluations.employee_id,
									tcsp_data.id,
									tcsp_data.name,
									tcsp_data.cnic_name');
		$this->db->from('tcsp_evaluations');
		$this->db->join('tcsp_data', 'tcsp_evaluations.employee_id = tcsp_data.id', 'left');
		$this->db->where('tcsp_data.cnic_name', $this->session->userdata('tcsp_cnic'));
		$this->db->where('employee_id NOT IN(SELECT employee_id FROM tcsp_remarks)');
		return $this->db->get()->result();
	}
	// Get for AC.
	public function get_tcsps_for_ac(){
		$this->db->select('tcsp_evaluations.evalu_id,
									tcsp_evaluations.employee_id,
									tcsp_data.id,
									tcsp_data.name,
									tcsp_data.cnic_ac');
		$this->db->from('tcsp_evaluations');
		$this->db->join('tcsp_data', 'tcsp_evaluations.employee_id = tcsp_data.id', 'left');
		$this->db->where('tcsp_data.cnic_ac', $this->session->userdata('ac_cnic'));
		$this->db->where('employee_id NOT IN(SELECT employee_id FROM sec_level_tcsp_remarks)');
		return $this->db->get()->result();
	}
	// Get remarks by TCSP.
	public function get_tcsp_remarks($id=''){
		$this->db->select('tcsp_remarks.remarks_id,
									tcsp_remarks.employee_id,
									tcsp_remarks.remarks,
									tcsp_remarks.signature,
									tcsp_remarks.comment,
									tcsp_remarks.created_at');
		$this->db->from('tcsp_remarks');
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

  // ---------------------------------------------------------------------------
  // Export to Excel..
	// Export to excel using Codeigniter's library phpSpreadsheet. [TCSP's data].
	public function export_excel(){
		$this->db->select('tcsp_evaluations.*,
		  							tcsp_data.id,
		  							tcsp_data.name,
		  							tcsp_data.position,
		  							tcsp_data.cnic_name,
		  							tcsp_data.province,
		  							tcsp_data.district,
		  							tcsp_data.tehsil,
		  							tcsp_data.uc,
		  							tcsp_data.join_date,
		  							peo_data.peo_id,
		  							peo_data.peo_name,
		  							peo_data.peo_cnic,
		  							ac_data.ac_id,
		  							ac_data.ac_name,
		  							ac_data.ac_cnic,
		  							tcsp_remarks.employee_id as tcsp_id,
		  							tcsp_remarks.comment,
		  							sec_level_tcsp_remarks.employee_id as sec_tcsp_id,
		  							sec_level_tcsp_remarks.assessment_result');
	   $this->db->from('tcsp_evaluations');
	   // $this->db->limit(10);
	   $this->db->join('tcsp_data', 'tcsp_evaluations.employee_id = tcsp_data.id');
	   $this->db->join('peo_data', 'tcsp_data.cnic_peo = peo_data.peo_cnic', 'left');
	   $this->db->join('ac_data', 'tcsp_data.cnic_ac = ac_data.ac_cnic', 'left');
	   $this->db->join('tcsp_remarks', 'tcsp_data.id = tcsp_remarks.employee_id', 'left');
	   $this->db->join('sec_level_tcsp_remarks', 'tcsp_data.id = sec_level_tcsp_remarks.employee_id', 'left');
	   $this->db->group_by('tcsp_data.id');
	   $this->db->query('SET SQL_BIG_SELECTS=1');
	   return $this->db->get()->result_array();
	}

	// Export to Excel [UCPO's data].
	public function export_excel_ucpos() {
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
	  							peo_data.peo_cnic,
	  							ac_data.ac_id,
	  							ac_data.ac_name,
	  							ac_data.ac_cnic,
	  							ptpp_remarks.employee_id as ptpp_id,
	  							ptpp_remarks.comment,
	  							sec_level_sup_remarks.employee_id as sup_id,
	  							sec_level_sup_remarks.assessment_result');
	  $this->db->from('performance_evaluation');
	  // $this->db->limit(10);
	  $this->db->join('ucpo_data', 'performance_evaluation.employee_id = ucpo_data.id', 'left');
	  $this->db->join('peo_data', 'ucpo_data.cnic_peo = peo_data.peo_cnic', 'left');
	  $this->db->join('ac_data', 'ucpo_data.cnic_ac = ac_data.ac_cnic', 'left');
	  $this->db->join('ptpp_remarks', 'ucpo_data.id = ptpp_remarks.employee_id', 'left');
	  $this->db->join('sec_level_sup_remarks', 'ucpo_data.id = sec_level_sup_remarks.employee_id', 'left');
	  $this->db->group_by('ucpo_data.id');
	  $this->db->query('SET SQL_BIG_SELECTS=1');
	  return $this->db->get()->result_array();
	}

	// ---------------------------------------------------------------------------------
	// Summary dashboard. For Administrators...
	// count number of all the ucpo's in the database.
	public function all_ucpos(){
		return $this->db->from('ucpo_data')->count_all_results(); // Count all TCSP's.
	}
	// count number of all the tcsp's in the database.
	public function all_tcsps(){
		return $this->db->from('tcsp_data')->count_all_results(); // Count all UCPO's.
	}
	// Count no. of UCPO's pending from UCPOS.
	public function count_pending_from_ucpos(){
		return $this->db->where('employee_id NOT IN(SELECT employee_id FROM ptpp_remarks)')->from('performance_evaluation')->count_all_results();
	}
	// Count no. of TCSP's pending from TCSP's.
	public function count_pending_from_tcsps(){
		return $this->db->where('employee_id NOT IN(SELECT employee_id FROM tcsp_remarks)')->from('tcsp_evaluations')->count_all_results();
	}
	// Count number of all UCPO's evaluated by PEO.
	public function count_ucpos_pending(){
		return $this->db->where('id NOT IN(SELECT employee_id FROM ptpp_remarks)')->from('ucpo_data')->count_all_results(); // returns no. of ucpo's of which id not in PTPP remarks table.
	}
	// Count number of UCPO's pending for AC.
	public function count_ac_ucpos_pending(){
		return $this->db->where('employee_id NOT IN(SELECT employee_id FROM sec_level_sup_remarks)')->from('ptpp_remarks')->count_all_results(); // returns no. of ucpo not evaluated by AC.
	}
	// Count no. of UCPO's completed.
	public function completed_ucpos(){
		return $this->db->from('sec_level_sup_remarks')->count_all_results();
	}
	// Count no. of TCSP's completed.
	public function completed_tcsps(){
		return $this->db->from('sec_level_tcsp_remarks')->count_all_results();
	}
	// Count number of all TCSP's.
	public function count_tcsps_pending(){
		return $this->db->where('id NOT IN(SELECT employee_id FROM tcsp_remarks)')->from('tcsp_data')->count_all_results();
	}
	// Count number of TCSP's pending for AC.
	public function count_ac_tcsps_pending(){
		return $this->db->where('employee_id NOT IN(SELECT employee_id FROM sec_level_tcsp_remarks)')->from('tcsp_remarks')->count_all_results();
	}
	// Count UCPO's pending in list TCSPs.
	public function ucpos_pending(){
		return $this->db->where('id NOT IN(SELECT employee_id FROM performance_evaluation)')->from('ucpo_data')->count_all_results();
	}
	// Get summary UCPO's.
	public function get_summary_ucpos($limit, $offset){
		$this->db->select('ucpo_data.id,
							ucpo_data.name,
							ucpo_data.cnic_name,
							ucpo_data.cnic_peo,
							ucpo_data.cnic_ac,
							ucpo_data.province,
							peo_data.peo_cnic,
							peo_data.peo_name,
							ac_data.ac_cnic,
							ac_data.ac_name');
		$this->db->from('ucpo_data');
		$this->db->join('peo_data', 'ucpo_data.cnic_peo = peo_data.peo_cnic', 'left');
		$this->db->join('ac_data', 'ucpo_data.cnic_ac = ac_data.ac_cnic', 'left');
		$this->db->where('id NOT IN(SELECT employee_id FROM performance_evaluation)');
		$this->db->where('id NOT IN(SELECT employee_id FROM ptpp_remarks)');
		$this->db->where('ucpo_data.status', 0);
		$this->db->order_by('ucpo_data.id', 'DESC');
		$this->db->limit($limit, $offset);
		return $this->db->get()->result();
	}
	// Count TCSPs pending in list TCSPs.
	public function tcsps_pending(){
		return $this->db->where('id NOT IN(SELECT employee_id FROM tcsp_evaluations)')->from('tcsp_data')->count_all_results();
	}
	// Get summary TCSP's.
	public function get_summary_tcsps($limit, $offset){
		$this->db->select('tcsp_data.id,
							tcsp_data.name,
							tcsp_data.cnic_name,
							tcsp_data.cnic_peo,
							tcsp_data.cnic_ac,
							tcsp_data.province,
							peo_data.peo_cnic,
							peo_data.peo_name,
							ac_data.ac_cnic,
							ac_data.ac_name');
		$this->db->from('tcsp_data');
		$this->db->join('peo_data', 'tcsp_data.cnic_peo = peo_data.peo_cnic', 'left');
		$this->db->join('ac_data', 'tcsp_data.cnic_ac = ac_data.ac_cnic', 'left');
		$this->db->where('id NOT IN(SELECT employee_id FROM tcsp_evaluations)');
		$this->db->where('id NOT IN(SELECT employee_id FROM tcsp_remarks)');
		$this->db->where('tcsp_data.status', 0);
		$this->db->order_by('tcsp_data.id', 'DESC');
		$this->db->limit($limit, $offset);
		return $this->db->get()->result();
	}
	// Search for UCPO's
	public function search_ucpos($search = ''){
		$this->db->select('ucpo_data.id,
							ucpo_data.name,
							ucpo_data.cnic_name,
							ucpo_data.cnic_peo,
							ucpo_data.cnic_ac,
							ucpo_data.province,
							peo_data.peo_cnic,
							peo_data.peo_name,
							ac_data.ac_cnic,
							ac_data.ac_name');
		$this->db->from('ucpo_data');
		$this->db->join('peo_data', 'ucpo_data.cnic_peo = peo_data.peo_cnic', 'left');
		$this->db->join('ac_data', 'ucpo_data.cnic_ac = ac_data.ac_cnic', 'left');
		$this->db->like('peo_data.peo_name', $search);
		$this->db->or_like('ac_data.ac_name', $search);
		$this->db->where('id NOT IN(SELECT employee_id FROM performance_evaluation)');
		$this->db->where('id NOT IN(SELECT employee_id FROM ptpp_remarks)');
		$this->db->where('ucpo_data.status', 0);
		return $this->db->get()->result();
	}
	// Search for TCSP's.
	public function search_tcsps($search = ''){
		$this->db->select('tcsp_data.id,
							tcsp_data.name,
							tcsp_data.cnic_name,
							tcsp_data.cnic_peo,
							tcsp_data.cnic_ac,
							tcsp_data.province,
							peo_data.peo_cnic,
							peo_data.peo_name,
							ac_data.ac_cnic,
							ac_data.ac_name');
		$this->db->from('tcsp_data');
		$this->db->join('peo_data', 'tcsp_data.cnic_peo = peo_data.peo_cnic', 'left');
		$this->db->join('ac_data', 'tcsp_data.cnic_ac = ac_data.ac_cnic', 'left');
		$this->db->like('peo_data.peo_name', $search);
		$this->db->or_like('ac_data.ac_name', $search);
		$this->db->where('id NOT IN(SELECT employee_id FROM tcsp_evaluations)');
		$this->db->where('id NOT IN(SELECT employee_id FROM tcsp_remarks)');
		$this->db->where('tcsp_data.status', 0);
		return $this->db->get()->result();
	}
	// ------- Get all PEO's & AC's to list them in the UCPO's addtion form -----------------//
	public function get_peos(){
		$this->db->select('peo_id, peo_name, peo_cnic');
		$this->db->from('peo_data');
		return $this->db->get()->result();
	}
	public function get_acs(){
		$this->db->select('ac_id, ac_name, ac_cnic');
		$this->db->from('ac_data');
		return $this->db->get()->result();
	}
	//--------------------- Add PEO's, AC's, UCPO's and TCSP's -------------------------------// 
	// Add PEO's
	public function add_peos($data){
		$this->db->insert('peo_data', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	// Add AC's
	public function add_acs($data){
		$this->db->insert('ac_data', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	// Add UCPO's.
	public function add_ucpos($data){
		$this->db->insert('ucpo_data', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	// Add TCSP's.
	public function add_tcsps($data){
		$this->db->insert('tcsp_data', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	// Edit UCPO.
	public function edit_ucpo($id){
		$this->db->select('*');
		$this->db->from('ucpo_data');
		$this->db->where('id', $id);
		return $this->db->get()->row();
	}
	// Update UCPO.
	public function update_ucpo($id = '', $data = ''){
        $this->db->where('id', $id);
        $this->db->update('ucpo_data', $data);
        return true;
    }
    // Delete UCPO.
    public function delete_ucpo($id){
    	$this->db->where('id', $id);
    	$this->db->delete('ucpo_data');
    	return true;
    }
    // Edit TCSP.
    public function edit_tcsp($id){
    	$this->db->select('*');
    	$this->db->from('tcsp_data');
    	$this->db->where('id', $id);
    	return $this->db->get()->row();
    }
    // Update TCSP.
    public function update_tcsp($id = '', $data = ''){
    	$this->db->where('id', $id);
    	$this->db->update('tcsp_data', $data);
    	return true;
    }
    // Delete TCSP
    public function delete_tcsp($id){
    	$this->db->where('id', $id);
    	$this->db->delete('tcsp_data');
    	return true;
    }
	// ---------------------------------- Get data for PDF --------------------------------- //
	// Print appraisal, UCPO.
	public function appraisal_print($eval_id){
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
							peo_data.peo_cnic,
							ac_data.ac_id,
							ac_data.ac_name,
							ac_data.ac_cnic');
	  $this->db->from('performance_evaluation');
	  $this->db->join('ucpo_data', 'performance_evaluation.employee_id = ucpo_data.id');
	  $this->db->join('peo_data', 'ucpo_data.cnic_peo = peo_data.peo_cnic', 'left');
	  $this->db->join('ac_data', 'ucpo_data.cnic_ac = ac_data.ac_cnic', 'left');
	  $this->db->where('eval_id', $eval_id);
	  // $this->db->or_where('ucpo_data.cnic_ac', $this->session->userdata('ac_cnic'));
	  $query = $this->db->get();
	  return $query->row();
	}
	// Print appraisal report, TCSP.
	public function appraisal_print_tcsp($evalu_id){
		$this->db->select('tcsp_evaluations.*,
		  							tcsp_data.id,
		  							tcsp_data.name,
		  							tcsp_data.position,
		  							tcsp_data.cnic_name,
		  							tcsp_data.province,
		  							tcsp_data.district,
		  							tcsp_data.tehsil,
		  							tcsp_data.uc,
		  							tcsp_data.join_date,
		  							peo_data.peo_id,
		  							peo_data.peo_name,
		  							peo_data.peo_cnic,
		  							ac_data.ac_id,
		  							ac_data.ac_name,
		  							ac_data.ac_cnic');
	    $this->db->from('tcsp_evaluations');
	    $this->db->join('tcsp_data', 'tcsp_evaluations.employee_id = tcsp_data.id');
	    $this->db->join('peo_data', 'tcsp_data.cnic_peo = peo_data.peo_cnic', 'left');
	    $this->db->join('ac_data', 'tcsp_data.cnic_ac = ac_data.ac_cnic', 'left');
	    $this->db->where('evalu_id', $evalu_id);
	    $query = $this->db->get();
	    return $query->row();
	}
	// ----------------------- Export report to Excel ---------------------- //
	// UCPOs.
	public function ucpos_report(){
		$this->db->select('ucpo_data.id,
							ucpo_data.name,
							ucpo_data.cnic_name,
							ucpo_data.cnic_peo,
							ucpo_data.cnic_ac,
							ucpo_data.province,
							ucpo_data.district,
							ucpo_data.uc,
							peo_data.peo_cnic,
							peo_data.peo_name,
							ac_data.ac_cnic,
							ac_data.ac_name');
		$this->db->from('ucpo_data');
		$this->db->join('peo_data', 'ucpo_data.cnic_peo = peo_data.peo_cnic', 'left');
		$this->db->join('ac_data', 'ucpo_data.cnic_ac = ac_data.ac_cnic', 'left');
		$this->db->where('id NOT IN(SELECT employee_id FROM performance_evaluation)');
		$this->db->where('id NOT IN(SELECT employee_id FROM ptpp_remarks)');
		return $this->db->get()->result_array();
	}
	// TCSPs.
	public function tcsps_report(){
		$this->db->select('tcsp_data.id,
							tcsp_data.name,
							tcsp_data.cnic_name,
							tcsp_data.cnic_peo,
							tcsp_data.cnic_ac,
							tcsp_data.province,
							tcsp_data.district,
							tcsp_data.uc,
							peo_data.peo_cnic,
							peo_data.peo_name,
							ac_data.ac_cnic,
							ac_data.ac_name');
		$this->db->from('tcsp_data');
		$this->db->join('peo_data', 'tcsp_data.cnic_peo = peo_data.peo_cnic', 'left');
		$this->db->join('ac_data', 'tcsp_data.cnic_ac = ac_data.ac_cnic', 'left');
		$this->db->where('id NOT IN(SELECT employee_id FROM tcsp_evaluations)');
		$this->db->where('id NOT IN(SELECT employee_id FROM tcsp_remarks)');
		return $this->db->get()->result_array();
	}
}

?>