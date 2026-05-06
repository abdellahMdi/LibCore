<?php
include_once 'server/Library.php';
$continuer = true;

while ($continuer) {
    $choix = showMenuLibrarian();

    switch ($choix) {
        case 1:
            echo "=> Lancement de l'ajout d'un livre...\n";
            // Hna ghadi t3yyt l la méthode d'ajout f Library
            break;
        case 2:
            echo "=> Création d'un membre...\n";
            break;
        case 3:
            echo "=> Affichage du stock...\n";
            break;
        case 4:
            echo "=> Maintenance du matériel...\n";
            break;
        case 5:
            echo "Au revoir !\n";
            $continuer = false; // Hadi li katsali l'programme
            break;
        default:
            echo "Choix invalide. Veuillez réessayer.\n";
    }
}