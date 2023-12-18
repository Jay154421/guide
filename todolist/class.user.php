<?php
class USER{
    public $db;
 
    //data connection ni
    function __construct($DB_con){
      $this->db = $DB_con;
    }
   
    //Mao ning fucntion register
    public function register($username,$email,$password){
       try{
         //gi hash ang password
           $new_password = password_hash($password, PASSWORD_DEFAULT);
   
           //Mao ning database para mo insert ang imong gi butang sa register
           $stmt = $this->db->prepare("INSERT INTO users(username,email,password) VALUES(:username, :email, :password)");           
           $stmt->bindparam(":username", $username);
           $stmt->bindparam(":email", $email);
           $stmt->bindparam(":password", $new_password);            
           $stmt->execute(); 
           return $stmt; 
       }
       catch(PDOException $e){
           echo $e->getMessage();
       }    
    }

    //function autlogin mao ning imong errpr 
    public function authLogin($user){
      $username = $_POST['username_email'];
      $email = $_POST['username_email'];
      $password = $_POST['password'];
         
      //e check niya sa database kung naa ba didto ang gi butang sa user na login 
      if($this->login($username,$email,$password)){
         //if true mo adto siya sa Dashboard.php
         $this->redirect('Dashboard.php');
      }
      //e check niya ang if the user type a username is admin and password is admin 
      elseif($username === "admin" && $password === "admin"){
         //if  true mo adto siya sa admin.php
         $_SESSION['admin'] = 'admin';
         $this->redirect('admin.php');
      }
      //kung wala ni true ang if og elseif kani mo gawas
      else{
       echo "<p style='color:red;'>Invalid username/email or password</p>";
      } 
    }

    //function authRegister 
   public function authRegister($user){
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password']; 
      $conpassword = $_POST['conpassword'];
   
         //if user wala ga butang sa username kani mo gawas
         if($username=="") {
            echo "<p style='color:red;'>Provide username!</p>"; 
         }
          //if user wala ga butang sa email kani mo gawas
         else if($email=="") {
            echo "<p style='color:red;'>Provide email!</p>"; 
         }
         //if user dili valid email iyang gi butang kani mo gawas
         else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<p style='color:red;'>Please enter a valid email address!</p>";
         }
          //if user wala ga butang sa password kani mo gawas
         else if($password=="") {
           echo "<p style='color:red;'>Provide password!</p>";
         }
         //if user wala ka abot sa iyang password tanam sa 6 kani mo gawas
         else if(strlen($password) < 6){
           echo "<p style='color:red;'>Password must be atleast 6 characters</p>"; 
         }
          //if user wala ga parihas iyang password og confirmpassword kani mo gawas
         else if($password !== $conpassword){
            echo "<p style='color:red;'>Passwords you entered do not match</p>";
         }
         //else kani mo gawas
         else{
            try{
               $stmt = $this->db->prepare("SELECT username,email FROM users WHERE username=? OR email=?");
               $stmt->execute([$username,$email]);
               $row=$stmt->fetch(PDO::FETCH_ASSOC);
         
               ///kani lantawon niya kung naa bay parihas username if naa kani mo gawas
               if(is_array($row)){
                  if($row['username']==$username) {
                      echo "<p style='color:red;'>Sorry username already taken!</p>";
                  }
                   ///kani lantawon niya kung naa bay parihas email if naa kani mo gawas
                  else if($row['email']==$email) {
                      echo "<p style='color:red;'>Sorry email id already taken!</p>";
                  }
              }
              //else e insert niya ang gi input sa user
              else{
                  if($this->register($username,$email,$password)){
                      $this->redirect('index.php');
                  }
              }
         }
         catch(PDOException $e){
            echo $e->getMessage();
         }
      }
    } 

    //function login
    public function login($username,$email,$password){
       try{
         //lantawon niya sa database kung naa bai username/email and password
          $stmt = $this->db->prepare("SELECT * FROM users WHERE username=:username OR email=:email LIMIT 1");
          $stmt->execute(array(':username'=>$username, ':email'=>$email));
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0){
             if(password_verify($password, $userRow['password'])){
                $_SESSION['user_session'] = $userRow['id'];
                return true;
             }
             else{
                return false;
             }
          }
       }
       catch(PDOException $e){
           echo $e->getMessage();
       }
   }
 
   //kani na function is_loggedin  mao ning kung naka login ba siya or wala
   public function is_loggedin(){
      if(isset($_SESSION['user_session']) || isset($_SESSION['admin'])){
         return true;
      }
   }
 
   //function redirect para files nalang iyang e butang
   public function redirect($url){
       header("Location: $url");
   }

   //function insertask mao ning para add the task
  public function insertTask($task, $user_id){
   try{
      $stmt = $this->db->prepare("INSERT INTO tasks(task,user_id) VALUES(:task,:email)");
      $stmt->bindparam(":task", $task);
      $stmt->bindparam(":email", $user_id);
      $stmt->execute();
         return true;
      }
      catch(PDOException $e){
        echo $e->getMessage();
        return false;
      }
   }

   //function name 
   public function name($user_id){
      $stmt = $this->db->prepare("SELECT * FROM users WHERE id=:user_id");
      $stmt->execute(array(":user_id"=>$user_id));
      $user = $stmt->fetch(PDO::FETCH_ASSOC);
      return $user;
   }
  
   //function edittask e update niya
   public function editTask($task_id, $new_task){
      try{
          $stmt = $this->db->prepare("UPDATE tasks SET  task=:new_task WHERE id=:task_id");
          $stmt->bindparam(":new_task", $new_task);
          $stmt->bindparam(":task_id", $task_id);
          $stmt->execute();
          
          return $this->redirect('Dashboard.php');

      }
      catch(PDOException $e){
          echo $e->getMessage();
          return false;
      }
  }

  
}

?>