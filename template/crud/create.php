<?php
/**
 * create page template
 */
$action = 'Create';
$errors ='';

if($_POST['submit']){
    $title = trim($_POST['title']);
    $url = trim($_POST['url']);
    $descr_min = trim($_POST['descr_min']);
    $description = trim($_POST['description']);
    $cid = $_POST['cid'];

    move_uploaded_file($_FILES['image']['tmp_name'], 'static/images/'.$_FILES['image']['name']);
    $image = $_FILES['image']['name'];

    $create = createArticle($title, $url, $descr_min, $description, $cid, $image);

    if($create) {
        header("Location: /admin");
    }
    else {
        setcookie("alert", "create error", time()+60*5);
    }
}
else {
    $result = array (
        "title" => "",
        "cid" => "",
        "descr_min" => "",
        "description" => "",
        "image" => ""
    );
}

if(isset($_COOKIE['alert'])){
    $alert = $_COOKIE['alert'];
    setcookie("alert", "create error", time()-60*5);
    unset($_COOKIE['alert']);
    $errors = $alert;
}

require_once '../project_1_unit_18-27/template/header_admin.php';
?>


<div class="content pure-u-1 pure-u-md-3-4">
<h1>Create</h1>

        <?php 
        require_once '_form.php';
        echo $errors;
        require_once '../project_1_unit_18-27/template/footer.php'; ?>
    </div>
</div>
</div><!-- layout end -->
