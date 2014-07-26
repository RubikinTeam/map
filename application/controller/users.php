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
        $mailer_model = $this->loadModel('mailerModel');
        if (isset($_POST['fname'])&&isset($_POST['lname'])&&isset($_POST['email'])&&isset($_POST['password'])){
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $activationCode = md5(rand());
            if ($users_model->addUser($fname, $lname, $email, $password, $activationCode))
            {
                $mailer_model->confirmMailer($email, $lname, $activationCode);
               echo 1;
            }
            else {
                echo 0;
            }

        }
        $this->render('users/register');
    }
    public function userConfirm(){
        $email = $_GET['email'];
        $code = $_GET['activationCode'];
        $users_model = $this->loadModel('usersmodel');
        $result = 0;
        if ($users_model->userActivation($email, $code))
            $result = 1;
        $this->render('users/userConfirm', array('result'=> $result));
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