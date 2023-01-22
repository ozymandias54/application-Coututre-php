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
    if (isset($_POST['suivant'])) {
        insererCmd($_POST['delai'], $_POST['client']);
        header('location:article.php');
    }
    
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Nouvelle Commande</title>
    </head>
    <body>
        <?php
        include './head.php';
        ?>
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-header">
                <h2 class="">Nouvelle Commande</h2> 
            </div>
            <div class="card-body p-0">
                <form class="user" action="commande.php" method="post">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Info sur la Commande</h1>
                </div>
                
                <div class="form-group" style="margin: 31px">Delai Pour la Commande
                    <input type="date" name="delai" class="form-control" >
                 </div>
                <div class="form-group" style="margin: 31px">Client
                        <select name="client" class="form-select form-select-sm" aria-label=".form-select-sm example">
                            <?php
                                $list= liste();
                                foreach ($list as $value) {
                                    echo '<option value="'.$value['idc'].'">'.$value['nom'].'</option>';
                                }
                            ?>
                        </select>
                </div>
                
                <div class="form-group">
                     <center><input type="submit" class="btn btn-outline-primary" name="suivant" value="Suivant->"> </center>
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
