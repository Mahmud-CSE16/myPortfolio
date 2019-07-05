<?php
 session_start();
  $error="";
  $name=$username=$email=$password="";
  $connection= mysqli_connect("localhost","root","","my_portfolio");
  
  
  if (mysqli_connect_errno())
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  else{
    if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    if(!empty($email)&&!empty($password)){
        if(!empty($_POST["remember"])){
              setcookie('cookie_name','$email', time() + (86400 * 30)); // 86400 = 1 day
          }
      $query = "SELECT * FROM auth where email='$email' and password='$password'";

      if($check=mysqli_query($connection, $query)){

        if(mysqli_num_rows($check)>0){

          $entity = mysqli_fetch_array($check);
          $_SESSION['user_email']=$entity['email'];
          $_SESSION['user_id']=$entity['id'];
          $_SESSION['user_name']=$entity['name'];

          echo "<script type='text/javascript'>";
          echo "alert('Successfully Loged in');";
          echo "</script>";

        }else{
          echo "<script type='text/javascript'>";
          echo "alert('Not Loged In, please enter your correct email/password.');";
          echo "</script>";
        }
         $name=$username=$email=$password="";

      }else{
        echo "<script type='text/javascript'>";
        echo "alert('Not Loged In, there have some problem');";
        echo "</script>";

      $name=$username=$email=$password="";
      }
    }
    }
  }
  
 ?>

<?php 
  if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    else{
    if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if(!empty($name)&&!empty($email)&&!empty($password)){
      $query = "INSERT INTO auth SET
          ID='',
          name='$name',
          email='$email',
          password='$password'";
      $error="";
      if($check=mysqli_query($connection, "SELECT * FROM auth where email='$email'")){
        if(mysqli_num_rows($check)>=1){
          $error.='*Already have your account.';
        }
      }if($error==""){
        if(mysqli_query($connection, $query)){

          echo "<script type='text/javascript'>";
          echo "alert('Successfully Registered');";
          echo "</script>";
          $name=$username=$email=$password="";

        }else{
          echo "<script type='text/javascript'>";
          echo "alert('Not Registered, there have some problem');";
          echo "</script>";

        $name=$username=$email=$password="";
        }
      }else{
         echo "<script type='text/javascript'>";
          echo "alert('Not Registered,".$error."');";
          echo "</script>";
      }
  }

  }
  }
 
 ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Shahnewaz Protfolio</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="css/clean-blog.min.css" rel="stylesheet">
  <style>

/* Full-width input fields */
input[type=text], input[type=password], input[type=email] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 30%;
  border-radius: 50%;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="index.php">Shahnewaz</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="education.php">Education</a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="skill.php">Skill</a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="extra_curriculam.php">Extra Curriculum</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
          <?php if(isset($_SESSION['user_name'])){ ?>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href=""><i class="fas fa-user mr-1" style="color: black;"></i><?php echo $_SESSION['user_name']; ?></a>
          </li>
          <?php }else{ ?>
           <li class="nav-item">
            <a class="nav-link" onclick="document.getElementById('id01').style.display='block'">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" onclick="document.getElementById('id02').style.display='block'">Register</a>
          </li>
        <?php } ?>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Shahnewaz's Protfolio</h1>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <h1 class="text-success" style="margin: 0; padding: 0; padding-bottom: 3px">Shahnewaz Rahi</h1>
      <h4 class="text-success" style="margin: 0; padding: 0;">
        Khan Jahan Ali Hall,<br>
          KUET,Khulna. <br>
          Mobile: 01536187265 <br>
          Email: shahnewazrahi@gmail.com
        </h4>
      <hr>

         <!-- Comments Form -->
         <?php 
         if(isset($_POST['submit'])){
             $user_id = $_SESSION['user_id'];
             $user_name = $_SESSION['user_name'];
             $content = $_POST['content'];
             
             $query = "INSERT INTO comment(user_id,content) ";
             $query .= "VALUES({$user_id},'{$content}')";
             
             $create_comment_query = mysqli_query($connection,$query);
             if(!$create_comment_query){
                 die("Query failed ".mysqli_error($connection));
             } 
           }
          ?>
          <div class="well">
              <h4>Leave a Comment <small>(give me some suggession and inspiration)</small>:</h4>
              <form method="POSt" action="">
                  <div class="form-group">
                      <textarea class="form-control" rows="3" name="content"></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
              </form>
          </div>

          <hr>

          <!-- Posted Comments -->

           <?php 
                  $query = "select (select name from auth where auth.id = comment.user_id) as name,content from comment ";
                  $query .= "ORDER BY id DESC ";
                  $select_comments = mysqli_query($connection,$query);

                  while($row = mysqli_fetch_assoc($select_comments)){
                     $comment_author = $row['name'];
                     $comment_content = $row['content'];
                    ?>
                     <!-- Comment -->
                 <div class="media">
                    <a class="pull-left" href="#">
                        <i class="fas fa-user mr-2" style="color: black;"></i>
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?></h4>
                        <?php echo $comment_content; ?>
                    </div>
                 </div>

                <?php  
                  }?>

          <!-- Comment -->
          <hr>
      </div>
    </div>
  </div>

  <hr>

  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <ul class="list-inline text-center">
            <li class="list-inline-item">
              <a href="https://www.instagram.com/shahnewaz_rahi/">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab  fa-instagram fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="https://www.facebook.com/shahnewazrahi">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
          </ul>
          <p class="copyright text-muted">Copyright &copy; Shahnewaz Rahi 2019</p>
        </div>
      </div>
    </div>
  </footer>

  <div id="id01" class="modal">
  <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          
          <form class="modal-content animate" method="POST" action="">
            <div class="imgcontainer">
              <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
              <img  src="img/rahi.PNG" alt="" class="avatar">
            </div>

            <div class="container">
              <label for="email"><b>Email</b></label>
              <input type="email" placeholder="Enter Email" name="email" required>

              <label for="password"><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="password" required>
                
              <button type="submit" name="login">Login</button>
              <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
              </label>
            </div>

            <div class="container" style="background-color:#f1f1f1">
              <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
              <span class="psw">Forgot <a href="#">password?</a></span>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div id="id02" class="modal">
  <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          
          <form class="modal-content animate"  method="POST" action="">
            <div class="imgcontainer">
              <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
              <img  src="img/rahi.PNG" alt="" class="avatar">
            </div>

            <div class="container">
              <label for="name"><b>Name</b></label>
              <input type="text" placeholder="Enter Name" name="name" required>

              <label for="email"><b>Email</b></label>
              <input type="email" placeholder="Enter Email" name="email" required>

              <label for="password"><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="password" required>
                
              <button type="submit" name="register">Register</button>
            </div>

            <div class="container" style="background-color:#f1f1f1">
              <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
              <!-- <span class="psw">Forgot <a href="#">password?</a></span> -->
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

<!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/clean-blog.min.js"></script>

</body>

</html>
