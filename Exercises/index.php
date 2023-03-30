<!-- Let's create a simple example using a Book class and a BookDAO class for managing books in a library.

    Create a Book class with the following properties:
        id
        title
        author
        genre

    Create a BookDAO class with the following methods:
        __construct(): Initializes the database connection.
        connect(): Sets up the PDO connection to the database.
        fetch(): Retrieves a book by its ID.
        fetchAll(): Retrieves all books.
        create(): Creates a new book object using data from the database.
        store(): Inserts a new book into the database.
        destroy(): Deletes a book from the database.
        where(): Retrieves books based on a specific attribute and value.
        first(): Retrieves the first book with a specific attribute and value.

    The table structure for the books table is as follows:

  CREATE TABLE `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4; -->

<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require("Models/Dao/DaoBook.php");
require("Models/Entities/Book.php");

$book1 = new Book(false, "voyage au centre de la terre", "Julles Verne", "Aventure");
//echo "test";
$daoBook = new DaoBook();
//var_dump($daoBook->fetch(1));
//$daoBook->store($book1);
//var_dump($daoBook->fetch_all());

//$daoBook->destroy(3);

//$daoBook->where("genre", "Horreur");
echo "<pre>";
print_r($daoBook->fetch_all());
echo "</pre>";

// echo "<pre>";
// print_r($daoBook->where("genre", "Horreur"));
// echo "</pre>";


echo "<pre>";
print_r($daoBook->first("genre", "Fantasy"));
echo "</pre>";
?>
