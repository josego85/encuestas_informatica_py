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
		$p_titulo_universitario = $this->input->post('titulo_universitario', true);
		$p_genero = $this->input->post('genero', true);
		$p_edad = $this->input->post('edad', true);
		$p_latitud = $this->input->post('latitud', true);
		$p_longitud = $this->input->post('longitud', true);

		// Utilitarios para las validaciones.
		$this->form_validation->set_error_delimiters('<p>',"</p>");

		// Reglas de validacion.
		$this->form_validation->set_rules('titulo_universitario', 'T&itulo univeritario', 'required');

		if($this->form_validation->run() !== false){
			$v_datos = array(
				'encuesta_titulo_universitario' => $p_titulo_universitario,
				'encuesta_genero' => $p_genero,
				'encuesta_edad' => $p_edad,
				'encuesta_latitud' => $p_latitud,
				'encuesta_longitud' => $p_longitud,
			);
			// Inicio de transaccion.
            //-----------------------------------
            $this->db->trans_begin();

			$v_result = $this->encuestas->insertar_encuesta($v_datos);

			// Comprobacion de transacciones.
			if($this->db->trans_status() === true && $v_result !== false){
		        $this->db->trans_commit();
				$v_data['mensaje'] = 'Se ha guardado correctamente los datos de la encuesta.';
				$v_data['success'] = true;
			}else{
		         $this->db->trans_rollback();
				 $v_data['mensaje'] = 'Error al guardar la encuesta';
				 $v_data['success'] = false;
			}
        }else{
	         $v_data['mensaje'] = 'Ver mensajes de error de las validaciones';
			 $v_data['errores'] = validation_errors();
			 $v_data['success'] = false;
		}
		$this->load->view('output', array('p_output' => $v_data));
	}
}
