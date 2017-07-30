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
     * @Method get_genero
     * @param void
     * @return boolean
     */
    public function get_genero(){
        return $this->db->query(
            "SELECT
              (SELECT CASE WHEN encuesta_genero is NULL OR 'f'
                  THEN 0 ELSE COUNT(encuesta_genero) END FROM encuestas
                  WHERE encuesta_genero = 'm') cantidad_genero_masc,
              (SELECT CASE WHEN encuesta_genero is NULL OR 'm'
                  THEN 0 ELSE COUNT(encuesta_genero) END FROM encuestas
                  WHERE encuesta_genero = 'f') cantidad_genero_fem"
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
     * @Method get_titulo_universitario
     * @param void
     * @return boolean
     */
    public function get_titulo_universitario(){
        return $this->db->query(
            "SELECT
              (SELECT CASE WHEN encuesta_genero is NULL OR 'si'
                  THEN 0 ELSE COUNT(encuesta_titulo_universitario) END FROM encuestas
                  WHERE encuesta_titulo_universitario = 'si') cantidad_titulo_universitario_si,
              (SELECT CASE WHEN encuesta_titulo_universitario is NULL OR 'no'
                  THEN 0 ELSE COUNT(encuesta_titulo_universitario) END FROM encuestas
                  WHERE encuesta_titulo_universitario = 'no') cantidad_titulo_universitario_no"
        );
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
