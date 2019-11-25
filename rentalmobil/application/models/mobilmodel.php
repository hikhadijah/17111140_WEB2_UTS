<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksimodel extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->library('fungsi');
	}

	function GetMobil() {
        $this->db->from("mobil");
		$this->db->order_by("type", "ASC");
		$query = $this->db->get(); 
		return $query->result();
    }

    function GetData($id) {
    	$id = $this->uri->segment(3);
    	return $this->db->get_where('mobil', array('idmobil'=> $id))->row();
    }

    public function getMerk(){

  		$this->db->from("merk");
		$this->db->order_by("namamerk", "ASC");
		$query = $this->db->get(); 
		return $query->result();

 	}

 	public function insert()
	{
		
		$type 		= $this->input->post('type');
		$idmerk 	= $this->input->post('idmerk');
		$tahun 		= $this->input->post('tahun');
		$plat 		= $this->input->post('plat');
		$kursi 		= $this->input->post('kursi');
		$tarif 		= $this->input->post('tarif');
		$lembur 	= $this->input->post('lembur');
		$rangka 	= $this->input->post('rangka');
		$foto 		= $this->input->post('foto');
		
		$sekarang	= $this->fungsi->hariini();

		$image_info = $this->upload->data();
		$file_name 	= $image_info['file_name'];

		$input = array (
			'date' 			=> $sekarang,
		    'type' 			=> $type,
		    'idmerk'  		=> $idmerk,
		    'tahunproduksi' => $tahun,
		    'platnomer'  	=> $plat,
		    'kursi'  		=> $kursi,
		    'tarif'  		=> $tarif,
		    'lembur'  		=> $lembur,
		    'norangka'  	=> $rangka,
		    'foto'  		=> $file_name
		);

		return $this->db->insert('mobil', $input);
	}
}