<?php
/**
 * Created by PhpStorm.
 * User: Nguyen
 * Date: 7/18/14
 * Time: 11:13 AM
 */
class Map extends Controller
{
    public function index()
    {
        $users_model = $this->loadModel('usersmodel');
        $userLogged = $users_model->checkUserLogged();
        $this->render('map/index', array('userLogged' => $userLogged));
    }
    public function getLocationById()
    {
        $id = $_POST['id'];
        $locations_model = $this->loadModel('locationsmodel');
        echo $locations_model->getLocationById($id);
    }
}