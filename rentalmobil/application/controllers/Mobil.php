	<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merk extends CI_Controller {

	public function index()
	{	
		$data['mobil'] = $this->mobilmodel->GetMobil();
		$data['content'] = "mobil/view";
		$this->load->view('template/template', $data);
	}

	public function add()
	{

		if($this->input->post('submit')) 
			{
				$this->form_validation->set_rules('type', 'Field of Type Mobil', 'required');
				$this->form_validation->set_rules('idmerk', 'Field of Merk Mobil', 'required');
				$this->form_validation->set_rules('tahun', 'Field of Tahun Mobil', 'required');
				$this->form_validation->set_rules('plat', 'Field of No. Plat Mobil', 'required');
				$this->form_validation->set_rules('kursi', 'Field of Jumlah Kursi Mobil', 'required');
				$this->form_validation->set_rules('tarif', 'Field of Tarif Mobil', 'required');
				$this->form_validation->set_rules('lembur', 'Field of Overtime', 'required');
				$this->form_validation->set_rules('rangka', 'Field of No. Rangka Mobil', 'required');
				
				if ($this->form_validation->run() == FALSE)
		                {
		                	$data['mobil'] = $this->mobilmodel->status();
		                    return $this->fungsi->status();
							$data['content'] = "mobil/add";
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
					 				
					                $insert = $this->mobilmodel->insert();
				                    if($insert) 
										{
											$this->session->set_flashdata('info', 'Data berhasil disimpan');
											redirect('mobil');
										} 
					            }
			                    
		                }

			} else {
				$data['list'] = $this->mobilmodel->getMerk();
				$data['content'] = "mobil/add";
				$this->load->view('template/template', $data);
			}
		}
	}