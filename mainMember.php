<?php
include __DIR__ . "/src/services/memberfcts.php";
require_once __DIR__."/config/db.php";
$conn = DB::connect();

$member = new gestionMember() ;
$member->startMember();
$wrng = true ;
while($wrng){
    switch ( $member->displayMemberMenu($member->logInMyMember($member->getAllMembers()))) {
        case 1:
            echo "Entrez le titre du livre : ";
            $titre = readline();
            $member->searchBookByNm($member->getAllBooks(), $titre);
            $member->leaveOrContinue($member);
            $wrng = false ;
            break;

        case 2:
            echo "Entrez l'ISBN du livre à emprunter : ";
            $isbn = readline();
            $member->borrowBook($member->getId(), $isbn);
            $member->leaveOrContinue($member);
            $wrng = false ;
            break;

        case 3:
            echo "Entrez l'ISBN du livre à rendre : ";
            $isbn = readline();
            $member->rendreLivre($member->getId(), $isbn);
            $member->leaveOrContinue($member);
            $wrng = false ;
            break;

        case 4:
            $member->displayMyEmpreints($member->getMyEmpreints($member->getId()));
            $member->leaveOrContinue($member);
            $wrng = false ;
            break;

        case 5:
            echo "Au revoir !\n";
            exit;

        default:
            echo "Option invalide";
            $wrng = true ;
            break;
    }

}
