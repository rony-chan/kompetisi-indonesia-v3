<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class save extends CI_Controller {

	/**
	 * Example: DOMPDF 
	 *
	 * Documentation: 
	 * http://code.google.com/p/dompdf/wiki/Usage
	 *
	 */
	public function index() {	
		$this->load->model('m_kompetisi');
		// Load all views as normal
		$idkompetisi = $this->input->get('id');
		$dec = base64_decode(base64_decode($idkompetisi));
		$id_kompetisi = str_replace('', '=', $dec);
		$data['kompetisi'] = $this->m_kompetisi->get_competition_by_id_kompetisi($id_kompetisi);

		$this->load->view('savekompetisi',$data);
		// Get output html
		$html = $this->output->get_output();
		
		// Load library
		$this->load->library('dompdf_gen');
		
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$judul = str_replace(' ', "-", $data['kompetisi']['judul_kompetisi']);
		$this->dompdf->stream($judul.".pdf");//pdf file name
		
	}
}
