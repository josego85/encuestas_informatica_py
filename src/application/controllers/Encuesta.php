<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Encuesta extends CI_Controller {
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
		//
	}

	public function enviarDatos(){
		$p_sexo = $this->input->post('sexo', true);
		$p_latitud = $this->input->post('latitud', true);
		$p_longitud = $this->input->post('longitud', true);

		$v_datos = array(
			'encuesta_sexo' => $p_sexo,
			'encuesta_latitud' => $p_latitud,
			'encuesta_longitud' => $p_longitud,
		);

		if($this->encuestas->insertar_encuesta($v_datos)){
			echo json_encode("OK");
		}else{
			 echo json_encode("NOK");
		}
	}
}
