<?php

class CountryController extends Controller {

    public function countriesList()
    {
        $sql = 'SELECT * FROM countries ORDER BY title';
        
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Страна</th><th>Описание</th><th>&nbsp;</th><th>&nbsp;</th></tr>";
       

        foreach ($this->db->query($sql) as $row) {

            // var_dump($country);
            echo "<tr>";
            echo "<td>{$row["id"]}</td>";
            echo "<td>{$row["title"]}</td>";
            echo "<td>{$row["description"]}</td>";
            echo "<td><a href='?section=countries&action=editform&id={$row['id']}'>EDIT</a></td>";
            echo "<td><a href='?section=countries&action=delete&id={$row['id']}'>DELETE</a></td>";

            echo "</tr>";
        }
        
        echo "</table>";
    }
    
    
     public function editform($id)
    {
        $countryId = $id;
        if($countryId) {
            $sql = "SELECT * FROM countries WHERE id = {$countryId}";
            $country = $this->db->query($sql)->fetch();
            if($country) {
                include_once $_SERVER["DOCUMENT_ROOT"] . "/admin/resources/country/editform.php";
            }
        }else{
            echo "Страна не найден.";
        }
    }

    public function store($id, $title, $description)
    {
        $sql = "UPDATE countries SET
                title = '$title',	
                description = '$description'
                WHERE id = $id";

        //echo $sql;
        $this->db->query($sql);
        $this->countriesList();

    }
    
    public function delete($id) 
    {
        $sql = "DELETE FROM `countries` WHERE id = '$id'";
        
        $this->db->query($sql);
        $this->countriesList();
    }
    
    public function addCountry() 
    {
        include_once $_SERVER["DOCUMENT_ROOT"] . "/admin/resources/country/add.php";
    }

    public function storeAdd($id, $title, $description)
    {
        $sql = "INSERT INTO `countries`(`id`, `title`, `description`) 
        VALUES ('$id','$title', '$description')";

        //echo $sql;
        $this->db->query($sql);
        $this->countriesList();

    }
}


?>
