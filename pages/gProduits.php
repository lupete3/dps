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
          <li class="breadcrumb-item active">Ajouter un Produit</li>
        </ol>
        <form action="" method="POST" id="form" enctype="multipart/form-data">
        <div class=" col-md-12 text-right" style="margin-bottom: 5px;">
          <button type="submit" id="add_produit" name="save" class="btn btn-sm btn-success "><i class="fa fa-check-circle"></i> Enregistrer </button>
          <a href="listProduits.php" title=""><button type="button" class="btn btn-sm btn-secondary "><i class="fa fa-list"></i> Liste des produits</button></a>
        </div>
        <!-- DataTables Example -->
       <div class="card  mt-8">
      <div class="card-header text-uppercase">Ajouter un Article</div>
      <div class="card-body">
        
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                 <!-- Affichage de la notification -->
                 <?php if (isset($_GET['error'])) {
                   echo '
                    <div class="alert alert-danger alert-dismissible" id="msg" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h6>Completer tous les champs</h6>
                    </div> ';
                 } ?>
                 <div id="result">
                   
                 </div>
              </div>
              
              <div class="col-md-4">
                <input type="text" id="designation" name="designation" class="form-control" placeholder="Designation du produit"   autocomplete="off"><br>
                <input type="text" id="prix" name="prix" class="form-control" placeholder="Prix du Produit"   autocomplete="off"><br>
                <input type="number" id="qte" name="qte" class="form-control" placeholder="Quantité disponible"   autocomplete="off"><br>
                <select name="categorie" id="categorie" class="form-control">
                  <option value="" selected="">Choisir une catégorie</option>
                  <?php 
                    if (!empty($list_category)) {
                      foreach($list_category as $row){
                    ?>
                  <option value="<?php echo $row['id']?>"><?php echo $row['libelle']?></option>
                  <?php }} ?>
                </select><br>
                <select name="disponible" id="disponible" required="" class="form-control">
                  <option value="" selected="" disabled="">Prêt pour la vente </option>
                  <option value="Oui" selected="">Oui</option>
                  <option value="Non" selected="">Non</option>
                </select><br>
                
              </div>
              
              <div class="col-md-8">
                <div class="form-group">
                    <label for=""><b> Description Produit</b></label>
                    <textarea class="form-control product_description" id="detail" name="detail" rows="8" cols="80" requried ></textarea>
                </div>
                <input type="file"  name="file" class="" onchange="previewFile(this);"  id="file" multiple="" ><br>
                <div class='preview'>
                  <img src="" id="previewImg" width="100" height="100">
                </div>
              </div>
              <div class="col-md-12">
                
              </div>
            </div>
          </div>
        </form>
        
      </div>
    </div>

      </div>
      <div class="spacer">
      </div>

      <!-- Sticky Footer -->
      <?php include('include/footer.php'); ?>

      <script>
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

        $(document).on("click","#add_produit", function(e){
          e.preventDefault();

          var designation = $("#designation").val();
          var prix = $("#prix").val();
          var qte = $("#qte").val();
          var categorie = $("#categorie").val();
          var disponible = $("#disponible").val();
          var detail = $("#detail").val();

          var fd = new FormData();
          var files = $('#file')[0].files;

          var add_produit = $("#add_produit").val();

          fd.append('file',files[0]);
          fd.append('designation',designation);
          fd.append('prix',prix);
          fd.append('qte',qte);
          fd.append('categorie',categorie);
          fd.append('disponible',disponible);
          fd.append('detail',detail);
        
          $.ajax({
            url: 'add_product.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
              $("#result").html(response);
              $("#img").attr("src",response); 
              $("#form")[0].reset();
              $("#previewImg").hide();
            },
          });     
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
