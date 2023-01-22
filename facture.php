<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<?php
    include './connect/connect.php';
    include './fonction/requeteClient.php';
    if(isset($_GET['cmd'])){
        $req=$bdd->query('select * from commande where idcmd='.$_GET['cmd']);
        foreach ($req as $value) { 
            $client=$bdd->query('select * from client where idc='.$value['idc']);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>facture numero <?php echo ''.$_GET['cmd']; ?></title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="theme/sb-admin-2.min.css"/>
    </head>
    <body onload="window.print()">
        <div class="header-area" style="height: 21px;margin-bottom: 21px">
            <h3 class="header-title btn-primary" >Facture</h3>
        </div><br><br><br>
        <div style="float: left; margin-left: 36px;" class="card-body card ">
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
                <h3 class="bold" >Facturé a:</h3>
                <h5 class="text-center">Nom  : <?php echo ''.$v['nom']; ?></h5>
                <h5 class="text-center">Contact : <?php echo ''.$v['contact']; ?></h5>
            </center>
            <?php 
                
            }  ?>
        </div><br><br><br>
        <div>
            <table class="table table-primary" width="100%" >
                <thead  style="font-size: 35px;">
                    <tr>
                        <th>Numero </th>
                        <th>Tissu</th>
                        <th>Description </th>
                        <th>Prix Article</th>
                    </tr>
                </thead>
                <tbody class=" text-center" style="font-size: 25px;">
                    <?php 
                        $article=$bdd->query('select * from article where idcmd='.$_GET['cmd']);
                        foreach ($article as $va) {
                            echo '<tr>';
                            echo '<td>'.$va['ida'].'</td>';
                            echo '<td>'.$va['materiel'].'</td>';
                            echo '<td>'.$va['description'].'</td>';
                            echo '<td>'.$va['montant'].'</td>';
                            echo '</tr>';
                        }
                     ?>
                    
                        
                </tbody>
            </table>
        </div><br><br><br>
        <div style="float: right; margin-right: 16%;margin-bottom: 35px" class="card-body card border-left-primary">
            <center>
                <h4 class="text-center">Nombre Article  : <?php echo ''.$value['nbreArticle']; ?></h4>
                <h4 class="text-center">Prix Total :<?php echo ''.$value['montant']; ?></h4>
                <h4 class="text-center">Avance : <?php echo ''.$value['avance']; ?></h4>
                <h4 class="text-center">Reste : <?php echo ''.$value['reste']; ?></h4>
            </center>
        </div>  
        <?php
            }
    }
        ?>
    </body>
</html>
