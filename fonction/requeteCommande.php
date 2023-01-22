<?php
function insererCmd($delai, $idc)
{
    include '../connect/connect.php';
    $req = $bdd->prepare('insert into commande (montant,avance,reste,dateDepot,delai,idc,nbreArticle,etat) values (?,?,?,?,?,?,?,?)');
    $req->bindvalue(1, 0);
    $req->bindvalue(2, 0);
    $req->bindvalue(3, 0);
    $req->bindvalue(4, date("Y-m-d"));
    $req->bindvalue(5, $delai);
    $req->bindvalue(6, $idc);
    $req->bindvalue(7, 0);
    $req->bindvalue(8, "en cours");
    $req->execute();
}
function dernierCommande()
{
    include '../connect/connect.php';
    $req = $bdd->query('select * from commande where idcmd=(select MAX(idcmd) from commande)');
    return $req;
}
function listeCmd()
{
    include '../connect/connect.php';
    $req = $bdd->query('select * from commande');
    return $req;
}
function listeEnCours()
{
    include '../connect/connect.php';
    $req = $bdd->query('select * from commande where etat="en cours"');
    return $req;
}
function listeTerminé()
{
    include '../connect/connect.php';
    $req = $bdd->query('select * from commande where etat="termine"');
    return $req;
}
function listeRetiré()
{
    include '../connect/connect.php';
    $req = $bdd->query('select * from commande where etat="retire"');
    return $req;
}
function prixTotalCommande($idcmd)
{
    include '../connect/connect.php';
    $req = $bdd->query('select sum(montant) as prix from article where idcmd=' . $idcmd);
    $prix;
    foreach ($req as $value) {
        $prix = $value['prix'];
    }
    return $prix;
}
function nbreArticleCommande($idcmd)
{
    include '../connect/connect.php';
    $req = $bdd->query('select count(*) as nbre from article where idcmd=' . $idcmd);
    $nbre;
    foreach ($req as $value) {
        $nbre = $value['nbre'];
    }
    return $nbre;
}
function finaliseCmd($montant, $avance, $nbreArticle, $idcmd)
{
    include '../connect/connect.php';
    $reste = $montant - $avance;
    $req = $bdd->prepare('update commande set montant=?, avance=?,reste=?, nbreArticle=? where idcmd=?');
    $req->bindvalue(1, $montant);
    $req->bindvalue(2, $avance);
    $req->bindvalue(3, $reste);
    $req->bindvalue(4, $nbreArticle);
    $req->bindvalue(5, $idcmd);
    $req->execute();
}
function terminé($idcmd)
{
    include '../connect/connect.php';
    $termine = 'terminé';
    $req = $bdd->prepare('update commande set etat=? where idcmd=?');
    $req->bindvalue(1, $termine);
    $req->bindvalue(2, $idcmd);
    $req->execute();
}
function retiré($idcmd)
{
    include '../connect/connect.php';
    $retire = 'retiré';
    $req = $bdd->prepare('update commande set etat=? where idcmd=?');
    $req->bindvalue(1, $retire);
    $req->bindvalue(2, $idcmd);
    $req->execute();
}
function annulé($idcmd)
{
    include '../connect/connect.php';
    $req = $bdd->query('delete from article where idcmd=' . $idcmd);
    $req = $bdd->query('delete from commande where idcmd=' . $idcmd);
}
function cmdTotal()
{
    include '../connect/connect.php';
    $req = $bdd->query('select count(*) as nbre from commande');
    $ligne = $req->fetch();
    $nbre = $ligne['nbre'];
    return $nbre;
}
function cmdEnCours()
{
    include '../connect/connect.php';
    $req = $bdd->query('select count(*) as nbre from commande where etat="en cours"');
    $ligne = $req->fetch();
    $nbre = $ligne['nbre'];
    return $nbre;
}
function cmdTerminé()
{
    include '../connect/connect.php';
    $req = $bdd->query('select count(*) as nbre from commande where etat="termine"');
    $ligne = $req->fetch();
    $nbre = $ligne['nbre'];
    return $nbre;
}
function cmdRetiré()
{
    include '../connect/connect.php';
    $req = $bdd->query('select count(*) as nbre from commande where etat="retire"');
    $ligne = $req->fetch();
    $nbre = $ligne['nbre'];
    return $nbre;
}
