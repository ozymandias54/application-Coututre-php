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
    include '../fonction/requeteEmploye.php';
    include '../fonction/requeteJournal.php';
    if(isset($_POST['enregistrer'])){
         modifier($_POST['CIN'], $_POST['nom'], $_POST['prenom'], $_POST['salaire'], $_POST['dateNaissance'], $_POST['dateEmbauche'], $_POST['poste'], $_POST['genre'], $_POST['telephone'], $_POST['ide']);
         journal("Modifier l'employé ".$_POST['nom'].' '.$_POST['prenom'], $_SESSION['idu']);
         header('location:listeEmploye.php');
     }
    if(isset($_GET['index'])){
        $req=$bdd->query('select nom,prenom from employe where ide='.$_GET['index']);
         
         $ligne=$req->fetch();
         journal("Supprimer l'employé ".$ligne['nom'].' '.$ligne['prenom'], $_SESSION['idu']);
         supprimer($_GET['index']);
         header('location:listeEmploye.php');
     }
 ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Liste des employés</title>
    </head>
    <body>
        <?php
        include './head.php';
        ?>
        <h1 class="h3 mb-2 text-gray-800">Gestion des Employés</h1>
        
         <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Liste des Employés</h6>
                        </div>
                        <div class="card-body">
                           <div class="data-tables">
                                    <table id="dataTable" class="text-center">
                                    <thead class="bg-light text-capitalize">
                                        <tr>
                                            <th>CIN</th>
                                            <th>Nom</th>
                                            <th>Prenom</th>
                                            <th>Salaire</th>
                                            <th>Date Naissance</th>
                                            <th>Embauche</th>
                                            <th>Poste</th>
                                            <th>Genre</th>
                                            <th>Telephone</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php
                                            $liste= liste();
                                            $cpt=1;
                                            foreach ($liste as $value) {
                                            $cpt=$cpt+1;
                                            echo '<tr>';
                                            echo '<td>'.$value['CIN'].'</td>'; 
                                            echo '<td>'.$value['nom'].'</td>';
                                            echo '<td>'.$value['prenom'].'</td>'; 
                                            echo '<td>'.$value['salaire'].'</td>'; 
                                            echo '<td>'.$value['dateNaissance'].'</td>'; 
                                            echo '<td>'.$value['dateEmbauche'].'</td>'; 
                                            echo '<td>'.$value['poste'].'</td>'; 
                                            echo '<td>'.$value['genre'].'</td>'; 
                                            echo '<td>'.$value['telephone'].'</td>'; 
                                            echo '<td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="apparaitre('.$value['ide'].',\''.$value['CIN'].'\',\''.$value['nom'].'\',\''.$value['prenom'].'\',\''.$value['salaire'].'\',\''.$value['dateNaissance'].'\',\''.$value['dateEmbauche'].'\',\''.$value['poste'].'\',\''.$value['genre'].'\',\''.$value['telephone'].'\')">Modifier</button> '
                                            . '<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#supp'.$cpt.'">Supprimer</button></td>'; 
                                            echo '<div class="modal fade" id="supp'.$cpt.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="text-center">
                                                            <i class="fa fa-warning" style="font-size: 45px;margin-top: 21px;"></i>  
                                                            <h3>Supprimer cet employé?</h3>
                                                            <p>Cet action est irréversible.</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light " data-bs-dismiss="modal">Annuler</button>
                                                            <a href="listeEmploye.php?index='.$value['ide'].'"><button type="button" class="btn btn-danger" style="margin-right: 32%;">Supprimer</button></a>
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
        
                     <!--***************** Modal pour modification**************************************** -->
                     
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modification</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                            <div class="modal-body">
                                                <form class="user" action="listeEmploye.php" method="post">
                                                    <input type="hidden" name="ide" id="ide">
                                                    <div class="form-group">CIN
                                                        <input type="text" class="form-control "
                                                         name="CIN" required="" value="" id="CIN">
                                                    </div>
                                                    <div class="form-group">Nom
                                                        <input type="text" class="form-control "
                                                        name="nom" required="" id="nom">
                                                    </div>
                                                    <div class="form-group">Prenom
                                                        <input type="text" class="form-control "
                                                        name="prenom" required="" id="prenom">
                                                    </div>
                                                    <div class="form-group">Salaire
                                                        <input type="text" class="form-control "
                                                        name="salaire" required="" id="salaire">
                                                    </div>
                                                    <div class="form-group">Date de Naissance
                                                        <input type="date" class="form-control "
                                                        name="dateNaissance" required="" id="dateNaissance">
                                                    </div>
                                                    <div class="form-group">Date d'embauche
                                                        <input type="date" class="form-control "
                                                        name="dateEmbauche" required="" id="dateEmbauche">
                                                    </div>
                                                    <div class="form-group">Poste
                                                        <input type="text" class="form-control "
                                                        name="poste" required="" id="poste">
                                                    </div>
                                                    <div class="form-group">Genre
                                                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                            <input type="radio" class="btn-check" value="Homme" name="genre" id="btnradio1" autocomplete="off" checked>
                                                            <label class="btn btn-outline-primary" for="btnradio1">Homme</label>

                                                            <input type="radio" class="btn-check" value="Femme" name="genre" id="btnradio2" autocomplete="off">
                                                            <label class="btn btn-outline-primary" for="btnradio2">Femme</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">Telephone
                                                        <input type="text" class="form-control "
                                                        name="telephone" required="" id="telephone">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                        <button type="submit" class="btn btn-primary" name="enregistrer">Enregistrer</button>
                                                    </div>
                                                </form>  
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
            function apparaitre(ide,CIN,nom,prenom,salaire,dateNaissance,dateEmbauche,poste,genre,telephone){
            document.getElementById("ide").value=""+ide;
            document.getElementById("CIN").value=""+CIN;
            document.getElementById("nom").value=""+nom;
            document.getElementById("prenom").value=""+prenom;
            document.getElementById("salaire").value=""+salaire;
            document.getElementById("dateNaissance").value=""+dateNaissance;
            document.getElementById("dateEmbauche").value=""+dateEmbauche;
            document.getElementById("poste").value=""+poste;
            document.getElementById("telephone").value=""+telephone;
            if(genre==='Femme'){
               document.getElementById("btnradio2").checked=true;
            }
            else{
               document.getElementById("btnradio1").checked=true;
            }
        }
        </script>
        <?php
        include './foot.php';
        ?>
  
    </body>
</html>
