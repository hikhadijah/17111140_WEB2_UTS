<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksimodel extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->library('fungsi');
	}

	function GetMerk() {
        return $this->db->get('merk')->result();
    }

    function GetData($id) {
    	return $this->db->get_where('merk', array('idmerk'=> $id))->row();
    }

	public function insert()
	{
		
		$merk = $this->input->post('merk');
		$merk_seo  = $this->fungsi->seo_title($merk);

		$input = array (
		    'namamerk' => $merk,
		    'namamerk_seo'  => $merk_seo
		);

		return $this->db->insert('merk', $input);
	}
}