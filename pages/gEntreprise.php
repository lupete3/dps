<?php 
  $title = 'Gestion Entreprise';
  require_once('include/headerAdmin.php'); 

  $model = new Model;

  $entreprise = $model->getEntrepriseInfo();

  if (!empty($entreprise)) {
    foreach($entreprise as $data):

      $nom = $data['nom'];
      $adresse = $data['adresse'];
      $telephone = $data['contact_phone'];
      $email = $data['contact_email'];
      $logo = $data['logo'];

    endforeach;
  }
  

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
          <li class="breadcrumb-item active">Modifier l'adresse de votre entreprise</li>
        </ol>
        <div class="row">
          <div class="col-md-12">
            <form action="" id="form" method="POST" enctype="multipart/form-data">
       
        <!-- DataTables Example -->
            <div class="card ">
              <div class="card-header text-uppercase">Adresse de l'entreprise</div>
                <div class="card-body">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-12">
                      <!-- Affichage de la notification -->
                      <div id="etat" ></div>
                      <div id="result" class="badge badge-danger" ></div>
                      </div>
              
                      <div class="col-md-12">
                        <label for="nom"> <b>Nom Entreprise</b> </label>
                        <input type="text" value="<?= $nom?>" id="nom" name="nom" class="form-control" placeholder="Nom Entreprise"  autocomplete="off">
                        <label for="nom"> <b>Adresse Entreprise</b> </label>
                        <input type="text" value="<?= $adresse?>" id="adresse" name="adresse" class="form-control" placeholder="Adresse Entreprise"  autocomplete="off">
                        <label for="nom"> <b>Téléphone Entreprise</b> </label>
                        <input type="text" value="<?= $telephone?>" id="telephone" name="telephone" class="form-control" placeholder="Téléphone Entreprise"  autocomplete="off">
                        <label for="nom"> <b>Email Entreprise</b> </label>
                        <input type="text" value="<?= $email?>" id="email" name="email" class="form-control" placeholder="Email Entreprise"  autocomplete="off"><br>

                        <input type="file"  name="file" class="" onchange="previewFile(this);"  id="file" multiple="" ><br>

                        <div class='preview'>
                          <label for=""><b>Logo</b></label>
                          <img src="../../img/<?= $logo?>" id="previewImg" width="50" height="50">

                        </div>

                      </div>
                      <div class="col-md-12">
                        <button type="submit" name="edit_entreprise" id="edit_entreprise" class="btn btn-sm btn-success "><i class="fa fa-check-circle"></i> Modifier et Enregistrer</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <br>
        <!-- /.modal-content -->

      <!-- Sticky Footer -->
      <?php include('include/footer.php'); ?>

      <script>

        $('#result').hide();

        function previewFile(input){
          var file = $("input[type=file]").get(0).files[0];
   
          if(file){
            var reader = new FileReader();
   
            reader.onload = function(){
              $("#previewImg").attr("src", reader.result);
              $("#previewImg").show();
            }
            reader.readAsDataURL(file);
          }
        }

        //Enregistrement des données de la table entreprise
         
         $(document).on("click","#edit_entreprise", function(e){
          e.preventDefault();

          var nom = $("#nom").val();
          var adresse = $("#adresse").val();
          var telephone = $("#telephone").val();
          var email = $("#email").val();

          var fd = new FormData();
          var files = $('#file')[0].files;

          var edit_entreprise = $("#edit_entreprise").val();

          fd.append('file',files[0]);
          fd.append('nom',nom);
          fd.append('adresse',adresse);
          fd.append('telephone',telephone);
          fd.append('email',email);
        
          $.ajax({
            url: 'edit_entreprise.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
              $("#etat").html(response);
              $("#img").attr("src",response); 
            },
          });     
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
