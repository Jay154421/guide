<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>To-Do List</title>
</head>
<body>
<header>
To-Do List
</header>

  <section id="particles-js">
    <div class="container">
          <form method="post">
            <h1>Login</h1>
            <?php
            //connect to the dbconfig.php
              require_once 'dbconfig.php';

              //if user naka login na tapos mo adto siya sa site ani mo balik siya sa dashboard.php
                if($user->is_loggedin()!=""){
                $user->redirect('Dashboard.php');
                }
      
                //kung gi click niya ang login button 
                if(isset($_POST['btn-login'])){
                  $user->authLogin($_POST['btn-login']);
                }
            ?>
            <div class="input-box">  
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
              <input type="text" name="username_email" placeholder="Username or Email" required> 
            </div>
            <div class="input-box">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
              <input type="password"  name="password" placeholder="Password" required> 
            </div>
              <button type="submit" name="btn-login">Log In</button>
              <br>
              <span class="signup">No account yet?<a href="register.php"> Register</a></span>
          </form>
    </div>
  </section>
<script src="css/particles.js"></script>
<script src="css/app.js"></script>

</body>
</html>