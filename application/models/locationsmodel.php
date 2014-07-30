<?php
/**
 * Created by PhpStorm.
 * User: Nguyen
 * Date: 7/20/14
 * Time: 10:20 AM
 */
class LocationsModel
{
    public function __construct(PDO $db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit("Database couldn't established");
        }
    }
    public function getLocationById($id)
    {
        $sql = "SELECT `name`, `email`, `phone`, `no`, `street`,`ward`, `dist`, `city`, `lat`, `long`, `imageUrl` FROM v_place v JOIN address a ON v.addressId = a.id JOIN location l ON v.locationId = l.id JOIN images i on v.thumbnailImageId = i.id";
        if ($id != 0)
        $sql .= " WHERE v.id = $id";
        $query=$this->db->prepare("SET NAMES 'UTF8'");
        $query->execute();
        $query = $this->db->prepare($sql);
        $query->execute();
        $array = $query->fetchAll();
        if (count($array) > 0) {
            $text = '[';
            foreach ($array as $element)
            {
                $text .= '{"lat" : "'.$element->lat.'", "long" : "'.$element->long.'", "name" : "'.$element->name.
                    '", "email" : "'.$element->email.'", "phone" : "'.$element->phone.'", "no" : "'.$element->no.
                    '", "street" : "'.$element->street.'", "ward" : "'.$element->ward.'", "dist" : "'.$element->dist.
                    '", "city" : "'.$element->city.'", "thumbnail" : "'.$element->imageUrl.'"},';
            }
            $text = rtrim($text, ",");
            $text .= "]";
            return $text;
        }
        else {
            return 0;
        }

    }
}