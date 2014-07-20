<?php
/**
 * Created by PhpStorm.
 * User: Duyen
 * Date: 7/21/14
 * Time: 12:26 AM
 */

class Activities extends Controller
{
    public function detail($id)
    {
        $activities_model = $this->loadModel('ActivitiesModel');
        $activity = $activities_model->getActivityById($id);

        $otherActivities = $activities_model->getSomeActivities(0, 2, 6);

        $comments_model = $this->loadModel('CommentsModel');
        $comments = $comments_model->getSomeComments(2, $id, 2, 0);

        $this->render('activities/detail', array('activity' => $activity, 'comments' => $comments, 'otherActivities' => $otherActivities));
    }

    public function addComment($id)
    {
        if (isset($_POST["submit_add_comment"])) {
            $comments_model = $this->loadModel('CommentsModel');

            $users_model = $this->loadModel('UsersModel');
            $userLogged = $users_model->checkUserLogged();

            if($userLogged == 0) {
                $comments_model->addComment($_POST["type"], $id, 'Anonymous', $_POST["comment"]);
            }
            else {
                $comments_model->addComment($_POST["type"], $id, $userLogged['fname'].' '.$userLogged['lname'], $_POST["comment"]);
            }
        }
        header('location: ' . URL . 'activities/detail/' . $id);
    }
}