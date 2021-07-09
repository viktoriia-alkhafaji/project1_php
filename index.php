<?php
require_once 'config/db.php';
require_once 'core/function_db.php';
require_once 'core/function.php';
$conn = connect();

$route = $_GET['route'];
$route = explodeURL($route);

// main - главная страница
// cat - категории
// article - статья

switch ($route) {
    case ($route[0] == ''):
        // main
        $query = 'SELECT * FROM info';
        $result = select($query);
        require_once 'template/main.php';
        break;
    case ($route[0] == 'article' and isset($route[1])):
        $url = $route[1];
        $result = getArticle($url);
        require_once 'template/article.php';
        break;
    case ($route[0] == 'cat' and !isset($route[1])):
        $query = 'SELECT * FROM category';
        $result = select($query);
        require_once 'template/categories.php';
        break;
    case ($route[0] == 'cat' and isset($route[1])):
        $url = $route[1];
        $cat = getCategory($url);
        if (count($cat) !== 0) {
            $result = getCategoryArticles($cat['id']);
        } else {
            $result = [];
        }
        require_once 'template/cat.php';
        break;
    case ($route[0] == 'register'):
        require_once 'template/register.php';
        break;
    case ($route[0] == 'login'):
        require_once 'template/login.php';
        break;
    default:
        require_once 'template/404.php';
}
