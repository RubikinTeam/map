<?php
/**
 * Class Users
 */
class Users extends Controller
{
    /**
     * PAGE: register
     * This method handles what happens when you move to http://URL/users/register
     */
    public function register()
    {
        // render the view, pass the data
        $this->render('users/register');
    }
    public function userLogin()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $users_model = $this->loadModel('usersmodel');
        $users_model->userLogin($email, $password);
    }

    public function userLogOut()
    {
        session_start();
        session_destroy();
        header("location: ../../");
    }
}