<?php
include("conexion.php");

@$opc = $_REQUEST['opc'];
@$informacion = array();


@$nombre = $_POST['nombre'];
@$contenido = $_POST['elm1'];
@$id = $_REQUEST['id'];


@$articulo = $_REQUEST['articulo'];
@$busq = strtolower($_GET["term"]);

switch ($opc) {
	case 'crear':
		// $entity_contenido = htmlentities($contenido);
		$entity_contenido = $contenido;
		$entity_contenido = mysql_real_escape_string($entity_contenido);
		$crea = mysql_query("INSERT into escritos values('','$nombre','$entity_contenido',NOW(),'') ");

		$return = 'correcto';
		echo json_encode($return);
	break;
	case 'cargart':
		$bus = mysql_query("SELECT id,titulo,creado from escritos ORDER BY id desc");
		while($resp=mysql_fetch_object($bus))
		{
			$informacion[]=$resp;
		}
		echo '{"escrito":'.json_encode($informacion).'}';
	break;
	case 'cargaru':
		$bus = mysql_query("SELECT id,titulo,encabezado,tipo,autor,contenido from articulos where Id='$id'");
		while($resp=mysql_fetch_object($bus))
		{
			$informacion[]=$resp;
		}
		echo '{"articulo":'.json_encode($informacion).'}';
	break;
	case 'editar':
		$entity_contenido =$contenido;
		$entity_contenido = mysql_real_escape_string($entity_contenido);
		$act = mysql_query("UPDATE articulos set titulo='$nombre',encabezado='$encabeza',autor='$creador',tipo='$tipo',contenido='$entity_contenido',modificado=NOW() where Id='$id' ");
		if($nombre_archivo!='')
		{
			$act = mysql_query("UPDATE articulos set imagen='$archivador' where Id='$id'");
			if (!move_uploaded_file($tmp_archivo, $archivador))
			{
				$return = 'error';
			}
			else
				$return = 'correcto';
		}
		else
			$return = 'correcto';

		echo json_encode($return);
	break;
	case 'borrar':
		$eli  = mysql_query("DELETE from escritos where id='$id'");
		echo 'correcto';
	break;
	case 'visitas':
		$vis = mysql_query("UPDATE escritos SET visitas = (visitas+1) WHERE id = '$id' ");
		$bus = mysql_query("SELECT visitas FROM escritos WHERE id = '$id' ");
		while($res=mysql_fetch_array($bus))
		{
			$informacion['total']=$res['visitas'];
		}
		echo json_encode($informacion);
	break;

	default:
		break;
}

?>