<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>To-Do List</title>
</head>
<style>
  
</style>
<body>
<header>
To-Do List
</header>

<section id="particles-js">
<div class="container">
      <form method="post">
        <h1>Register</h1>
        <br>
        <?php
        //connect to the dbconfig.php
            require_once 'dbconfig.php';

            //if user naka login na tapos mo adto siya sa site ani mo balik siya sa dashboard.php
            if($user->is_loggedin()!=""){
                $user->redirect('Dashboard.php');
            }

            //if i click niya ang submit button
            if(isset($_POST['btn-register'])){
                $user->authRegister($_POST);
            }
        ?>
        <div class="input-box">  
            <input type="text" name="username" placeholder="Username" > 
        </div>
        <div class="input-box">
            <input type="email" name="email"  placeholder="Email" > 
        </div>
        <div class="input-box">
            <input type="password" name="password"  placeholder="Password" > 
        </div>
        <div class="input-box">
            <input type="password" name="conpassword"  placeholder="Confirm Password" > 
        </div>
          <button type="submit" name="btn-register">Submit</button>
          <br>
          <span>Already have an account? <a href="index.php">Log In</a></span>
      </form>
</div>
</section>
<script src="css/particles.js"></script>
<script src="css/app.js"></script>

</body>
</html>