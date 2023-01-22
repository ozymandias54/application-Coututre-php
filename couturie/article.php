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
    include '../fonction/requeteCommande.php';
    include '../fonction/requeteArticle.php';
    include '../fonction/requeteModele.php';
    if(isset($_POST['enregistrer'])){
        $cmd= dernierCommande();
        $idcmd;
        foreach ($cmd as $value) {
            $idcmd=$value['idcmd'];
        }
       
        insererArt($_POST['materiel'], $_POST['description'], $_POST['montant'], $_POST['tCoup'], $_POST['lgEpaule'], $_POST['loBras'], $_POST['tPoignet'], $_POST['torse'], $_POST['hauteur'], $_POST['loJambe'], $_POST['tCuisse'], $_POST['tPied'], $idcmd,$_POST['modele']);
        header('location:finCommande.php?idcmd='.$idcmd);
    }
    if(isset($_POST['ajouter'])){
        $cmd= dernierCommande();
        $idcmd;
        foreach ($cmd as $value) {
            $idcmd=$value['idcmd'];
        }
        
        insererArt($_POST['materiel'], $_POST['description'], $_POST['montant'], $_POST['tCoup'], $_POST['lgEpaule'], $_POST['loBras'], $_POST['tPoignet'], $_POST['torse'], $_POST['hauteur'], $_POST['loJambe'], $_POST['tCuisse'], $_POST['tPied'], $idcmd,$_POST['modele']);
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title >Enregistrement des Articles</title>
    </head>
    <body>
        <?php
        include './head.php';
        ?>
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-header">
                <h2 class="">Ajouter les articles</h2> 
            </div>
            <div class="card-body p-0">
                <form class="user" action="article.php" method="post">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Detail de article</h1>
                </div>
                
                <div class="form-group" style="margin: 31px">Materiel
                    <input type="text" name="materiel" class="form-control" required="">
                </div>
                <div class="form-group" style="margin: 31px">Description
                    <textarea  name="description" class="form-control" required="" cols="10"></textarea>
                </div>
                <div class="form-group " style="margin: 31px">
                    <input id="modele" type="hidden" name="modele" value="1">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Ajouter un modele
                    </button> 
                    <img id="image" src="../modele/pasdemodele.jpg" alt="alt" width="251px"/>
                </div>
                <div class="row" style="margin: 31px">
                    
                    <div class="col">
                        <div class="form-group" >Prix
                            <input type="text" name="montant" class="form-control" required="" >
                        </div>
                        <div class="form-group" >Tour de Coup
                            <input type="number" name="tCoup" class="form-control" value="0">
                        </div>
                        <div class="form-group" >Largeur Epaule
                            <input type="number" name="lgEpaule" class="form-control" value="0">
                        </div>
                        <div class="form-group" >Longueur Bras
                            <input type="number" name="loBras" class="form-control" value="0">
                        </div>
                        <div class="form-group" >Tour de poignet
                            <input type="number" name="tPoignet" class="form-control" value="0">
                        </div>
                        
                    </div>
                    
                    <div class="col">
                        <div class="form-group" >Torse
                            <input type="number" name="torse" class="form-control" value="0">
                        </div>
                        <div class="form-group" >Hauteur
                            <input type="number" name="hauteur" class="form-control" value="0">
                        </div>
                        <div class="form-group" >Longueur Jambe
                            <input type="number" name="loJambe" class="form-control" value="0">
                        </div>
                        <div class="form-group" >Tour de Cuisse
                            <input type="number" name="tCuisse" class="form-control" value="0">
                        </div>
                        <div class="form-group" >Tour de Pied
                            <input type="number" name="tPied" class="form-control" value="0">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                     <center>
                        <input type="submit" class="btn btn-outline-primary" name="ajouter" value="Ajouter un autre article">
                        <input type="submit" class="btn btn-outline-secondary" name="enregistrer" value="Enregistrer la Commande">
                     </center>
                </div>
                
            </form>
            </div>
        </div>
        <script >
            var menu=document.getElementById('menuCmd');
            menu.setAttribute("class","nav-item active");
            function modele(idm,nom){
                var m=document.getElementById('modele');
                m.value=""+idm;
                var img=document.getElementById('image');
                img.src="../modele/"+nom;
            }
        </script>
        
        
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                       <div class="row">
                        <?php
                        $list= listeModele();
                        foreach ($list as $value) {
                        echo '<img class="col-4" data-bs-dismiss="modal" src="../modele/'.$value['modele'].'" alt="'.$value['nomModele'].'" onclick="modele('.$value['idm'].',\''.$value['modele'].'\')"/>';
                        }
                         ?>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include './foot.php';
        ?>
    </body>
</html>
