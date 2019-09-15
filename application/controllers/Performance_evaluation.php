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
		$data['ptpp_employees'] = $this->Performance_appraisal_model->ptpp_employees();
		$data['ac_employees'] = $this->Performance_appraisal_model->get_ptpp();
		$data['ucpos'] = $this->Perf_login_model->get_ucpos();
		$data['title'] = 'Performance Evaluation';
		$data['content'] ='performance_evaluation/performance_eval'; 
		$this->load->view('components/template', $data);
	}
	// Get the previously added evaluations.
	public function get_previous($offset = NULL, $id = ''){
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
		$data['recents'] = $this->Performance_appraisal_model->get_performance_evaluation($limit, $offset);
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
			'created_at' => date('Y-m-d', strtotime($this->input->post('1st_date')))
		);
		$this->Performance_appraisal_model->add($data);
		$this->session->set_flashdata('success', 'Evaluation has successfully been forwarded to UCPO!');
		redirect('performance_evaluation/get_previous');
	}
	// Save the remarks by PTPP to the database.
	public function remarks_by_ptpp(){
		$data = array(
			'employee_id' => $this->input->post('ptpp_employee'),
			'remarks' => $this->input->post('ptpp_remarks'),
			'signature' => $this->input->post('ptpp_holder_sign'),
			'created_at' => date('Y-m-d', strtotime($this->input->post('ptpp_date')))
		);
		$this->Performance_appraisal_model->add_ptpp_remarks($data);
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
		var_dump($data); exit;
		$this->Performance_appraisal_model->add_sec_level_remarks($data);
		$this->session->set_flashdata('success', 'Remarks by the Second level supervisor have been saved successfully!');
		redirect('performance_evaluation/get_previous');
	}

	/* ------------------------------------------------------------------------------------- */
	// Performance evaluation form for TCSP (Tehsil Campaign Support Person).
	public function tcsp_evaluation(){
		$data['title'] = 'TCSP Evaluations';
		$data['tcsps'] = $this->Perf_login_model->get_tcsps();
		$data['content'] = 'performance_evaluation/tcsp_evaluation';
		$this->load->view('components/template', $data);
	}
	// Get the saved evaluations by TCSP.
	public function tcsp_previous($offset = NULL){
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
			'created_at' => date('Y-m-d', strtotime($this->input->post('1st_date')))
		);
		$this->Performance_appraisal_model->insert_tcsp_evaluations($data);
		$this->session->set_flashdata('success', 'Evaluation saved successfully!');
		redirect('Performance_evaluation/get_tcsp_data');
	}
	// Save TCSP remarks.
	public function remarks_by_tcsp(){
		$data = array(
			'employee_id' => $this->input->post('employee_tcsp'),
			'remarks' => $this->input->post('tcsp_remarks'),
			'signature' => $this->input->post('apw_holder_sign'),
			'created_at' => date('Y-m-d', strtotime($this->input->post('apw_date')))
		);
		$this->Performance_appraisal_model->add_tcsp_remarks($data);
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
		$this->session->set_flashdata('success', 'Overall Assessment by the CTC staff has been saved successfully.');
		redirect('Performance_evaluation/tcsp_previous');
	}
}
?>