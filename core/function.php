<?php

function explodeURL($url)
{
    return explode('/', $url);
}

function getArticle($url)
{
    $query = 'SELECT * FROM info WHERE url="' . $url . '"';
    return select($query);
}

function getCategory($url)
{
    $query = 'SELECT * FROM category WHERE url="' . $url . '"';
    return select($query)[0];
}

function getCategoryArticles($cid)
{
    $query = 'SELECT * FROM info WHERE cid="' . $cid . '"';
    return select($query);
}


function data_output_articles($result)
{
    $out = '';
    for ($i = 0; $i < count($result); $i++) {
        $out .= '<div class="pure-u-1 pure-u-md-1-2">';
        $out .= '<div class="article-box">';
        $out .= '<h3>' . $result[$i]["title"] . '</h3>';
        $out .= '<p>' . $result[$i]["descr_min"] . '</p>';
        $out .= '<img src="../static/images/' . $result[$i]["image"] . '" width="100%">';
        $out .= '<div class="btn"><a class="pure-button pure-button-primary" href="/article/' . $result[$i]["url"] . '"> Read more ...</a></div>';
        $out .= '</div>';
        $out .= '</div>';
    }
    return $out;
}

function data_output_one_article($result)
{
    $out = '';
    $out .= '<div class="article-box">';
    $out .= '<h3>' . $result["title"] . '</h3>';
    $out .= '<p>' . $result["descr_min"] . '</p>';
    $out .= '<img src="../static/images/' . $result["image"] . '" width="80%">';
    $out .= '<p>' . $result["description"] . '</p>';
    $out .= '</div>';
    $out .= '<div><a class="pure-button" href="/">На главную</a></div>';
    $out .= '<div><a class="pure-button" href="/cat/' . get_url_of_category_by_id($result["cid"]) . '"> Перейти ко всем статьям из этой категории</a></div>';
    return $out;
}

function get_url_of_category_by_id($id)
{
    $query = "SELECT * FROM category WHERE id=" . $id . "";
    return select($query)[0]['url'];
}

function data_output_category($cat)
{
    $out = '';
    $out .= '<div>';
    $out .= '<h3>Категория: ' . $cat["title"] . '</h3>';
    $out .= '<p>' . $cat["description"] . '</p>';
    $out .= '</div>';
    $out .= '<div><a class="pure-button" href="/cat"> К списку категорий</a></div>';
    return $out;
}

function data_output_all_categories($cat)
{
    $out = '';
    for ($i = 0; $i < count($cat); $i++) {
        $out .= '<div class="pure-g article-box">';
        $out .= '<div class="pure-u-1 pure-u-md-3-5"';
        $out .= '<h3>Категория: ' . $cat[$i]["title"] . '</h3>';
        $out .= '<p>' . $cat[$i]["description"] . '</p>';
        $out .= '</div>';
        $out .= '<div class="pure-u-1 pure-u-md-2-5"';
        $out .= '<p><a class="pure-button pure-button-primary" href="cat/' . $cat[$i]['url'] . '">Перейти к статьям из категории</a></p>';
        $out .= '</div>';
        $out .= '</div>';
    }
    return $out;
}

function isLoginExist($login)
{
    global $conn;
    $login = mysqli_real_escape_string($conn, $login);
    $query = "SELECT id FROM users WHERE login='" . $login . "'";
    $result = select($query);
    if (count($result) == 0) {
        return false;
    } else return true;
}

function createUser($login, $password)
{   
    global $conn;
    $password = md5(md5(trim($password)));
    $login = trim($login);
    $login = mysqli_real_escape_string($conn, $login);
    $password = mysqli_real_escape_string($conn, $password);
    $query = "INSERT INTO users( login, password) VALUES ('" . $login . "','" . $password . "')";
    return execQuery($query);
}

function login($login, $password)
{
    global $conn;
    $password = md5(md5(trim($password)));
    $login = trim($login);
    $login = mysqli_real_escape_string($conn, $login);
    $password = mysqli_real_escape_string($conn, $password);
    $query = "SELECT * FROM users WHERE login='" . $login . "' AND password='" . $password . "'";
    $result = select($query);
    if (count($result) != 0) return $result;
    return $result;
}

function generateCode($length = 7)
{
    $chars = "qwertzuiopüasdfghjklöäyxcvbnmQWERTZUIOPÜASDFGHJKLÖÄYXCVBNM1234567890";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
        $code .= $chars[mt_rand(0, $clen)];
    }
    return $code;
}

function updateUser($id, $hash, $ip){
    if (is_null($ip)) {
        $query = "UPDATE users SET hash='".$hash."' WHERE id = ".$id;
    }
    else {
        $query = "UPDATE users SET hash='".$hash."', ip=INET_ATON('".$ip."') WHERE id=".$id;
    }
    return execQuery($query);
}

function getUser() {
    if (isset($_COOKIE['id']) and isset($_COOKIE['hash'] )){
        global $conn;
        $_COOKIE['id'] = mysqli_real_escape_string($conn, $_COOKIE['id']);
        $_COOKIE['hash']  = mysqli_real_escape_string($conn, $_COOKIE['hash']);
        $query = "SELECT id, login, hash, INET_NTOA(ip) as ip FROM users WHERE id = ".intval($_COOKIE['id'])." LIMIT 1";
        $user = select($query);
        if (count($user) === 0) {
            return false;
        }
        else {
            $user = $user[0];
            if ( $user['hash']!== $_COOKIE['hash']) {
                clearCookies();
                return false;
            }
            if (!is_null($user['ip'])) {
                if ($user['ip'] !== $_SERVER['REMOTE_ADDR']){
                    clearCookies();
                    return false;
                }
            }
            $_GET['login'] = $user['login'];
            return true;
        }

    }
    else {
        clearCookies();
        return false;
    }
}

function clearCookies(){
    setcookie('id', "", time()-60*60*24*30, "/", null, null, true);
    setcookie('hash', "", time()-60*60*24*30, "/", null, null, true);
    unset($_GET['login']);
}

function createArticle($title, $url, $descr_min, $description, $cid, $image){
    global $conn;
    $title = mysqli_real_escape_string($conn, $title);
    $url = mysqli_real_escape_string($conn, $url);
    $descr_min = mysqli_real_escape_string($conn, $descr_min);
    $description = mysqli_real_escape_string($conn, $description);
    $image = mysqli_real_escape_string($conn, $image);
    
    $query = "INSERT INTO info (cid, title, url, descr_min, description, image) VALUES (".$cid.",'".($title)."','".($url)."','".($descr_min)."','".($description)."','".($image)."')";
    return execQuery($query);
}

function updateArticle($id, $title, $url, $descr_min, $description, $cid, $image) {
    global $conn;
    $title = mysqli_real_escape_string($conn, $title);
    $url = mysqli_real_escape_string($conn, $url);
    $descr_min = mysqli_real_escape_string($conn, $descr_min);
    $description = mysqli_real_escape_string($conn, $description);
    $image = mysqli_real_escape_string($conn, $image);
    $query = "UPDATE info SET title='".$title."', url='".$url."', descr_min='".$descr_min."', description='".$description."', cid=".$cid.", image='".$image."' WHERE id=".$id;
    return execQuery($query);
}

function logout() {
    clearCookies();
    header('Location: /');
    exit;
}
?>