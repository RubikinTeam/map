<?php
/**
 * Created by PhpStorm.
 * User: DUONG_TRUC
 * Date: 7/29/14
 * Time: 7:23 PM
 */
class navSearch extends Controller  {
    public function  articleSearch () {
        $str = $_GET['query'];
        $article_model = $this->loadModel('articlesmodel');
        $str = $this->convertSearchString($str);
        echo $article_model->searchArticle($str);
    }
}