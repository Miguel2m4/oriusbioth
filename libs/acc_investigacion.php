<?php

include('conexion.php');

@$opc = $_REQUEST['opc'];
@$informacion = array();

@$nombre = $_POST['nombre'];
@$cultivo = $_REQUEST['cultivo'];

//ADJUNTOS
@$upload_folder ='../archivos/investigaciones';
@$upload_imgcul ='../archivos/cultivos';
@$nombre_archivo = $_FILES['archivo']['name'];
@$tmp_archivo = $_FILES['archivo']['tmp_name'];
//

switch ($opc) {
	case 'ncultivo':
		@$archivador = $upload_imgcul . '/'.$nombre.'_'.$nombre_archivo;
		if(move_uploaded_file($tmp_archivo, $archivador))
		{
			$crea = mysql_query("INSERT INTO cultivos VALUES('','$nombre','$archivador') ");
			$respuesta['status'] = 'correcto';
		}
		else
			$respuesta['status'] = 'error';
		echo json_encode($respuesta);
	break;
	case 'ecultivo':
		$act = mysql_query("UPDATE cultivos SET Nombre_cu = '$nombre' WHERE Id_cu = '$cultivo' ");
		if($act)
			echo'correcto';
	break;
	case 'listar':
		$sel = mysql_query("SELECT * FROM cultivos ");
		while($res = mysql_fetch_object($sel))
		{
			$sel2 = mysql_query("SELECT COUNT(Id_in) as total FROM investigaciones WHERE Id_cu = '$res->Id_cu' ");
			if(mysql_num_rows($sel2)!=0)
			{
				while($res2 = mysql_fetch_array($sel2))
				{
					$res =(array)$res;
					$res['total'] = $res2['total'];
					$res =(object)$res;
					$informacion[]=$res;
				}
			}
			else
			{
				$res =(array)$res;
				$res['total'] = 0;
				$res =(object)$res;
				$informacion[]=$res;
			}
		}
		echo '{"investigaciones":'.json_encode($informacion).'}';
	break;
	case 'cargar':
		$sel = mysql_query("SELECT Id_in,Nombre_in FROM investigaciones WHERE Id_cu = '$cultivo' ORDER BY Id_in DESC ");
		while($res = mysql_fetch_object($sel))
		{
			$informacion[]=$res;
		}
		echo '{"investigaciones":'.json_encode($informacion).'}';
	break;
	case 'ninvestiga':
		@$archivador = $upload_folder . '/'.$cultivo.'_'.$nombre_archivo;
		if(move_uploaded_file($tmp_archivo, $archivador))
		{
			$crea = mysql_query("INSERT INTO investigaciones VALUES('','$nombre','$archivador','$cultivo') ");
			$respuesta['status'] = 'correcto';
		}
		else
			$respuesta['status'] = 'error';
		echo json_encode($respuesta);
	break;
	case 'binvestiga':
		$sel = mysql_query("SELECT * FROM investigaciones WHERE Id_in = '$cultivo' ");
		$res = mysql_fetch_object($sel);
		unlink($res->Archivo_in);
		$eli = mysql_query("DELETE FROM investigaciones WHERE Id_in = '$cultivo' ");
	break;
	case 'cinvestiga':
// sleep(1);
		$sel = mysql_query("SELECT Nombre_in,Archivo_in FROM investigaciones WHERE Id_cu = '$cultivo'  ORDER BY Id_in DESC ");
		while($res = mysql_fetch_object($sel))
		{
			$informacion[]=$res;
		}
		echo '{"investigaciones":'.json_encode($informacion).'}';
	break;
	case 'einvestiga':
		$act = mysql_query("UPDATE investigaciones SET Nombre_in = '$nombre' WHERE Id_in = '$cultivo' ");
		if($act)
			echo'correcto';
	break;

	default:
		break;
}

?>