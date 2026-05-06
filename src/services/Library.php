<?php
function showMenuLibrarian(){
    echo "============================================= \n1. Ajouter un livre \n2. Gérer les membres \n3. Consulter les stocks \n4. Retirer / réparer livre \n5. Quitter \n============================================= \n";
    $choix = readline("Ton choix ? : ");
    return $choix ;
}

function showMenuMember(){
    echo "============================================= \n1. Rechercher un livre \n2. Voir mes emprunts \n3. Emprunter un livre \n4. Rendre un livre \n 5.Quitter \n============================================= \n";
    $choix = readline("Ton choix ? : ");
    return $choix ;
}