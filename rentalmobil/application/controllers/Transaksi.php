<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merk extends CI_Controller {

	public function index()
	{
		$data['transaksi'] = $this->transaksimodel->Gettransaksi();
		
		$data['content'] = "transaksi/view";
		$this->load->view('template/template', $data);	
	}

	public function add()
	{

		if($this->input->post('submit')) 
			{
				$this->form_validation->set_rules('namapelanggan', 'Field Nama Pelanggan', 'required');
				$this->form_validation->set_rules('noktp', 'Field No. KTP', 'required');
				$this->form_validation->set_rules('nohp', 'Field No. HP', 'required');
				$this->form_validation->set_rules('alamat', 'Field Alamat', 'required');
				$this->form_validation->set_rules('tglsewa', 'Field Tanggal Sewa', 'required');
				$this->form_validation->set_rules('idmobil', 'Field Mobil', 'required');
				$this->form_validation->set_rules('idsupir', 'Field Supir', 'required');

				if ($this->form_validation->run() == FALSE)
		            {
		                    $data['mobil'] = $this->transaksimodel->getMobil();
							$data['supir'] = $this->transaksimodel->getSupir();
							$data['content'] = "transaksi/add";
							$this->load->view('template/template', $data);
		                }
		            else
		                {			
		                			
					                $insert 	= $this->transaksimodel->insert();
				                    if($insert) 
				                    {
											$this->updatestmbl($this->input->post('idmobil'), 'jalan');
											$this->session->set_flashdata('info', 'Data berhasil disimpan');
											redirect('transaksi');
										}			                    
		                }

			} else {
				$data['mobil'] = $this->transaksimodel->getMobil();
				$data['supir'] = $this->transaksimodel->getSupir();
				$data['content'] = "transaksi/add";
				$this->load->view('template/template', $data);
			}
		}
	}