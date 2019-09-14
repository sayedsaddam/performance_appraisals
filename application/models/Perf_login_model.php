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
    // Get UCPO's for PEO to evaluate.
    public function get_ucpos(){
        $this->db->select('ucpo_data.id,
                            ucpo_data.position,
                            ucpo_data.province,
                            ucpo_data.district,
                            ucpo_data.tehsil,
                            ucpo_data.uc,
                            ucpo_data.cnic_name,
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
    // Get UCPO's for AC to evaluate.
    // public function get_ucpos_ac(){
    //     $this->db->select('ucpo_data.id,
    //                         ucpo_data.position,
    //                         ucpo_data.province,
    //                         ucpo_data.district,
    //                         ucpo_data.tehsil,
    //                         ucpo_data.uc,
    //                         ucpo_data.cnic_name,
    //                         ucpo_data.name,
    //                         ac_data.ac_id,
    //                         ac_data.ac_name,
    //                         ac_data.ac_cnic');
    //     $this->db->from('ucpo_data');
    //     $this->db->join('ac_data', 'ucpo_data.cnic_ac = ac_data.ac_cnic', 'left');
    //     $this->db->where('ucpo_data.cnic_ac', $this->session->userdata('ac_cnic'));
    //     $query = $this->db->get();
    //     echo $this->db->last_query();
    //     return $query->result();
    // }
}


?>