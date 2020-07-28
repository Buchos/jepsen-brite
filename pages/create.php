<?php require_once('../assets/php/initialize.php') ?>
<?php $page_title = 'Create user' ?>
<?php require('../assets/php/header.php') ?>
<?php require('../assets/php/nav.php')?>
 
<form action="create_post.php" method="post">

<table>
<tr>
    <td>
        Titre de l'évènement :
    </td>
    <td>
        <input type="text" name="title" value="" /> <br/>
    </td>
</tr>
<tr>
    <td>
        Créateur de l'évènement :
    </td>
    <td>
        <input type="text" name="author" value="" /> <br/>
    </td>
</tr>
<tr>
    <td>
        Date de l'évènement :
    </td>
    <td>
        <input type="date" name="date"  /> <br/>
    </td>
</tr>
<tr>
    <td>
        Heure de l'évènement :
    </td>
    <td>
        <input type="time" name="time" /> <br/>
    </td>
</tr>
<tr>
    <td>
        Image de l'évènement :
        </td>
        <td>
        <input type="text" name="image" value="" /> <br/>
    </td>
</tr>
<tr>
    <td>
        Description de l'évènement :
        </td>
        <td>
        <input type="text" name="description" /> <br/>
    </td>
</tr>
<tr>
    <td>
        Catégorie de l'évènement :
        </td>
        <td>
        <input type="text" name="category" value="" /> <br/>
    </td>
</tr>
<tr>
</tr>
<tr>
    <td>
    </td>
    <td>
        <input type="submit" value="Valider" />
        <input type="button" value="Reset" Onclick="javascript:window.history.go(0)">
    </td>
</tr>
</table>
</form>

<br>
</p>
 
<?php require('../assets/php/footer.php');
