<?php
include("conexion.php");

        $usuario = mysql_real_escape_string($_POST['nombre']);
        $pswd = mysql_real_escape_string($_POST['password']);
        $answer = array();
        $sel = mysql_query("SELECT  * FROM clientes WHERE login='$usuario' and aprobado='si'");
        if ($resp = mysql_fetch_array($sel))
        {
            $pass = $resp['pass'];
            if( crypt($pswd, $pass) == $pass)
            {
                session_start();
                $_SESSION['catusu'] = $resp['razon'];
                $answer['redirec'] = 'cataingreso';
            }
            else
                $answer = 'error';
        }

        else
        {   $sel = mysql_query("SELECT  * FROM sucursales WHERE login='$usuario' and aprobado='si'");
            if ($resp = mysql_fetch_array($sel))
            {
                $pass = $resp['pass'];
                if( crypt($pswd, $pass) == $pass)
                {
                    session_start();
                    $_SESSION['catusu'] = $resp['razon'];
                    $answer['redirec'] = 'cataingreso';
                }
                else
                    $answer = 'error';
            }
            else
        	 $answer = 'error';
        }
        echo json_encode($answer);
?>