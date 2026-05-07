<?php
require_once __DIR__ . '/src/services/Library.php';
$continuer = true;

while ($continuer) {
    $choix = showMenuLibrarian();

    switch ($choix) {
        case 1:
            echo "=> Lancement de l'ajout d'un livre...\n";

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
            $continuer = false;
            break;
        default:
            echo "Choix invalide. Veuillez réessayer.\n";
    }
}