<?php
session_start();
if(empty($_SESSION['idu'])){
    header('location:../index.php');
}
?>
<!DOCTYPE html>

<?php
     include '../connect/connect.php';
     include '../fonction/requeteCommande.php';
     include '../fonction/requeteClient.php';
     if(isset($_GET['terminé'])){
         terminé($_GET['terminé']);
         header('location:depot.php?cat=Toutes-les-Commandes');
     }
     if(isset($_GET['annulé'])){
         annulé($_GET['annulé']);
         header('location:depot.php?cat=Toutes-les-Commandes');
     }
     if(isset($_GET['retiré'])){
         retiré($_GET['retiré']);
         header('location:depot.php?cat=Toutes-les-Commandes');
     }
 ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Depot Commande</title>
    </head>
    <body>
        <?php
        include './head.php';
        ?>
        <h1 class="h3 mb-2 text-gray-800">Gestion des Commande</h1>
        <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Commande Total</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo ''. cmdTotal(); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
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
                                                Commande en cours</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo ''. cmdEnCours(); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-people-carry fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                      </div>
         </div>
            
        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-dark shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                Commande Terminé</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo ''. cmdTerminé(); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-chalkboard fa-2x text-gray-300" ></i>
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
                                                Commande Retiré</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo ''. cmdRetiré(); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-chalkboard fa-2x text-gray-300" ></i>
                                        </div>
                                    </div>
                                </div>
                      </div>
         </div>
        
        </div>
         <div class="card shadow mb-4">
                        <div class="card-header">
                          <div class="row">
                            <h6 class="col-sm-8 font-weight-bold text-primary">
                                 Liste des Commandes
                            </h6>
                            <div class="dropdown col-sm-4">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php 
                                    if(isset($_GET['cat'])){
                                        echo ''.$_GET['cat'];
                                    }
                                 ?>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="depot.php?cat=Toutes-les-Commandes">Toutes-les-Commandes</a></li>
                                    <li><a class="dropdown-item" href="depot.php?cat=Commande-en-cours">Commande-en-cours</a></li>
                                    <li><a class="dropdown-item" href="depot.php?cat=Commande-Terminé">Commande-Terminé</a></li>
                                    <li><a class="dropdown-item" href="depot.php?cat=Commande-Retiré">Commande-Retiré</a></li>
                                </ul>
                            </div>
                          </div>
                        </div>
                        <div class="card-body ">
                            <div class="data-tables table-responsive">
                                    <table id="dataTable" class="text-center">
                                    <thead class="bg-light text-capitalize">                                      
                                        <tr>
                                            <th>Client</th>
                                            <th>Date de Depot</th>
                                            <th>Delai</th>
                                            <th>Avance</th>
                                            <th>Prix Total</th>
                                            <th>Nombre d'article</th>
                                            <th>Etat</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        
                                        <?php
                                        if ($_GET['cat']=='Commande-en-cours') {
                                            $list= listeEnCours();                        
                                        }
                                        elseif ($_GET['cat']=='Commande-Terminé') {
                                            $list= listeTerminé();
                                        }
                                        elseif ($_GET['cat']=='Commande-Retiré') {
                                            $list= listeRetiré();
                                        }
                                        else {$list= listeCmd();}
                                        
                                        $cpt=1;
                                        foreach ($list as $value) {
                                            if($value['nbreArticle']!=0){
                                            $cpt=$cpt+1;
                                            $client= recherche($value['idc']); $nomclt;
                                            foreach ($client as $v) {
                                                $nomclt=$v['nom'];
                                            }
                                            echo '<tr>';
                                            echo '<td>'.$nomclt.
                                                 '</td>';
                                            echo '<td>'.$value['dateDepot'].'</td>'; 
                                            echo '<td>'.$value['delai'].'</td>'; 
                                            echo '<td>'.$value['avance'].'</td>'; 
                                            echo '<td>'.$value['montant'].'</td>';
                                            echo '<td>'.$value['nbreArticle'].'</td>';
                                            if($value['etat']=='en cours'){
                                            echo '<td><button type="button" class="btn btn-warning">'.$value['etat'].'</button></td>';
                                            echo '<td><a href="../facture.php?cmd='.$value['idcmd'].'" target="_blank"><button type="button" class="btn btn-outline-info">Facture</button></a>'
                                               . '    <a href="detail.php?cmd='.$value['idcmd'].'" target="_blank"><button type="button" class="btn btn-outline-dark">Detail</button></a>'
                                               . '    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop'.$cpt.'">Terminer</button>'
                                               . '    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal'.$cpt.'">Annuler</button>'
                                               . '    </td>'
                                                    . '<div class="modal fade" id="exampleModal'.$cpt.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="text-center">
                                                                    <i class="fa fa-warning" style="font-size: 45px;margin-top: 21px;"></i>  
                                                                    <h3>Annuler cette Commande?</h3>
                                                                    <p>Une fois annulé vous ne pourez plus recuperer la commande</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-light " data-bs-dismiss="modal">Annuler</button>
                                                                    <a href="depot.php?annulé='.$value['idcmd'].'"><button type="button" class="btn btn-danger" style="margin-right: 32%;">Confirmer</button></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                       </div>
                                                       


                                                       <div class="modal fade" id="staticBackdrop'.$cpt.'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="text-center">
                                                                    <i class="fa fa-question" style="font-size: 45px;margin-top: 21px;"></i>  
                                                                    <h3>Etez vous sûr que cette commande est bien terminé?</h3>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-light " data-bs-dismiss="modal">Annuler</button>
                                                                    <a href="depot.php?terminé='.$value['idcmd'].'"><button type="button" class="btn btn-warning" style="margin-right: 32%;">Confirmer</button></a>
                                                                </div>                                                                
                                                            </div>
                                                        </div>
                                                       </div>
                                                    ';
                                            }
                                            else if($value['etat']=='terminé'){
                                            echo '<td><button type="button" class="btn btn-success">'.$value['etat'].'</button></td>';
                                            echo '<td><a href="../facture.php?cmd='.$value['idcmd'].'" target="_blank"><button type="button" class="btn btn-outline-info">Facture</button></a>'
                                               . '    <a href="detail.php?cmd='.$value['idcmd'].'" target="_blank"><button type="button" class="btn btn-outline-dark">Detail</button></a>'
                                               . '    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop'.$cpt.'">Retiré</button>'
                                               . '    </td>'
                                                    . '<div class="modal fade" id="staticBackdrop'.$cpt.'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="text-center">
                                                                    <i class="fa fa-info" style="font-size: 45px;margin-top: 21px;"></i>  
                                                                    <h3>Assurez vous que tous les frais ont été payé avant de confirmer</h3>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-light " data-bs-dismiss="modal">Annuler</button>
                                                                    <a href="depot.php?retiré='.$value['idcmd'].'"><button type="button" class="btn btn-warning" style="margin-right: 32%;">Confirmer</button></a>
                                                                </div>                                                                
                                                            </div>
                                                        </div>
                                                       </div>';
                                            }
                                        else {
                                            echo '<td><button type="button" class="btn btn-primary">'.$value['etat'].'</button></td>';
                                            echo '<td><a href="../facture.php?cmd='.$value['idcmd'].'" target="_blank"><button type="button" class="btn btn-outline-info">Facture</button></a> '
                                                 .'<a href="detail.php?cmd='.$value['idcmd'].'" target="_blank"><button type="button" class="btn btn-outline-dark">Detail</button></a></td>';
                                        }
                                            echo '</tr>';
                                        }
                                        }
                                        ?>
                                    </tbody>
                                </table>                                    
                            </div>
                        </div>
                    </div>           
        <script >
            var menu=document.getElementById('menuD');
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
       
    </body>
</html>
