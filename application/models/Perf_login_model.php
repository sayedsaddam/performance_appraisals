<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/**
 * filename: Perf_login_model.php
 * filepath: models / Perf_login_model.php
 * Author: Saddam
 */
class Perf_login_model extends CI_Model
{
    /**
     * summary
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    // PEO login.
    public function validate_user($peo_cnic, $password)
    {
    	$this->db->select('peo_id, peo_name, peo_cnic, peo_password');
    	$this->db->from('peo_data');
		$this->db->where('peo_cnic',$peo_cnic);
        $this->db->where('peo_password', $password);
		$query = $this->db->get();
		if($query->num_rows() == 0)
			return false;
		else
			return $query->row_array();
    }
    // AC login.
    public function validate_ac($ac_cnic, $password)
    {
        $this->db->select('ac_id, ac_name, ac_cnic, ac_password');
        $this->db->from('ac_data');
        $this->db->where('ac_cnic', $ac_cnic);
        $this->db->where('ac_password',$password);
        $query = $this->db->get();
        if($query->num_rows() == 0)
            return false;
        else
            return $query->row_array();
    }
    // UCPO login.
    public function validate_ucpo($ucpo_cnic, $password)
    {
        $this->db->select('id, name, cnic_name, ucpo_password');
        $this->db->from('ucpo_data');
        $this->db->where('cnic_name', $ucpo_cnic);
        $this->db->where('ucpo_password', $password);
        $query = $this->db->get();
        if($query->num_rows() == 0)
            return false;
        else
            return $query->row_array();
    }
    // TCSP login.
    public function validate_tcsp($tcsp_cnic, $password)
    {
        $this->db->select('id, name, cnic_name, tcsp_password');
        $this->db->from('tcsp_data');
        $this->db->where('cnic_name', $tcsp_cnic);
        $this->db->where('tcsp_password', $password);
        $query = $this->db->get();
        if($query->num_rows() == 0)
            return false;
        else
            return $query->row_array();
    }
    // Validate the administrators to view everything.
    public function validate_admin($admin_cnic){
        $this->db->select('admin_id, admin_name, admin_cnic, admin_role');
        $this->db->from('administrators');
        $this->db->where('admin_cnic', $admin_cnic);
        $query = $this->db->get();
        if($query->num_rows() == 0)
            return false;
        else
            return $query->row_array();
    }
    // Get UCPO's for PEO to evaluate.
    public function get_ucpos(){
        $this->db->select('ucpo_data.id,
                            ucpo_data.position,
                            ucpo_data.province,
                            ucpo_data.district,
                            ucpo_data.tehsil,
                            ucpo_data.uc,
                            ucpo_data.cnic_name,
                            ucpo_data.cnic_peo,
                            ucpo_data.name,
                            peo_data.peo_id,
                            peo_data.peo_name,
                            peo_data.peo_cnic');
        $this->db->from('ucpo_data');
        $this->db->join('peo_data', 'ucpo_data.cnic_peo = peo_data.peo_cnic', 'left');
        $this->db->where('ucpo_data.cnic_peo', $this->session->userdata('peo_cnic'));
        $this->db->where('id NOT IN(SELECT employee_id FROM performance_evaluation)');
        $query = $this->db->get();
        return $query->result();
    }
    // Get TCSP's for PEO to evaluate.
    public function get_tcsps(){
        $this->db->select('tcsp_data.id,
                            tcsp_data.position,
                            tcsp_data.province,
                            tcsp_data.district,
                            tcsp_data.tehsil,
                            tcsp_data.uc,
                            tcsp_data.cnic_name,
                            tcsp_data.cnic_peo,
                            tcsp_data.name,
                            peo_data.peo_id,
                            peo_data.peo_name,
                            peo_data.peo_cnic');
        $this->db->from('tcsp_data');
        $this->db->join('peo_data', 'tcsp_data.cnic_peo = peo_data.peo_cnic', 'left');
        $this->db->where('tcsp_data.cnic_peo', $this->session->userdata('peo_cnic'));
        $query = $this->db->get();
        return $query->result();
    }
    // Get UCPO's for AC to evaluate.
    public function get_ac_ucpos(){
        $this->db->select('ucpo_data.id,
                            ucpo_data.position,
                            ucpo_data.province,
                            ucpo_data.district,
                            ucpo_data.tehsil,
                            ucpo_data.uc,
                            ucpo_data.cnic_name,
                            ucpo_data.name,
                            ucpo_data.cnic_ac,
                            ac_data.ac_id,
                            ac_data.ac_name,
                            ac_data.ac_cnic');
        $this->db->from('ucpo_data');
        $this->db->join('ac_data', 'ucpo_data.cnic_ac = ac_data.ac_cnic', 'left');
        $this->db->where('ucpo_data.cnic_ac', $this->session->userdata('ac_cnic'));
        $query = $this->db->get();
        return $query->result();
    }
    // Get TCSP's for AC to evaluate.
    public function get_ac_tcsps(){
        $this->db->select('tcsp_data.id,
                            tcsp_data.position,
                            tcsp_data.province,
                            tcsp_data.district,
                            tcsp_data.tehsil,
                            tcsp_data.uc,
                            tcsp_data.cnic_name,
                            tcsp_data.name,
                            tcsp_data.cnic_ac,
                            ac_data.ac_id,
                            ac_data.ac_name,
                            ac_data.ac_cnic');
        $this->db->from('tcsp_data');
        $this->db->join('ac_data', 'tcsp_data.cnic_ac = ac_data.ac_cnic', 'left');
        $this->db->where('tcsp_data.cnic_ac', $this->session->userdata('ac_cnic'));
        $query = $this->db->get();
        return $query->result();
    }
    
}


?>