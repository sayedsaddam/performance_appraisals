<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * Filename: Perf_login.php
 * Filepath: controllers / Perf_login.php
 * Author: Saddam
 */
class Perf_login extends CI_Controller
{
    /**
     * 
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Perf_login_model');
    }
    // Index function to load the main page.
    public function index()
    {
    	$this->load->view('perf_login');
    }
    // Validate user to make an appraisal, for PEO.
    public function validate()
    {
    	// PEO login.
    	// $peo_name = $this->input->post('peo_name');
  		$peo_cnic = $this->input->post('peo_cnic');
  		// AC login.
  		// $ac_name = $this->input->post('peo_name');
  		$ac_cnic = $this->input->post('peo_cnic');
      // UCPO Login.
      // $ucpo_name = $this->input->post('peo_name');
      $ucpo_cnic = $this->input->post('peo_cnic');
      // TCSP login.
      // $tcsp_name = $this->input->post('peo_name');
      $tcsp_cnic = $this->input->post('peo_cnic');
      // Administrators login.
      // $admin_name = $this->input->post('peo_name');
      $admin_cnic = $this->input->post('peo_cnic');

  		$peo_signin = $this->Perf_login_model->validate_user($peo_cnic); // PEO login.
  		$ac_signin = $this->Perf_login_model->validate_ac($ac_cnic); // AC login.
      $ucpo_signin = $this->Perf_login_model->validate_ucpo($ucpo_cnic); // UCPO login.
      $tcsp_signin = $this->Perf_login_model->validate_tcsp($tcsp_cnic); // TCSP login.
      $admin_signin = $this->Perf_login_model->validate_admin($admin_cnic); // Admin login.
  		if($peo_signin){
  			$this->session->set_userdata(array('peo_cnic' => $peo_cnic));
  			redirect('performance_evaluation');
  		}elseif($ac_signin){
  			$this->session->set_userdata(array('ac_cnic' => $ac_cnic));
  			redirect('performance_evaluation');
  		}elseif($ucpo_signin){
  			$this->session->set_userdata(array('ucpo_cnic' => $ucpo_cnic));
        $this->db->select('id');
        $this->db->from('ucpo_data');
        $this->db->where('cnic_name', $this->session->userdata('ucpo_cnic'));
        $ucpo_id = $this->db->get()->row();
        $test = $ucpo_id->id;
              redirect("performance_evaluation/index/".$test);
  		}elseif($tcsp_signin){
              $this->session->set_userdata(array('tcsp_cnic' => $tcsp_cnic));
              $this->db->select('id');
              $this->db->from('tcsp_data');
              $this->db->where('cnic_name', $this->session->userdata('tcsp_cnic'));
              $tcsp_id = $this->db->get()->row();
              $test1 = $tcsp_id->id;
              redirect("performance_evaluation/tcsp_evaluation/".$tests1);
      }elseif(admin_signin){
          $this->session->set_userdata(array('admin_cnic' => $admin_cnic));
          redirect('performance_evaluation/get_previous');
      }else{
        $this->session->set_flashdata('failed', '<strong>Aww snap! </strong> Looks like you do not have to permission to make an appraisal, contract your supervisor for further detail.');
          $this->index();
      }
    }
    // Terminate the session and log the user out.
    public function logout(){
		$this->session->sess_destroy('peo_cnic');
		$this->session->set_flashdata('logged_out', '<strong>Hooray !</strong> You have been logged out successfully, Login again .');
		$this->index();
	}
}

?>