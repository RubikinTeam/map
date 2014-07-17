<?php

/**
 * Created by PhpStorm.
 * User: Nguyen
 * Date: 7/17/14
 * Time: 11:36 AM
 */
class PlacesModel
{
    public function __construct($db)
    {
        try {
            $this->db = $db;
        } catch
        (PDOException $e) {
            exit ("Database is not established!");
        }
    }

    /**
     * Tra ve v_place co $id
     * @return: Ton tai: array chua thong tin cua place; Khong ton tai: 0;
     */
    public function getOnePlace($id)
    {
        $sql = "SELECT * FROM v_place WHERE id = $id";
        $query = $this->db->prepare($sql);
        $result = $query->fetchAll();
        if (count($result) > 0) return $result;
        else return 0;
    }
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
    }
}