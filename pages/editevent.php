<?php require_once('../assets/php/initialize.php') ?>
<?php $page_title = 'Categories' ?>
<?php require(PHP . '/header.php') ?>
<?php require(PHP . '/nav.php')?>
<?php
// PHP Mailer, send mails
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';
$mail = new PHPMailer();
?>

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
            Image / Video URL (for youtube copy link from "share" submenu) :
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




// Send mail after modification

$mail->IsSMTP();
        $mail->Mailer = "smtp";
        //$mail->SMTPDebug  = 1;
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = "tls";
        $mail->Port       = 587;
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = "bryanrasamizafy98@gmail.com";
        $mail->Password   = "apzoeiruty135";

        $mail->IsHTML(true);
        $mail->AddAddress($_SESSION['mail'], $_SESSION['username']);
        $mail->SetFrom("bryanrasamizafy98@gmail.com", "JEPSEN-BRITE");
        $mail->AddReplyTo("rasamizafybryan98@gmail.com", "J-B's community manager");
        $mail->AddCC("cc-recipient-email@domain", "cc-recipient-name");
        $mail->Subject = "You edited your event successfully";
        $content = "<b>Thank you for registering on our website !</b>";

        $mail->MsgHTML($content);
        $mail->send();
    } else {
        header('Location: ../index.php');
    }
} else {
    header('Location: ../index.php');
} ?>

<?php require('../assets/php/footer.php');
