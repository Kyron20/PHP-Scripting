<?php
session_start();

if (!isset($_SESSION['basket'])) {
    $_SESSION['basket'] = array();
}

// Connect to database
$host = "dragon.kent.ac.uk";
$user = "comp6390";
$password = "mesohn6";
$database = "comp6390";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the books in the basket
$basket = array();

foreach ($_SESSION['basket'] as $book_id) {
    $sql = "SELECT * FROM books WHERE id=$book_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $book = array(
            'id' => $row['id'],
            'title' => $row['title'],
            'author' => $row['author'],
            'price' => $row['price']
        );

        array_push($basket, $book);
    }
}

// Display the basket
echo "<h1>Your Basket</h1>";

if (count($basket) == 0) {
    echo "<p>Your basket is empty.</p>";
} else {
    echo "<table>";
    echo "<tr><th>Title</th><th>Author</th><th>Price</th></tr>";

    foreach ($basket as $book) {
        echo "<tr>";
        echo "<td>" . $book['title'] . "</td>";
        echo "<td>" . $book['author'] . "</td>";
        echo "<td>£" . $book['price'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
}

mysqli_close($conn);
?>
<br>
<a href="ans6.php">Return Page</a>
