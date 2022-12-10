<?php 
  $title = 'Gestion Eleves';
  require_once('include/headerAdmin.php'); 

 ?>

  <div id="wrapper">

    <!-- Sidebar -->
    <?php include('include/sidebarAdmin.php'); ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="admin">Tableau de Bord</a>
          </li>
          <li class="breadcrumb-item active">Gestion des élèves </li>
        </ol>
        <div class="row">
          
          <div class="col-md-12">
            <div id="result">
              
            </div>
            <!-- Affichage des données de la base de donnée -->
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-table"></i>
                Liste des élèves <div class="float-right">     
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Nom Elève</th>
                      <th>Postnom Elève</th>
                      <th>Sexe</th>
                      <th>Date de naissance</th>
                      <th>Lieu Naissance</th>
                      <th>Adresse</th>
                      <th>N° Téléphone</th>
                      <th>Login</th>
                      <th>Password</th>
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
          <div class="modal-dialog modal-lg">
            <div class="modal-content panel-danger">
              <div class="modal-header">
                <h4 class="modal-title" id="AddSectionLabel">Info élève</h4>
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
        function getEleves(){

          let showAllEleves = "showAllEleves";

          $.ajax({
            url : "actions_eleve.php",
            type : "post",
            data:{showAllEleves:showAllEleves},
            success : function(data){
              $("#data_list").html(data);
            }
          });
        }

        //Appel fonction qui affiche les écoles de la base de données 
        getEleves();

        //Enregistrement des données de la table catégorie
         $(document).on("click","#add_eleve", function(e){
          e.preventDefault();

          let designation = $("#designation").val();
          let adresse = $("#adresse").val();
          let typeEcole = $("#typeEcole").val();
          let login = $("#login").val();
          let password = $("#password").val();

          let add_ecole = $("#add_ecole").val();
        
          $.ajax({
            url: 'actions_ecole.php',
            type: 'post',
            data: {
              designation:designation,
              adresse:adresse,
              typeEcole:typeEcole,
              login:login,
              password:password,
              add_ecole:add_ecole,
            },
            success: function(response){
              getEleves();
              $("#result").html(response);
              $("#form")[0].reset();
            },
          });     
        });

         //Affichage fenetre modale de la catégorie
         $(document).on("click","#editBtn", function(e){
          e.preventDefault();

          $("#editForm").modal("show");

          let id = $(this).attr("value");

          $.ajax({
            url : "actions_eleve.php",
            type : "post",
            data : {
              id : id
            },
            success : function(data){
              $("#ed_data").html(data);
            }

          });

         });

         //Modification de la catégorie
         $(document).on("click","#update", function(e){
          e.preventDefault();

            let idM = $("#idM").val();
            let nomM = $("#nomM").val();
            let postnomM = $("#postnomM").val();
            let sexeM = $("#sexeM").val();
            let dateNaissanceM = $("#dateNaissanceM").val();
            let lieuNaissanceM = $("#lieuNaissanceM").val();
            let adresseM = $("#adresseM").val();
            let telephoneM = $("#telephoneM").val();
            let loginM = $("#loginM").val();
            let passwordM = $("#passwordM").val();

            let editEleve = "editEleve";
           
           $.ajax({
              url:'actions_eleve.php',
              type : "post",
              data : {idM:idM,nomM:nomM,postnomM:postnomM,sexeM:sexeM,dateNaissanceM:dateNaissanceM,lieuNaissanceM:lieuNaissanceM,adresseM:adresseM,telephoneM:telephoneM,loginM:loginM,passwordM:passwordM,editEleve:editEleve},
              success : function(data){
                $("#editForm").modal("hide");
                getEleves();
                $("#result").html(data);
              }

           });
         });

         //Suppression de la catégorie
         $(document).on("click","#deleteBtn", function(e){
          e.preventDefault();

          if(window.confirm("Voulez-vous supprimer cet élève ?")){

            let idS = $(this).attr("value");
            let supprimEleve = "supprimEleve";

            $.ajax({
              url:'actions_eleve.php',
              type:'post',
              data:{
                idS:idS,
                supprimEleve:supprimEleve
              },
              success : function(data){
                getEleves();
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
