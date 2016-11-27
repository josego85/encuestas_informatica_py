<?php
/**
 * Esta vista se encargara de devolver los valores solicitados a las aplicaciones
 * clientes. Ej json, xml
 * @author josego
 */
if(!isset($headers)){
	$headers='Content-type:application/json';
}
header($headers);
echo json_encode($p_output,JSON_PRETTY_PRINT);
