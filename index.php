<?php
  include('conectaBDconPDO.php');

  $obj =  conectaBD::singleton();
/*
  $result2 = $obj->telefonosPublicos();
  echo json_encode($result2);*/
  $nom = $_GET['nombre'];
  $result = $obj->consultaPreparada4($nom);
  print_r($result);
?>