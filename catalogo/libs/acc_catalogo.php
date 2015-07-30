<?php
include("conexion.php");

@$opc = $_REQUEST['opc'];
@$informacion = array();
@$comentario = $_POST['comentario'];
@$producto = $_POST['producto'];
@$cantidad = $_POST['cantidad'];
@$pedido = $_REQUEST['pedido'];

@$inicio = $_REQUEST['inicio'];
@$fin = $_REQUEST['fin'];
@$estado = $_REQUEST['estado'];
@$pass = $_POST['pass'];

$nfecha =  date('Y-m-j H:i:s');

switch ($opc) {
	case 'cargar':
		$bus = mysql_query("SELECT * from catalogo");
		while($resp=mysql_fetch_object($bus))
		{
			$id = $resp->Id_item;
			$informacion[] = $resp;
			$bus1 = mysql_query("SELECT * from catalogo_productos where Id_item='$id'");
			while($resp1=mysql_fetch_object($bus1))
			{
				$informacion[] = $resp1;
				$pr = $resp1->nombre_pr;
			}
			if($resp->img_item=='')
			{
				$array = explode(chr(32),$pr);
				$prod = explode('/',(separar($array)));
				$bus2 = mysql_query("SELECT imagen_pr from productos where nombre_pr like '$prod[0]%' group by nombre_pr");
				while($resp2=mysql_fetch_object($bus2))
				{
					$informacion[] =  array('Id_img'=>$resp->Id_item,'imagen_pr'=>$resp2->imagen_pr);
				}
			}
			else
				$informacion[] = array('Id_img'=>$resp->Id_item,'imagen_pr'=>$resp->img_item);
		}
		echo '{"producto":'.json_encode($informacion).'}';
	break;
	case 'npedido':
		session_start();
		$cliente = $_SESSION['catusu'];
		$crea = mysql_query("INSERT INTO pedidos values('','$cliente','$comentario','$nfecha','PEN','','','','no','')");
		$bus = mysql_query("SELECT MAX(Id_ped) as id from pedidos");
		$resp=mysql_fetch_object($bus);
		$id=$resp->id;
		$bus = mysql_query("SELECT municipio from clientes where razon='$cliente'");
		if(mysql_num_rows($bus)!=0)
			$resp = mysql_fetch_object($bus);
		else
		{
			$bus = mysql_query("SELECT municipio from sucursales where razon='$cliente'");
			$resp = mysql_fetch_object($bus);
		}
		$crea = mysql_query("INSERT into registro_pedidos values ('','P','$id','$cliente','$resp->municipio','PEN','$nfecha','','','no') ");
		$bus = mysql_query("SELECT MAX(Id) from registro_pedidos");
		$resp = mysql_fetch_row($bus);
		$nid = $resp[0];
		for($i=0;$i<count($producto);$i++)
		{
			$crea = mysql_query("INSERT INTO pedidos_detalles values('$id','$producto[$i]','$cantidad[$i]')");
			$crea2 = mysql_query("INSERT into registro_pedidos_productos values ('$nid','$producto[$i]','$cantidad[$i]')");
		}
		$crea = mysql_query("INSERT into pedidos_historia values('$id','$nfecha','PEN','','$comentario','','$cliente')");
		echo'correcto';
	break;
	case 'lpedidos':
		session_start();
		$cliente = $_SESSION['catusu'];
		$bus = mysql_query("SELECT * from pedidos where Client_ped='$cliente' ORDER BY Id_ped desc");
		while($resp=mysql_fetch_object($bus))
		{

			$bus1 = mysql_query("SELECT * FROM pedidos_transporte WHERE Id_ped = '$resp->Id_ped' ");
			if(mysql_num_rows($bus1)!=0)
			{
				$resp1 = mysql_fetch_object($bus1);
				$trans = $resp1->transp_ped;
				$ticket = $resp1->ticket_trans;
				$resp = (array)$resp;
				$resp['transp_ped']=$trans;
				$resp['ticket_trans']=$ticket;
				$resp = (object)$resp;
				$informacion[]=$resp;
			}
			else
				$informacion[]=$resp;
		}
		echo '{"pedidos":'.json_encode($informacion).'}';
	break;
	case 'verpedido':
		$bus=mysql_query("SELECT * from pedidos where Id_ped='$pedido'");
		while($resp=mysql_fetch_object($bus))
		{
			$informacion[]=$resp;
			$bus2=mysql_query("SELECT * from pedidos_detalles where Id_ped='$pedido'");
			while($resp2=mysql_fetch_object($bus2))
			{
				$informacion[]=$resp2;
			}
			if($resp->Fact_ped!='')
			{
				$bus3=mysql_query("SELECT fac_ped as factura from pedidos_factura where Id_ped='$pedido'");
				while($resp3=mysql_fetch_object($bus3))
				{
					$informacion[]=$resp3;
				}
			}
		}
		$bus=mysql_query("SELECT cpubli_ped as comentario,fecha_ht as fecha,usuario from pedidos_historia where Id_ped='$pedido'");
		while($resp=mysql_fetch_object($bus))
		{
			if($resp->comentario!='')
			$informacion[]=$resp;
		}
		echo '{"pedidos":'.json_encode($informacion).'}';
	break;
	case 'filtrar':
		if($inicio=='')
			$inicio='0000-00-00';
		if($fin=='')
			$fin='9000-00-00';
		if($estado=='')
			$estado='%';
		session_start();
		$cliente = $_SESSION['catusu'];
		$bus =mysql_query("SELECT * from pedidos where Client_ped='$cliente' and Estado_ped like '$estado' and Fecha_ped between '$inicio' and '$fin' ORDER BY Id_ped desc");
		while($resp=mysql_fetch_object($bus))
		{
			$bus1 = mysql_query("SELECT * FROM pedidos_transporte WHERE Id_ped = '$resp->Id_ped' ");
			if(mysql_num_rows($bus1)!=0)
			{
				$resp1 = mysql_fetch_object($bus1);
				$trans = $resp1->transp_ped;
				$ticket = $resp1->ticket_trans;
				$resp = (array)$resp;
				$resp['transp_ped']=$trans;
				$resp['ticket_trans']=$ticket;
				$resp = (object)$resp;
				$informacion[]=$resp;
			}
			else
				$informacion[]=$resp;
		}
		echo '{"pedidos":'.json_encode($informacion).'}';
	break;
	case 'comentario':
		session_start();
		$cliente = $_SESSION['catusu'];
		$crea = mysql_query("INSERT INTO pedidos_historia values ('$pedido','$nfecha','','si','$comentario','','$cliente')");
		echo'correcto';
	break;
	case 'comprobar':
		session_start();
		$cliente = $_SESSION['catusu'];
		$sel = mysql_query("SELECT * FROM clientes where razon='$cliente'");
		$resp=mysql_fetch_array($sel);
		$pass2 = $resp['pass'];
		 if( crypt($pass, $pass2) == $pass2)
			echo'correcto';
		else
			echo'error';
	break;
	case 'editpass':
		session_start();
		$cliente = $_SESSION['catusu'];
		$encript = crypt_blowfish_bycarluys($pass);
		$act = mysql_query("UPDATE clientes set pass='$encript' where razon='$cliente'");
		echo 'correcto';
	break;
	default:
		break;
}
function separar($n)
{
	foreach($n as $pr)
	{
		if(is_numeric($pr))
		{
			$cant = $pr;
		}
		elseif($pr!='gr' and $pr!='ml')
		{
			if(!empty($nom))
				$nom = $nom .' '.$pr;
			else
				$nom = $pr;
		}
	}
	return($nom.'/'.$cant);
}
function crypt_blowfish_bycarluys($password, $digito = 7) {
$set_salt = './1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
$salt = sprintf('$2a$%02d$', $digito);
for($i = 0; $i < 22; $i++)
{
 $salt .= $set_salt[mt_rand(0, 63)];
}
return crypt($password, $salt);
}
?>