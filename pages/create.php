<?php require_once('../assets/php/initialize.php') ?>
<?php $page_title = 'Create event' ?>
<?php require('../assets/php/header.php') ?>
<?php require('../assets/php/nav.php')?>

    <!-- IF NOT LOGGED, redirect to index.php-->
<?php if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
} else {
    $username = $_SESSION['username'];
} ?>

    <form action="create_post.php" method="post">
        <table>
            <tr>
                <td>
                    Title :
                </td>
                <td>
                    <input type="text" name="title" value="" /> <br/>
                </td>
            </tr>
            <tr class="hidden">
                <td>
                    Author :
                </td>
                <td>
                    <select name="username">
                        <option value="<?php echo $username ?>"><?php echo $username ?></option>
                    </select>
                    <br>
                </td>
            </tr>
            <tr>
                <td>
                    Date :
                </td>
                <td>
                    <input type="date" name="date"  /> <br/>
                </td>
            </tr>
            <tr>
                <td>
                    Hour :
                </td>
                <td>
                    <input type="time" name="time" /> <br/>
                </td>
            </tr>
            <tr>
                <td>
                    Image URL :
                </td>
                <td>
                    <input type="text" name="image" value="" /> <br/>
                </td>
            </tr>
            <tr>
                <td>
                    Description :
                </td>
                <td>
                    <input type="text" name="description" /> <br/>
                </td>
            </tr>
            <tr>
                <td>
                    Category :
                </td>
                <td>
                    <select name="category" required>
                        <?php
                        $categories = $bdd->query('SELECT * FROM `categories`');
                        while ($cats = $categories->fetch()) {
                            $catname = $cats['name'];
                            echo '<option value="' . $catname . '">' . $catname . '</option>';
                        } ?>
                    </select>
                    <br>
                </td>
            </tr>
            <tr>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    <input type="submit" value="Validate" />
                    <input type="button" value="Reset" Onclick="javascript:window.history.go(0)">
                </td>
            </tr>
        </table>
    </form>
     
<?php require('../assets/php/footer.php');
