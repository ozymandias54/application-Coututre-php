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
     include '../fonction/requeteJournal.php';
     if(isset($_POST['enregistrer'])){
         $genre;
         if($_POST['genre']=='Homme'){ $genre='Homme';}
         else {$genre='Femme';}
         $req=$bdd->prepare('insert into employe (CIN,nom,prenom,salaire,dateNaissance,dateEmbauche,poste,genre,telephone) values (?,?,?,?,?,?,?,?,?)');
         $req->bindvalue(1,$_POST['CIN']);
         $req->bindvalue(2,$_POST['nom']);
         $req->bindvalue(3,$_POST['prenom']);
         $req->bindvalue(4,$_POST['salaire']);
         $req->bindvalue(5,$_POST['dateNaissance']);
         $req->bindvalue(6,date("Y-m-d H:i:s"));
         $req->bindvalue(7,$_POST['poste']);
         $req->bindvalue(8,$genre);
         $req->bindvalue(9,$_POST['telephone']);
         $req->execute();
         journal("Enregistrer l'employé ".$_POST['nom'].' '.$_POST['prenom'],  $_SESSION['idu']);
         header('location:listeEmploye.php');
     }
 ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Nouvelle Employé</title>
    </head>
    <body>
        <?php
        include './head.php';
        ?>
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                       <div class="row">
                            <div class="col-lg-6 d-none d-lg-block " style="background-image:url(../icon/couture.jpeg);"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Nouvelle Employé</h1>
                                    </div>
                                    <form class="user" action="employe.php" method="post">
                                        <div class="form-group">CIN
                                            <input type="text" class="form-control "
                                                   name="CIN" required="">
                                        </div>
                                        <div class="form-group">Nom
                                            <input type="text" class="form-control "
                                              name="nom"  required="">
                                        </div>
                                       <div class="form-group">Prenom
                                            <input type="text" class="form-control "
                                               name="prenom" required="">
                                        </div>
                                        <div class="form-group">Salaire
                                            <input type="text" class="form-control "
                                              name="salaire" required="">
                                        </div>
                                        <div class="form-group">Date de naissance
                                            <input type="date" class="form-control "
                                              name="dateNaissance" required="">
                                        </div>
                                        <div class="form-group">Poste
                                            <input type="text" class="form-control "
                                             name="poste" required="">
                                        </div>
                                        <div class="form-group">Genre<br>
                                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                <input type="radio" class="btn-check" value="Homme" name="genre" id="btnradio1" autocomplete="off" checked>
                                               <label class="btn btn-outline-primary" for="btnradio1">Homme</label>

                                               <input type="radio" class="btn-check" value="Femme" name="genre" id="btnradio2" autocomplete="off">
                                               <label class="btn btn-outline-primary" for="btnradio2">Femme</label>
                                            </div>
                                        </div>
                                        <div class="form-group">Telephone
                                            <input type="text" class="form-control"
                                             name="telephone" required="">
                                        </div>
                                        <input type="submit" name="enregistrer" class="btn btn-primary btn-user btn-block" value="Enregistrer">
                                        <hr>
                                      
                                    </form>
                                  
                                    <div class="text-center">
                                        <a class="small" href="#">
                                            Liste des Employés
                                         </a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        <script >
            var liste=document.getElementById('collapseUtilities');
            var menu=document.getElementById('menuE');
            var fleche=document.getElementById('flecheE');
            liste.setAttribute("class","collapse show");
            menu.setAttribute("class","nav-item active");
            fleche.setAttribute("class","nav-link");
            
        </script>
        <?php
        include './foot.php';
        ?>
    </body>
</html>
