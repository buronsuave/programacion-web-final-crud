CREATE TABLE UserTypes 
(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL
);

CREATE TABLE Users 
(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    name VARCHAR(30) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    idUserType INT(6) UNSIGNED, 
    FOREIGN KEY (idUserType) REFERENCES UserTypes(id)
);

CREATE TABLE Categories
(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL
);

CREATE TABLE Products
(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    price INT(6) NOT NULL,
    stock INT(6) NOT NULL,
    idCategory INT(6) UNSIGNED, 
    FOREIGN KEY (idCategory) REFERENCES Categories(id)
);

INSERT INTO UserTypes (name) VALUES ('admin');
INSERT INTO UserTypes (name) VALUES ('client');
INSERT INTO UserTypes (name) VALUES ('programmer');
INSERT INTO UserTypes (name) VALUES ('storer');

INSERT INTO Users (username, name, lastName, idUserType) VALUES ('buronsuave', 'David', 'Lopez', 1);
INSERT INTO Users (username, name, lastName, idUserType) VALUES ('dtejedas', 'Daniel', 'Tejeda', 1);
INSERT INTO Users (username, name, lastName, idUserType) VALUES ('sergio_ruzza', 'Sergio', 'Ruiz', 2);
INSERT INTO Users (username, name, lastName, idUserType) VALUES ('nintendero', 'Andres', 'Huerta', 2);
INSERT INTO Users (username, name, lastName, idUserType) VALUES ('alanlop', 'Alan', 'Lopez', 3);
INSERT INTO Users (username, name, lastName, idUserType) VALUES ('mcclovyn', 'Marco', 'Galindo', 4);
INSERT INTO Users (username, name, lastName, idUserType) VALUES ('andy', 'Andrea', 'Barrera', 4);

INSERT INTO Categories (name) VALUES ('videogame');
INSERT INTO Categories (name) VALUES ('jigsaw');
INSERT INTO Categories (name) VALUES ('boardgame');
INSERT INTO Categories (name) VALUES ('cube');

INSERT INTO Products (name, price, stock, idCategory) VALUES ('Rubik 3x3 Cube', 100, 100, 4);
INSERT INTO Products (name, price, stock, idCategory) VALUES ('Helicopter Cube', 300, 20, 4);
INSERT INTO Products (name, price, stock, idCategory) VALUES ('Rubik 4x4 Cube', 200, 50, 4);
INSERT INTO Products (name, price, stock, idCategory) VALUES ('Portal', 300, 50, 1);
INSERT INTO Products (name, price, stock, idCategory) VALUES ('Portal 2', 300, 50, 1);
INSERT INTO Products (name, price, stock, idCategory) VALUES ('The Golden Girls Jigsaw', 500, 20, 2);
INSERT INTO Products (name, price, stock, idCategory) VALUES ('Majestic Park Puzzle', 500, 20, 2);
INSERT INTO Products (name, price, stock, idCategory) VALUES ('Clue', 250, 100, 3);
INSERT INTO Products (name, price, stock, idCategory) VALUES ('Monopoly', 300, 100, 3);
INSERT INTO Products (name, price, stock, idCategory) VALUES ('Scrabble', 350, 40, 3);
INSERT INTO Products (name, price, stock, idCategory) VALUES ('Battleship', 400, 30, 3);
INSERT INTO Products (name, price, stock, idCategory) VALUES ('Risk', 500, 20, 3);
