<?php

/**
 * category page template
 */

 require_once 'header.php';
 ?>

<div class="content pure-u-1 pure-u-md-3-4">

        <hr>
        <?php 
        if(count($cat) !== 0) {
            // вывод инфы о категории
             echo data_output_category($cat);
       
             if(count($result) !== 0){
                 echo data_output_articles($result);
             }
             else echo 'Эта категория еще пуста...';
        }
        else {
            echo 'Такой категории не существует.';
            echo '<div><a class="pure-button" href="/">На главную</a><a href="/cat"> К списку категорий</a></div>';
        }
       
        
        require_once 'footer.php'; ?>
    </div>
</div>
</div><!-- layout end -->