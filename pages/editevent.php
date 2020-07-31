<?php require_once('../assets/php/initialize.php') ?>
<?php
if (isset($_SESSION['id'])) {
    $reqevent = $bdd->prepare("SELECT * FROM events WHERE id = ?");
    $reqevent->execute(array($_POST['id']));
    $event = $reqevent->fetch();
    if (isset($_POST['newtitle']) and !empty($_POST['newtitle']) and $_POST['newtitle'] != $event['title']) {
        $newtitle = htmlspecialchars($_POST['newtitle']);
        $inserttitle = $bdd->prepare("UPDATE events SET title = ? WHERE id = ?");
        $inserttitle->execute(array($newtitle, $_POST['id']));
        header('Location: event.php?id='.$_POST['id']);
    }
   
    if (isset($_POST['newdate']) and !empty($_POST['newdate']) and $_POST['newdate'] != $event['date']) {
        $newdate = htmlspecialchars($_POST['newdate']);
        $insertdate = $bdd->prepare("UPDATE events SET date = ? WHERE id = ?");
        $insertdate->execute(array($newdate, $_POST['id']));
        header('Location: event.php?id='.$_POST['id']);
    }
    
    if (isset($_POST['newtime']) and !empty($_POST['newtime']) and $_POST['newtime'] != $event['time']) {
        $newtime = htmlspecialchars($_POST['newtime']);
        $inserttime = $bdd->prepare("UPDATE events SET time = ? WHERE id = ?");
        $inserttime->execute(array($newtime, $_POST['id']));
        header('Location: event.php?id='.$_POST['id']);
    }

    if (isset($_POST['newimage']) and !empty($_POST['newimage']) and $_POST['newimage'] != $event['image']) {
        $newimage = htmlspecialchars($_POST['newimage']);
        $insertimage = $bdd->prepare("UPDATE events SET image = ? WHERE id = ?");
        $insertimage->execute(array($newimage, $_POST['id']));
        header('Location: event.php?id='.$_POST['id']);
    }

    if (isset($_POST['newdescription']) and !empty($_POST['newdescription']) and $_POST['newdescription'] != $event['description']) {
        $newdescription = htmlspecialchars($_POST['newdescription']);
        $insertdescription = $bdd->prepare("UPDATE events SET description = ? WHERE id = ?");
        $insertdescription->execute(array($newdescription, $_POST['id']));
        header('Location: event.php?id='.$_POST['id']);
    }

    if (isset($_POST['newcategory']) and !empty($_POST['newcategory']) and $_POST['newcategory'] != $event['category']) {
        $newcategory = htmlspecialchars($_POST['newcategory']);
        $insertcategory = $bdd->prepare("UPDATE events SET category = ? WHERE id = ?");
        $insertcategory->execute(array($newcategory, $_POST['id']));
        header('Location: event.php?id='.$_POST['id']);
    } ?>
<?php $page_title = 'Edit Your Event' ?>
<?php require('../assets/php/header.php') ?>
<?php require('../assets/php/nav.php')?>

      <div align="center">
         <h2>Edition de mon profil</h2>
         <div align="left">
            <form method="POST" action="" enctype="multipart/form-data">
            <label>event title :</label>
               <input type="text" name="newtitle" placeholder="event title" value="<?php echo $event['title']; ?>" /><br /><br />
               <label>event date :</label>
               <input type="date" name="newdate" placeholder="event date" value="<?php echo $event['date']; ?>" /><br /><br />
               <label>event tie :</label>
               <input type="time" name="newtime" placeholder="event time" value="<?php echo $event['time']; ?>" /><br /><br />
               <label>Image :</label>
               <input type="text" name="image" placeholder="image url ?" value="<?php echo $event['image']; ?>"/><br /><br />
               <label>Category :</label>
               <input type="text" name="category" placeholder="categories" value="<?php echo $event['category']; ?>"/><br /><br />
               <input type="submit" value="Update my event !" />
            </form>
            <?php if (isset($msg)) {
        echo $msg;
    } ?>
         </div>
      </div>
      <?php require('../assets/php/footer.php'); ?>
<?php
} else {
        header("Location: login.php");
    }
?>