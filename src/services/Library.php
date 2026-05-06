<?php
function showMenuLibrarian(){
    echo "=============================================";
    echo "1. Ajouter un livre";
    echo "2. Gérer les membres";
    echo "3. Consulter les stocks";
    echo "4. Retirer / réparer livre";
    echo "5. Quitter";
    echo "=============================================";
    $choix = readline("Ton choix ? : ");
    return $choix ;
}

showMenuLibrarian();