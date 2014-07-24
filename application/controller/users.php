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
        $users_model = $this->loadModel('usersmodel');
        if (isset($_POST['fname'])&&isset($_POST['lname'])&&isset($_POST['email'])&&isset($_POST['password'])){
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            if ($users_model->addUser($fname, $lname, $email, $password))
            {
               echo 1;
            }
            else {
                echo 0;
            }

        }
        /*if(isset($_SERVER['HTTP_REFERER'])) {
            header('Location: '.$_SERVER['HTTP_REFERER']);
        } else {
            header('Location: '. URL .'/home');
        }
        exit;
        return $r;*/
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
        if(isset($_SERVER['HTTP_REFERER'])) {
            header('Location: '.$_SERVER['HTTP_REFERER']);
        } else {
            header('Location: '. URL .'/home');
        }
        exit;
    }
}