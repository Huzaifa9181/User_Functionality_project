<?php
//database
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_user";

$conn = mysqli_connect($servername,$username,$password,$database);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Project</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="welcome.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="login.php">login</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
</body>

<?php


// doesnot save same username on database
  
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];
    
    $same = "SELECT * FROM `users` WHERE `name` = '$user'";
    $samesql = mysqli_query($conn,$same);
    $row = mysqli_num_rows($samesql);
    if($row > 0){
       echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>ERROR !</strong> The Username is already exsists.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }else{
    if($pass == $cpass){
      $hash = password_hash($password , PASSWORD_DEFAULT); 
      $sql = "INSERT INTO `users` (`name`, `password`) VALUES ('$user', '$hash');";
      $result = mysqli_query($conn,$sql);
      if($result){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Successfully!</strong> Your account is created and you login.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        header("location: login.php");
      }

    }else{
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>ERROR !</strong> Write a same passsword.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
      
  }

}

?>


<div class="container mt-5">
    <h1 class="text-center my-5">Welcome to SignUp Page</h1>
    <form action ="/php_project/signup.php" method="post" >   
          <div class="mb-3">
            <label for="username" class="form-label">User Name</label>
            <input type="text" required class="form-control" id="username" name="username">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" required class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
            <label for="cpassword" class="form-label">Confirm Password</label>
            <input type="password" required class="form-control" id="cpassword" name="cpassword">
        </div>
      <button type="submit" class="btn btn-primary">Sign Up</button>
    </form>
</div>

</html>