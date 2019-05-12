<?php
require "db.php";

$data = $_POST;
if(isset($data['do_signup'])) {
    //регистрация

    $errors = array();
    if(trim($data['login']) == ''){
        $errors[] = 'Enter login!';
    }

    if(trim($data['email']) == ''){
        $errors[] = 'Enter E-mail!';
    }

    if($data['password'] == ''){
        $errors[] = 'Enter password!';
    }
    if($data['password_2'] != $data['password']){
        $errors[] = 'Passwords do not match!';
    }
    if(R::count('users', "login = ?", array($data['login'])) > 0){
        $errors[] = 'Such login already exists!';
    }
    if(R::count('users', "email = ?", array($data['email'])) > 0){
        $errors[] = 'User with this email already exists!';
    }

    if(empty($errors) ){
        //всё хорошо, регистрация
        $user = R::dispense('users');
        $user->login = $data['login'];
        $user->email = $data['email'];
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        R::store($user);
        echo '<div style="color: #68cd1f;"> Registration successful!</div><hr>';

    }
    else {
        echo '<div style="color: #cd0004;">' .array_shift($errors).'</div><hr>';
    }
}


?>

<form action="signup.php" method="POST">

    <p>
    <p><strong>Ваш логин</strong>:</p>
    <input type="text" name="login" value="<?php echo @$data['login']; ?>">

</p>

    <p>
    <p><strong>Ваш Email</strong>:</p>
    <input type="email" name="email" value="<?php echo @$data['email']; ?>">

    </p>



    <p><strong>Введите ваш пароль:</strong>:</p>
    <p><input type="password" name="password" value="<?php echo @$data['password']; ?>">
    </p>

    <p>
    <p><strong>Повторите пароль:</strong>:</p>

    <p>
    <input type="password" name="password_2" value="<?php echo @$data['password_2']; ?>">
    </p>

    <p><button type="submit" name="do_signup">Зарегестрироваться</button>
    </p>

</form>
