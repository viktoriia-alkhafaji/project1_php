<?php
/**
 * register page template
 */
if (isset($_POST['submit'])) {
    $err = [];
    if (strlen($_POST['login']) < 4 or strlen($_POST['login']) > 30) {
        $err[] = "Логин не меньше 4 и не больше 30";
    }
    if ( isLoginExist($_POST['login'])) {
        $err[] = "Логин уже существует";
    }
    if (count($err) === 0) {
        createUser($_POST['login'], $_POST['password']);
        header('Location: /login');
        exit();
    } else {
        echo '<h4>Ошибки регистрации: </h4>';
        foreach ($err as $error) {
            echo $error . '<br>';
        }
    }
}
?>
<h1>Регистрация</h1>
<form method="POST">
    <label for="login">Login:</label> <input id="login" type="text" name="login" required>
    <label for="pass">Password: </label> <input id="pass" type="text" name="password" required>
    <input type="submit" name="submit" value="Регистрация">
</form>