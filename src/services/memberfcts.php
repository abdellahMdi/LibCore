<?php 
require_once __DIR__."/../Entities/User.php";
require_once __DIR__."/../Entities/Member.php";
require_once __DIR__."/../Entities/Book.php";
require_once __DIR__."/../Entities/User.php";
require_once __DIR__ . "/../../config/db.php";
use LibCore\Entities\Book;
use LibCore\Entities\Member;


$conn = DB::connect();

function getAllMembers($conn){
    $sql = "SELECT users.id, users.nom, users.email, members.role FROM users JOIN members ON users.id = members.user_id";
    $res = $conn->query($sql);

    $allRows = $res->fetchAll();

    $membersList = [];

    for ($i = 0; $i < count($allRows); $i++) {
      
        $newMember = new Member($allRows[$i]['nom'], $allRows[$i]['email'],
         $allRows[$i]['role'],$allRows[$i]['id']);

        $membersList[] = $newMember;
    }

    return $membersList;
}

function logInMyMember($members) {
   
    echo "--- List of Members ---\n";
    foreach ($members as $member) {
        echo "ID: ".$member->getId()." | Name: ".$member->getName()."\n";
    }
    echo "-----------------------\n";

    while (true) {
        echo "Enter a valid ID from the list: ";
        $choice = readline();

        foreach ($members as $member) {
            if ($choice == $member->getId()) {
                echo "\n Success!";
                return $member; 
            }
        }

        echo "Error: ID '$choice' n'exist pas";
    }
}

function getAllBooks($conn) {
    $sql = "SELECT * FROM books";
    $res = $conn->query($sql);
    $allBks = $res->fetchAll();

    $booksList = [];

    for ($i = 0; $i < count($allBks); $i++) {

        $newBook = new Book($allBks[$i]['isbn'],$allBks[$i]['titre'],$allBks[$i]['auteur'],$allBks[$i]['etat']);

        $booksList[] = $newBook;
    }

    return $booksList;
}

function searchBookByNm($books, $searchTerm) {
    $similar = [];

    for ($i = 0; $i < count($books); $i++) {
        $currentBook = $books[$i];
        if (stripos($currentBook->getTitre(), $searchTerm) !== false) {
            
            $similar[] = $books[$i];
        }
    }

    return $similar;
}

function isAvailable($conn,$isbn){
    $sql = "SELECT etat FROM books WHERE isbn = ?";
    $Check = $conn->prepare($sql);
    $Check->execute([$isbn]);
    $book = $Check->fetch();
    return $book ;
}

function borrowBook($conn, $id_mem, $isbn) {
    $book = isAvailable($conn,$isbn);

    if ($book && $book['etat'] == 'disponible') {
        
        $date_today = date('Y-m-d');
        $insert = "INSERT INTO emprunts (borrowing_date, member_id, book_isbn) VALUES (?, ?, ?)";
        $stmInsert = $conn->prepare($insert);
        $stmInsert->execute([$date_today, $id_mem,$isbn]);

        
        $update = "UPDATE books SET etat = 'Emprunté' WHERE isbn = ?";
        $stmtUpdate = $conn->prepare($update);
        $stmtUpdate->execute([$isbn]);

        echo "Success! The book is now yours.";
        return true;

    } else {
        echo "Error: Book is either already borrowed or doesn't exist :/";
        return false;
    }
}

function rendreLivre($conn, $id_mem, $isbn) {
    
    $sql = "SELECT id FROM emprunts WHERE member_id = ? AND book_isbn = ? AND return_date IS NULL";
    $stmtCheck = $conn->prepare($sql);
    $stmtCheck->execute([$id_mem,$isbn]);
    $loan = $stmtCheck->fetch();

    if ($loan) {
        $closeEmprunt = "UPDATE emprunts SET return_date = ? WHERE id = ?";
        
        $stmCloseEmprunt = $conn->prepare($closeEmprunt);
        $stmCloseEmprunt->execute([date('Y-m-d'),$loan['id']]);

        $sql = "UPDATE books SET etat = 'disponible' WHERE isbn = ?";
        $stmtUpdateBook = $conn->prepare($sql);
        $stmtUpdateBook->execute([$isbn]);

        echo "Success! The book has been returned and is now available.";
        return true;

    } else {
        echo "Error: Not found !!???!?";
        return false;
    }
}

function displayLivres(array $livress) {
    echo "\n------------------------------------------------------------\n";

    if (empty($livress)) {
        echo "there are no books";
    } else {
        foreach ($livress as $livre) {
            echo "ISBN : ".$livre->getIsbn()." | "."Titre : ".$livre->getTitre()." | "."Auteur : ".$livre->getAuteur()." | "."État : ".$livre->getEtat()."\n".
                 "------------------------------------------------------------\n";
        }
    }
    echo "------------------------------------------------------------\n";
}

function leaveOrContinue($conn, $member){
    $choix = readline("Want to continue ? (y/n): ");
    if($choix == "y" || $choix == "Y" ){
        displayMemberMenu($conn, $member);
    }else if($choix == "n" || $choix == "N" ){
        exit ;
    }
}

function displayMemberMenu($conn, $member) {
    echo "\n--- MENU MEMBRE ---\n";
    echo "1. Rechercher un livre \n";
    echo "2. Emprunter un livre \n";
    echo "3. Rendre un livre \n";
    echo "4. Mes emprunts actuels \n";
    echo "5. Quitter";
    echo "Choisissez une option : ";

    $choix = readline();

    switch ($choix) {
        case 1:
            echo "Entrez le titre du livre : ";
            $titre = readline();
            searchBookByNm(getAllBooks($conn), $titre);
            leaveOrContinue($conn, $member);
            break;

        case 2:
            echo "Entrez l'ISBN du livre à emprunter : ";
            $isbn = readline();
            borrowBook($conn, $member->getId(), $isbn);
            leaveOrContinue($conn, $member);
            break;

        case 3:
            echo "Entrez l'ISBN du livre à rendre : ";
            $isbn = readline();
            rendreLivre($conn, $member->getId(), $isbn);
            leaveOrContinue($conn, $member);
            break;

        case 4:
            leaveOrContinue($conn, $member);
            break;

        case 5:
            echo "Au revoir !\n";
            exit;

        default:
            echo "Option invalide";
            displayMemberMenu($conn, $member);
            break;
    }
}

function startMember($conn){
    displayMemberMenu($conn, logInMyMember(getAllMembers($conn)));
}