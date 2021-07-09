<?php

/**
 * main page template
 */

echo '<pre>';
//print_r($result);

echo '<dir><a href="cat">Перейти к списку категорий</a></dir>';

echo '<h2>Все статьи</h2>';
echo data_output_articles($result);