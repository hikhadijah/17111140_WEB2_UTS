<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merk extends CI_Controller {

	public function index()
	{	
		$data['merk'] = $this->merkmodel->GetMerk();
		$data['content'] = "merk/view";
		$this->load->view('template/template', $data);
	}

	public function add()
	{
		if($this->input->post('submit')) 
			{
				$this->form_validation->set_rules('merk', 'Field of Merk Mobil', 'required');
				if ($this->form_validation->run() == FALSE)
		                {
		                    $data['content'] = "merk/add";
							$this->load->view('template/template', $data);
		                }
		            else
		                {
			                    $insert = $this->merkmodel->insert();
			                    if($insert) 
									{
										$this->session->set_flashdata('info', 'Data berhasil disimpan');
										redirect('merk');
									} 
		                }

			} else {
				$data['content'] = "merk/add";
				$this->load->view('template/template', $data);
			}
		}
	}