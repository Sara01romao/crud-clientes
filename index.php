
<?php
include("db_config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Clientes</title>
     
    
      <!-- bootsrap -->
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js' type='text/javascript'></script>
    
     <!-- sweetalert-->
    <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body>
    
     <section class="container">
      
        <div>

        </div>
        
        <div class=" container tabela-container">
            <table class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contato</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>

                  
                <?php
                       
                        $sql= "SELECT * FROM `clientes`";
                        $result= mysqli_query($con, $sql);

                        while ($array= mysqli_fetch_array($result)){
                            $id= $array['clientes_id'];
                            $nome= $array['clientes_nome'];
                            $email= $array['clientes_email'];
                            $contato= $array['clientes_contato'];
                            

                            

                ?>
                 
                  <tr>
                    <td><?php echo $nome; ?></td>
                    <td><?php echo $email;?></td>
                    <td><?php echo $contato;?></td>
                  
                    <td class="d-flex ">
                        <button type="button" data-id="<?php echo $id;?>" class="btn-editar btn btn-success btn-sm mr-3">
                            
                          <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.38215 2.36727L10.6326 5.61783L3.57442 12.6763L0.67641 12.9962C0.288452 13.0391 -0.0393326 12.7111 0.00383034 12.3231L0.326283 9.42293L7.38215 2.36727ZM12.643 1.88332L11.1168 0.357062C10.6407 -0.119021 9.86859 -0.119021 9.39253 0.357062L7.95673 1.79293L11.2072 5.04349L12.643 3.60762C13.119 3.13129 13.119 2.3594 12.643 1.88332Z" fill="white"/>
                          </svg>
                            Editar
                        </button>

                        <button type="button" data-id="<?php echo $id;?>"  class="btn-excluir btn btn-danger btn-sm">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 2L7 7M12 12L7 7M7 7L2 12L12 2" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Excluir   
                        </button>
                        
                    </td>
                  </tr>

                <?php } ?>
                  
                </tbody>
            </table>
        </div>
     </section>

     


</body>
</html>