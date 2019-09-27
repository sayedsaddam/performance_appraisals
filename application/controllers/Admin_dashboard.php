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
		$config['total_rows'] = $this->Performance_appraisal_model->all_ucpos();
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
		$config['base_url'] = base_url('Admin_dashboard/all_ucpos');
		$config['total_rows'] = $this->Performance_appraisal_model->all_tcsps();
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
}

?>