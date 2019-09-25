<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/*
* Filename: Performance_evaluation.php
* Filepath: controllers / Performane_evaluation.php
* Author: Saddam
*/
class Performance_evaluation extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('session');

		$this->load->helper('form');

		$this->load->helper('url');

		$this->load->helper('html');

		$this->load->database();

		$this->load->library('form_validation');

		//load the model

		$this->load->model("Performance_appraisal_model");
		$this->load->model("Perf_login_model");
	}
	/*Function to set JSON output*/
	public function output($Return=array()){
		/*Set response header*/
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json; charset=UTF-8");
		/*Final JSON response*/
		exit(json_encode($Return));
	}
	// Load the form view. For UCPO.
	public function index(){
		if($this->session->userdata('tcsp_cnic')){
			redirect('performance_evaluation/tcsp_evaluation');
		}
		$data['previously_added'] = $this->Performance_appraisal_model->get_previously_added();
		$data['ptpp_employees'] = $this->Performance_appraisal_model->ptpp_employees();
		$data['ac_employees'] = $this->Performance_appraisal_model->get_ptpp();
		if($this->session->userdata('peo_cnic')){
			$data['ucpos'] = $this->Perf_login_model->get_ucpos();
		}else{
			$data['ucpos'] = $this->Perf_login_model->get_ac_ucpos();
		}
		$data['title'] = 'UCPO | Performance Appraisals';
		$data['content'] ='performance_evaluation/performance_eval'; 
		$this->load->view('components/template', $data);
	}
	// Get the previously added evaluations.
	public function get_previous($offset = NULL, $id = ''){
		if($this->session->userdata('ucpo_cnic')){
			redirect('performance_evaluation');
		}
		$limit = 10;
		if(!empty($offset)){
			$this->uri->segment(3);
		}
		$this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url('Performance_evaluation/get_previous');
		$config['total_rows'] = $this->Performance_appraisal_model->count_evaluations();
		$config['per_page'] = $limit;
		$config['num_links'] = 3;
		$config["full_tag_open"] = '<ul class="pagination">';
	    $config["full_tag_close"] = '</ul>';
	    $config["first_tag_open"] = '<li>';
	    $config["first_tag_close"] = '</li>';
	    $config["last_tag_open"] = '<li>';
	    $config["last_tag_close"] = '</li>';
	    $config['next_link'] = 'next &raquo;';
	    $config["next_tag_open"] = '<li>';
	    $config["next_tag_close"] = '</li>';
	    $config["prev_link"] = "prev &laquo;";
	    $config["prev_tag_open"] = "<li>";
	    $config["prev_tag_close"] = "</li>";
	    $config["cur_tag_open"] = "<li class='active'><a href='javascript:void(0);'>";
	    $config["cur_tag_close"] = "</a></li>";
	    $config["num_tag_open"] = "<li>";
	    $config["num_tag_close"] = "</li>";
		$this->pagination->initialize($config);
		$data['title'] = 'Previous Evaluations';
		if(!$this->session->userdata('admin_cnic')){
			$data['recents'] = $this->Performance_appraisal_model->get_performance_evaluation($limit, $offset);
		}else{
			$data['recents'] = $this->Performance_appraisal_model->get_performance_evaluation_admin($limit, $offset);
		}
		$data['content'] = 'performance_evaluation/recent_evals';
		$this->load->view('components/template', $data);
	}
	// Save form data to the database, by first level supervisor. (Forward to UCPO).
	public function save_evaluation(){
		$data = array(
			'employee_id' => $this->input->post('emp_name'),
			'start_date' => date('Y-m-d', strtotime($this->input->post('app_start_date'))),
			'end_date' => date('Y-m-d', strtotime($this->input->post('app_end_date'))),
			'que_one' => $this->input->post('remark'),
			'que_two' => $this->input->post('remark1'),
			'que_three' => $this->input->post('remark2'),
			'que_four' => $this->input->post('remark3'),
			'que_five' => $this->input->post('remark4'),
			'que_six' => $this->input->post('remark5'),
			'que_seven' => $this->input->post('remark6'),
			'que_eight' => $this->input->post('remark7'),
			'attrib_1' => $this->input->post('attribute'),
			'attrib_2' => $this->input->post('attribute1'),
			'attrib_3' => $this->input->post('attribute2'),
			'attrib_4' => $this->input->post('attribute3'),
			'attrib_5' => $this->input->post('attribute4'),
			'attrib_6' => $this->input->post('attribute5'),
			'comment_1' => $this->input->post('others_a'),
			'comment_2' => $this->input->post('others_b'),
			'signature' => $this->input->post('1st_signature'),
			'created_at' => $this->input->post('1st_date')
		);
		$this->Performance_appraisal_model->add($data);
		$this->session->set_flashdata('success', 'Evaluation has successfully been forwarded to UCPO!');
		redirect('performance_evaluation/get_previous');
	}
	// Update UCPO evaluation if rolled back.
	public function update_rolledback(){
		$employee_id = $this->input->post('rollback_update');
		$data = array(
			'start_date' => date('Y-m-d', strtotime($this->input->post('app_start_date'))),
			'end_date' => date('Y-m-d', strtotime($this->input->post('app_end_date'))),
			'que_one' => $this->input->post('remark'),
			'que_two' => $this->input->post('remark1'),
			'que_three' => $this->input->post('remark2'),
			'que_four' => $this->input->post('remark3'),
			'que_five' => $this->input->post('remark4'),
			'que_six' => $this->input->post('remark5'),
			'que_seven' => $this->input->post('remark6'),
			'que_eight' => $this->input->post('remark7'),
			'attrib_1' => $this->input->post('attribute'),
			'attrib_2' => $this->input->post('attribute1'),
			'attrib_3' => $this->input->post('attribute2'),
			'attrib_4' => $this->input->post('attribute3'),
			'attrib_5' => $this->input->post('attribute4'),
			'attrib_6' => $this->input->post('attribute5'),
			'comment_1' => $this->input->post('others_a'),
			'comment_2' => $this->input->post('others_b'),
			'signature' => $this->input->post('1st_signature'),
			'status' => 0,
			'created_at' => $this->input->post('1st_date')
		);
		$this->Performance_appraisal_model->update_rolled_back($employee_id, $data);
		$this->db->where('employee_id', $_POST['rollback_update']);
		$this->db->delete('ptpp_remarks');
		$this->session->set_flashdata('success', '<strong>Success !</strong> Record has been updated successfully !');
		redirect('performance_evaluation/get_previous');
	}
	// Save the remarks by PTPP to the database.
	public function remarks_by_ptpp(){
		$emp_id = $_POST['ptpp_employee'];
		$data = array(
			'employee_id' => $emp_id,
			'remarks' => $this->input->post('ptpp_remarks'),
			'comment' => $this->input->post('remarks_by_ucpo'),
			'signature' => $this->input->post('ptpp_holder_sign'),
			'created_at' => $this->input->post('ptpp_date')
		);
		$this->Performance_appraisal_model->add_ptpp_remarks($data);
		$this->db->select('status')->from('performance_evaluation')->get()->row();
		$this->db->where('employee_id', $_POST['ptpp_employee']);
		$this->db->update('performance_evaluation', array('status' => '1'));
		$this->session->set_flashdata('success', 'PTPP Remarks have been saved successfully!');
		redirect('performance_evaluation/get_previous');
	}
	// Save the remarks by the second level supervisor to the database.
	public function remarks_by_sec_level_sup(){
		$data = array(
			'employee_id' => $this->input->post('sec_level'),
			'assessment_result' => $this->input->post('sec_level_remarks'),
			'signature' => $this->input->post('sec_level_sign'),
			'created_at' => date('Y-m-d', strtotime($this->input->post('sec_level_date')))
		);
		$this->Performance_appraisal_model->add_sec_level_remarks($data);
		$this->db->select('status')->from('performance_evaluation')->get()->row();
		$this->db->where('employee_id', $_POST['sec_level']);
		if(isset($_POST['submit_1'])){
			$this->db->update('performance_evaluation', array('status' => '3', 'rollback_comment' => $this->input->post('rollback_comment')));
			$this->db->where('employee_id', $_POST['sec_level']);
			$this->db->delete('sec_level_sup_remarks');
			$this->session->set_flashdata('success', '<strong>Sucess !</strong> The rollback operation was successful.');
		}else{
			$this->db->update('performance_evaluation', array('status' => '2'));
			$this->session->set_flashdata('success', 'Remarks by the Second level supervisor have been saved successfully!');
		}
		redirect('performance_evaluation/get_previous');
	}
	// Get province, district, tehsil for selected employee in the dropdown.
	public function get_address_ucpos($id = ''){
		$ucpo_address = $this->Performance_appraisal_model->get_address_ucpos($id);
		echo json_encode($ucpo_address);
	}

	/* ------------------------------------------------------------------------------------- */
	// Performance evaluation form for TCSP (Tehsil Campaign Support Person).
	public function tcsp_evaluation(){
		if($this->session->userdata('ucpo_cnic')){
			redirect('performance_evaluation');
		}
		$data['prev_added_tcsps'] = $this->Performance_appraisal_model->get_previously_added_tcsps();
		$data['title'] = 'TCSP | Performance Appraisals';
		if($this->session->userdata('peo_cnic')){
			$data['tcsps'] = $this->Perf_login_model->get_tcsps();
		}else{
			$data['tcsps'] = $this->Perf_login_model->get_ac_tcsps();
		}
		$data['tcsp_employees'] = $this->Performance_appraisal_model->get_tcsps();
		$data['ac_tcsps'] = $this->Performance_appraisal_model->get_tcsps_for_ac();
		$data['content'] = 'performance_evaluation/tcsp_evaluation';
		$this->load->view('components/template', $data);
	}
	// Get the saved evaluations by TCSP.
	public function tcsp_previous($offset = NULL){
		if($this->session->userdata('tcsp_cnic')){
			redirect('performance_evaluation/tcsp_evaluation');
		}
		$limit = 10;
		if(!empty($offset)){
			$this->uri->segment(3);
		}
		$this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url('Performance_evaluation/tcsp_previous');
		$config['total_rows'] = $this->Performance_appraisal_model->count_tcsp();
		$config['per_page'] = $limit;
		$config['num_links'] = 3;
		$config["full_tag_open"] = '<ul class="pagination">';
	    $config["full_tag_close"] = '</ul>';
	    $config["first_tag_open"] = '<li>';
	    $config["first_tag_close"] = '</li>';
	    $config["last_tag_open"] = '<li>';
	    $config["last_tag_close"] = '</li>';
	    $config['next_link'] = 'next &raquo;';
	    $config["next_tag_open"] = '<li>';
	    $config["next_tag_close"] = '</li>';
	    $config["prev_link"] = "prev &laquo;";
	    $config["prev_tag_open"] = "<li>";
	    $config["prev_tag_close"] = "</li>";
	    $config["cur_tag_open"] = "<li class='active'><a href='javascript:void(0);'>";
	    $config["cur_tag_close"] = "</a></li>";
	    $config["num_tag_open"] = "<li>";
	    $config["num_tag_close"] = "</li>";
		$this->pagination->initialize($config);
		$data['title'] = 'TCSP Evaluations | Rcently Added';
		$data['recent_tcsp'] = $this->Performance_appraisal_model->get_tcsp_evaluations($limit, $offset);
		$data['content'] = 'performance_evaluation/recent_tcsp';
		$this->load->view('components/template', $data);
	}
	// Save the TCSP form data into the database.
	public function save_tcsp_evaluation(){
		$data = array(
			'employee_id' => $this->input->post('emp_name'),
			'start_date' => date('Y-m-d', strtotime($this->input->post('app_start_date'))),
			'end_date' => date('Y-m-d', strtotime($this->input->post('app_end_date'))),
			'que_one' => $this->input->post('remark'),
			'que_two' => $this->input->post('remark1'),
			'que_three' => $this->input->post('remark2'),
			'que_four' => $this->input->post('remark3'),
			'que_five' => $this->input->post('remark4'),
			'que_six' => $this->input->post('remark5'),
			'que_seven' => $this->input->post('remark6'),
			'que_eight' => $this->input->post('remark7'),
			'que_nine' => $this->input->post('remark8'),
			'que_ten' => $this->input->post('remark9'),
			'attrib_1' => $this->input->post('attribute'),
			'attrib_2' => $this->input->post('attribute1'),
			'attrib_3' => $this->input->post('attribute2'),
			'attrib_4' => $this->input->post('attribute3'),
			'attrib_5' => $this->input->post('attribute4'),
			'attrib_6' => $this->input->post('attribute5'),
			'comment_1' => $this->input->post('others_a'),
			'comment_2' => $this->input->post('others_b'),
			'signature' => $this->input->post('1st_signature'),
			'created_at' => $this->input->post('1st_date')
		);
		$this->Performance_appraisal_model->insert_tcsp_evaluations($data);
		$this->session->set_flashdata('success', 'Evaluation saved successfully!');
		redirect('Performance_evaluation/get_tcsp_data');
	}
	// Update rolled back TCSP Evaluations.
	public function update_rolledback_tcsp(){
		$employee_id = $this->input->post('rolledbback_tcsp');
		$data = array(
			'start_date' => date('Y-m-d', strtotime($this->input->post('app_start_date'))),
			'end_date' => date('Y-m-d', strtotime($this->input->post('app_end_date'))),
			'que_one' => $this->input->post('remark'),
			'que_two' => $this->input->post('remark1'),
			'que_three' => $this->input->post('remark2'),
			'que_four' => $this->input->post('remark3'),
			'que_five' => $this->input->post('remark4'),
			'que_six' => $this->input->post('remark5'),
			'que_seven' => $this->input->post('remark6'),
			'que_eight' => $this->input->post('remark7'),
			'que_nine' => $this->input->post('remark8'),
			'que_ten' => $this->input->post('remark9'),
			'attrib_1' => $this->input->post('attribute'),
			'attrib_2' => $this->input->post('attribute1'),
			'attrib_3' => $this->input->post('attribute2'),
			'attrib_4' => $this->input->post('attribute3'),
			'attrib_5' => $this->input->post('attribute4'),
			'attrib_6' => $this->input->post('attribute5'),
			'comment_1' => $this->input->post('others_a'),
			'comment_2' => $this->input->post('others_b'),
			'signature' => $this->input->post('1st_signature'),
			'status' => 0,
			'created_at' => $this->input->post('1st_date')
		);
		var_dump($data); exit;
	}
	// Save TCSP remarks.
	public function remarks_by_tcsp(){
		$data = array(
			'employee_id' => $this->input->post('employee_tcsp'),
			'remarks' => $this->input->post('tcsp_remarks'),
			'signature' => $this->input->post('apw_holder_sign'),
			'comment' => $this->input->post('remarks_by_tcsp'),
			'created_at' => date('Y-m-d', strtotime($this->input->post('apw_date')))
		);
		$this->Performance_appraisal_model->add_tcsp_remarks($data);
		$this->db->select('status')->from('tcsp_evaluations')->get()->row();
		$this->db->where('employee_id', $_POST['employee_tcsp']);
		$this->db->update('tcsp_evaluations', array('status' => '1'));
		$this->session->set_flashdata('success', 'Remarks by TCSP have been saved successfully!');
		redirect('Performance_evaluation/tcsp_previous');
	}
	// Save Second level TCSP remarks to the database.
	public function sec_level_tcsp_rem(){
		$data = array(
			'employee_id' => $this->input->post('sec_level_tcsp'),
			'assessment_result' => $this->input->post('sec_level_tcsp_remarks'),
			'signature' => $this->input->post('sec_level_sign'),
			'created_at' => date('Y-m-d', strtotime($this->input->post('sec_level_date')))
		);
		$this->Performance_appraisal_model->add_sec_level_tcsp($data);
		$this->db->select('status')->from('tcsp_evaluations')->get()->row();
		$this->db->where('employee_id', $_POST['sec_level_tcsp']);
		if(isset($_POST['submit_1'])){
			$this->db->update('tcsp_evaluations', array('status' => '3', 'rollback_comment' => $this->input->post('rollback_comment')));
			$this->db->where('employee_id', $_POST['sec_level_tcsp']);
			$this->db->delete('sec_level_tcsp_remarks');
			$this->session->set_flashdata('success', '<strong>Success ! </strong> The Roll back operation was successful !');
		}else{
			$this->db->update('tcsp_evaluations', array('status' => '2'));
			$this->session->set_flashdata('success', 'Overall Assessment by the CTC staff has been saved successfully.');
		}
		redirect('Performance_evaluation/tcsp_previous');
	}
	// Get province, district, tehsil for selected employee in the dropdown list.
	public function get_address_tcsps($id = ''){
		$tcsp_address = $this->Performance_appraisal_model->get_address_tcsps($id);
		echo json_encode($tcsp_address);
	}
	// Get summary of all the data.
	public function summary(){
		$data['count_ucpos'] = $this->Performance_appraisal_model->get_summary_ucpos();
		$data['count_tcsps'] = $this->Performance_appraisal_model->get_summary_tcsps();
		$data['title'] = 'Summary Dashboard';
		$data['content'] = 'performance_evaluation/admin_dashboard';
		$this->load->view('components/template', $data);
	}
}
?>