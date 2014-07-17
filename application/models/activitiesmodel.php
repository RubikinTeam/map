<?php

/**
 * Created by PhpStorm.
 * User: Nguyen
 * Date: 7/17/14
 * Time: 9:39 AM
 */
class ActivitiesModel
{
public function __construct($db)
{
    try {
        $this->db = $db;
    } catch (PDOException $e)
    {
        exit ("Database is not established!");
    }

}
    /**
     * Ham tra ve mot mang cac article theo mot so tieu chuan nhat dinh
     *      * @param $type
     *      = 1 : comment cua article
     *      = 2 : comment cua activites
     * @param $ownerId : Id cua doi tuong can lay comment (articles, activites, place)
     * @param $order :
     *      = 1 : theo thoi gian tu xa den gan
     *      = 2 : theo thoi gian tu gan den xa
     *      = 3 : theo luong like tu it den nhieu
     *      = 4 : theo luong like tu nhieu den it
     *      = 0: Khong order
     * @param $quantity
     *      = 0 neu muon lay tat ca
     *      = n (n > 0): Lay n comment dau tien
     * @return mixed
     */
    public function getSomeComments($type, $ownerId, $order, $quantity)
    {
        $sql = "SELECT * FROM comment";
        switch ($type) {
            case 1:
                $sql .= " WHERE type = 1 ";
                break;
            case 2:
                $sql .= " WHERE type = 2 ";
                break;
            case 3:
                $sql .= " WHERE type = 3 ";
                break;
            default:
                break;
        }
        $sql .= " AND ownerId = $ownerId ";
        switch ($order) {
            case 1:
                $sql .= " ORDER BY `date` ASC ";
                break;
            case 2:
                $sql .= " ORDER BY `date` DESC ";
                break;
            case 3:
                $sql .= " ORDER BY `like` ASC ";
                break;
            case 4:
                $sql .= " ORDER BY `like` DESC ";
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