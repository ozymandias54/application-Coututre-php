<?php
session_start();
if (empty($_SESSION['idu'])) {
  header('location:../index.php');
}
include '../connect/connect.php';
include '../fonction/requeteCaisse.php';
include '../fonction/requeteCommande.php';
?>
<html>

<head>
  <title>title</title>
</head>

<body>
  <?php
  include './head.php';
  ?>
  <?php
  $req = $bdd->query('select sum(montant) from caisse where type="Entree"');
  $ligne = $req->fetch();
  $entrée = $ligne['sum(montant)'];
  echo '' . $entrée;

  ?>
  <?php
  include './foot.php';
  ?>
</body>

</html>