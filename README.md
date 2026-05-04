```mermaid
classDiagram
    %% Les Relations
    User <|-- Librarian : Héritage
    User <|-- Member : Héritage
    Member <|-- Student : Héritage
    Member <|-- Teacher : Héritage
    Library o-- Book : Contient (Composition)
    Library o-- User : Contient (Composition)
    Member o-- Book : Emprunte (Association)

    %% Classe Système (Le Chef d'Orchestre)
    class Library {
        - array books
        - array users
        + addBook(b: Book) void
        + registerMember(u: User) void
        + borrowBook(m: Member, b: Book) bool
        + returnBook(m: Member, b: Book) void
        + displayBooks() array
        + searchBook(keyword: string) array
        + removeBook(b: Book) void
    }

    %% Classe Abstraite Mère
    class User {
        <<abstract>>
        # string name
        # string email
        + getName() string
        + getEmail() string
    }

    %% L'Admin (Ton rôle)
    class Librarian {
        + markAsRepair(b: Book) void
    }

    %% Le Client Mère
    class Member {
        # array borrowedBooks
        # int maxBooksLimit
        + getBorrowedBooks() array
        + canBorrow() bool
    }

    %% Les Sous-classes (Bonus)
    class Student {
        - maxBooksLimit = 3
    }

    class Teacher {
        - maxBooksLimit = 10
    }

    %% L'Entité Livre
    class Book {
        - string title
        - string author
        - string isbn
        - string status 
        - bool isAvailable
        + getTitle() string
        + getAuthor() string
        + getIsbn() string
        + isAvailable() bool
        + setStatus(status: string) void
        + setAvailable(state: bool) void
    }