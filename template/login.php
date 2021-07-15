<?php
/**
 * login page template
 */
$out = '';
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
                setcookie('id', $user['id'], time()+60*60*24*30, '/');
                setcookie('hash', $hash, time()+60*60*24*30, '/');
                header("Location: /admin");
                exit();
            }
            else {
                $out = '<div class="message warning">Hеверный пользователь или пароль.</div>';
            }
        }
require_once 'header.php';
?>

<div class="content pure-u-1 pure-u-md-3-4">

    <h1>Login</h1>
    <form method="POST" class="pure-form pure-form-aligned">
        <fieldset>
            <div class="pure-control-group">
                <label for="aligned-name">Login</label>
                <input type="text" id="aligned-name" name="login" placeholder="Login" required />
                <span class="pure-form-message-inline">This is a required field.</span>
            </div>
            <div class="pure-control-group">
                <label for="aligned-password">Password</label>
                <input type="password" id="aligned-password" name="password" placeholder="Password" required />
                <span class="pure-form-message-inline">This is a required field.</span>
            </div>

            <div class="pure-controls">
                <label for="aligned-cb" class="pure-checkbox">
                    <input type="checkbox" id="aligned-cb" name="ip" /> IP-Adresse beziehen
                </label>
                <button type="submit" class="pure-button pure-button-primary" name="submit">Login</button>
            </div>
        </fieldset>
    </form>

    <?php
    echo $out;
    require_once 'footer.php'; ?>
</div>
</div>
</div><!-- layout end -->