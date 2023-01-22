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
        include '../fonction/requeteClient.php';
        include '../fonction/requeteCaisse.php';
        include '../fonction/requeteJournal.php';
        if (isset($_POST['enregistrer'])) {
        $cmd=dernierCommande();
            $idcmd;
            foreach ($cmd as $value) {
            $idcmd=$value['idcmd'];
        }
        insererCaisse("Avance pour la commande ".$idcmd, "Entrée", $_POST['avance'], $_SESSION['idu']);
        finaliseCmd($_POST['montant'], $_POST['avance'], $_POST['nbreArticle'], $idcmd);
        journal("Commande numero ".$idcmd, $_SESSION['idu']);
       
        header('location:depot.php?cat=Toutes-les-Commandes');
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Fin Commande</title>
    </head>
    <body>
     
        <?php
        include './head.php';
        ?>      
                    
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-header">
                <h2 class=""> Commande</h2> 
            </div>
            <div class="card-body p-0">
                <form class="user" action="finCommande.php" method="post">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Info sur la Commande</h1>
                </div>
                
                <div class="form-group" style="margin: 31px">Montant Total
                    <input type="text" name="montant" class="form-control" 
                           value="<?php 
                           $cmd=dernierCommande();
                           $idcmd;
                           foreach ($cmd as $value) {
                               $idcmd=$value['idcmd'];
                           }
                           $prix=prixTotalCommande($idcmd);
                           echo ''.$prix; 
                           
                           ?>" readonly="">
                 </div>
                <div class="form-group" style="margin: 31px">Nombre d'article
                    <input type="text" name="nbreArticle" class="form-control" 
                           value="<?php 
                           $cmd=dernierCommande();
                           $idcmd;
                           foreach ($cmd as $value) {
                               $idcmd=$value['idcmd'];
                           }
                           $nbre= nbreArticleCommande($idcmd);
                           echo ''.$nbre; 
                           
                           ?>" readonly="">
                 </div>
                 <div class="form-group" style="margin: 31px">Avance
                    <input type="text" name="avance" class="form-control" >
                 </div>
                
                <div class="form-group">
                     <center><input type="submit" class="btn btn-outline-primary btn-user " name="enregistrer" value="Enregistrer la Commande -->"> </center>
                </div>
            </form>
            </div>
        </div>
        <script >
            var menu=document.getElementById('menuCmd');
            menu.setAttribute("class","nav-item active");
        </script>
        <?php
        include './foot.php';
        ?>
    </body>
</html>
