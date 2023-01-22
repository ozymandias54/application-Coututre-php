<?php
session_start();
if(empty($_SESSION['idu'])){
    header('location:../index.php');
}
include '../connect/connect.php';
include '../fonction/requeteJournal.php';
?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Jornal Activité</title>
    </head>
    <body>
        <?php
         include './head.php';
        ?>
        <div class="header-title">
            <h4 class="text-secondary text-center">Journal des Activités de Mon Application </h4>
        </div>
        
                        <div class="card-header">
                          <div class="row">
                            <h6 class="col-sm-8 font-weight-bold text-primary">
                                 Liste des Activités
                            </h6>
                            
                          </div>
                        </div>
        
        <table width='100%' class="text-center shadow" id="dataTable">
            <thead class="btn-primary">
                <tr>
                    <th>Date</th>
                    <th>Utilisateur</th>
                    <th>Operation Effectué</th>
                </tr>
            </thead>
            <tbody>
               <?php
                    $list= listeJournal();
                    foreach ($list as $value) {
                    echo '<tr>';
                    echo '<td>'.$value['dateOperation'].'</td>';
                    $r=$bdd->query('select nom,prenom from employe where ide=(select ide from utilisateur where idu='.$value['idu'].')');
                    $ligne=$r->fetch();
                    echo '<td>'.$ligne['nom'].' '.$ligne['prenom'].'</td>'; 
                    echo '<td>'.$value['libelle'].'</td>'; 
                    echo '</tr>';
                                        }
                                        ?>
            </tbody>
        </table>

        <?php
         include './foot.php';
        ?>
    </body>
</html>
