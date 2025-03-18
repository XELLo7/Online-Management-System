<?php
session_start();
include("connect.php");


if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}


$email = $_SESSION['email'];
$stmt = $conn->prepare("SELECT firstName, lastName FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $fullName = $row['firstName'] . " " . $row['lastName'];
} else {
    $fullName = "User  ";
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Management System</title>
    <link rel="stylesheet" href="homepage.css">
</head>
<body>

<header>
    <h1>Online Library Management System</h1>
    <div class="search-container">
        <form action="search.php" method="GET">
            <input type="text" name="query" placeholder="Search..." required>
            <button type="submit">Search</button>
        </form>
    </div>
</header>
    <div class="container">
        <aside class="sidebar">
            <h2>Menu</h2>
            <ul>
                <li><a href="add_book.php">Book Inventory</a></li>
                <li><a href="borrow_return.php">Borrow/Return</a></li>
                <li><a href="search.php">Search Functionality</a></li>
            </ul>
        </aside>
        <main class="content">
            <h2>Welcome to the Online Management System</h2>
            <p>This is your dashboard where you can manage books and users.</p>
            <!-- Additional content can go here -->
        </main>
    </div>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Your Website Name</p>
    </footer>
</body>
</html>