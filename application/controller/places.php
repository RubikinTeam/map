<?php
/**
 * Created by PhpStorm.
 * User: Duyen
 * Date: 7/24/14
 * Time: 9:57 AM
 */
class Places extends Controller
{
    public function index()
    {
        $places_model = $this->loadModel('PlacesModel');
        $places = $places_model->getSomePlaces(2, 0);
        $this->render('places/index', array('places' => $places));
    }

    public function detail($id)
    {
        $users_model = $this->loadModel('usersmodel');
        $userLogged = $users_model->checkUserLogged();

        $places_model = $this->loadModel('PlacesModel');
        $place = $places_model->getOnePlace($id);

        $otherPlaces = $places_model->getSomePlaces(0, 0);

        $comments_model = $this->loadModel('CommentsModel');
        $comments = $comments_model->getSomeComments(3, $id, 2, 0);

        $this->render('places/detail', array('place' => $place, 'comments' => $comments, 'otherPlaces' => $otherPlaces, 'userLogged' => $userLogged));
    }
}