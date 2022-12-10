<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Inscription</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link href="pages/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="pages/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="pages/css/sb-admin.css" rel="stylesheet">
<link rel="stylesheet" href="pages/vendor/editor/css/jquery-te-1.4.0.css">
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
		<div class='preloader'><div class='loaded'>&nbsp;</div></div>
        <!-- Sections -->
        

        

        <!--Home page style-->
        
        <div class="container">
            <div class="row">
                <div class="col-md-3">
            
                </div>
                <div class="col-md-6"  style="margin-top: 10px;">
                    <div id="result"></div>
                    <div class="card " >
                        <div class="card-header text-uppercase">INSCRIPTION</div>
                            <form action="" method="post" id="form" was-validate>
                                <div class="form-group col-md-12 mt-4">
                                  <input type="text" name="nomM" value="" id="nomM" class="form-control" placeholder="Nom Elève" required="required" >
                                </div>
                                <div class="form-group col-md-12">
                                  <input type="text" name="postnomM" value="" id="postnomM" class="form-control" placeholder="Postnom ELève" required="required" >
                                </div>
                                <div class="form-group col-md-12">
                                  <select class="form-control" id="sexeM" name="sexeM" required>
                                    <option value="" selected disabled>---Sexe---</option>
                                    <option value="M">M</option>
                                    <option value="F">F</option>
                                  </select>
                                </div>
                                <div class="form-group col-md-12">
                                  <input type="date" name="dateNaissanceM" value="<" id="dateNaissanceM" class="form-control" placeholder="Date Naissance" required="required" >
                                </div>
                                <div class="form-group col-md-12">
                                  <input type="text" name="lieuNaissanceM" value="" id="lieuNaissanceM" class="form-control" placeholder="Lieu Naissance" required="required" >
                                </div>
                                <div class="form-group col-md-12">
                                  <input type="text" name="adresseM" value="" id="adresseM" class="form-control" placeholder="Adresse" required="required" >
                                </div>
                                <div class="form-group col-md-12">
                                  <input type="text" name="telephoneM" value="" id="telephoneM" class="form-control" placeholder="Téléphone" required="required" >
                                </div>
                                <div class="form-group col-md-12">
                                  <input type="text" name="loginM" value="" id="loginM" class="form-control" placeholder="Login" required="required" >
                                </div>
                                <div class="form-group col-md-12">
                                  <input type="text" name="passwordM" value="" id="passwordM" class="form-control" placeholder="Mot de passe" required="required" >
                                </div>

                                  <div class="col-md-12 text-center">
                                    <button type="submit" name="add_eleve" id="add_eleve" class="btn btn-md btn-info "><i class="fa fa-check"></i> S'incrire </button>
                                  </div>
                                  <div class="col-md-12 text-center mt-2">
                                    <p><a href="./"><i class="fa fa-key"></i> Se Connecter</a></p>
                                  </div>
                            </form>
                    </div>
            </div>
        <script src="assets/js/vendor/jquery-1.11.2.min.js"></script>
        <script src="assets/js/vendor/bootstrap.min.js"></script>

        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/modernizr.js"></script>
        <script src="assets/js/main.js"></script>
        <script type="text/javascript">
            //Modification de la catégorie
         $(document).on("click","#add_eleve", function(e){
          e.preventDefault();

            let nomM = $("#nomM").val();
            let postnomM = $("#postnomM").val();
            let sexeM = $("#sexeM").val();
            let dateNaissanceM = $("#dateNaissanceM").val();
            let lieuNaissanceM = $("#lieuNaissanceM").val();
            let adresseM = $("#adresseM").val();
            let telephoneM = $("#telephoneM").val();
            let loginM = $("#loginM").val();
            let passwordM = $("#passwordM").val();

            let addEleve = "addEleve";
           
            $.ajax({
              url:'pages/actions_eleve.php',
              type : "post",
              data : {nomM:nomM,postnomM:postnomM,sexeM:sexeM,dateNaissanceM:dateNaissanceM,lieuNaissanceM:lieuNaissanceM,adresseM:adresseM,telephoneM:telephoneM,loginM:loginM,passwordM:passwordM,addEleve:addEleve},
              success : function(data){
                $("#result").html(data);
                $("#form")[0].reset();
              }

           });
         });
        </script>
    </body>

	
</html>
