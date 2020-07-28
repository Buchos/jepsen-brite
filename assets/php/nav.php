        <nav>
            <a href="<?php echo $stupidroot?>">Home</a>
            <div class="dropdown">
                <button class="dropbtn">Categories</button>
                <div class="dropdown-content">
                    <a href="<?php echo $stupidroot;?>pages/categories.php?category=birthday">birthday</a>
                    <a href="<?php echo $stupidroot;?>pages/categories.php?category=cinema">cinema</a>
                    <a href="<?php echo $stupidroot;?>pages/categories.php?category=concert">concert</a>
                    <a href="<?php echo $stupidroot;?>pages/categories.php?category=conference">conference</a>
                    <a href="<?php echo $stupidroot;?>pages/categories.php?category=culture">culture</a>
                    <a href="<?php echo $stupidroot;?>pages/categories.php?category=dance">dance</a>
                    <a href="<?php echo $stupidroot;?>pages/categories.php?category=exhibition">exhibition</a>
                    <a href="<?php echo $stupidroot;?>pages/categories.php?category=meetup">meetup</a>
                    <a href="<?php echo $stupidroot;?>pages/categories.php?category=sport">sport</a>
                    <a href="<?php echo $stupidroot;?>pages/categories.php?category=other">other</a>
                </div>
            </div>
            <a href="<?php echo $stupidroot?>pages/past.php">Past Events</a>
            <a href="<?php echo $stupidroot?>pages/login.php">Log In</a>
            <a href="<?php echo $stupidroot?>pages/new_user.php">SIGN UP</a>
            <a href="<?php echo $stupidroot?>pages/profile.php?id="<?php $_SESSION['id'];?>">Your Profile</a>
            <a href="<?php echo $stupidroot?>pages/create.php">Create New Event</a>
        </nav>
        <section class="main-grid">
