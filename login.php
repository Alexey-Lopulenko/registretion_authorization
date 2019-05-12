<?php
require "db.php";

$data = $_POST;

if(isset($data['do_login'])){
    $errors = array();
    $user = R::findOne('users', 'login =?', array($data['login']));

    if( $user ){
        //логин существует, проверка пароля
        if( password_verify($data['password'], $user->password)){
            //пароль верный, логиним пользователя
            $_SESSION['logged_user'] = $user;

            echo '<div style="color: #68cd1f;"> Successful authorization! You can go to the 
            <a href="reg.php">main page </a></div><hr>';
        }
        else{
            $errors[] = 'Wrong password!';
        }
    }
    else{
        $errors[] = 'User with this name was not found!';
    }


    if(!empty($errors) ){

        echo '<div style="color: #cd0004;">' .array_shift($errors).'</div><hr>';
    }

}

?>

<form action="login.php" method="post">
    <p>
    <p><strong>логин :</strong>:</p>
    <input type="text" name="login" value="<?php echo @$data['login']; ?>">

    </p>
    <p><strong>пароль:</strong>:</p>
    <p><input type="password" name="password" value="<?php echo @$data['password']; ?>">
    </p>
    <p>

    <p><button type="submit" name="do_login">Войти</button>
    </p>







</form>
