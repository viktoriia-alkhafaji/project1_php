<?php

/**
 * article page template
 */

//echo data_output_one_article($result[0]);

require_once 'header.php';
?>




<div class="content pure-u-1 pure-u-md-3-4">
        <?php echo data_output_one_article($result[0]);?>
        <?php require_once 'footer.php'; ?>
    </div>
</div>
</div><!-- layout end -->
