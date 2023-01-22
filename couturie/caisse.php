<?php
session_start();
if(empty($_SESSION['idu'])){
    header('location:../index.php');
}
include '../connect/connect.php';
?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->

<html>
    <head>
        <meta charset="UTF-8">
        <title>Caisse</title>
        
    </head>
    <body>
        <?php
        include './head.php';
        include '../connect/connect.php';
        include '../fonction/requeteCaisse.php';
        include '../fonction/requeteJournal.php';
        if(isset($_POST['enregistrer'])){
            journal('Type:'.$_POST['type']." ; ".$_POST['libelle'].'; montant:'.$_POST['montant'],  $_SESSION['idu']);
            insererCaisse($_POST['libelle'], $_POST['type'],$_POST['montant'],$_SESSION['idu']);
        }
        if(isset($_POST['modifier'])){
            journal('Modification d\'un depense de '.$_POST['montant'],  $_SESSION['idu']);
            modifierCaisse($_POST['libelle'], $_POST['type'],$_POST['montant'],$_POST['idCaisse']);
        }
        if(isset($_GET['index'])){
            journal("Suppression d'un depense ",  $_SESSION['idu']);
            supprimerCaisse($_GET['index']);  
         
     }
        ?>
        <h1 class="h3 mb-2 text-gray-800">Gestion de la caisse</h1>
        <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Bénéfice</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">F CFA <?php echo ''. benefice(); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-money-check fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                      </div>
         </div>
        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Les Entrées</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">F CFA <?php echo ''. entrée(); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                      </div>
         </div>
            
        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Les Sorties</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">F CFA <?php echo ''. sortie(); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300" ></i>
                                        </div>
                                    </div>
                                </div>
                      </div>
         </div>
         <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                Benefice du jour</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">F CFA <?php echo ''. beneficeJour(date("Y-m-d")); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-coins fa-2x text-gray-300" ></i>
                                        </div>
                                    </div>
                                </div>
                      </div>
         </div>
        
        </div>
   
         <div class="card shadow mb-4">
                        <div class="card-header">
                            <div class=" row">
                            <h6 class="col-sm-8 font-weight-bold text-primary">Liste des depenses</h6>
                            <button type="button" class="btn btn-primary col-sm-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="">Ajouter</button>
                            </div>
                        </div>


                        <div class="card-body">
                             <div class="data-tables">
                                    <table id="dataTable" class="text-center">
                                    <thead class="bg-light text-capitalize">
                                        <tr>
                                            <th>Libelle</th>
                                            <th>Type</th>
                                            <th>Montant</th>
                                            <th>Date Operation</th>
                                            <th>Utilisateur</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php
                                        $req=$bdd->query('select * from caisse');
                                        $cpt=1;
                                        foreach ($req as $value) {
                                            $cpt=$cpt+1;
                                            $r=$bdd->query('select nom,prenom from employe where ide=(select ide from utilisateur where idu='.$value['idu'].')');
                                            $ligne=$r->fetch();
                                            $ut=$ligne['nom'].' '.$ligne['prenom'];
                                            echo '<tr>';
                                            echo '<td>'.$value['libelle'].'</td>';
                                            echo '<td>'.$value['type'].'</td>'; 
                                            echo '<td>'.$value['montant'].'</td>'; 
                                            echo '<td>'.$value['date'].'</td>'; 
                                            echo '<td>'.$ut.'</td>'; 
                                            echo '<td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="apparaitre('.$value['idCaisse'].',\''.$value['libelle'].'\',\''.$value['type'].'\','.$value['montant'].')">Modifier</button>'
                                            . ' <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#supp'.$cpt.'">Supprimer</button></td>';
                                            echo '<div class="modal fade" id="supp'.$cpt.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="text-center">
                                                            <i class="fa fa-warning" style="font-size: 45px;margin-top: 21px;"></i>  
                                                            <h3>Supprimer cette depense?</h3>
                                                            <p>Cet action est irréversible.</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light " data-bs-dismiss="modal">Annuler</button>
                                                            <a href="caisse.php?index='.$value['idCaisse'].'"><button type="button" class="btn btn-danger" style="margin-right: 32%;">Supprimer</button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                   </div>';
                                            echo '</tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
        
        <script >
            var menu=document.getElementById('menuCaisse');
            menu.setAttribute("class","nav-item active");
            function apparaitre(idCaisse,libelle,type,montant){
             document.getElementById("idCaisse").value=""+idCaisse;
             document.getElementById("libelle").value=""+libelle;
            document.getElementById("montant").value=""+montant;
            if (type=='Entrée') {
              document.getElementById("entrée").selected=true;
            } else {
               document.getElementById("sortie").selected=true;
            }
            }
        </script> 
        <?php
        include './foot.php';
        ?>
        <!--***************** Modal pour ajouter**************************************** -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Inserer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="user" action="caisse.php" method="post">
                        <div class="form-group">Libelle
                            <input type="text" class="form-control "
                             name="libelle" required="">
                        </div>
                        <div class="form-group">Type
                            <select name="type" class="form-control ">
                                <option >Entrée</option>
                                <option >Sortie</option>
                            </select>
                        </div>
                        <div class="form-group">Montant
                            <input type="text" class="form-control "
                             name="montant" required="">
                        </div>             
                        <div class="modal-footer">    
                            <input type="submit" name="enregistrer" class="btn btn-primary btn-user btn-block" value="Enregistrer">
                            <hr>
                        </div>  
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- Modal pour modification -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="user" action="caisse.php" method="post">
                        <input type="hidden" id="idCaisse" name="idCaisse">
                        <div class="form-group">Libelle
                            <input type="text" class="form-control "
                            name="libelle" id="libelle" required="">
                        </div>
                        <div class="form-group">Type
                            <select name="type" class="form-control ">
                                <option id="entrée">Entrée</option>
                                <option id="sortie">Sortie</option>
                            </select>
                        </div>
                        <div class="form-group">Montant
                            <input type="text" class="form-control "
                                   name="montant" id="montant" required="">
                        </div>              
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <input type="submit" name="modifier" class="btn btn-primary " value="Enregistrer">
                        </div>  
                    </form>
                </div>
            </div>
        </div>
    </div>

    </body>
</html>
