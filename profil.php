<?php
session_start();
include './connect/connect.php';
include './fonction/requeteJournal.php';
 if(isset($_POST['envoyer'])){
     $_SESSION['idu']=$_POST['idu'];
            $libelle="connexion";
            insererJournal($libelle, $_POST['idu']);
            header('location:admin/index.php');
 }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Profil</title>
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link href="theme/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="theme/sb-admin-2.min.css" rel="stylesheet">

</head>

<body >
  <div id="preloader">
        <div class="loader"></div>
    </div>
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block " style="background-image:url(icon/profil.png); background-repeat: no-repeat;background-size: 100%"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="row">
                                        <?php
                                        $req=$bdd->query('select * from employe where ide='.$_GET['ide']);
                                        $emp=$req->fetch();
                                        echo 'MR '.$emp['nom'].' '.$emp['prenom'].' Veillez a ne plus oublier votre mot de passe';
                                        ?>
                                    </div>
                                    <br>
                                    
                                    <div class="row">
                                        <h4>Profil</h4>
                                    </div>
                                        <hr>
                                    <div>
                                        <?php
                                        $r=$bdd->query('select * from utilisateur where ide='.$emp['ide']);
                                        $ut=$r->fetch();
                                        ?>
                                        Login :<?php echo ''.$ut['login']; ?><br>
                                       Password: <?php echo ''.$ut['password']; ?><br>
                                       Profil : <?php echo ''.$ut['profil']; ?> <br>
                                    </div>
                                        <hr>
                                        <form class="user" action="profil.php"method="post">
                                            <input type="hidden" name="idu" value="<?php echo ''.$ut['idu']; ?> ">
                                            <input type="hidden" name="profil" value="<?php echo ''.$ut['profil']; ?> ">
                                            <input type="submit" name="envoyer" class="btn btn-primary btn-user btn-block" value="Acceder a l'appli ici">
                                        </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="theme/jquery.min.js"></script>
    <script src="theme/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="theme/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="theme/sb-admin-2.min.js"></script>
<script src="assets/js/scripts.js"></script>
</body>

</html>