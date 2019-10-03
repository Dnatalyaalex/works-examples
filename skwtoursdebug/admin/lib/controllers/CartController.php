<?php
class CartController extends Controller {
    
    public function showCart() {
        
        $sql = "SELECT * FROM cart";
        
        $mysqli = new mysqli("127.0.0.1", "root", "", "skw_tours");

        /* проверка соединения */
        if (mysqli_connect_errno()) {
            printf("Соединение не удалось: %s\n", mysqli_connect_error());
            exit();
        }

        $result = $mysqli->query("SELECT * FROM cart");

        /* определение числа рядов в выборке */
        $row_cnt = $result->num_rows;
                
        
        if($row_cnt != 0) {
        
        echo "<table border = '1'>";
        
        echo "<tr>";
            echo "<th>ID</th><th>Name</th><th>Phone</th><th>Tour</th><th>&nbsp;</th>";
        echo "</tr>";
        
        foreach($this->db->query($sql) as $cart) {
            
            echo "<tr>";
                echo "<td>".$cart['id']."</td>";
                echo "<td>".$cart['name']."</td>";
                echo "<td>".$cart['phone']."</td>";
                echo "<td><a id='tourTarget' target='_blank' href='{$cart['link']}'>{$cart['link']}</a></td>";
                echo "<td><a href='?section=cart&action=delete&id={$cart['id']}'>DELETE</a></td>";
            echo "</tr>";
            
        }
        echo "</table>";
            
        } else {
            echo "<h4>Корзина пустая, пока:(</h4>";
        }
        
    }
    
    public function delete($id) 
    {
        $sql = "DELETE FROM `cart` WHERE id = '$id'";
        
        $this->db->query($sql);
        $this->showCart();
    }
    
   
}
?>