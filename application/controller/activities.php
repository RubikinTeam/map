<?php
/**
 * Created by PhpStorm.
 * User: Duyen
 * Date: 7/21/14
 * Time: 12:26 AM
 */

class Activities extends Controller
{
    public function index()
    {
        $activities_model = $this->loadModel('ActivitiesModel');
        $activities = $activities_model->getSomeActivities(0, 0, 2, 0);

        $users_model = $this->loadModel('usersmodel');
        $userLogged = $users_model->checkUserLogged();

        $this->render('activities/index', array('activities' => $activities, 'userLogged' => $userLogged));
    }

    public function detail($id)
    {
        $users_model = $this->loadModel('usersmodel');
        $userLogged = $users_model->checkUserLogged();

        $activities_model = $this->loadModel('ActivitiesModel');
        $activity = $activities_model->getActivityById($id);

        $otherActivities = $activities_model->getSomeActivities(0, 0, 2, 3);

        $comments_model = $this->loadModel('CommentsModel');
        $comments = $comments_model->getSomeComments(2, $id, 2, 0);

        $this->render('activities/detail', array('activity' => $activity, 'comments' => $comments, 'otherActivities' => $otherActivities, 'userLogged' => $userLogged));
    }

    public function getActivityShortDesByType()
    {
        $type = $_POST['type'];
        $activities_model = $this->loadModel('ActivitiesModel');
        echo $activities_model->getActivityShortDesByType($type);
    }
}