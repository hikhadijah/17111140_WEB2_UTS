<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksimodel extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->library('fungsi');
	}

	function Getsupir() {
        return $this->db->get('supir')->result();
    }

    function GetData($id) {
    	$id = $this->uri->segment(3);
    	return $this->db->get_where('supir', array('idsupir'=> $id))->row();
    }

 	public function insert()
	{
		
		$namasupir 	= $this->input->post('namasupir');
		$tgllahir 	= $this->input->post('tgllahir');
		$alamat 	= $this->input->post('alamat');
		$noktp 		= $this->input->post('noktp');
		$foto 		= $this->input->post('foto');
		
		$sekarang	= $this->fungsi->hariini();

		$image_info = $this->upload->data();
		$file_name 	= $image_info['file_name'];

		$input = array (
			'date' 			=> $sekarang,
			'tgllahir' 		=> $tgllahir,
		    'namasupir' 	=> $namasupir,
		    'alamat'  		=> $alamat,
		    'noktp' 		=> $noktp,
		    'foto'  		=> $file_name
		);

		return $this->db->insert('supir', $input);
	}
}