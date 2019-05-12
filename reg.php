<?php
require  "db.php";
?>

<?php if(isset($_SESSION['logged_user'])) : ?>
Authorized!<br>
Hello, <?php echo $_SESSION['logged_user']->login; ?>
<hr>
<a href="logout.php">Exit</a>

<?php else : ?>
<table border="1" , bgcolor="#f0f8ff">
    <tr>
        <td>
    <a href ="login.php">Авторизоваться</a><br>
        </td>
        <tr>
        <td>
    <a href ="signup.php">Регистрация</a>
        </td>
    </tr>
    </tr>
</table>
<?php endif; ?>

