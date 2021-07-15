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
    case ($route[0] == 'admin' and $route[1] == 'delete' and isset($route[2])):
        if (is_numeric($route[2])) {
            if (getUser()) {
                $query = 'DELETE FROM info WHERE id=' . $route[2];
                execQuery($query);
                header("Location: /admin");
                exit;
            }
            header("Location: /login");
            break;
        } else {
            header("Location: /404.php");
        }
        break;
    case ($route[0] == 'admin' and $route[1] == 'create'):
        if (getUser()) {
            $query = 'SELECT id, title FROM category';
            $category = select($query);
            require_once 'template/crud/create.php';
        } else {
            header("Location: /login");
        }
        break;
    case ($route[0] == 'admin' and $route[1] == 'update' and isset($route[2])):
        if (is_numeric($route[2])) {
            if (getUser()) {
                $query = 'SELECT * FROM info WHERE id=' . $route[2];
                $result = select($query)[0];
                if (count($result) != 0) {
                    $query = 'SELECT id, title FROM category';
                    $category = select($query);
                    require_once 'template/crud/update.php';
                } else {
                    header("Location: /404.php");
                }
            } else {
                header("Location: /admin.php");
            }
        } else {
            header("Location: /404.php");
        }
        break;
    case ($route[0] == 'admin'):
        $query = 'SELECT * FROM info';
        $result = select($query);
        require_once 'template/admin.php';
        break;
    case ($route[0] == 'logout'):
        require_once 'template/logout.php';
        break;
    default:
        require_once 'template/404.php';
}

echo ('<link rel="stylesheet" href="https://unpkg.com/purecss@2.0.6/build/pure-min.css" integrity="sha384-Uu6IeWbM+gzNVXJcM9XV3SohHtmWE+3VGi496jvgX1jyvDTXfdK+rfZc8C1Aehk5" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://unpkg.com/purecss@2.0.6/build/grids-responsive-min.css">');
?>