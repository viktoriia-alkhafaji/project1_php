<?php
/**
 * login page template
 */

if (isset($_POST['submit'])) {
    $user = login($_POST['login'], $_POST['password']);
    if($user){
        // войти
        $user = $user[0];
        $hash = md5(generateCode(10));
        $ip = null;
        if(!empty($_POST['ip'])){
            // привязаться к ip
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        updateUser($user['id'],$hash,$ip);
    }
   // else {
        // неверный пользователь или пароль
     //   echo 'неверный пользователь или пароль';
    //}
}

?>

<h1>Логин</h1>
<form method="POST">
    Login:<input type="text" name="login" required><br>
    Password:<input type="text" name="password" required><br>
    Не прикреплять к IP: <input type="checkbox" name="ip"><br>
    <input type="submit" name="submit" value="Войти">
</form>