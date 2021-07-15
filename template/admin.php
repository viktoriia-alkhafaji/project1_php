<?php

/**
 * login page template
 */
if (!getUser()) {
    header("Location: /login");
}
$out = '';
for ($i = 0; $i < count($result); $i++) {
    $out .= '<div class="pure-u-1 pure-u-md-1-2">';
    $out .= '<section class="post">';
    $out .= '<header class="post-header"> <h4 class="post-title">' . $result[$i]["title"] . '</h4></header>';
    $out .= '<img src="../static/images/' . $result[$i]["image"] . '" width="150px">';
    $out .= '<div><a class="pure-button pure-button-primary" href="/admin/update/' . $result[$i]["id"] . '" >Update</a>';
    $out .= '<a class="pure-button" href="/admin/delete/' . $result[$i]["id"] . '" onclick="return confirm(\'Are you sure? You cannot undo this action.\')">Delete</a></div>';
    $out .= '</section>';
    $out .= '</div>';
}

require_once 'header_admin.php';
?>

<div class="content pure-u-1 pure-u-md-3-4">

<div class="pure-g">
    <div class="pure-u-1 pure-u-md-2-3"><h1  class="brand-title">Admin panel</h1></div>
    <div class="pure-u-1 pure-u-md-1-3"><p><a class="pure-button" href="/admin/create">Creare an article</a></p></div>
</div>
    <div class="posts">
    <h1 class="content-subhead">Recent Posts</h1>
    <div class="pure-g">
    
     <?php
    echo $out;
    ?>
    </div>   
    </div>
    <?php require_once 'footer.php'; ?>
</div>
</div>
</div><!-- layout end -->