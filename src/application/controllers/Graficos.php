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
		$this->load->model('Departamentos_m', 'departamentos');
	}

	public function index(){
		$this->load->view('graficos');
	}

	public function getGraficoGenero(){
		// Se obtiene la cantidad_genero_masc y
		// la cantidad_genero_fem
		$query = $this->encuestas->get_genero();

		echo json_encode($query->row());
	}

	public function getUbicacion(){
		// Se obtiene todos los departamentos.
		$query_departamentos = $this->departamentos->get_departamentos();

		// Crear un array de los departamentos.
		$v_array_departamentos = array();

		if($query_departamentos->num_rows() > 0){
			$v_departamentos = $query_departamentos->result();
			foreach($v_departamentos as $v_departamento){
				// Se crea un objeto departamento.
				$v_objecto_departemento = new stdClass();
				$v_objecto_departemento->id = $v_departamento->departamento_id;
				$v_objecto_departemento->nombre = $v_departamento->departamento_nombre;
				$v_objecto_departemento->cantidad = 0;

				// Se agrega el objeto departamento al array.
				$v_array_departamentos[$v_departamento->departamento_id] = $v_objecto_departemento;
			}
			// Se obtiene todas las encuestas.
			$query_encuestas = $this->encuestas->get_listado_encuestas();
			$v_encuestas = $query_encuestas->result();
			foreach ($v_encuestas as $v_encuesta){
				// Se obtiene el departamento.
				$v_longitud = $v_encuesta->encuesta_longitud;
				$v_latitud = $v_encuesta->encuesta_latitud;
				$query_departamento = $this->departamentos->get_departamento($v_longitud, $v_latitud);
				if($query_departamento->num_rows() > 0){
					$v_departamento = $query_departamento->row();
					$v_departamento_id = $v_departamento->departamento_id;
					if(isset($v_array_departamentos[$v_departamento_id])){
						$v_array_departamentos[$v_departamento_id]->cantidad += 1;
					}
				}
			}
		}
		// Se manda la informacion de los departamentos con sus cantidades
		// correspondientes en formato json.
		$json = json_encode($v_array_departamentos);
		header('Content-type: application/json; charset=utf-8');
		echo $json;
	}

	public function getTituloUniversitario(){
		// Se obtiene la cantidad_titulo_universitario_si y
		// la cantidad_titulo_universitario_no
		$query = $this->encuestas->get_titulo_universitario();

		echo json_encode($query->row());
	}

	public function getGraficoEdad(){
		// Se obtiene el rango de edades.
		$query = $this->encuestas->get_edad();

		echo json_encode($query->row());
	}
}
