<?php
session_start();
if(empty($_SESSION['idu'])){
    header('location:../index.php');
}
?>
<!DOCTYPE html>

<?php
     include '../connect/connect.php';
     include '../fonction/requeteUtilisateur.php';
     include '../fonction/requeteJournal.php';
     if(isset($_POST['enregistrer'])){
         modifier($_POST['login'], $_POST['password'], $_POST['profil'], $_POST['idu']);
         journal("Modifier l'utilisateur ".$_POST['login'], $_SESSION['idu']);
         header('location:listeUtilisateur.php');
     }
     if(isset($_GET['index'])){
         $req=$bdd->query('select login from utilisateur where idu='.$_GET['index']);
         
         $ligne=$req->fetch();
         $login=$ligne['login'];
         journal("Supprimer l'utilisateur ".$login, $_SESSION['idu']);
         supprimer($_GET['index']);
         header('location:listeUtilisateur.php');
     }
 ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Liste des utilisateurs</title>
    </head>
    <body>
        <?php
        include './head.php';
        ?>
        <h1 class="h3 mb-2 text-gray-800">Gestion des Utilisateurs</h1>
        
         <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Liste des utilisateurs</h6>
                        </div>
                        <div class="card-body">
                            <div class="data-tables table-responsive">
                                    <table id="dataTable" class="text-center">
                                    <thead class="bg-light text-capitalize">                                      
                                        <tr>
                                            <th>Login</th>
                                            <th>Mot de passe</th>
                                            <th>Profil</th>
                                            <th>Employé</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        
                                        <?php
                                        $list= liste();
                                        $cpt=1;
                                        foreach ($list as $value) {
                                            $cpt=$cpt+1;
                                            echo '<tr>';
                                            echo '<td>'.$value['login'].'</td>';
                                            echo '<td>'.$value['password'].'</td>'; 
                                            echo '<td>'.$value['profil'].'</td>'; 
                                            echo '<td>'.$value['nom'].' '.$value['prenom'].'</td>'; 
                                            
                                            echo '<td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="apparaitre('.$value['idu'].',\''.$value['login'].'\',\''.$value['password'].'\',\''.$value['profil'].'\',\''.$value['nom'].'\',\''.$value['prenom'].'\')">Modifier</button>         '
                                                    . '<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#supp'.$cpt.'">Supprimer</button>'
                                                    . '</td>'; 
                                            echo '<div class="modal fade" id="supp'.$cpt.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                   <div class="modal-dialog modal-dialog-centered ">
                                                    <div class="modal-content">
                                                        <div class="text-center">
                                                            <i class="fa fa-warning" style="font-size: 45px;margin-top: 21px;"></i>  
                                                            <h3>Supprimer cet utilisateur?</h3>
                                                            <p>Cet action est irréversible.</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light " data-bs-dismiss="modal">Annuler</button>
                                                            <a href="listeUtilisateur.php?index='.$value['idu'].'"><button type="button" class="btn btn-danger" style="margin-right: 32%;">Supprimer</button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                               </div>';
                                            echo '</tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <!--***************** Modal pour modification**************************************** -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modification</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                            <div class="modal-body">
                                                <form class="user" action="listeUtilisateur.php" method="post">
                                                    <input type="hidden" name="idu" id="idu">
                                                    <div class="form-group">Login
                                                        <input type="text" class="form-control "
                                                         name="login" required="" value="" id="login">
                                                    </div>
                                                    <div class="form-group">Mot de passe
                                                        <input type="text" class="form-control "
                                                        name="password" required="" id="password">
                                                    </div>
                                                    <div class="form-group">Profil
                                                        <select name="profil" class="form-control form-select" aria-label=".form-select-lg example">
                                                            <option  id="profil"></option>
                                                            <option >Administateur</option>
                                                            <option >Couturie</option>
                                                            <option  >Secretaire</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">Employé
                                                        <p class="btn form-control" id="employe">Nom employe</p>
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
                            </div>
                        </div>
                    </div>
        <script >
            var liste=document.getElementById('collapseTwo');
            var menu=document.getElementById('menuU');
            var fleche=document.getElementById('flecheU');
            liste.setAttribute("class","collapse show");
            menu.setAttribute("class","nav-item active");
            fleche.setAttribute("class","nav-link");
            function apparaitre(idu,login,password,profil,nom,prenom){
            document.getElementById("idu").value=""+idu;
            document.getElementById("login").value=""+login;
            document.getElementById("password").value=""+password;
            document.getElementById("profil").textContent=""+profil;
            document.getElementById("profil").selected=true;
            document.getElementById("employe").textContent=""+nom+" "+prenom;
        }
        
        </script>
       
        <?php
        include './foot.php';
        ?>
       
    </body>
</html>
