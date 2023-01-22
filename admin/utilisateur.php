<?php
session_start();
if(empty($_SESSION['idu'])){
    header('location:../index.php');
}
?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
 <?php
     include '../connect/connect.php';
     include '../fonction/requeteUtilisateur.php';
     include '../fonction/requeteJournal.php';
     if(isset($_POST['enregistrer'])){
        inserer($_POST['login'], $_POST['password'], $_POST['profil'],$_POST['employe']);
        journal("Enregistrer l'utilisateur ".$_POST['login'], $_SESSION['idu']);
         header('location:listeUtilisateur.php');
     }
 ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Nouvelle Utilisateur</title>
    </head>
    <body>
        <?php
        include './head.php';
        ?>
        <div class="card o-hidden border-0 shadow-lg ">
            <div class="card-body p-0">
                       <div class="row">
                            <div class="col-lg-6 d-none d-lg-block " style="background-image:url(../icon/couture.jpeg);"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Nouvelle Utilisateur</h1>
                                    </div>
                                    <form class="user" action="utilisateur.php" method="post">
                                        <div class="form-group">Login
                                            <input type="text" class="form-control "
                                                   name="login" required="">
                                        </div>
                                        <div class="form-group">Mot de passe
                                            <input type="text" class="form-control "
                                               name="password" required="">
                                        </div>
                                        <div class="form-group">Profil
                                            <select name="profil" class="form-control form-select" aria-label=".form-select-lg example">
                                                <option selected>Administateur</option>
                                                <option >Couturie</option>
                                                <option >Secretaire</option>
                                            </select>
                                        </div>
                                       <div class="form-group">Employé
                                           <select name="employe" class="form-select form-control" aria-label=".form-select-lg example">
                                                <?php
                                                $req=$bdd->query('select ide,nom,prenom from employe');
                                                foreach ($req as $value) {
                                                    echo '<option value="'.$value['ide'].'">'.$value['nom'].' '.$value['prenom'].'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        
                                        <input type="submit" name="enregistrer" class="btn btn-primary btn-user btn-block" value="Enregistrer">
                                        <hr>
                                      
                                    </form>
                                  
                                    <div class="text-center">
                                        <a class="small" href="listeUtilisateur.php">
                                            Liste des Utilisateurs
                                         </a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        <script >
            var liste=document.getElementById('collapseTwo');
            var menu=document.getElementById('menuU');
            var fleche=document.getElementById('flecheU');
            liste.setAttribute("class","collapse show");
            menu.setAttribute("class","nav-item active");
            fleche.setAttribute("class","nav-link");
            
        </script>
        <?php
        include './foot.php';
        ?>
    </body>
</html>
