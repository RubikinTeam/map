<?php
/**
 * Created by PhpStorm.
 * User: Duyen
 * Date: 7/21/14
 * Time: 9:45 PM
 */

class Comments extends Controller
{
    public function add()
    {
        if (isset($_POST["type"]) && isset($_POST["id"]) && isset($_POST["comment"])) {
            $comments_model = $this->loadModel('CommentsModel');

            $users_model = $this->loadModel('UsersModel');
            $userLogged = $users_model->checkUserLogged();

            if($userLogged == 0) {
                $comments_model->addComment($_POST["type"], $_POST["id"], 'Anonymous', $_POST["comment"]);
            }
            else {
                $comments_model->addComment($_POST["type"], $_POST["id"], $userLogged['fname'].' '.$userLogged['lname'], $_POST["comment"]);
            }
        }
    }

    public function get($id, $type)
    {
        $comments_model = $this->loadModel('CommentsModel');
        $comments = $comments_model->getSomeComments($type, $id, 2, 0);
        $this->render('comments/get', array('comments' => $comments));
    }
}