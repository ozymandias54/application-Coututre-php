<?php
function inserer($nom,$contact) {
      include '../connect/connect.php';
           $req=$bdd->prepare('insert into client (nom,contact) values (?,?)');
         $req->bindvalue(1,$nom);
         $req->bindvalue(2,$contact);
         $req->execute();
}

function modifier($nom,$contact,$idc) {
        include '../connect/connect.php';
        $req=$bdd->prepare('update client set nom=?, contact=? where idc=?');
         $req->bindvalue(1,$nom);
         $req->bindvalue(2,$contact);
         $req->bindvalue(3,$idc);
         $req->execute();
}
function supprimer($idc) {
    include '../connect/connect.php';
    $req=$bdd->query('delete from client where idc='.$idc);
}
function liste() {
    include '../connect/connect.php';
    $req=$bdd->query('select * from client');
    return $req;
}
function recherche($idc) {
    include '../connect/connect.php';
    $req=$bdd->query('select * from client where idc='.$idc);
    return $req;
}
function miseaJourClient($idc) {
    include '../connect/connect.php';
    $req=$bdd->query('update client set nbreArticle=(select sum(nbreArticle) from commande where idc='.$idc.') where idc='.$idc);
    
}
