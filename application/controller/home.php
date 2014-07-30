<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Home extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        $articles_model = $this->loadModel('articlesmodel');
        $articles = $articles_model->getSomeArticles(0, 3, 6);

        $activities_model = $this->loadModel('ActivitiesModel');
        $activities = $activities_model->getSomeActivities(0, 0, 3, 6);

        $comments_model = $this->loadModel('commentsmodel');
        $comments = $comments_model->getSomeComments(2, 2, 1, 3);

        $places_model = $this->loadModel('PlacesModel');
        $places = $places_model->getSomePlaces(2, 4);

        $users_model = $this->loadModel('usersmodel');
        $userLogged = $users_model->checkUserLogged();
        //session_start();
        //$_SESSION['loginFail'] = 0;
        //echo $place_model->addOnePlace('place name', 'place description', '', 'place email', 1, 0, 1);
        //$comments_model->addComment(1, 2, "Nguyen Duong Truc", "Demo comment adding on table comment");
        // debug message to show where you are, just for the demo
        //echo 'Message from Controller: You are in the controller home, using the method index()';
	    // render the view, pass the data
        $this->render('home/index', array('articles' => $articles, 'activities' => $activities, 'places' => $places, 'userLogged' => $userLogged));
	}
}
