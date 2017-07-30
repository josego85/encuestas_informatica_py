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
		$this->load->model('Actividades_m', 'actividades');
	}

	public function index(){
		//
	}

	public function enviarDatos(){
		$titulo_universitario = $this->input->post('titulo_universitario', true);
		$genero = $this->input->post('genero', true);
		$edad = $this->input->post('edad', true);
		$latitud = $this->input->post('latitud', true);
		$longitud = $this->input->post('longitud', true);
		$actividades = $this->input->post('actividades', true);

		// Utilitarios para las validaciones.
		$this->form_validation->set_error_delimiters('<p>',"</p>");

		// Reglas de validacion.
		$this->form_validation->set_rules('titulo_universitario', 'T&itulo univeritario', 'required');

		if($this->form_validation->run() !== false){
			$datos = array(
				'encuesta_titulo_universitario' => $titulo_universitario,
				'encuesta_genero' => $genero,
				'encuesta_edad' => $edad,
				'encuesta_latitud' => $latitud,
				'encuesta_longitud' => $longitud
			);
			// Inicio de transaccion.
            //-----------------------------------
            $this->db->trans_begin();

			// Se inserta la encuesta.
			$encuesta_id = $this->encuestas->insertar_encuesta($datos);

			// Se inserta las actividades.
			foreach($actividades as  $actividad){
				$datos = array(
					'actividad_descripcion' => $actividad,
					'encuesta_id' => $encuesta_id
				);
				$this->actividades->insertar_actividad($datos);
			}

			// Comprobacion de transacciones.
			if($this->db->trans_status() === true){
		        $this->db->trans_commit();
				$data['mensaje'] = 'Se ha guardado correctamente los datos de la encuesta.';
				$data['success'] = true;
			}else{
		         $this->db->trans_rollback();
				 $data['mensaje'] = 'Error al guardar la encuesta';
				 $data['success'] = false;
			}
        }else{
	         $data['mensaje'] = 'Ver mensajes de error de las validaciones';
			 $data['errores'] = validation_errors();
			 $data['success'] = false;
		}
		$this->load->view('output', array('p_output' => $data));
	}
}
