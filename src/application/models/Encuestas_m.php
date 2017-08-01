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
     * @Method get_edad
     * @param void
     * @return boolean
     */
    public function get_edad(){
        return $this->db->query(
            "select
                sum(case
                  when (encuesta_edad between 18 and 25) then 1
                  else 0
                  end) Edad18a25,
                sum(case
                  when (encuesta_edad between 26 and 30) then 1
                  else 0
                  end) Edad26a30,
                sum(case
                  when (encuesta_edad between 31 and 35) then 1
                  else 0
                  end) Edad31a35,
                sum(case
                  when (encuesta_edad between 36 and 40) then 1
                  else 0
                  end) Edad36a40,
                sum(case
                  when (encuesta_edad between 41 and 99) then 1
                  else 0
                  end) Edad41
                from encuestas");
    }

    /**
     * @Method get_edad
     * @param void
     * @return boolean
     */
    public function get_actividades(){
        return $this->db->query(
            "select
                sum(case
                  when (actividad_descripcion = 'Organizar Proyectos') then 1
                  else 0
                  end) OrganizarProyectos,
                sum(case
                  when (actividad_descripcion = 'Analizar') then 1
                  else 0
                  end) Analizar,
                sum(case
                  when (actividad_descripcion = 'Programar') then 1
                  else 0
                  end) Programar,
                sum(case
                  when (actividad_descripcion = 'Testear') then 1
                  else 0
                  end) Testear,
                sum(case
                  when (actividad_descripcion = 'Infraestructura') then 1
                  else 0
                  end) Infraestructura,
                sum(case
                  when (actividad_descripcion = 'Soporte Usuarios') then 1
                  else 0
                  end) SoporteUsuarios,
                sum(case
                  when (actividad_descripcion = 'Soporte Tecnico') then 1
                  else 0
                  end) SoporteTecnico
                from actividades");
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
