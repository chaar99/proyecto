<?php
    include('conectaBDconPDO.php');
    include('Password.php');

    $obj = json_decode($_GET["x"], false);

    $correo = $obj->correo;
    $usu = $obj->usuario;
    $contra = $obj->contra;    
    $contra_hash = Password::hash($contra);
    $dni = $obj->dni;

    $obj =  conectaBD::singleton();
    $obj->registroDeUsuario($correo,$usu,$contra_hash,$dni) ;

    echo json_encode("Usuario registrado!");
?>