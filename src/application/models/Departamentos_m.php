<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Departamentos_m extends CI_Model {
    /**
     * Modelo para manejo de los departamentos de Paraguay.
     * @author josego
     */
    public function __construct(){
        parent::__construct();
    }

    /**
	 * Devuelve el departamento especifico de Paraguay.
	 * Se le pasa como parametro la latitud y la longitud.
	 * @param int $p_longitude
	 * @param int $p_latitude
	 * @return Object
	 */
	public function get_departamento($p_longitud, $p_latitud){
		$query = "SELECT departamento_id
          FROM departamentos
          WHERE CONTAINS(geom, POINT($p_longitud, $p_latitud)
        )";
		$v_result = $this->db->query($query);
		return $v_result;
	}

	/**
	 * Devuelve todos los departamentos de Paraguay.
	 * @param void
	 * @return Array
	 */
	public function get_departamentos(){
		$query = 'SELECT departamento_id, departamento_nombre FROM departamentos';
		$v_result = $this->db->query($query);
		return $v_result;
	}

    /**
     * Recupera la cantidad de filas (reales si se uso sql_calc_found_rows) de
     * la ultima consulta que se haya ejecutado
     * @return integer
     */
    public function get_cantidad_resultados(){
    	return $this->db->query('SELECT FOUND_ROWS() AS found_rows')->row()->found_rows;
    }
}
/* End of Departamentos_m.php */
