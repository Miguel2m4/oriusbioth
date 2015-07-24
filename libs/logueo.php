<?php
include("conexion.php");
    $usuario = mysql_real_escape_string($_POST['usuario']);
    $pswd = mysql_real_escape_string($_POST['password']);
    $answer = array();
    $sel = mysql_query("SELECT  * FROM usuarios WHERE Usuario_usu='$usuario' ");
    if ($resp = mysql_num_rows($sel)!=0)
    {
        $resp = mysql_fetch_array($sel);
        $pass = $resp['Pass_usu'];
        if( crypt($pswd, $pass) == $pass)
        {
            session_start();
            $_SESSION['usulog'] = $resp['Usuario_usu'];
            $_SESSION['tipousu'] = $resp['Tipo_usu'];
            $answer['redirec'] = 'adminhome';
        }
        else
            $answer = crypt($pswd, $pass);
    }
    else
    {
    	 $answer = 'error1';
    }
    echo json_encode($answer);
?>