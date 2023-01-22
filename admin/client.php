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
     include '../fonction/requeteClient.php';
     $list= liste();
     foreach ($list as $value) {
         miseaJourClient($value['idc']);
    }
     if(isset($_POST['enregistrer'])){
         inserer($_POST['nom'], $_POST['contact']);
     }
     if(isset($_POST['modifier'])){
         modifier($_POST['nom'], $_POST['contact'],$_POST['idc']);
     }
     if(isset($_GET['index'])){
         
           supprimer($_GET['index']);  
         
         header('location:client.php');
     }
 ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Client</title>
        
    </head>
    <body>
        <?php
        include './head.php';
        ?>
        <h1 class="h3 mb-2 text-gray-800">Gestion des Clients</h1>
           
         <div class="card shadow mb-4">
                        <div class="card-header">
                            <div class=" row">
                            <h6 class="col-sm-8 font-weight-bold text-primary">Liste des clients</h6>
                            <button type="button" class="btn btn-primary col-sm-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="">Ajouter</button>
                            </div>
                        </div>


                        <div class="card-body">
                             <div class="data-tables">
                                    <table id="dataTable" class="text-center">
                                    <thead class="bg-light text-capitalize">
                                        <tr>
                                            <th>Nom</th>
                                            <th>Contact</th>
                                            <th>Nombre Article</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php
                                        $req=$bdd->query('select * from client');
                                        $cpt=1;
                                        foreach ($req as $value) {
                                            $cpt=$cpt+1;
                                            $nbre=$value['nbreArticle'];
                                            echo '<tr>';
                                            echo '<td>'.$value['nom'].'</td>';
                                            echo '<td>'.$value['contact'].'</td>'; 
                                            if($nbre==null){
                                            echo '<td>0</td>'; 
                                            
                                            echo '<td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="apparaitre('.$value['idc'].',\''.$value['nom'].'\',\''.$value['contact'].'\')">Modifier</button>'
                                            . ' <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#supp'.$cpt.'">Supprimer</button></td>';
                                            echo '<div class="modal fade" id="supp'.$cpt.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="text-center">
                                                            <i class="fa fa-warning" style="font-size: 45px;margin-top: 21px;"></i>  
                                                            <h3>Supprimer cet client?</h3>
                                                            <p>Cet action est irréversible.</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light " data-bs-dismiss="modal">Annuler</button>
                                                            <a href="client.php?index='.$value['idc'].'"><button type="button" class="btn btn-danger" style="margin-right: 32%;">Supprimer</button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                   </div>';
                                            echo '</tr>';
                                            }
                                            else {
                                            echo '<td>'.$nbre.'</td>'; 
                                            echo '<td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="apparaitre('.$value['idc'].',\''.$value['nom'].'\',\''.$value['contact'].'\')">Modifier</button></td>';
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
        
        <script >
            var menu=document.getElementById('menuC');
            menu.setAttribute("class","nav-item active");
            function apparaitre(idc,nom,contact){
             document.getElementById("idc").value=""+idc;
             document.getElementById("nom").value=""+nom;
            document.getElementById("contact").value=""+contact;
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
                    <form class="user" action="client.php" method="post">
                        <div class="form-group">Nom
                            <input type="text" class="form-control "
                             name="nom" required="">
                        </div>
                        <div class="form-group">Contact
                            <input type="text" class="form-control "
                            name="contact" required="">
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
                    <form class="user" action="client.php" method="post">
                        <input type="hidden" id="idc" name="idc">
                        <div class="form-group">Nom
                            <input type="text" class="form-control "
                            name="nom" id="nom" required="">
                        </div>
                        <div class="form-group">Contact
                            <input type="text" class="form-control "
                            name="contact" id="contact" required="">
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
