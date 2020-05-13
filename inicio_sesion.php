<?php
    /* Parainiciar sesión*/
 
    include('conectaBDconPDO.php');
    include('Password.php');

    $obj = json_decode($_GET["x"], false);

    $correo = $obj->correo;
    $contra = $obj->contra;

    $obj =  conectaBD::singleton();

    $result = $obj->inicioSesion($correo) ;
  
    if( count($result) == 1){

        if(Password::verify($contra,$result)){
           
            session_start();
            $_SESSION["correo"] = $correo;

            $salida = 3;
            
        }else{

            $salida = 0;
        }

    }else{

       $salida = 1;

    }
    echo json_encode($salida);
       
?>