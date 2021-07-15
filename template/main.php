<?php

/**
 * main page template
 */
require_once 'header.php';
?>

<div class="content pure-u-1 pure-u-md-3-4">
    <h1 style="text-align: center;">Main page</h1>
    <div class="pure-g">
        <?php echo data_output_articles($result); ?>
    </div>
    <?php require_once 'footer.php'; ?>
</div>
</div>
</div><!-- layout end -->