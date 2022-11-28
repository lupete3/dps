<?php 
  $title = 'Gestion Produits';
  require_once('include/headerAdmin.php'); 

  $model = new Model;

  $list_category = $model->getCategory();
  

 ?>

  <div id="wrapper">

    <!-- Sidebar -->
    <?php include('include/sidebarAdmin.php'); ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="admin.php">Tableau de Bord</a>
          </li>
          <li class="breadcrumb-item active">Ajouter un utilisateurs</li>
        </ol>
        <div class="row">
          <div class="col-md-4">
            <form action="" id="form" method="POST" enctype="multipart/form-data">
       
        <!-- DataTables Example -->
            <div class="card ">
              <div class="card-header text-uppercase">Ajouter une utilisateurs</div>
                <div class="card-body">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-12">
                      <!-- Affichage de la notification -->
                      <div id="result">
                        
                      </div>
                      </div>
              
                      <div class="col-md-12">
                        <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom complet"  autocomplete="off"><br>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email"  autocomplete="off"><br>
                        <input type="text" id="telephone" name="telephone" class="form-control" placeholder="Téléphone"  autocomplete="off"><br>
                        <input type="text" id="login" name="login" class="form-control" placeholder="Login"  autocomplete="off"><br>
                        <input type="text" id="password" name="password" class="form-control" placeholder="Mot de passe"  autocomplete="off"><br>
                        <select class="form-control" id="type">
                          <option class="" selected value="" disabled>Type Utilisateur</option>
                          <option value="Admin">Admin</option>
                          <option value="Gérant">Gérant</option>
                        </select><br>
                      </div>
                      <div class="col-md-12">
                        <button type="submit" name="add_user" id="add_user" class="btn btn-sm btn-success "><i class="fa fa-check-circle"></i> Enregistrer </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <!-- Affichage des données de la base de donnée -->
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-table"></i>
                Liste des utilisateurs <div class="float-right">     
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Noms</th>
                      <th>Email</th>
                      <th>Téléphone</th>
                      <th>Login</th>
                      <th>Password</th>
                      <th>Type</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  
                  <tbody id="data_list">
                    
                  </tbody>
                </table>            
              </div>
            </div>  
            
          </div>
        </div>

        <!-- fenetre modal d'affichage donnée user -->
        <div class="modal fade" id="editForm" tabindex="-1" role="dialog" aria-labelledby="Modregister" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content panel-danger">
              <div class="modal-header">
                <h4 class="modal-title" id="AddSectionLabel">Info utilisateur</h4>
                <button type="button" class="close btn " data-dismiss="modal" aria-hidden="true">&times;</button>
              </div>
              <div class="modal-body">
                <form action="delete_agent.php" method="post" was-validate>
                  <div class="form-group">
                  </div>
                  <div class="form-group " id="ed_data" >
                    
                  </div><br>

                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-secondary btn-block" data-dismiss="modal" name="btn">Annuler </button>
                  <button type="submit" class="btn btn-primary btn-block" id="update" name="update"> Modifier </button>
                </div>
              </form>
              
            </div>
          </div>
        </div>
        <!-- /.modal-content -->

      <!-- Sticky Footer -->
      <?php include('include/footer.php'); ?>

      <script>
        
        //Fonction pour afficher les catégories
        function getUser(){
          $.ajax({
            url : "listUsers.php",
            type : "post",
            success : function(data){
              $("#data_list").html(data);
            }
          });
        }

        //Appel fonction qui affiche les catégories
        getUser();

        //Enregistrement des données de la table catégorie
         $(document).on("click","#add_user", function(e){
          e.preventDefault();

          var nom = $("#nom").val();
          var email = $("#email").val();
          var telephone = $("#telephone").val();
          var login = $("#login").val();
          var password = $("#password").val();
          var type = $("#type").val();

          var add_user = $("#add_user").val();
        
          $.ajax({
            url: 'add_user.php',
            type: 'post',
            data: {
              nom:nom,
              email:email,
              telephone:telephone,
              login:login,
              password:password,
              type:type,
              add_user:add_user,
            },
            success: function(response){
              getUser();
              $("#result").html(response);
              $("#form")[0].reset();
            },
          });     
        });

         //Affichage fenetre modale de la catégorie
         $(document).on("click","#editBtn", function(e){
          e.preventDefault();

          $("#editForm").modal("show");

          var id = $(this).attr("value");

          $.ajax({
            url : "show_user.php",
            type : "post",
            data : {
              id : id
            },
            success : function(data){
              $("#ed_data").html(data);
            }

          });

          //alert(id);
         });

         //Modification de la catégorie
         $(document).on("click","#update", function(e){
          e.preventDefault();
            var id = $("#idM").val();
            var nom = $("#nomM").val();
            var email = $("#emailM").val();
            var telephone = $("#telephoneM").val();
            var login = $("#loginM").val();
            var password = $("#passwordM").val();
           
           $.ajax({
              url:'edit_user.php',
              type : "post",
              data : {id:id,nom:nom,email:email,telephone:telephone,login:login,password:password},
              success : function(data){
                $("#editForm").modal("hide");
                getUser();
                $("#result").html(data);
              }

           });
         });

         //Suppression de la catégorie
         $(document).on("click","#deleteBtn", function(e){
          e.preventDefault();

          if(window.confirm("Voulez-vous supprimer cet utilisateur ?")){
            var id = $(this).attr("value");

            $.ajax({
              url:'delete_user.php',
              type:'post',
              data:{
                id:id,
              },
              success : function(data){
                getUser();
                $("#result").html(data);
              }
            });

          }
         });
      </script>

<!-- bootstrap-wysiwyg -->
  <script src="js/jquery.hotkeys.js"></script>
  <script src="js/bootstrap-wysiwyg.js"></script>
  <script src="js/bootstrap-wysiwyg-custom.js"></script>
  <script src="js/moment.js"></script>
  <script src="js/bootstrap-colorpicker.js"></script>
  <script src="js/daterangepicker.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <!-- ck editor -->
  <script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
  <!-- custom form component script for this page-->
  <script src="js/form-component.js"></script>
  <!-- custome script for all page -->
  <script src="js/scripts.js"></script>
