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

     if($result_create){
        
        $sqlTotal = "SELECT COUNT(`clientes_id`) as total_clientes FROM `clientes`";
        $resultTotal = mysqli_query($con, $sqlTotal);

        
        
        $row = mysqli_fetch_assoc($resultTotal);
        
        $totalClientes = $row["total_clientes"];

        $response = ['id' => $id, 'total' => $totalClientes];
  
       
   
        echo json_encode($response);
     }

     

}


    if(isset($_POST['removerId'])){

        $id = json_decode($_POST['removerId'], true);
        
        
        

        $delete_sql = "DELETE FROM `clientes` WHERE clientes_id=$id";
    
        $result_remove = mysqli_query($con, $delete_sql);

        if($result_remove){

            $sqlTotal = "SELECT COUNT(`clientes_id`) as total_clientes FROM `clientes`";
            $resultTotal = mysqli_query($con, $sqlTotal);

            if($resultTotal){
                $row = mysqli_fetch_assoc($resultTotal);

                $totalClientes = $row["total_clientes"];

                $response = ['total' => $totalClientes];
               
                echo json_encode($response);
            }
        }
        
        
        
        

    }


?>