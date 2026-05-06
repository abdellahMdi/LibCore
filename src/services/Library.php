<?php
function showMenuLibrarian(): int {
    echo "\n=============================================\n";
    echo "           DASHBOARD BIBLIOTHÉCAIRE          \n";
    echo "=============================================\n";
    echo "1. Ajouter un livre \n";
    echo "2. Gérer les membres \n";
    echo "3. Consulter les stocks \n";
    echo "4. Retirer / réparer livre \n";
    echo "5. Quitter \n";
    echo "=============================================\n";

    $choix = readline("Ton choix ? : ");


    return (int) $choix;
}

require_once __DIR__ . "/../../config/db.php";
class Library
{
    public function info()
    {
        echo 'info';
    }
}

showMenuLibrarian();