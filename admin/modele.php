<?php
session_start();
if(empty($_SESSION['idu'])){
    header('location:../index.php');
}
include '../connect/connect.php';
?>
<html>
    <head>
        <title>Modele</title>        
    </head>
    <body>
         <?php
        include './head.php';
        ?>
         <?php
        include '../connect/connect.php';
        include '../fonction/requeteModele.php';
        if (isset($_POST['valider'])) {
            $image = $_FILES['img']['name'];
            $nom=$_POST['nom'];
            $destination='C:\xampp\htdocs\ProjetCouture\modele\\'.$image;
            if(file_exists($destination)){
                echo '<script>alert(\'Modele déja enregistrer\')</script>';
            } else{
            move_uploaded_file($_FILES['img']['tmp_name'], $destination);
            include '../connect/connect.php';
            $req=$bdd->prepare('insert into modele (nomModele,modele) values (?,?)');
            $req->bindvalue(1,$nom);
            $req->bindvalue(2,$image);
            $req->execute();
        }
        }
        ?>
        
        <div class="row">
        <h1 class="h3 mb-2 text-gray-800 col-9">Gestion des Modeles</h1>
        <button type="button" style="" class="btn btn-primary col-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
         Ajouter un modele
        </button>
        </div><br>
        
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Enregistrer un modele</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="user" action="modele.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                Nom du Modele
                                <input type="text"  name="nom" required="" class="form-control ">
                            </div> 
                            <div class="form-group">
                                Modele 
                                <input type="file"  name="img" class="form-control" >
                            </div> 
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <input type="submit" value="Enregistrer" name="valider" class="btn btn-primary">
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <?php
                $list= listeModele();
                foreach ($list as $value) {
                echo '<div class="col-xl-3 col-md-6 mb-4">';
                echo '<div class="card border-left-primary shadow h-100 py-2">';
                echo '<div class="card-body">';
                echo '<div class="row no-gutters align-items-center">';
                echo '<img src="../modele/'.$value['modele'].'" alt="'.$value['nomModele'].'"/>';
                echo ''.$value['nomModele'].'';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                
                echo '</div>';
                }
                                    
                                    /*    <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Administrateur</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">13</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>*/
                                    
                               
            ?>
            
        </div>
        <script >
            var menu=document.getElementById('menuM');
            menu.setAttribute("class","nav-item active");
           
        </script>
        <?php
        include './foot.php';
        ?>
    </body>
</html>
