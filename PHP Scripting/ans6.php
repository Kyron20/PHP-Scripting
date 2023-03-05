<?php
session_start();

ob_start();
// Connect to database
$host = "dragon.kent.ac.uk";
$user = "comp6390";
$password = "mesohn6";
$database = "comp6390";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Checks the add basket form has been submitted
if (isset($_POST['add'])) {
    // Get the book IDs from the form
     if(isset($_POST['books'])) {
    $books = $_POST['books'];

    // Add the selected books to the basket
    if (isset($_SESSION['basket'])) {
        $_SESSION['basket'] = array_merge($_SESSION['basket'], $books);
    } else {
        $_SESSION['basket'] = $books;
    }
}
}

// Checks if empty basket has been clicked.
if (isset($_POST['empty'])) {
    // Clears the basket
    unset($_SESSION['basket']);
}

// Get the number of items in the basket. We initially set it to 0 as nothing as been made.
$numItems = 0;

if (isset($_SESSION['basket'])) {
    $numItems = count($_SESSION['basket']);
}

// Displays the books. We use php to echo the table in with the connection established earlier with MYSQL.
$sql = "SELECT * FROM books";
$result = mysqli_query($conn, $sql);

echo "<form method='post'>";
echo "<input type='submit' name='add' value='Add to Basket'>";
echo "&nbsp;&nbsp;&nbsp;";
echo "<input type='submit' name='viewbasket' value='View Basket'>";
echo "&nbsp;&nbsp;&nbsp;";
echo "<input type='submit' name='empty' value='Empty Basket'>";
echo "<br><br>";

echo "<table border='1'>";
echo "<tr><th>Title</th><th>Author</th><th>Price</th><th>Rating</th><th>Description</th><th>Cover</th><th>Add to Basket</th></tr>";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $title = $row['title'];
        $author = $row['author'];
        $price = $row['price'];
        $rating = $row['rating'];
        $description = $row['description'];
        $cover = base64_encode($row['cover']);

        echo "<tr>";
        echo "<td>$title</td><td>$author</td><td>£$price</td><td>$rating</td><td>$description</td><td><img src='data:image/jpeg;base64,$cover' width='100'></td>";
        echo "<td><input type='checkbox' name='books[]' value='$id'></td>";
        echo "</tr>";
    }
}

echo "</form>";
echo "<br>";
echo "You have $numItems items in your basket.";
echo "</table>";

// view basket button to post to an new page.
if (isset($_POST['viewbasket'])) {
    header("Location: view_basket.php");
    exit;

}

mysqli_close($conn);
?>
