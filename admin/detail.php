<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<?php
    include '../connect/connect.php';
    include '../fonction/requeteClient.php';
    if(isset($_GET['cmd'])){
        $req=$bdd->query('select * from commande where idcmd='.$_GET['cmd']);
        foreach ($req as $value) { 
            $client=$bdd->query('select * from client where idc='.$value['idc']);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Commande numero <?php echo ''.$_GET['cmd']; ?></title>
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="../theme/sb-admin-2.min.css"/>
    </head>
    <body>
        <div class="header-area">
            <center><h3 class="header-title btn-primary" >Detail de la Commande</h3></center>
        </div>
        <div class="row">
        <div style="float: left; margin-left: 36px;margin-right: 46px;margin-bottom: 35px" class="card-body card border-left-primary ">
            <center>
                <h2 class="header-title" >SUMAR</h2>
                <h2 class="header-title" >CREATION</h2>
                <h2 class="header-title" >COUTURE</h2>
            </center>
        </div>
        <div style="float: right; margin-right: 16%;margin-bottom: 35px" class="card-body card border-left-primary">
            <?php foreach ($client as $v) {
                
              ?>
            <center>
                <h3 class="header-title btn-primary" >Client</h3>
                <h4 class="text-center">Nom  : <?php echo ''.$v['nom']; ?></h4><br>
                <h4 class="text-center">Contact : <?php echo ''.$v['contact']; ?></h4>
            </center>
            <?php 
                
            }  ?>
        </div> 
       </div>
        <?php 
            $article=$bdd->query('select * from article where idcmd='.$_GET['cmd']);
            foreach ($article as $va) {
                $modele=$bdd->query('select * from modele where idm='.$va['idm']);
                foreach ($modele as $v) {
                echo '<div style="margin-bottom: 41px;" class="row bg-white shadow">
                        <div class="card-body card border-left-primary col-4" >
                            <img src="../modele/'.$v['modele'].'" alt="alt" height="241px"/>
                            <h4 class="footer-area">'.$v['nomModele'].'</h4>
                        </div>
                        <div class="col-8">
                            <div class="row" style="margin: 31px">
                    
                                <div class="col">
                                    <div class="form-group" >Materiel
                                        <p>'.$va['materiel'].'</p>
                                    </div>
                                    <div class="form-group" >Description
                                        <p>'.$va['description'].'</p>
                                    </div>
                                    <div class="form-group" >Prix
                                        <p>'.$va['montant'].'</p>
                                    </div>
                                    <div class="form-group" >Tour de Coup
                                        <p>'.$va['tCoup'].'</p>
                                    </div>
                                    <div class="form-group" >Largeur Epaule
                                        <p>'.$va['lgEpaule'].'</p>
                                    </div>
                                    <div class="form-group" >Longueur Bras
                                        <p>'.$va['loBras'].'</p>
                                    </div>
                                </div>
                    
                                <div class="col">
                                    <div class="form-group" >Tour de poignet
                                        <p>'.$va['tPoignet'].'</p>
                                    </div>
                                    <div class="form-group" >Torse
                                        <p>'.$va['torse'].'</p>
                                    </div>
                                    <div class="form-group" >Hauteur
                                        <p>'.$va['hauteur'].'</p>
                                    </div>
                                    <div class="form-group" >Longueur Jambe
                                        <p>'.$va['loJambe'].'</p>
                                    </div>
                                    <div class="form-group" >Tour de Cuisse
                                        <p>'.$va['tCuisse'].'</p>
                                    </div>
                                    <div class="form-group" >Tour de Pied
                                        <p>'.$va['tPied'].'</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                }
            }
        ?>
 
        <?php
            }
    }
        ?>
    </body>
</html>
