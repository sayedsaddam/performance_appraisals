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
    public function validate_user($peo_name, $peo_cnic)
    {
    	$this->db->select('peo_id, peo_name, peo_cnic');
    	$this->db->from('peo_data');
		$this->db->where('peo_name', $peo_name);
		$this->db->where('peo_cnic', $peo_cnic);
		$query = $this->db->get();
		if($query->num_rows() == 0)
			return false;
		else
			return $query->row_array();
    }
    // AC login.
    public function validate_ac($ac_name, $ac_cnic)
    {
        $this->db->select('ac_id, ac_name, ac_cnic');
        $this->db->from('ac_data');
        $this->db->where('ac_name', $ac_name);
        $this->db->where('ac_cnic', $ac_cnic);
        $query = $this->db->get();
        if($query->num_rows() == 0)
            return false;
        else
            return $query->row_array();
    }
    // UCPO login.
    public function validate_ucpo($ucpo_name, $ucpo_cnic)
    {
        $this->db->select('id, name, cnic_name');
        $this->db->from('ucpo_data');
        $this->db->where('name', $ucpo_name);
        $this->db->where('cnic_name', $ucpo_cnic);
        $query = $this->db->get();
        if($query->num_rows() == 0)
            return false;
        else
            return $query->row_array();
    }
    // TCSP login.
    public function validate_tcsp($tcsp_name, $tcsp_cnic)
    {
        $this->db->select('id, name, cnic_name');
        $this->db->from('tcsp_data');
        $this->db->where('name', $tcsp_name);
        $this->db->where('cnic_name', $tcsp_cnic);
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
        $query = $this->db->get();
        return $query->result();
    }
    // Get TCSP's for evaluation.
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
    
}


?>