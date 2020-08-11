<?php session_start(); ?>

<?php


// PHP Mailer, send mails
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';
$mail = new PHPMailer();


// Effectuer ici la requête qui insère le message

try {
    $bdd = new PDO('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_cc256803d465131', 'bd60e8ee909b42', '2db04edd', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
};

$require = $bdd->prepare('INSERT INTO events(title, username, date, time, image , description, adresse, codepostal, ville, category) VALUES(:title, :username, :date, :time, :image , :description, :adresse, :codepostal, :ville, :category)');
$require->execute(array(
    'title' => $_POST['title'],
    'username' => $_SESSION['id'],
    'date' => $_POST['date'],
    'time' => $_POST['time'],
    'image' => $_POST['image'],
    'description' => $_POST['description'],
    'adresse' => $_POST['adresse'],
    'codepostal' => $_POST['codepostal'],
    'ville' => $_POST['ville'],
    'category' =>  $_POST['category']
));


// Send mail after creation

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
        $mail->Subject = "Thank you for registering on our website !";
        $content = "<b>Thank you for registering on our website !</b>";

        $mail->MsgHTML($content);
        $mail->send();


// Puis rediriger vers l'index.php comme ceci :
 header('Location: ../index.php');
?>