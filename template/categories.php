<?php

/**
 * list of all categories page template
 */

require_once 'header.php';
?>


<div class="content pure-u-1 pure-u-md-3-4">

        
        <?php 
        echo data_output_all_categories($result);
        require_once 'footer.php'; ?>
    </div>
</div>
</div><!-- layout end -->