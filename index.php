
<?php
include("db_config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Clientes</title>
     <link rel="stylesheet" href="styles.css">
    
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
             <button class="btn btn-primary btn-criar">+ Novo</button>
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
                  
                    <td class="d-flex justify-content-between btn-acoes">
                        <button type="button" data-id="<?php echo $id;?>" class="btn-editar btn btn-success btn-sm ">
                            
                          <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.38215 2.36727L10.6326 5.61783L3.57442 12.6763L0.67641 12.9962C0.288452 13.0391 -0.0393326 12.7111 0.00383034 12.3231L0.326283 9.42293L7.38215 2.36727ZM12.643 1.88332L11.1168 0.357062C10.6407 -0.119021 9.86859 -0.119021 9.39253 0.357062L7.95673 1.79293L11.2072 5.04349L12.643 3.60762C13.119 3.13129 13.119 2.3594 12.643 1.88332Z" fill="white"/>
                          </svg>
                           
                        </button>

                        <button type="button" data-id="<?php echo $id;?>"  class="btn-excluir btn btn-danger btn-sm">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 2L7 7M12 12L7 7M7 7L2 12L12 2" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                           
                        </button>
                        
                    </td>
                  </tr>

                <?php } ?>
                  
                </tbody>
            </table>
        </div>
     </section>

     
   <script>

$(document).ready(function () {
       $('button.btn-criar').on('click', function() {
        
        //criar form no modal
        Swal.fire({
                html: `
                 <h1> Cadastrar Cliente</h1>
                  <form id="createCustumer">
                    

                    <label for="customer_name">Nome do Cliente:</label>
                    <input type="text" id="nome" name="nome"  required>
                
                    <br>

                    <label for="customer_email">E-mail do Cliente:</label>
                    <input type="email" id="email" name="email"  required>

                    <br>

                    <label for="customer_contact">Contato do Cliente:</label>
                    <input type="tel" id="contato" name="contato" required>

                    <br>
                
                  </form>
                   
                 
                `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                confirmButtonText: `
                    <i class="fa fa-thumbs-up"></i> Salvar
                `,
                confirmButtonAriaLabel: "Thumbs up, great!",
              
                 

                
                
                preConfirm:()=>{

                    var cliente_nome = document.getElementById("nome").value;
                    var cliente_email = document.getElementById("email").value;
                    var cliente_contato = document.getElementById("contato").value;

                    // if(cliente_nome == '' || cliente_email == '' || cliente_contato  == ''  ){
                    //   Swal.showValidationMessage(`
                    //         <small>"Preencha os campos corretamente"</small>
                    //   `);
                    // }
                    
                    

                    // Criar objeto com os valores do formulário
                    var objetoCliente = {
                        
                        "cliente_nome": cliente_nome,
                        "cliente_email": cliente_email ,
                        "cliente_contato": cliente_contato,
                        
                    };

                    console.table(objetoCliente)
                    
                    return objetoCliente ;
                }


                
            }).then((result) => {
                if (result.isConfirmed){

                    var dataCreate = result.value;

                    $.ajax({
                    url: 'api.php',
                    type: 'post',
                    data: { dataCreate: JSON.stringify(dataCreate)},

                    success: function (response) {
                      
                        var idNovoCliente = JSON.parse(response);
                        
                        console.log(idNovoCliente)
                        

                        var novoCliente = `
                            <tr>
                                <td>${dataCreate.cliente_nome}</td>
                                <td>${dataCreate.cliente_email}</td>
                                <td>${dataCreate.cliente_contato}</td>
                                <td class="d-flex justify-content-between btn-acoes">
                                    <button data-id="${idNovoCliente.id}" class='btn btn-success btn-sm btn-edit'>
                                      <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.38215 2.36727L10.6326 5.61783L3.57442 12.6763L0.67641 12.9962C0.288452 13.0391 -0.0393326 12.7111 0.00383034 12.3231L0.326283 9.42293L7.38215 2.36727ZM12.643 1.88332L11.1168 0.357062C10.6407 -0.119021 9.86859 -0.119021 9.39253 0.357062L7.95673 1.79293L11.2072 5.04349L12.643 3.60762C13.119 3.13129 13.119 2.3594 12.643 1.88332Z" fill="white"/>
                                      </svg>
                                      
                                    </button>

                                    <button data-id="${idNovoCliente.id}" class='btn-excluir btn btn-danger btn-sm'>
                                      <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M2 2L7 7M12 12L7 7M7 7L2 12L12 2" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                                      </svg>
                                      
                                    </button>
                                </td>
                            </tr>
                        `;
                        
                        Swal.fire({
                          position: "center",
                          icon: "success",
                          title: "Adicionado com sucesso",
                          showConfirmButton: false,
                          timer: 1500
                        });


                      $("table").append(novoCliente);

                      
                    }

                  });
                }
                  
              })




           
      
      });




              //remover
              $('table').on('click', 'button.btn-excluir', function() {
            
            var removerId = $(this).data('id');
            console.log(removerId)


            Swal.fire({
              title: "Tem certeza de que deseja remover?",
              html:``,
              confirmButtonText: "Remover",
              showCancelButton: true,
              cancelButtonText: "Cancelar",

          }).then((result) => {
           
            if (result.isConfirmed) {
              
              $.ajax({
                url: 'api.php',
                type: 'post',
                data: { removerId: JSON.stringify(removerId)},

                success: function (response) {
                  // var result = JSON.parse(response)
                  console.log(response)


                  


                  Swal.fire({
                      position: "center",
                      icon: "success",
                      title: "Removido com sucesso",
                      showConfirmButton: false,
                      timer: 1500
                  });

                  $(`table button[data-id="${removerId}"]`).closest('tr').remove()
                }

              });


             
            } 
          });
      });

    });
   </script>

</body>
</html>