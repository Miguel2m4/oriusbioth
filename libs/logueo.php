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

        $secret = "orius2015";
        $clavex = hash_hmac("sha512", $pswd, $secret);

        if (hash_compare($clavex, $pass)) {
            session_start();
            $_SESSION['usulog'] = $resp['Usuario_usu'];
            $_SESSION['tipousu'] = $resp['Tipo_usu'];
            $answer['redirec'] = 'adminhome';
        }
        else
            $answer = 'error';

    }
    else
    {
    	 $answer = 'error';
    }
    echo json_encode($answer);



        function hash_compare($a, $b) {
        if (!is_string($a) || !is_string($b)) {
            return false;
        }

        $len = strlen($a);
        if ($len !== strlen($b)) {
            return false;
        }

        $status = 0;
        for ($i = 0; $i < $len; $i++) {
            $status |= ord($a[$i]) ^ ord($b[$i]);
        }
        return $status === 0;
    }

?>