<?php
// GET NUMBER OF EVENTS FOR EACH CATEGORY
$categories = $bdd->query('SELECT * FROM `categories`');
while ($cats = $categories->fetch()) {
    $catname = $cats['name'];
    $catcount = $bdd->prepare('SELECT COUNT(*) AS catcount FROM `events` WHERE `category`= ? AND `date` >= ? AND `deleted` = 0');
    $catcount->execute(array($catname, $today));
    $numbofcat = $catcount->fetch();
    // CREATE A VARIABLE FOR EACH CATEGORY
    ${'numbof' . $catname} = $numbofcat[0];
}
?>
        <nav>
            <a href="http://becode.local/jepsen-brite/">Home</a>
            <div class="dropdown">
                <button class="dropbtn">Categories</button>
                <div class="dropdown-content">
                    <a href="<?php echo $stupidroot;?>pages/categories.php?category=birthday">birthday - (<?php echo $numbofbirthday; ?>)</a>
                    <a href="<?php echo $stupidroot;?>pages/categories.php?category=cinema">cinema - (<?php echo $numbofcinema; ?>)</a>
                    <a href="<?php echo $stupidroot;?>pages/categories.php?category=concert">concert - (<?php echo $numbofconcert; ?>)</a>
                    <a href="<?php echo $stupidroot;?>pages/categories.php?category=conference">conference - (<?php echo $numbofconference; ?>)</a>
                    <a href="<?php echo $stupidroot;?>pages/categories.php?category=culture">culture - (<?php echo $numbofculture; ?>)</a>
                    <a href="<?php echo $stupidroot;?>pages/categories.php?category=dance">dance - (<?php echo $numbofdance; ?>)</a>
                    <a href="<?php echo $stupidroot;?>pages/categories.php?category=exhibition">exhibition - (<?php echo $numbofexhibition; ?>)</a>
                    <a href="<?php echo $stupidroot;?>pages/categories.php?category=meetup">meetup - (<?php echo $numbofmeetup; ?>)</a>
                    <a href="<?php echo $stupidroot;?>pages/categories.php?category=sport">sport - (<?php echo $numbofsport; ?>)</a>
                    <a href="<?php echo $stupidroot;?>pages/categories.php?category=other">other - (<?php echo $numbofother; ?>)</a>
                </div>
            </div>
            <a href="http://becode.local/jepsen-brite/pages/past.php">Past Events</a>
            <a href="http://becode.local/jepsen-brite/pages/login.php">LOGIN</a>
        </nav>
        <section class="main-grid">