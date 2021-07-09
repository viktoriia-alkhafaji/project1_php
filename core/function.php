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
        $out .= '<div>';
        $out .= '<h3>' . $result[$i]["title"] . '</h3>';
        $out .= '<p>' . $result[$i]["descr_min"] . '</p>';
        $out .= '<img src="../static/images/' . $result[$i]["image"] . '" width="500px">';
        $out .= '<div><a href="/article/' . $result[$i]["url"] . '"> Читать полностью</a></div>';
        $out .= '</div>';
    }
    return $out;
}

function data_output_one_article($result)
{
    $out = '';
    $out .= '<div>';
    $out .= '<h3>' . $result["title"] . '</h3>';
    $out .= '<p>' . $result["descr_min"] . '</p>';
    $out .= '<img src="../static/images/' . $result["image"] . '" width="500px">';
    $out .= '<p>' . $result["description"] . '</p>';
    $out .= '</div>';
    $out .= '<div><a href="/">На главную</a></div>';
    $out .= '<div><a href="/cat/' . get_url_of_category_by_id($result["cid"]) . '"> Перейти ко всем статьям из этой категории</a></div>';
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
    $out .= '<div><a href="/">На главную</a><a href="/cat"> К списку категорий</a></div>';
    return $out;
}

function data_output_all_categories($cat){
    $out = '';
    for ($i = 0; $i < count($cat); $i++) {
        $out .= '<div>';
        $out .= '<h3>Категория: ' . $cat[$i]["title"] . '</h3>';
        $out .= '<p>' . $cat[$i]["description"] . '</p>';
        $out .= '<p><a href="cat/' . $cat[$i]['url'] . '">Перейти к статьям из категории</a></p>';
        $out .= '</div>';
    }
    return $out;
}

function isLoginExist($login){
    $query = "SELECT id FROM users WHERE login='".$login."'";
    $result = select($query);
    if(count($result) == 0){
        return false;
    }
    else return true;
}

function createUser($login,$password){
    $password = md5(md5(trim($password)));
    $login = trim($login);
    $query = "INSERT INTO users( login, password) VALUES ('".$login."','".$password."')";
    return execQuery($query);
}

function login($login,$password){
    $password = md5(md5(trim($password)));
    $login = trim($login);
    $query = "SELECT * FROM users WHERE login='".$login."' AND password='".$password."'";
    $result = select($query);
    var_dump(count($result));
    if(count($result) == 0){
        return false;
    }
    else return $result;
}

function generateCode($length = 7){
    $chars = "qwertzuiopüasdfghjklöäyxcvbnmQWERTZUIOPÜASDFGHJKLÖÄYXCVBNM1234567890";
    $code = "";
    $clen = strlen($chars)-1;
    while (strlen($code)<$length){
        $code .= $chars[mt_rand(0, $clen)];
    }
    return $code;
}

function updateUser($id,$hash,$ip){
    if(is_null($ip)){
        $query =  "UPDATE users SET hash='".$hash."' WHERE id = ".$id;
    }
    else {
        $query = "UPDATE users SET hash='".$hash."',ip= '". $ip."' WHERE id = ".$id;

    }
}
