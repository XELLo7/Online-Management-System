<?php
session_start();
include 'connect.php';

$searchResults = [];

if (isset($_GET['query'])) {
    $searchQuery = $_GET['query'];
    $stmt = $conn->prepare("SELECT * FROM books WHERE title LIKE ? AND status = 'available'");
    $searchTerm = "%" . $searchQuery . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $searchResults[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="homepage.css">
</head>
<body>

<header class="main-header">
    <h1 class="title">Search Results</h1>
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
        <h2>Search Results for "<?php echo htmlspecialchars($searchQuery); ?>"</h2>

        <?php if (count($searchResults) > 0): ?>
            <ul class="recommended-books-list">
                <?php foreach ($searchResults as $book): ?>
                    <li>
                        <h4><?php echo htmlspecialchars($book['title']); ?></h4>
                        <img src="img/<?php echo htmlspecialchars($book['image']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>">
                        <p>Author: <?php echo htmlspecialchars($book['author']); ?></p>
                        <p>Genre: <?php echo htmlspecialchars($book['genre']); ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No books found matching your search.</p>
        <?php endif; ?>
    </main>
</div>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Rexelle Azarraga</p> 
</footer>

</body>
</html>