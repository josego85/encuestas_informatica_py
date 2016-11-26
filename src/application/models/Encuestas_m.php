<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Encuestas_m extends CI_Model {
    /**
     * Modelo para manejo de la encuesta.
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
    public function insertar_encuesta($p_datos){
    	if($this->db->insert('encuestas', $p_datos)){
    		return $this->db->insert_id();
    	}
    	return false;
    }

    /**
     * @Method get_sexo
     * @param void
     * @return boolean
     */
    public function get_sexo(){
        return $this->db->query(
            "SELECT
              (SELECT CASE WHEN encuesta_sexo is NULL OR 'f'
                  THEN 0 ELSE COUNT(encuesta_sexo) END FROM encuestas
                  WHERE encuesta_sexo = 'm') cantidad_sexo_masc,
              (SELECT CASE WHEN encuesta_sexo is NULL OR 'm'
                  THEN 0 ELSE COUNT(encuesta_sexo) END FROM encuestas
                  WHERE encuesta_sexo = 'f') cantidad_sexo_fem"
        );
    }

    /**
     * @Method get_listado_encuestas
     * @param void
     * @return boolean
     */
    public function get_listado_encuestas(){
        $this->db->select("*");
        return $this->db->get('encuestas');
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
/* End of Encuestas_m.php */
