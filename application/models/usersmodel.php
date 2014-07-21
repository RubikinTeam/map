<?php

/**
 * Created by PhpStorm.
 * User: minh
 * Date: 7/17/14
 * Time: 10:42 AM
 */
class UsersModel
{
    public function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit("Database couldn't established");
        }
    }

    /**
     * Ham kiem tra user co email la $email da to tai hay chua
     * @param $email
     * @return bool : TRUE neu user da ton tai, FALSE: user chua ton tai
     */
    public function checkUserExist($email)
    {
        $sql = "SELECT id FROM `user` WHERE `email` = '$email'";
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        $count = sizeof($result);
        if ($count > 0)
            return true;
        else return false;
    }

    /**
     * Ham add user vao database va tu sinh ma kich hoat
     * @param $fname
     * @param $lname
     * @param $email
     * @param $pw
     * @return int 1: Add user successful 0: unsuccessful
     */
    public function addUser($fname, $lname, $email, $pw)
    {
        $query = $this->db->prepare("SET NAMES 'UTF8'");
        $query->execute();
        $number = rand();
        $code = md5($number);
        $code = substr($code, 0, 10);
        if (!$this->checkUserExist($email)) {
            $sql = "insert into user(fname,lname,email,password,activationCode) values('$fname','$lname','$email','md5($pw)','$code');";
            $query = $this->db->prepare($sql);
            $query->execute();
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * ham check user co ton tai chua va ma kich hoat nhap vao co dung ko
     * @param $email
     * @param $code
     * @return bool
     */
    public function checkActivationUser($email, $code)
    {
        $sql = "SELECT id FROM `user` WHERE `email` = '$email' and `activationCode`='$code'";
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        $count = sizeof($result);
        if ($count > 0)
            return true;
        else return false;
    }

    /**
     * ham kich hoat tai khoang, groupID=0 chuyen sang groupID=1, tai khoan da kich hoat
     * @param $email
     * @param $code
     * @return string
     */
    public function ActivationUser($email, $code)
    {
        if ($this->checkActivationUser($email, $code)) {
            $sql = "UPDATE user SET groupID=1 WHERE email='$email'";
            $query = $this->db->prepare($sql);
            $query->execute();
            return "tai khoan da duoc kich hoat";
        } else {
            return "Kich hoat khong thanh cong";
        }
    }

    /** User Login
     * @param $email
     * @param $password
     * @return int
     */
    public function userLogin($email, $password)
    {
        if (!is_null($email) && !is_null($password)) {
            $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
            $query = $this->db->prepare("SET NAMES 'UTF8'");
            $query->execute();
            $query = $this->db->prepare($sql);
            $query->execute();
            $result = $query->fetchAll();
            //var_dump($result);
            if (count($result) == 1) {
                session_start();
                $_SESSION['fname'] = $result[0]->fname;
                $_SESSION['lname'] = $result[0]->lname;
                $_SESSION['groupId'] = $result[0]->groupId;
                if ($result[0]->imageUrl == '') {
                    $_SESSION['image'] = URL . "/public/img/avatars/default.jpg";
                } else {
                    $_SESSION['image'] = URL . $result[0]->imageUrl;
                }
                header("location: " . URL);
                return 1;
            } else {
                header("location: " . URL);
                return 0;
            }
        } else {
            header("location: " . URL);
            return 0;
        }
    }

    /**
     * Check if user is logged
     * @return array|int
     */
    public function checkUserLogged()
    {
        session_start();
        if (isset($_SESSION['groupId'])) {
            $userInfo = array('fname' => $_SESSION['fname'], 'lname' => $_SESSION['lname'], 'groupId' => $_SESSION['groupId'], 'imageUrl' => $_SESSION['image']);
            return $userInfo;
        } else {
            return 0;
        }
    }

    public function updateUser($email, $fname, $lname, $dob, $job, $phone)
    {
        $sql = "SELECT * FROM `user` WHERE `email` = '$email'";
        $query = $this->db->query($sql);
        $query->execute();
        $result = $query->fetchAll();
        foreach ($result as $re) {
            $thisfname = $re->fname;
            $thislname = $re->lname;
            $thisdob = $re->dob;
            $thisaddressId = $re->addressId;
            $thisjob = $re->job;
            $thisphone = $re->phone;
            if ((strcmp($re->fname, $fname))) {
                $thisfname = $fname;
            }
            if ((strcmp($re->lname, $lname))) {
                $thislname = $lname;
            }
            if ((strcmp($re->dob, $dob))) {
                $thisdob = $dob;
            }
            if ((strcmp($re->job, $job))) {
                $thisjob = $job;
            }
            if ((strcmp($re->phone, $phone))) {
                $thisphone = $phone;
            }
        }
        $sql = "UPDATE user SET fname ='$thisfname',lname ='$thislname',dob ='$thisdob',job ='$thisjob',phone ='$thisphone' WHERE email='$email'";
        $query = $this->db->prepare($sql);
        $query->execute();
        return "tai khoan da duoc cap nhat";
    }
}