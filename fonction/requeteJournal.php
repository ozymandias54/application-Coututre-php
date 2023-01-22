<?php

function insererJournal($libelle,$idu) {
      include './connect/connect.php';
        
         $req=$bdd->prepare('insert into journal (libelle,idu) values (?,?)');
         $req->bindvalue(1,$libelle);
         $req->bindvalue(2,$idu);
         $req->execute();
}
function journal($libelle,$idu) {
    include '../connect/connect.php';
        
         $req=$bdd->prepare('insert into journal (libelle,idu) values (?,?)');
         $req->bindvalue(1,$libelle);
         $req->bindvalue(2,$idu);
         $req->execute();
}
function listeJournal() {
    include '../connect/connect.php';
    $req=$bdd->query('select * from journal');
    return $req;
}