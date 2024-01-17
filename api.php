<?php

include("db_config.php");

if(isset($_POST['dataCreate'])){
    $customerCreate_obj = json_decode($_POST['dataCreate'], true);

    $nome = $customerCreate_obj['cliente_nome'];
    $email = $customerCreate_obj['cliente_email'];
    $contato = $customerCreate_obj['cliente_contato'];

    
    
     $create_sql = "INSERT INTO `clientes`  (`clientes_nome`, `clientes_email`, `clientes_contato`) VALUES ('$nome', '$email', '$contato')";
   
     $result_create = mysqli_query($con, $create_sql);

      $id = mysqli_insert_id($con);

      $response = ['id' => $id];

     
 
     echo json_encode($response);

}


?>