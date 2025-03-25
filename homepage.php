<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Library Management System</title>
    <link rel="stylesheet" href="homepage.css">
</head>
<body>

<header class="main-header" role="banner">
    <h1 class="title">
        <a href="homepage.php" style="color: white; text-decoration: none;">Online Library Management System</a>
    </h1>
    <div class="logout-container">
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</header>

<nav class="navbar" role="navigation">
    <ul>
        <li><a href="homepage.php">Browse</a></li>
        <li><a href="show-books.php">Show Books</a></li>
        <li><a href="borrow-return.php">Borrow/Return</a></li>
        <li><a href="my-account.php">My Account</a></li>
    </ul>
    <div class="search-container">
        <form action="search.php" method="GET" role="search">
            <input type="text" name="query" placeholder="Search..." required aria-label="Search books">
            <button type="submit">Search</button>
        </form>
    </div>
</nav>

<div class="container">
    <main class="content" role="main">
        <h2>Welcome to Online Library Management System</h2>
        <section class="featured-books">
            <h3>Featured Books</h3>
            <ul class="featured-books-list">
                <li>
                    <h4>The Great Gatsby</h4>
                    <img src="img/the_great_gatsby.webp" alt="Cover of The Great Gatsby">
                    <p>Author: F. Scott Fitzgerald</p>
                    <p>Genre: Fiction</p>
                </li>
                <li>
                    <h4>1984</h4>
                    <img src="img/1984.jpg" alt="Cover of 1984">
                    <p>Author: George Orwell</p>
                    <p>Genre: Dystopian</p>
                </li>
                <li>
                    <h4>To Kill a Mockingbird</h4>
                    <img src="img/to_kill_a_mockingbird.jpg" alt="Cover of To Kill a Mockingbird">
                    <p>Author: Harper Lee</p>
                    <p>Genre: Fiction</p>
                </li>
                <li class="hidden">
                    <h4>The Catcher in the Rye</h4>
                    <img src="img/the_catcher_in_the_rye.jpg" alt="Cover of The Catcher in the Rye">
                    <p>Author: J.D. Salinger</p>
                </li>
                <li class="hidden">
                    <h4>The Alchemist</h4>
                    <img src="img/the_alchemist.jpg" alt="Cover of The Alchemist">
                    <p>Author: Paulo Coelho</p>
                </li>
            </ul>
            <button class="show-more" onclick="showMore('featured-books')">Show More</button>
        </section>
        <section class="new-arrivals">
            <h3>New Arrivals</h3>
            <ul>
                <li>
                    <h4>Becoming</h4>
                    <img src="img/becoming.jpg" alt="Cover of Becoming">
                    <p>Author: Michelle Obama</p>
                    <p>Genre: Biography</p>
                </li>
                <li>
                    <h4>The Silent Patient</h4>
                    <img src="img/the_silent_partient.jpg" alt="Cover of The Silent Patient">
                    <p>Author: Alex Michaelides</p>
                    <p>Genre: Thriller</p>
                </li>
                <li>
                    <h4>Educated</h4>
                    <img src="img/educated.jpg" alt="Cover of Educated">
                    <p>Author: Tara Westover</p>
                    <p>Genre: Memoir</p>
                </li>
                <li class="hidden">
                    <h4>Where the Crawdads Sing</h4>
                    <img src="img/where_the_crawdads_sing.jpg" alt="Cover of Where the Crawdads Sing">
                    <p>Author: Delia Owens</p>
                </li>
                <li class="hidden">
                    <h4>The Vanishing Half</h4>
                    <img src="img/the_vanishing_half.jpg" alt="Cover of The Vanishing Half">
                    <p>Author: Brit Bennett</p>
                </li>
            </ul>
            <button class="show-more" onclick="showMore('new-arrivals')">Show More</button>
        </section>
        <section class="user-recommendations">
            <h3>Your Recommendations</h3>
            <p>Based on your reading history, we recommend the following books:</p>
            <ul>
                <li>
                    <h4>The Catcher in the Rye</h4>
                    <img src="img/the_catcher_in_the_rye.jpg" alt="Cover of The Catcher in the Rye">
                    <p>Author: J.D. Salinger</p>
                </li>
                <li>
                    <h4>The Alchemist</h4>
                    <img src="img/the_alchemist.jpg" alt="Cover of The Alchemist">
                    <p>Author: Paulo Coelho</p>
                </li>
                <li>
                    <h4>The Book Thief</h4>
                    <img src="img/the_book_thief.jpg" alt="Cover of The Book Thief">
                    <p>Author: Markus Zusak</p>
                </li>
                <li class="hidden">
                    <h4>Little Fires Everywhere</h4>
                    <img src="img/little_fires_everywhere.jpg" alt="Cover of Little Fires Everywhere">
                    <p>Author: Celeste Ng</p>
                </li>
                <li class="hidden">
                    <h4>The Night Circus</h4>
                    <img src="img/the_night_circus.jpg" alt="Cover of The Night Circus">
                    <p>Author: Erin Morgenstern</p>
                </li>
            </ul>
            <button class="show-more" onclick="showMore('user-recommendations')">Show More</button>
        </section>
    </main>
</div>

<footer role="contentinfo">
    <p>&copy; <?php echo date("Y"); ?> Rexelle Azarraga</p> 
</footer>

<script src="script.js"></script>
<script>
    function showMore(section) {
        const hiddenItems = document.querySelectorAll(`.${section} .hidden`);
        hiddenItems.forEach(item => {
            item.style.display = 'block';
            item.classList.remove('hidden');
        });
        if (document.querySelectorAll(`.${section} .hidden`).length === 0) {
            document.querySelector(`.${section} .show-more`).style.display = 'none';
        }
    }
</script>
</body>
</html>