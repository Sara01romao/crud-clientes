
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
            <div>
              <h1>
                Clientes
                 <?php
                     
                     $sqlTotal = "SELECT COUNT(`clientes_id`) as total_clientes FROM `clientes`";
                     $resultTotal = mysqli_query($con, $sqlTotal);

                     if($resultTotal){
                      $row = mysqli_fetch_assoc($resultTotal);
                     }
                    

                 ?>

                 <span class="total_cliente"><?php  echo $row["total_clientes"];?></span>
               
              </h1>
            </div>
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
                 <h1 class="title-form"> 
                 <svg width="24" height="23" viewBox="0 0 24 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12.5 2V11.5M12.5 21V11.5M12.5 11.5H22M12.5 11.5H2" stroke="#7066E0" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                 </svg>


                   Cadastrar Cliente
                 </h1>
                  <form id="createCustumer">
                    
                    <div class="campo-container">
                      <label for="customer_name">Nome</label>
                      <input type="text" id="nome" name="nome"  placeholder="Seu Nome" required>
                    </div>
                    <br>

                    <div class="campo-container">
                      <label for="customer_email">E-mail</label>
                      <input type="email" id="email" name="email"  placeholder="Seu email" required>
                    </div>
                    <br>

                    <div class="campo-container">
                      <label for="customer_contact">Contato</label>
                      <input type="tel" id="contato" name="contato" placeholder="(11) 99999-99999" required>
                    </div>
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

                     if(cliente_nome == '' || cliente_email == '' || cliente_contato  == ''  ){
                      Swal.showValidationMessage(`
                             <small>"Preencha os campos corretamente"</small>
                       `);
                     }
                    
                    

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
                      
                        var clienteResponse = JSON.parse(response);

                        
                        var total = clienteResponse.total;
                        $('.total_cliente').text(total)
                        
                       
                        

                        var novoCliente = `
                            <tr>
                                <td>${dataCreate.cliente_nome}</td>
                                <td>${dataCreate.cliente_email}</td>
                                <td>${dataCreate.cliente_contato}</td>
                                <td class="d-flex justify-content-between btn-acoes">
                                    <button data-id="${clienteResponse.id}" class='btn btn-success btn-sm btn-edit'>
                                      <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.38215 2.36727L10.6326 5.61783L3.57442 12.6763L0.67641 12.9962C0.288452 13.0391 -0.0393326 12.7111 0.00383034 12.3231L0.326283 9.42293L7.38215 2.36727ZM12.643 1.88332L11.1168 0.357062C10.6407 -0.119021 9.86859 -0.119021 9.39253 0.357062L7.95673 1.79293L11.2072 5.04349L12.643 3.60762C13.119 3.13129 13.119 2.3594 12.643 1.88332Z" fill="white"/>
                                      </svg>
                                      
                                    </button>

                                    <button data-id="${clienteResponse.id}" class='btn-excluir btn btn-danger btn-sm'>
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


      

      //editar
      $('table').on('click', 'button.btn-editar', function() {
        var buscaId = $(this).data('id');

        console.log(buscaId )

        $.ajax({
          url: 'api.php',
          type: 'post',
          data: { buscaId: buscaId },
          success: function (response) {
            console.log(response)
            var clienteData = JSON.parse(response);
            
            console.log(clienteData.clientes_nome);
            Swal.fire({
                html: `
                 <h1> Editar Cadastrar</h1>
                  <form id="createCustumer">
                    

                    <label for="customer_name">Nome do Cliente:</label>
                    <input type="text" id="nome" name="nome" value='${clienteData.clientes_nome}' required>
                
                    <br>

                    <label for="customer_email">E-mail do Cliente:</label>
                    <input type="email" id="email" name="email" value='${clienteData.clientes_email}' required>

                    <br>

                    <label for="customer_contact">Contato do Cliente:</label>
                    <input type="tel" id="contato" name="contato" value='${clienteData.clientes_contato}' required>

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
                      "cliente_id": buscaId,
                        "cliente_nome": cliente_nome,
                        "cliente_email": cliente_email ,
                        "cliente_contato": cliente_contato,
                        
                    };

                    console.table(objetoCliente)
                    
                    return objetoCliente ;
                }


                
            }).then((result)=>{ 
                if (result.isConfirmed){ 
                    var editarValores = result.value
                    console.log("edit",editarValores)

                    

                    $.ajax({
                      url: 'api.php',
                      type: 'post',
                      data: { editarValores: JSON.stringify(editarValores)},
                      success: function (response){
                        // var result = JSON.parse(response)

                        $(`table button[data-id="${buscaId}"]`).closest('tr').replaceWith(`
                          <tr>
                                  <td>${editarValores.cliente_nome}</td>
                                  <td>${editarValores.cliente_email}</td>
                                  <td>${editarValores.cliente_contato}</td>
                                  <td class="d-flex justify-content-between btn-acoes">
                                      <button data-id="${buscaId}" class='btn-editar btn btn-success btn-sm '>
                                        <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M7.38215 2.36727L10.6326 5.61783L3.57442 12.6763L0.67641 12.9962C0.288452 13.0391 -0.0393326 12.7111 0.00383034 12.3231L0.326283 9.42293L7.38215 2.36727ZM12.643 1.88332L11.1168 0.357062C10.6407 -0.119021 9.86859 -0.119021 9.39253 0.357062L7.95673 1.79293L11.2072 5.04349L12.643 3.60762C13.119 3.13129 13.119 2.3594 12.643 1.88332Z" fill="white"/>
                                        </svg>
                                        
                                      </button>

                                      <button data-id="${buscaId}" class='btn-excluir btn btn-danger btn-sm'>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2 2L7 7M12 12L7 7M7 7L2 12L12 2" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        
                                      </button>
                                  </td>
                              </tr>
                        `);

                        
                      
                        
                        Swal.fire("Edição Concluída!");

                        console.log(result)
                      }


                    })

                  } 
                })





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
                  var total_clientes = JSON.parse(response);
                  var total = total_clientes.total;
                  

                 
            

                  Swal.fire({
                      position: "center",
                      icon: "success",
                      title: "Removido com sucesso",
                      showConfirmButton: false,
                      timer: 1500
                  });

                  $(`table button[data-id="${removerId}"]`).closest('tr').remove();

                  $('.total_cliente').text(total)
                }

              });


             
            } 
          });
      });

    });
   </script>

</body>
</html>