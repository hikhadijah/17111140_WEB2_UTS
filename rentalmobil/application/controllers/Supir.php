<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merk extends CI_Controller {

	public function index()
	{	
		$data['supir'] = $this->supirmodel->Getsupir();
		$data['content'] = "supir/view";
		$this->load->view('template/template', $data);
	}

	public function add()
	{

		if($this->input->post('submit')) 
			{
				$this->form_validation->set_rules('namasupir', 'Field of Type supir', 'required');
				$this->form_validation->set_rules('tgllahir', 'Field of Merk supir', 'required');
				$this->form_validation->set_rules('alamat', 'Field of Tahun supir', 'required');
				$this->form_validation->set_rules('noktp', 'Field of No. Plat supir', 'required');
				
				if ($this->form_validation->run() == FALSE)
		                {
		                	$data['supir'] = $this->supirmodel->status();
		                    return $this->fungsi->status();
							$data['content'] = "supir/add";
							$this->load->view('template/template', $data);
		                }
		            else
		                {
			                    $config['upload_path']          = './img/';
				                $config['allowed_types']        = 'gif|jpg|png';
				               
				                $this->load->library('upload', $config);

				                if (!$this->upload->do_upload('foto')) {
					               
					                $error = array('error' => $this->upload->display_errors());
					                $this->index($error);
					            } else {
					                
					                $upload_data = $this->upload->data();
					 				$file_name 	=   $upload_data['file_name'];
					 				
					                $insert = $this->supirmodel->insert();
				                    if($insert) 
										{
											$this->session->set_flashdata('info', 'Data berhasil disimpan');
											redirect('supir');
										} else {
											$this->session->set_flashdata('info', 'Data gagal disimpan');
											redirect('supir');
										}
					            }
			                    
		                }

			} else {
				$data['content'] = "supir/add";
				$this->load->view('template/template', $data);
			}
		}
	}