<?php defined("BASEPATH") OR exit('No direct script access allowed !');
/**
 * summary
 */
class Admin_dashboard extends CI_Controller
{
    /**
     * summary
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Performance_appraisal_model');
    }
    // Get summary of all the data.
	public function index($offset = NULL){
		$limit = 20;
		if(!empty($offset)){
			$this->uri->segment(3);
		}
		$data['pen_ucpos'] = $this->Performance_appraisal_model->get_summary_ucpos($limit, $offset);
		$data['pen_tcsps'] = $this->Performance_appraisal_model->get_summary_tcsps($limit, $offset);
		$data['title'] = 'Dashboard | Performance Appraisals';
		$data['content'] = 'performance_evaluation/admin_dashboard';
		$this->load->view('components/template', $data);
	}
	// View all UCPO's statistics...
	public function all_ucpos($offset = NULl){
		$limit = 20;
		if(!empty($offset)){
			$this->uri->segment(3);
		}
		$this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url('Admin_dashboard/all_ucpos');
		$config['total_rows'] = $this->Performance_appraisal_model->ucpos_pending();
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
		$data['title'] = "UCPO's List";
		$data['content'] = 'performance_evaluation/list_ucpos';
		$data['pending_ucpos'] = $this->Performance_appraisal_model->get_summary_ucpos($limit, $offset);
		$this->load->view('components/template', $data);
	}
	// Search for specific record.
	public function search_ucpos(){
		$search = $this->input->get('search_record');
		$data['title'] = 'Search Results | Admin Dashboard';
		$data['content'] = 'performance_evaluation/list_ucpos';
		$data['search_results'] = $this->Performance_appraisal_model->search_ucpos($search);
		$this->load->view('components/template', $data);
	}
	// -----------------------------------------------------------------------------------------//
	// TCSP's..
	// Show all TCSPs.
	public function all_tcsps($offset = NULL){
		$limit = 20;
		if(!empty($offset)){
			$this->uri->segment(3);
		}
		$this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url('Admin_dashboard/all_tcsps');
		$config['total_rows'] = $this->Performance_appraisal_model->tcsps_pending();
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
		$data['title'] = "TCSP's List";
		$data['content'] = 'performance_evaluation/list_tcsps';
		$data['pending_tcsps'] = $this->Performance_appraisal_model->get_summary_tcsps($limit, $offset);
		$this->load->view('components/template', $data);
	}
	// Search for specific record.
	public function search_tcsps(){
		$search = $this->input->get('search_record');
		$data['title'] = 'Search Results | Admin Dashboard';
		$data['content'] = 'performance_evaluation/list_tcsps';
		$data['search_results'] = $this->Performance_appraisal_model->search_tcsps($search);
		$this->load->view('components/template', $data);
	}
	// -----------------------------------------------------------------------------------------//
	// Add new UCPO's.
	public function add_ucpos(){
		$data['title'] = 'Add UCPOs | Performance Appraisal';
		$data['content'] = 'performance_evaluation/add_ucpos';
		$data['peos'] = $this->Performance_appraisal_model->get_peos();
		$data['acs'] = $this->Performance_appraisal_model->get_acs();
		$this->load->view('components/template', $data);
	}
	// Add new TCSP's.
	public function add_tcsps(){
		$data['title'] = 'Add TCSPs | Performance Appraisal';
		$data['content'] = 'performance_evaluation/add_tcsps';
		$data['peos'] = $this->Performance_appraisal_model->get_peos();
		$data['acs'] = $this->Performance_appraisal_model->get_acs();
		$this->load->view('components/template', $data);
	}
	// Add new PEO's and AC's.
	public function add_peos(){
		$data['title'] = 'Add PEOs | Performance Appraisal';
		$data['content'] = 'performance_evaluation/add_peos';
		$this->load->view('components/template', $data);
	}
	// Save PEO's to the database.
	public function save_peos(){
		$data = array(
			'peo_name' => $this->input->post('peo_name'),
			'peo_cnic' => $this->input->post('peo_cnic'),
			'peo_password' => $this->input->post('peo_pass')
		);
		$this->Performance_appraisal_model->add_peos($data);
		$this->session->set_flashdata('success_peo', '<strong>Success! </strong> PEO has been saved successfully!');
		redirect('admin_dashboard/add_peos');
	}
	// Save AC's to the database.
	public function save_acs(){
		$data = array(
			'ac_name' => $this->input->post('ac_name'),
			'ac_cnic' => $this->input->post('ac_cnic'),
			'ac_password' => $this->input->post('ac_pass')
		);
		$this->Performance_appraisal_model->add_acs($data);
		$this->session->set_flashdata('success_ac', '<strong>Success !</strong> AC has been added successfully!');
		redirect('admin_dashboard/add_peos');
	}
	// Save UCPO's to the database.
	public function save_ucpos(){
		$data = array(
			'position' => 'UCPO',
			'name' => $this->input->post('ucpo_name'),
			'cnic_name' => $this->input->post('ucpo_cnic'),
			'province' => $this->input->post('ucpo_prov'),
			'district' => $this->input->post('ucpo_distt'),
			'tehsil' => $this->input->post('ucpo_tehsil'),
			'uc' => $this->input->post('ucpo_uc'),
			'cnic_peo' => $this->input->post('ucpo_peo'),
			'cnic_ac' => $this->input->post('ucpo_ac'),
			'ucpo_password' => $this->input->post('ucpo_pass'),
			'join_date' => date('d-M-y', strtotime($this->input->post('join_date')))
		);
		$this->Performance_appraisal_model->add_ucpos($data);
		$this->session->set_flashdata('success', '<strong>Success !</strong> UCPO has been added successfully!');
		redirect('admin_dashboard/add_ucpos');
	}
	// Save TCSP's to the database.
	public function save_tcsps(){
		$data = array(
			'position' => 'TCSP',
			'name' => $this->input->post('tcsp_name'),
			'cnic_name' => $this->input->post('tcsp_cnic'),
			'province' => $this->input->post('tcsp_prov'),
			'district' => $this->input->post('tcsp_distt'),
			'tehsil' => $this->input->post('tcsp_tehsil'),
			'uc' => $this->input->post('tcsp_uc'),
			'cnic_peo' => $this->input->post('tcsp_peo'),
			'cnic_ac' => $this->input->post('tcsp_ac'),
			'tcsp_password' => $this->input->post('tcsp_pass'),
			'join_date' => date('d-M-y', strtotime($this->input->post('join_date')))
		);
		$this->Performance_appraisal_model->add_tcsps($data);
		$this->session->set_flashdata('success', '<strong>Success !</strong> UCPO has been added successfully!');
		redirect('admin_dashboard/add_tcsps');
	}
	// ------------------------------ Edit, update, and delete operations ------------------------ //
	// Edit UCPO.
	public function edit_ucpo($id){
		$data['title'] = 'Update | Performance Appraisals';
        $data['content'] = 'performance_evaluation/add_ucpos';
        $data['peos'] = $this->Performance_appraisal_model->get_peos();
		$data['acs'] = $this->Performance_appraisal_model->get_acs();
        $data['edit'] = $this->Performance_appraisal_model->edit_ucpo($id); // Model call.
        $this->load->view('components/template', $data);
	}
	// Update UCPO.
	public function update_ucpo(){
		$id = $this->input->post('emp_id');
		$data = array(
			'position' => 'UCPO',
			'name' => $this->input->post('ucpo_name'),
			'cnic_name' => $this->input->post('ucpo_cnic'),
			'province' => $this->input->post('ucpo_prov'),
			'district' => $this->input->post('ucpo_distt'),
			'tehsil' => $this->input->post('ucpo_tehsil'),
			'uc' => $this->input->post('ucpo_uc'),
			'cnic_peo' => $this->input->post('ucpo_peo'),
			'cnic_ac' => $this->input->post('ucpo_ac')
			// 'ucpo_password' => $this->input->post('ucpo_pass'),
			//'join_date' => date('d-M-y', strtotime($this->input->post('join_date')))
		);
		$this->Performance_appraisal_model->update_ucpo($id, $data);
		$this->session->set_flashdata('success', '<strong>Success !</strong> UCPO has been updated successfully');
		redirect('admin_dashboard/all_ucpos');
	}
	// Delete UCPO.
	public function delete_ucpo($id){
		if($this->Performance_appraisal_model->delete_ucpo($id)){
			$this->session->set_flashdata('success', '<strong>Success !</strong> The delete operation was successful.');
			redirect('admin_dashboard/all_ucpos');
		}else{
			echo "The operation wasn't successful !";
		}
	}
	// Edit TCSP.
	public function edit_tcsp($id){
		$data['title'] = 'Update | Performance Appraisals';
        $data['content'] = 'performance_evaluation/add_tcsps';
        $data['peos'] = $this->Performance_appraisal_model->get_peos();
		$data['acs'] = $this->Performance_appraisal_model->get_acs();
        $data['edit'] = $this->Performance_appraisal_model->edit_tcsp($id); // Model call.
        $this->load->view('components/template', $data);
	}
	// Update TCSP
	public function update_tcsp(){
		$id = $this->input->post('emp_id');
		$data = array(
			'position' => 'TCSP',
			'name' => $this->input->post('tcsp_name'),
			'cnic_name' => $this->input->post('tcsp_cnic'),
			'province' => $this->input->post('tcsp_prov'),
			'district' => $this->input->post('tcsp_distt'),
			'tehsil' => $this->input->post('tcsp_tehsil'),
			'uc' => $this->input->post('tcsp_uc'),
			'cnic_peo' => $this->input->post('tcsp_peo'),
			'cnic_ac' => $this->input->post('tcsp_ac')
			// 'tcsp_password' => $this->input->post('tcsp_pass'),
			//'join_date' => date('d-M-y', strtotime($this->input->post('join_date')))
		);
		$this->Performance_appraisal_model->update_tcsp($id, $data);
		$this->session->set_flashdata('success', '<strong>Success ! </strong>TCSP has been updated successfully!');
		redirect('admin_dashboard/all_tcsps');
	}
	// Delete TCSP.
	public function delete_tcsp($id){
		if($this->Performance_appraisal_model->delete_tcsp($id)){
			$this->session->set_flashdata('success', '<strong>Success ! </strong>The delete operation was successful!');
			redirect('admin_dashboard/all_tcsps');
		}else{
			echo "The operation wasn't successful !";
		}
	}

}

?>