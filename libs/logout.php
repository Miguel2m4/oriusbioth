<?php
session_start();


unset($_SESSION['usulog']);
unset($_SESSION['tipousu']);
session_destroy();
header('Location: ../adminorius' );


?>