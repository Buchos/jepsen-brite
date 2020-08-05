<?php require_once('../assets/php/initialize.php') ?>
<?php $page_title = 'Categories' ?>
<?php require(PHP . '/header.php') ?>
<?php require(PHP . '/nav.php')?>

<?php if (isset($_SESSION['id'])) {
    if (isset($_POST['edit_id'])) {
        $response = $bdd->prepare('SELECT * FROM `events` WHERE `id` = ?');
        $response->execute(array($_POST['edit_id']));
        $data = $response->fetch(); ?>
        <form action="editeventdb.php" method="POST">
            <!-- ID-->
            <input type="text" name="id" class="hidden" value="<?php echo $_POST['edit_id']; ?>">
            Title:
            <input type="text" name="title" value="<?php echo($data['title']) ?>"> <br>
            <!--        Author-->
            <input type="text" name="username" class="hidden" value="<?php echo($data['username']) ?>"> <br>
            Date
            <input type="date" name="date" value="<?php echo($data['date']) ?>"> <br>
            Hour
            <input type="time" name="time" value="<?php echo($data['time']) ?>"> <br>
            Image
            <input type="text" name="image" value="<?php echo($data['image']) ?>"> <br>
            Description
            <input type="text" name="description" value="<?php echo($data['description']) ?>"> <br>
            Adress
            <input type="text" name="adresse" value="<?php echo($data['adresse']) ?>"> <br>
            Postal Code
            <input type="text" name="codepostal" value="<?php echo($data['codepostal']) ?>"> <br>
            Town
            <input type="text" name="ville" value="<?php echo($data['ville']) ?>"> <br>
            Category
            <select name="category" required>
                        <?php
                        $categories = $bdd->query('SELECT * FROM `categories`');
        while ($cats = $categories->fetch()) {
            $catname = $cats['name'];
            echo '<option value="' . $catname . '">' . $catname . '</option>';
        } ?>
                    </select> <br>
            <input type="submit" value="Update Event">
        </form>
        <?php
    } else {
        header('Location: ../index.php');
    }
} else {
    header('Location: ../index.php');
} ?>

<?php require('../assets/php/footer.php');
