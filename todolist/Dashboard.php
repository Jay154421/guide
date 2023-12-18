<?php
//kani para maka connect sa dbconfig.php
require_once 'dbconfig.php';

 //kani kung ang user mo adto diri na site na wala pa ka login  mo balik siya sa index.php 
  if(!$user->is_loggedin()){
  $user->redirect('index.php');
  }
  
  //gi kuha niya ang user id
  $user_id = $_SESSION['user_session'];
  
  //gani gikuha niya ang pangalan sa user
  $name = $user->name($user_id);

  //if e click niya ang submit button mo insert dayun ang task
  if(isset($_POST['btn-tasks'])){
    $task = $_POST['tasks'];
    $user->insertTask($task,$user_id);
    $user->redirect('Dashboard.php');
  }
  
  //kani gi query niya ang database
  $alltask = $DB_con->query("SELECT * FROM tasks WHERE user_id = $user_id");  
  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>To-Do List</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="css/todolist.css" />
  </head>
  <style>
    
  </style>
  <body>
    <header>
    To-Do List
    <span>
      <a href="logout.php"><?=$name['username']?> Logout</a>
    </span>
    </header>
    
    <section class="container">
      <div class="heading">
        <img class="heading__img" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/756881/laptop.svg">
        <h1 class="heading__title">To-Do List</h1>
      </div>
      <form class="form" method="post">
        <div>
          <label class="form__label" for="todo">~ Today I need to ~</label>
          <input class="form__input"
               type="text"
               id="todo"
               name="tasks"
               size="30"
               required>
          <button class="button" name="btn-tasks"><span>Submit</span></button>
        </div>
      </form>
      <!-- kani gi kuha niya ang gi add sa user -->
      <?php while ($todo = $alltask->fetch(PDO::FETCH_ASSOC)):?>
            <div class="box">
                <input type="checkbox">
                <h2><?= $todo['task']?></h2>
                <a class="myBtn" data-task-id="<?=$todo['id']?>" data-task-text="<?=$todo['task']?>"><svg width="28" height="38" viewBox="0 0 43 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M19.708 6.33301H7.16634C6.21598 6.33301 5.30455 6.66664 4.63254 7.2605C3.96054 7.85437 3.58301 8.65982 3.58301 9.49967V31.6663C3.58301 32.5062 3.96054 33.3116 4.63254 33.9055C5.30455 34.4994 6.21598 34.833 7.16634 34.833H32.2497C33.2 34.833 34.1115 34.4994 34.7835 33.9055C35.4555 33.3116 35.833 32.5062 35.833 31.6663V20.583" stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M33.1455 3.95837C33.8583 3.32848 34.825 2.97461 35.833 2.97461C36.841 2.97461 37.8077 3.32848 38.5205 3.95837C39.2333 4.58826 39.6337 5.44257 39.6337 6.33337C39.6337 7.22416 39.2333 8.07848 38.5205 8.70837L21.4997 23.75L14.333 25.3334L16.1247 19L33.1455 3.95837Z" stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                          </svg>
                </a>      
                    <!-- The Modal -->
                      <div id="myModal" class="modal">
                        <!-- Modal content -->
                        <div class="modal-content">
                        <form action="edit.php" method="post">
                          <span class="close">&times;</span>
                          <label for="">Edit</label>
                          <input type="hidden" name="task_id" value="<?=$todo['id']?>">
                          <input type="text" name="newTask" value="<?=$todo['task']?>">
                          <button type="submit" name="btn-edit">Submit</button>
                        </form>
                        </div>
                      </div>
                <a href="delete.php?task_id=<?= $todo['id']?>"><svg width="28" height="38" viewBox="0 0 43 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M5.375 9.5H8.95833H37.625" stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M34.0413 9.50033V31.667C34.0413 32.5068 33.6638 33.3123 32.9918 33.9062C32.3198 34.5 31.4084 34.8337 30.458 34.8337H12.5413C11.591 34.8337 10.6795 34.5 10.0075 33.9062C9.33554 33.3123 8.95801 32.5068 8.95801 31.667V9.50033M14.333 9.50033V6.33366C14.333 5.49381 14.7105 4.68835 15.3825 4.09449C16.0545 3.50062 16.966 3.16699 17.9163 3.16699H25.083C26.0334 3.16699 26.9448 3.50062 27.6168 4.09449C28.2888 4.68835 28.6663 5.49381 28.6663 6.33366V9.50033" stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M17.917 17.417V26.917" stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M25.083 17.417V26.917" stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                          </svg>
                </a>
            </div>
        <?php endwhile; ?>
    </section>

<script src="css/modal_edit.js"></script>

  </body>
</html>
