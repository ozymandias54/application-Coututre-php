<?php
function insererArt($materiel,$description,$montant,$tCoup,$lgEpaule,$loBras,$tPoignet,$torse,$hauteur,$loJambe,$tCuisse,$tPied,$idcmd,$idm) {
    include '../connect/connect.php';
    $req=$bdd->prepare('insert into article (materiel,description,montant,tCoup,lgEpaule,loBras,tPoignet,torse,hauteur,loJambe,tCuisse,tPied,idcmd,idm) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $req->bindvalue(1,$materiel);
    $req->bindvalue(2,$description);
    $req->bindvalue(3,$montant);
    $req->bindvalue(4,$tCoup);
    $req->bindvalue(5,$lgEpaule);
    $req->bindvalue(6,$loBras);
    $req->bindvalue(7,$tPoignet);
    $req->bindvalue(8,$torse);
    $req->bindvalue(9,$hauteur);
    $req->bindvalue(10,$loJambe);
    $req->bindvalue(11,$tCuisse);
    $req->bindvalue(12,$tPied);
    $req->bindvalue(13,$idcmd);
    $req->bindvalue(14,$idm);
    $req->execute();
}
