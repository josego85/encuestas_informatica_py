<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Graficos extends CI_Controller {
	/**
	 *
	 * @author josego
	 */
	public function __construct(){
		parent::__construct();

		// Cargar models.
		$this->load->model('Encuestas_m', 'encuestas');
	}

	public function index(){
		$this->load->view('graficos');
	}

	public function getGraficoSexo(){
		// Se obtiene la cantidad_sexo_masc y
		// la cantidad_sexo_fem
		$query = $this->encuestas->get_sexo();

		echo json_encode($query->row());
	}
}
