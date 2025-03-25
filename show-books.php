<?php
session_start();
include 'connect.php';

$sql = "SELECT * FROM books";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Books</title>
    <link rel="stylesheet" href="homepage.css">
</head>
<body>

<header class="main-header">
    <h1 class="title">Available Books</h1>
    <div class="logout-container">
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
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
        <h2>List of Books</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                            <td><?php echo htmlspecialchars($row['author']); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                            <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No books available.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</div>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Rexelle Azarraga</p> 
</footer>

</body>
</html>