<?php
function inserer($login,$password,$profil,$ide) {
      include '../connect/connect.php';
            $req=$bdd->prepare('insert into utilisateur (login,password,profil,ide) values (?,?,?,?)');
         $req->bindvalue(1,$login);
         $req->bindvalue(2,$password);
         $req->bindvalue(3,$profil);
         $req->bindvalue(4,$ide);
         $req->execute();
}

function modifier($login,$password,$profil,$idu) {
        include '../connect/connect.php';
        $req=$bdd->prepare('update utilisateur set login=?, password=?, profil=? where idu=?');
         $req->bindvalue(1,$login);
         $req->bindvalue(2,$password);
         $req->bindvalue(3,$profil);
         $req->bindvalue(4,$idu);
         $req->execute();
}
function supprimer($idu) {
    include '../connect/connect.php';
    $req=$bdd->query('delete from utilisateur where idu='.$idu);
}
function liste() {
    include '../connect/connect.php';
    $req=$bdd->query('select ut.idu,ut.login,ut.password,ut.profil,em.nom,em.prenom from utilisateur ut, employe em where ut.ide=em.ide');
    return $req;
}
