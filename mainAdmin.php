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
           $maBibliotheque -> deleteLivre();
            break;
        case 4:
            $maBibliotheque -> repareLivre();
            break;
        case 5:
           $maBibliotheque->getAllBooks();

            break;
        default:
            echo "Choix invalide. Veuillez réessayer.\n";
    }
}