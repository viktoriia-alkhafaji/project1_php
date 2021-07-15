<?php

/**
 * register page template
 */
if (isset($_POST['submit'])) {
    $err = [];

    if (strlen($_POST['login']) < 4 or strlen($_POST['login']) > 30) {
        $err[] = "Логин не меньше 4 и не больше 30";
    }
    if (isLoginExist($_POST['login'])) {
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

require_once 'header.php';
?>


<div class="content pure-u-1 pure-u-md-3-4">
    <h1>Регистрация</h1>

    <form method="POST" class="pure-form pure-form-aligned">
    <fieldset>
        <div class="pure-control-group">
            <label for="aligned-name">Login or Username</label>
            <input type="text" id="aligned-name" placeholder="Username" name="login" required />
            <span class="pure-form-message-inline">This is a required field.</span>
        </div>
        <div class="pure-control-group">
            <label for="aligned-password">Password</label>
            <input type="password" id="aligned-password" placeholder="Password" name="password" required />
            <span class="pure-form-message-inline">This is a required field.</span>
        </div>
        <div class="pure-controls">
            <button type="submit" name="submit" class="pure-button pure-button-primary">Anmelden</button>
        </div>
    </fieldset>
</form>



    <?php

if (isset($_POST['submit'])) {
    $err = [];
    if (strlen($_POST['login']) < 4 or strlen($_POST['login']) > 30) {
        $err[] = "Логин не меньше 4 и не больше 30";
    }
    if (isLoginExist($_POST['login'])) {
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
        echo '<div>Уже зарегистрированы? <a href="/login">Login</a></div>';
    }
}

    require_once 'footer.php'; ?>
</div>
</div>
</div><!-- layout end -->