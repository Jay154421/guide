<?php
//kani para maka connect sa dbconfig.php
 require_once 'dbconfig.php';
  
 //kani kung ang user mo adto diri na site na wala pa ka login  mo balik siya sa index.php
 if(!$user->is_loggedin()){
  $user->redirect('index.php');
  }
  
//kani pang search
  $search = isset($_POST['search']) ? $_POST['search'] : '';

  //kani e query niya ang database 
  $allusers = $DB_con->query("SELECT * FROM users WHERE username LIKE '%$search%' OR email LIKE '%$search%' ORDER BY id DESC");
?>

<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
 <link rel="stylesheet" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Admin</title>
</head>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Joti+One&display=swap');
  .navbar{
    background: #BCBCBC;
  }

  .navbar-brand{
  color: #333333;
  font-family: 'Joti One', serif;
  font-size: 50px;
}
</style>
<body>
<nav class="navbar" >
  <div class="container-fluid ">
    <a class="navbar-brand">To-Do List</a>
    <form class="d-flex" role="search" method="POST" action="admin.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
    <span class="navbar-text">Admin  <a class="btn btn-outline-dark  " href="logout.php"> Logout</a></span>
  </div>
</nav>
<br>
<br>
  <div class="container">
    <table class="table">
      <thead>
        <tr>
          <th>Username</th>
          <th>Email</th>
          <th>Password</th>
          <th>RegisterDate</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <!-- kani ipa kita niya ang tanan users -->
        <?php while($user = $allusers->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
          <td><?=$user['username']?></td>
          <td><?=$user['email']?></td>
          <td><?=$user['password']?></td>
          <td><?=$user['registerdate']?></td>
          <td><a href="delete.php?id=<?=$user['id']?>" class="btn btn-outline-danger ">Delete</a></td>
        </tr>
        <?php endwhile;?>
      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>