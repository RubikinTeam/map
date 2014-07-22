<?php
/**
 * Created by PhpStorm.
 * User: Duyen
 * Date: 7/19/14
 * Time: 3:17 PM
 */

class Articles extends Controller
{
    public function detail($id)
    {
        $users_model = $this->loadModel('usersmodel');
        $userLogged = $users_model->checkUserLogged();
        $articles_model = $this->loadModel('ArticlesModel');
        $article = $articles_model->getArticleById($id);

        $otherArticles = $articles_model->getSomeArticles(0, 2, 6);

        $comments_model = $this->loadModel('CommentsModel');
        $comments = $comments_model->getSomeComments(1, $id, 2, 0);

        $this->render('articles/detail', array('article' => $article, 'comments' => $comments, 'otherArticles' => $otherArticles, 'userLogged' => $userLogged));
    }
}