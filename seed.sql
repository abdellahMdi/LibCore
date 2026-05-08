USE LibCore ;
-- Users (members + librarians)
INSERT INTO users (nom, email) VALUES
('Alice Martin', 'alice@mail.com'),
('Bob Dupont', 'bob@mail.com'),
('Clara Benali', 'clara@mail.com'),
('David Rousseau', 'david@mail.com'),
('Emma Leclerc', 'emma@mail.com');

-- Members
INSERT INTO members (role, user_id) VALUES
('student', 1),
('student', 2),
('student', 3),
('teacher', 4);

-- Librarians
INSERT INTO librarians (id_lib, user_id) VALUES
(1, 5);

-- Books (mix of available and borrowed)
INSERT INTO books (isbn, titre, auteur, etat) VALUES
('isbn-112008', 'To Kill a Mockingbird', 'Harper Lee',       'disponible'),
('isbn-743234', '1984',                  'George Orwell',    'disponible'),
('isbn-028329', 'Of Mice and Men',       'John Steinbeck',   'disponible'),
('isbn-743273', 'Brave New World',       'Aldous Huxley',    'Emprunté'),
('isbn-070360', 'Le Petit Prince',       'Antoine de Saint', 'Emprunté'),
('isbn-060935', 'To Kill a Mockingbird', 'Harper Lee',       'disponible'),
('isbn-452284', 'Animal Farm',           'George Orwell',    'disponible');

-- Emprunts (active loans — no return_date, matching 'Emprunté' books)
INSERT INTO emprunts (borrowing_date, return_date, member_id, book_isbn) VALUES
('2026-04-10', NULL, 1, 'isbn-743273'),  -- Alice has Brave New World
('2026-04-15', NULL, 2, 'isbn-070360'),  -- Bob has Le Petit Prince
('2026-03-01', '2026-03-15', 3, 'isbn-452284'); -- Clara returned Mockingbird