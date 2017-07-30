<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Actividades_m extends CI_Model {
    /**
     * Modelo para manejo de las actividades.
     * @author josego
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     *
     * @param Array $p_datos
     * @return boolean
     */
    public function insertar_actividad($p_datos){
    	if($this->db->insert('actividades', $p_datos)){
    		return $this->db->insert_id();
    	}
    	return false;
    }

    /**
     * Recupera la cantidad de filas (reales si se uso sql_calc_found_rows) de
     * la ultima consulta que se haya ejecutado
     * @method get_cantidad_resultados
     * @return integer
     */
    public function get_cantidad_resultados(){
    	return $this->db->query('SELECT FOUND_ROWS() AS found_rows')->row()->found_rows;
    }
}
/* End of Actividades_m.php */
