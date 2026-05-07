<?php
require_once __DIR__ . '/src/services/Library.php';
use LibCore\services\Library;
$maBibliotheque = new Library() ;
$continuer = true;

while ($continuer) {

    $choix =$maBibliotheque-> showMenuLibrarian();

    switch ($choix) {
        case 1:
           $maBibliotheque -> AjouterLivre();

            break;
        case 2:
          $maBibliotheque -> AjouterMembre();
            break;
        case 3:
            echo "=> Affichage du stock...\n";
            break;
        case 4:
            echo "=> Maintenance du matériel...\n";
            break;
        case 5:
            echo "Au revoir !\n";
            $continuer = false;
            break;
        default:
            echo "Choix invalide. Veuillez réessayer.\n";
    }
}