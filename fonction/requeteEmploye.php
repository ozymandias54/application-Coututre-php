<?php
function inserer($CIN, $nom, $prenom, $salaire, $dateNaissance, $dateEmbauche, $poste, $genre, $telephone)
{
    include '../connect/connect.php';
    $req = $bdd->prepare('insert into employe (CIN,nom,prenom,salaire,dateNaissance,dateEmbauche,poste,genre,telephone) values (?,?,?,?,?,?,?,?,?)');
    $req->bindvalue(1, $CIN);
    $req->bindvalue(2, $nom);
    $req->bindvalue(3, $prenom);
    $req->bindvalue(4, $salaire);
    $req->bindvalue(5, $dateNaissance);
    $req->bindvalue(6, $dateEmbauche);
    $req->bindvalue(7, $poste);
    $req->bindvalue(8, $genre);
    $req->bindvalue(9, $telephone);
    $req->execute();
}

function modifier($CIN, $nom, $prenom, $salaire, $dateNaissance, $dateEmbauche, $poste, $genre, $telephone, $ide)
{
    include '../connect/connect.php';
    $req = $bdd->prepare('update employe set CIN=?, nom=?, prenom=?, salaire=?, dateNaissance=?, dateEmbauche=?, poste=?, genre=?, telephone=? where ide=?');
    $req->bindvalue(1, $CIN);
    $req->bindvalue(2, $nom);
    $req->bindvalue(3, $prenom);
    $req->bindvalue(4, $salaire);
    $req->bindvalue(5, $dateNaissance);
    $req->bindvalue(6, $dateEmbauche);
    $req->bindvalue(7, $poste);
    $req->bindvalue(8, $genre);
    $req->bindvalue(9, $telephone);
    $req->bindvalue(10, $ide);
    $req->execute();
}
function supprimer($ide)
{
    include '../connect/connect.php';
    $req = $bdd->query('delete from employe where ide=' . $ide);
}
function liste()
{
    include '../connect/connect.php';
    $req = $bdd->query('select * from employe');
    return $req;
}
