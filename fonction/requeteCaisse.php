<?php
function insererCaisse($libelle, $type, $montant, $idu)
{
    include '../connect/connect.php';
    $req = $bdd->prepare('insert into caisse (libelle,type,montant,date,idu) values (?,?,?,?,?)');
    $req->bindvalue(1, $libelle);
    $req->bindvalue(2, $type);
    $req->bindvalue(3, $montant);
    $req->bindvalue(4, date("Y-m-d"));
    $req->bindvalue(5, $idu);
    $req->execute();
}

function modifierCaisse($libelle, $type, $montant, $idCaisse)
{
    include '../connect/connect.php';
    $req = $bdd->prepare('update caisse set libelle=?, type=? ,montant=? where idCaisse=?');
    $req->bindvalue(1, $libelle);
    $req->bindvalue(2, $type);
    $req->bindvalue(3, $montant);
    $req->bindvalue(4, $idCaisse);
    $req->execute();
}
function supprimerCaisse($idc)
{
    include '../connect/connect.php';
    $req = $bdd->query('delete from caisse where idCaisse=' . $idc);
}
function benefice()
{
    include '../connect/connect.php';
    $req = $bdd->query('select sum(montant) from caisse where type="entree"');
    $ligne = $req->fetch();
    $entrée = $ligne['sum(montant)'];
    $r = $bdd->query('select sum(montant) from caisse where type="sortie"');
    $lign = $r->fetch();
    $sortie = $lign['sum(montant)'];
    $benefice = $entrée - $sortie;
    return $benefice;
}
function beneficeJour($date)
{
    include '../connect/connect.php';
    $req = $bdd->query('select sum(montant) from caisse where type="Entrée" and date="' . $date . '"');
    $ligne = $req->fetch();
    $entrée = $ligne['sum(montant)'];
    $r = $bdd->query('select sum(montant) from caisse where type="Sortie" and date="' . $date . '"');
    $lign = $r->fetch();
    $sortie = $lign['sum(montant)'];
    $benefice = $entrée - $sortie;
    return $benefice;
}
function entrée()
{
    include '../connect/connect.php';
    $req = $bdd->query('select sum(montant) from caisse where type="Entrée"');
    $ligne = $req->fetch();
    $entrée = $ligne['sum(montant)'];
    return $entrée;
}
function sortie()
{
    include '../connect/connect.php';
    $req = $bdd->query('select sum(montant) from caisse where type="Sortie"');
    $ligne = $req->fetch();
    $sortie = $ligne['sum(montant)'];
    return $sortie;
}

function statistisque()
{
    include '../connect/connect.php';
    $req = $bdd->query('select date,sum(montant) from caisse where type="Entree" group by date');
    return $req;
}
