<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

$email = $_SESSION['email'];
$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $newEmail = $_POST['email'];

    $updateQuery = "UPDATE users SET firstName='$firstName', lastName='$lastName', email='$newEmail' WHERE email='$email'";
    
    if ($conn->query($updateQuery) === TRUE) {
        if ($newEmail !== $email) {
            $_SESSION['email'] = $newEmail;
        }
        echo "Profile updated successfully!";
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <link rel="stylesheet" href="homepage.css">
</head>
<body>

<header class="main-header">
    <h1 class="title">My Account</h1>
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
        <h2>Welcome, <?php echo htmlspecialchars($user['firstName']); ?>!</h2>
        <form method="post" action="my-account.php">
            <div class="input-group">
                <label for="fName">First Name:</label>
                <input type="text" name="fName" id="fName" value="<?php echo htmlspecialchars($user['firstName']); ?>" required>
            </div>
            <div class="input-group">
                <label for="lName">Last Name:</label>
                <input type="text" name="lName" id="lName" value="<?php echo htmlspecialchars($user['lastName']); ?>" required>
            </div>
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <input type="submit" class="btn" value="Update Profile">
        </form>
    </main>
</div>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Rexelle Azarraga</p> 
</footer>

</body>
</html>