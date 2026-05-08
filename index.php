<?php
$repeat = true ;
while($repeat){

    echo "--- Welcome to the Library System ---\n";
    echo "Please select your role:\n";
    echo "1. Librarian\n";
    echo "2. Member\n";
    echo "3. Exit\n";

    $choice = readline("Enter your choice (1-3): ");

    switch ($choice) {
        case '1':
            passthru("php mainAdmin.php");
        case '2':
            passthru("php mainMember.php");
        case '3':
            echo "Exiting system. Goodbye!\n";
            exit;
        default:
            echo "Invalid number \n\n";
            $repeat = true ;
            break ;
    }

}