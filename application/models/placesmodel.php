<?php

/**
 * Created by PhpStorm.
 * User: Nguyen
 * Date: 7/17/14
 * Time: 11:36 AM
 */
class PlacesModel
{
    public function __construct(PDO $db)
    {
        try {
            $this->db = $db;
        } catch
        (PDOException $e) {
            exit ("Database is not established!");
        }
    }

    /**
     * Ham tra ve mot mang cac article theo mot so tieu chuan nhat dinh
     * @param $condition:
     *      = 1 : theo thoi gian tu xa den gan
     *      = 2 : theo thoi gian tu gan den xa
     *      = 3 : theo luong like tu it den nhieu
     *      = 4 : theo luong like tu nhieu den it
     *      = 0: Khong order
     * @param $quantity
     *      = 0 neu muon lay tat ca
     *      = n (n > 0): Lay n articles dau tien
     * @return mixed
     */
    public function getSomePlaces($condition, $quantity)
    {
        $query = $this->db->prepare("SET NAMES 'UTF8'");
        $query->execute();
        $sql = "SELECT * FROM v_place";

        switch ($condition) {
            case 1:
                $sql .= " ORDER BY `rating` ASC ";
                break;
            case 2:
                $sql .= " ORDER BY `rating` DESC ";
                break;
            case 3:
                $sql .= " ORDER BY `view` ASC ";
                break;
            case 4:
                $sql .= " ORDER BY `view` DESC ";
                break;
            case 0:
                $sql .= " ORDER BY `id` DESC ";
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

    /**
     * Tra ve v_place co $id
     * @param $id
     * @return int : Ton tai: array chua thong tin cua place; Khong ton tai: 0;
     */
    public function getOnePlace($id)
    {
        $query = $this->db->prepare("SET NAMES 'UTF8'");
        $query->execute();
        $sql = "SELECT * FROM v_place WHERE id = $id";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);
    }

    /** Ham insert vao csdl thong tin 1 dia diem moi
     * @param $name
     * @param $description
     * @param $phone
     * @param $email
     * @param $addressId
     * @param $locationId
     * @param $authorId
     * @return int tra ve 1 neu insert thanh cong, nguoc lai tra ve 0
     */
    public function addOnePlace($name, $description, $phone, $email, $addressId, $locationId, $authorId)
    {
        if (isset($name)&&isset($description)&&isset($phone)&&isset($email)&&isset($addressId)&&isset($locationId)&&isset($authorId))
        {
            $sql = "INSERT INTO v_place (name, description, phone, email, addressId, locationId, creatorId) VALUES('$name', '$description', '$phone', '$email', $addressId, $locationId, $authorId)";
            if (!($query = $this->db->prepare($sql)))
            {
                return 0;
            }
            else {
                $query->execute();
                return 1;
            }
        }
        return 0;
    }
}