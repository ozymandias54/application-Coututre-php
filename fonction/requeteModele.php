<?php

function listeModele() {
    include '../connect/connect.php';
    $req=$bdd->query('select * from modele');
    return $req;
}
function modele($modele) {
    include '../connect/connect.php';
    $req=$bdd->query('select idm from modele where modele='.$modele);
    $idm;
    foreach ($req as $value) {
        $idm=$value['idm'];
    }
    return $idm;
}
