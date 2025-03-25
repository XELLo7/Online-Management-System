<?php
session_start();
include 'connect.php';

function borrowBook($bookId) {
    global $conn;
    $checkBookQuery = "SELECT * FROM books WHERE id = ? AND status = 'available' AND quantity > 0";
    $stmt = $conn->prepare($checkBookQuery);
    $stmt->bind_param("i", $bookId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $bookDetails = $result->fetch_assoc();
        $updateQuery = "UPDATE books SET status = 'borrowed', quantity = quantity - 1 WHERE id = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("i", $bookId);
        $updateStmt->execute();
        return "You have successfully borrowed the book: <b>" . htmlspecialchars($bookDetails['title']) . "</b> by <b>" . htmlspecialchars($bookDetails['author']) . "</b>.";
    } else {
        return "The book with ID: $bookId is not available for borrowing.";
    }
}

function returnBook($bookId) {
    global $conn;
    $checkReturnQuery = "SELECT * FROM books WHERE id = ? AND status = 'borrowed'";
    $stmt = $conn->prepare($checkReturnQuery);
    $stmt->bind_param("i", $bookId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $bookDetails = $result->fetch_assoc();
        $updateQuery = "UPDATE books SET status = 'available', quantity = quantity + 1 WHERE id = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("i", $bookId);
        $updateStmt->execute();
        return "You have successfully returned the book: <b>" . htmlspecialchars($bookDetails['title']) . "</b> by <b>" . htmlspecialchars($bookDetails['author']) . "</b>.";
    } else {
        return "The book with ID: $bookId is not currently borrowed.";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['borrow'])) {
        $bookId = $_POST['bookId'];
        $message = borrowBook($bookId);
    }

    if (isset($_POST['return'])) {
        $bookId = $_POST['returnBookId'];
        $message = returnBook($bookId);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrow and Return Books</title>
    <link rel="stylesheet" href="homepage.css">
</head>
<body>

<header class="main-header">
    <h1 class="title">Borrow and Return Books</h1>
</header>

<nav class="navbar">
    <ul>
        <li><a href="homepage.php">Browse</a></li>
        <li><a href="show-books.php">Show Books</a></li>
        <li><a href="borrow-return.php">Borrow/Return</a></li>
        <li><a href="my-account.php">My Account</a></li>
    </ul>
</nav>

<div class="container">
    <main class="content">
        <h2>Borrow a Book</h2>
        <form method="post" action="borrow-return.php">
            <div class="input-group">
                <label for="bookId">Book ID:</label>
                <input type="text" name="bookId" id="bookId" required>
            </div>
            <input type="submit" class="btn" name="borrow" value="Borrow Book">
        </form>

        <h2>Return a Book</h2>
        <form method="post" action="borrow-return.php">
            <div class="input-group">
                <label for="returnBookId">Book ID:</label>
                <input type="text" name="returnBookId" id="returnBookId" required>
            </div>
            <input type="submit" class="btn" name="return" value="Return Book">
        </form>

        <?php
        if (isset($message)) {
            echo "<p>$message</p>";
        }
        ?>
    </main>
</div>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Rexelle Azarraga</p> 
</footer>

</body>
</html>