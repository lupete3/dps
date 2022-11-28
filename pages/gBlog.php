<?php 
  $title = 'Gestion Blog';
  require_once('include/headerAdmin.php'); 

  $model = new Model;

  $all_blog = $model->getBlog($debut='',$fin='');
  

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
          <li class="breadcrumb-item active">Ajouter un témoignage</li>
        </ol>
        <div class="row">
          <div class="col-md-12">
            <form action="" method="POST" id="form" enctype="multipart/form-data">
       
        <!-- DataTables Example -->
            <div class="card ">
              <div class="card-header text-uppercase">Ajouter un témoignage <div class="float-right"><button type="submit" name="add_article" id="add_article" class="btn btn-sm btn-success "><i class="fa fa-check-circle"></i> Enregistrer </button></div> </div>
                <div class="card-body">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-12">
                      <!-- Affichage de la notification -->
                      <div id="result">
                        
                      </div>
                      </div>
              
                      <div class="col-md-12">
                      <label for=""><b> Titre Article</b></label>
                      <input type="hidden" id="id" name="id" class="form-control" placeholder="Id Admin" value="<?php echo $id ?>"  autocomplete="off"><br>
                      <input type="text" id="titre" name="titre" class="form-control" placeholder="Ex : Comment Activer Office 2019"  autocomplete="off"><br>
                      </div>
                      <div class="col-md-12">
                      <label for=""><b> Sous-Titre</b></label>
                        <input type="text" id="detail" name="detail" class="form-control" placeholder="Ex : Nous allons voir ensemble comment activer Office 2019 si il a expiré"  autocomplete="off"><br>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                            <label for=""><b> Description Article</b></label>
                            <textarea class="form-control product_description" id="description" name="description" rows="8" cols="80" requried ></textarea>
                        </div><br>
                        
                      </div>
                      <div class="col-md-8">
                      <input type="file"  name="file" class="" onchange="previewFile(this);"  id="file" multiple="" ><br>
                      </div>
                      <div class="col-md-4">
                        <div class='preview float-right'>
                            <img src="" id="previewImg" width="100%" height="">
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-12 mt-2">
            <!-- Affichage des données de la base de donnée -->
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-table"></i>
                Liste des articles publiés <div class="float-right">     
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Titre</th>
                      <th>Sous Titre</th>
                      <th>Date Publication</th>
                      <th>Image</th>
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

      <!-- Sticky Footer -->
      <?php include('include/footer.php'); ?>

      <script>
        
        //Fonction pour afficher les catégories
        function getBlog(){
          $.ajax({
            url : "listBlog.php",
            type : "post",
            success : function(data){
              $("#data_list").html(data);
            }
          });
        }

        $("#previewImg").hide();

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

        //Appel fonction qui affiche les témoignages seléctionnés
        getBlog();

        //Enregistrement des données de la table témoignage
         $(document).on("click","#add_article", function(e){
          e.preventDefault();

          var id = $("#id").val();
          var titre = $("#titre").val();
          var detail = $("#detail").val();
          var description = $("#description").val();
          
          var fd = new FormData();
          var files = $('#file')[0].files;

          var add_temoignage = $("#add_article").val();

          fd.append('file',files[0]);
          fd.append('id',id);
          fd.append('titre',titre);
          fd.append('detail',detail);
          fd.append('description',description);
        
          $.ajax({
            url: 'add_article.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
              $("#result").html(response);
              $("#img").attr("src",response); 
              $("#form")[0].reset();
              $("#previewImg").hide();
              getBlog();
            },
          });    
        });

         //Suppression du témoignage
         $(document).on("click","#deleteBtn", function(e){
          e.preventDefault();

          if(window.confirm("Voulez-vous supprimer ce témoignage ?")){
            var id = $(this).attr("value");

            $.ajax({
              url:'delete_blog.php',
              type:'post',
              data:{
                id:id,
              },
              success : function(data){
                getBlog();
                $("#result").html(data);
              }
            });

          }
         });
      </script>

<!-- bootstrap-wysiwyg -->
<script src="js/editor/jquery-te-1.4.0.min.js" type="text/javascript"></script>   
  <!-- https://jqueryte.com/ -->
  <script>
    $('.product_description').jqte({
      link: true,
      unlink: false,
      color: false,
      source: false,
    });
  </script>