<?php

namespace LibCore\services;
require_once __DIR__ . "/../../config/db.php";
class Library
{
    public function showMenuLibrarian(): int {
        echo "\n=============================================\n";
        echo "           DASHBOARD BIBLIOTHÉCAIRE          \n";
        echo "=============================================\n";
        echo "1. Ajouter un livre \n";
        echo "2. Gérer les membres \n";
        echo "3. Retirer livre \n";
        echo "4. Réparer livre \n";
        echo "5. afficher livre \n";

        echo "5. Quitter \n";
        echo "=============================================\n";

        $choix = readline("Ton choix ? : ");


        return (int) $choix;
    }



//showMenuLibrarian();
    public function AjouterLivre()
    {
        echo "\n--- AJOUT D'UN NOUVEAU LIVRE ---\n";


        $isbn   = trim(readline("ISBN : "));
        $titre  = trim(readline("Titre : "));
        $auteur = trim(readline("Auteur : "));
        $etat   = trim(readline("Etat (ex: Disponible) : "));


        if (empty($isbn) || empty($titre)) {
            echo "[Erreur] L'ISBN et le Titre sont obligatoires !\n";
            return;
        }

        try {
            $con = \DB::connect();
            $sql = "INSERT INTO books (isbn, titre, auteur, etat) VALUES (:isbn, :titre, :auteur, :etat)";

            $stmt = $con->prepare($sql);
            $stmt->execute([
                ':isbn'   => $isbn,
                ':titre'  => $titre,
                ':auteur' => $auteur,
                ':etat'   => $etat
            ]);

            echo "[Succès] Le livre '$titre' a été ajouté à la bibliothèque avec succès !\n";

        } catch (PDOException $e) {
            echo "[Erreur] Impossible d'ajouter ce livre. (L'ISBN existe peut-être déjà ?)\n";
        }
    }
    public function AjouterMembre()
    {
        echo "\n--- AJOUT D'UN NOUVEAU MEMBRE ---\n";

        $nom   = trim(readline("Nom : "));
        $email  = trim(readline("Email : "));
        $role = trim(readline("Rôle (Etudiant / Professeur) : "));


        if (empty($nom) || empty($email) || empty($role)) {
            echo "[Erreur] Le Nom, l'Email et le Rôle sont obligatoires !\n";
            return;
        }


        $role = ucfirst(strtolower($role));
        if ($role !== "Etudiant" && $role !== "Professeur") {
            echo "[Erreur] Rôle invalide. Veuillez taper 'Etudiant' ou 'Professeur'.\n";
            return;
        }

        try {
            $con = \DB::connect();
            $sqlUser = "INSERT INTO users (nom, email) VALUES (:nom, :email)";
            $stmtUser = $con->prepare($sqlUser);
            $stmtUser->execute([':nom' => $nom, ':email' => $email]);
            $idNouveauUser = $con->lastInsertId();
            $sqlMember = "INSERT INTO members (user_id, role) VALUES (:user_id, :role)";
            $stmtMember = $con->prepare($sqlMember);
            $stmtMember->execute([':user_id' => $idNouveauUser, ':role' => $role]);

            echo "[Succès] Le membre '$nom' a été ajouté à la bibliothèque avec succès !\n";

        } catch (PDOException $e) {
            echo "[Erreur] Impossible d'ajouter ce membre. (L'email existe peut-être déjà ?)\n";
        }
    }

public function deleteLivre ()
{
    echo "\n--- DELETE LIVRE ---\n";


    $isbn_id   = trim(readline("ISBN : "));



    if (empty($isbn_id)) {
        echo "[Erreur] L'ISBN sont obligatoires !\n";
        return;
    }

    try {
        $con = \DB::connect();
        $sql = "DELETE FROM books WHERE `books`.`isbn` = :isbn";

        $stmt = $con->prepare($sql);
        $stmt->execute([
            ':isbn'   => $isbn_id
        ]);

        echo "[Succès] Le livre  a été SUPREMER à la bibliothèque avec succès !\n";

    } catch (PDOException $e) {
        echo "[Erreur] Impossible SUPREMER ce livre. \n";
    }
}

    public function repareLivre ()
    {
        echo "\n--- REPARE LIVRE ---\n";


        $isbn_id   = trim(readline("ISBN : "));



        if (empty($isbn_id)) {
            echo "[Erreur] L'ISBN sont obligatoires !\n";
            return;
        }

        try {
            $con = \DB::connect();
            $sql = "UPDATE `books` SET `etat` = 'En reparation' WHERE `books`.`etat`= 'Disponible' AND `books`.`isbn` = :isbn";

            $stmt = $con->prepare($sql);
            $stmt->execute([
                ':isbn'   => $isbn_id
            ]);

            echo "[Succès] Le livre  a été REPARE à la bibliothèque avec succès !\n";

        } catch (PDOException $e) {
            echo "[Erreur] Impossible REPARE ce livre. \n";
        }
    }

    public function getAllBooks()
    {
        $con = \DB::connect();
        $sqlState =  $con->query("SELECT * FROM books");
        $books = $sqlState->fetchAll(\PDO::FETCH_OBJ);

        echo "\n===== BOOKS LIST =====\n";

        foreach ($books as $book) {
            echo "ID: {$book->isbn} | Title: {$book->titre} | Author: {$book->auteur} | Status: {$book->etat}\n";
        }
    }
}
