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
    // Validate user to make an appraisal, for all designations.
    public function validate()
    {
    	// PEO login.
    	$peo_cnic = $this->input->post('peo_cnic');
  		$password = $this->input->post('password');
  		// AC login.
  		$ac_cnic = $this->input->post('peo_cnic');
  		$password = $this->input->post('password');
      // UCPO Login.
      $ucpo_cnic = $this->input->post('peo_cnic');
      $password = $this->input->post('password');
      // TCSP login.
      $tcsp_cnic = $this->input->post('peo_cnic');
      $password = $this->input->post('password');
      // Administrators login.
      $admin_name = $this->input->post('peo_cnic');
      $admin_cnic = $this->input->post('password');

  		$peo_signin = $this->Perf_login_model->validate_user($peo_cnic, $password);
  		$ac_signin = $this->Perf_login_model->validate_ac($ac_cnic, $password);
      $ucpo_signin = $this->Perf_login_model->validate_ucpo($ucpo_cnic, $password);
      $tcsp_signin = $this->Perf_login_model->validate_tcsp($tcsp_cnic, $password);
      $admin_signin = $this->Perf_login_model->validate_admin($admin_cnic); // Admin login.
  		if($peo_signin){
  			$this->session->set_userdata(array('peo_cnic' => $peo_cnic));
  			redirect('performance_evaluation/get_previous');
  		}elseif($ac_signin){
  			$this->session->set_userdata(array('ac_cnic' => $ac_cnic));
  			redirect('performance_evaluation/get_previous');
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
              redirect("performance_evaluation/tcsp_evaluation/".$test1);
      }elseif($admin_signin){
          $this->session->set_userdata(array('admin_cnic' => $admin_cnic));
          redirect('performance_evaluation/get_previous');
      }else{
        $this->session->set_flashdata('failed', '<strong>Aww snap! </strong> Looks like you do not have to permission to make an appraisal, contract your supervisor for further detail.');
          $this->index();
      }
    }
    // Change password, this method will redirect the user to the change password page.
    public function change_password(){
      $this->load->view('change_password');
    }
    // Update password.
    public function password_change(){
      if($this->session->userdata('peo_cnic')){
        $this->db->where('peo_cnic', $this->session->userdata('peo_cnic'));
        $this->db->update('peo_data', array('peo_password' => $this->input->post('pass')));
      }elseif($this->session->userdata('ac_cnic')){
        $this->db->where('ac_cnic', $this->session->userdata('ac_cnic'));
        $this->db->update('ac_data', array('ac_password' => $this->input->post('pass')));
      }elseif($this->session->userdata('ucpo_cnic')){
        $this->db->where('ucpo_cnic', $this->session->userdata('ucpo_cnic'));
        $this->db->update('ucpo_data', array('ucpo_password' => $this->input->post('pass')));
      }elseif($this->session->userdata('tcsp_cnic')){
        $this->db->where('tcsp_cnic', $this->session->userdata('tcsp_cnic'));
        $this->db->update('tcsp_data', array('tcsp_password' => $this->input->post('pass')));
      }else{
        echo 'Failed to update your password!';
      }
      $this->session->set_flashdata('success', '<strong>Success !</strong> Password change has been successful !');
      redirect('Perf_login');
    }
    // Terminate the session and log the user out.
    public function logout(){
		$this->session->sess_destroy(array('peo_cnic'));
		$this->session->set_flashdata('logged_out', '<strong>Hooray !</strong> You have been logged out successfully, Login again .');
		$this->index();
	}
}

?>