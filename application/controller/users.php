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
}