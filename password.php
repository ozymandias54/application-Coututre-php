
<?php
include './connect/connect.php';
 if(isset($_POST['envoyer'])){
     $r=$bdd->query('select * from utilisateur where login=\''.$_POST['login'].'\'');
     if($ligne=$r->fetch()){
       $req=$bdd->query('select * from employe where ide='.$ligne['ide']);
       $emp=$req->fetch();
       if($_POST['CIN']==$emp['CIN']&&$_POST['nom']==$emp['nom']&&$_POST['prenom']==$emp['prenom']&&$_POST['telephone']==$emp['telephone']){
           header('Location:profil.php?ide='.$emp['ide']);
       }
 else {
         $_POST['incorrect']='incorrect';
       }
    }
    else {
        $_POST['incorrect']='incorrect';
    }
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
    <title>Mot de passe oublié</title>
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
                            <div class="col-lg-6 d-none d-lg-block " style="background-image:url(icon/password.png); background-repeat: no-repeat;background-size: 100%"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Mot de passe oublié</h1>
                                    </div>
                                    <form class="user" action="password.php" method="post">
                                        <input type="hidden" name="incorrect">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Login" name="login" required="" 
                                                value="<?php if(isset($_POST['incorrect'])){    echo ''.$_POST['login'];  } ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                   id="" placeholder="CIN" name="CIN" required=""
                                                   value="<?php if(isset($_POST['incorrect'])){    echo ''.$_POST['CIN'];  } ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                   id="" placeholder="Nom" name="nom" required=""
                                                   value="<?php if(isset($_POST['incorrect'])){    echo ''.$_POST['nom'];  } ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                   id="" placeholder="Prenom" name="prenom" required=""
                                                   value="<?php if(isset($_POST['incorrect'])){    echo ''.$_POST['prenom'];  } ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                   id="" placeholder="Telephone" name="telephone" required=""
                                                  value="<?php if(isset($_POST['incorrect'])){    echo ''.$_POST['prenom'];  } ?>" >
                                        </div>
                                        <?php
                                        if(isset($_POST['incorrect'])){
                                            echo ' <div class="alert alert-danger" role="alert">
                                            Nous n\'avons pas de compte qui correspond.
                                        </div>';
                                        }
                                        ?>
                                        <input type="submit" name="envoyer" class="btn btn-primary btn-user btn-block" value="Envoyer">
                                        <hr>
                                        
                                    </form>
                                    <div class="text-center">
                                        <a class="small" href="index.php">Page de connexion</a>
                                    </div>                                    
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