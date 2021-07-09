<?php

/**
 * category page template
 */

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
     echo '<div><a href="/">На главную</a><a href="/cat"> К списку категорий</a></div>';
 }