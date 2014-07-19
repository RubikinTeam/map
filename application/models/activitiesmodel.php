<?php

/**
 * Created by PhpStorm.
 * User: Nguyen
 * Date: 7/17/14
 * Time: 9:39 AM
 */
class ActivitiesModel
{
    public function __construct(PDO $db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit("Database couldn't established");
        }
    }

    /**
     * Ham tra ve mot mang cac activity theo mot so tieu chuan nhat dinh
     *      * @param $status
     *      = 1 : activities da duoc duyet
     *      = 2 : activities chua duyet
     *      = 0: khong rang buoc ve trang thai
     * @param $order :
     *      = 1 : theo thoi gian tu xa den gan
     *      = 2 : theo thoi gian tu gan den xa
     *      = 3 : theo luong like tu it den nhieu
     *      = 4 : theo luong like tu nhieu den it
     *      = 0: Khong order
     * @param $quantity
     *      = 0 neu muon lay tat ca
     *      = n (n > 0): Lay n activities dau tien
     * @return mixed
     */
    public function getSomeActivities($status, $condition, $quantity)
    {
        $query = $this->db->prepare("SET NAMES 'UTF8'");
        $query->execute();
        $sql = "SELECT * FROM activities";
        switch ($status) {
            case 1:
                $sql .= " WHERE status = 1 ";
                break;
            case 2:
                $sql .= " WHERE status = 2 ";
                break;
            case 0:
                break;
            default:
                break;
        }
        switch ($condition) {
            case 1:
                $sql .= " ORDER BY `startday` ASC ";
                break;
            case 2:
                $sql .= " ORDER BY `startday` DESC ";
                break;
            case 3:
                $sql .= " ORDER BY `rating` ASC ";
                break;
            case 4:
                $sql .= " ORDER BY `rating` DESC ";
                break;
            case 0:
                break;
            default:
                break;
        }
        if ($quantity > 0) {
            $sql .= " LIMIT $quantity";
        }
        //echo $sql ."</br>"; //If you wanna show sql statement, let's uncomment this line
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
}