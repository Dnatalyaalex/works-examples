<?
class UserController extends Controller {

    public function auth($login, $password){
        $sql = "SELECT * FROM users WHERE email = '$login' AND password = '$password'";
        $st = $this->db->query($sql);
		     
        return $st !== false;
       
    }
    
    

}
?>