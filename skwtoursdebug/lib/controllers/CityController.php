<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 08.05.2019
 * Time: 19:20
 */



class CityController extends Controller {

    public function citiesList()
    {
        $sql = 'SELECT * FROM cities ORDER BY title';

        foreach ($this->db->query($sql) as $row) {

            echo "<a href='?city={$row['id']}'>".$row['title'] . "</a><br>";
        }
    }

    public function showCity($city_id)
    {
        $sql = "SELECT * FROM cities WHERE id='{$city_id}'";

        $result = $this->db->query($sql)->fetch();
        echo $result["id"].":".$result["title"]."<br>";
    }
}