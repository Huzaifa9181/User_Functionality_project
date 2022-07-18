<?php
require "database.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $add_catg = $_POST['add-cat'];
    $sql = "INSERT INTO `categories` (`catg_name`) VALUES ('$add_catg');";
    $result = mysqli_query($conn,$sql);
}

if(isset($_GET["delet"] )){
    $a = $_GET["delet"];
    $del_sql = "DELETE FROM `categories` WHERE `categories`.`id` = $a";
    $result_del = mysqli_query($conn,$del_sql);

}

if(isset($_GET['edit'])){
    $edit = $_GET['edit'];
    $edit_sql = "select * from `categories` WHERE `categories`.`id` = $edit";
    $result_edit = mysqli_query($conn,$edit_sql);
    while($row2 = mysqli_fetch_assoc($result_edit) ){
        $value_id =  $row2['id'];
        $value_name = $row2['catg_name'];
        $val = $value_name;
    }
}

if(isset($_GET['save'])){
    $s = $_GET['save'];
    $save_sql="UPDATE `categories` SET `catg_name` = '$val' WHERE `categories`.`id` = $s";
    $result_save = mysqli_query($conn,$save_sql);
}

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- jquery cdn -->
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Project</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="order.php">Order</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="product.php">Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="category.php">Add Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">logout</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>

        <div class="container">
            <h1 class="text-center mt-5">Categories</h1>
            <hr>
            <!-- modal for add category -->
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add Category
    </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action ="/php_project/category.php" method="post">   
                              <div class="mb-3 row">
                                <label for="category" class="col-sm-2 col-form-label">Name :</label>
                                <div class="col-sm-10">
                                    <input type="text" name="add-cat" value="<?php echo $val;?>" class="form-control" id="add-cat">
                                </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <?php
                                
                                echo '<button type="submit" class="btn btn-primary">Save</button>';
                                ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- table -->
</div>

<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>Categories Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php

            $Sel_sql = "select * from `categories`";
            $Sel_result = mysqli_query($conn,$Sel_sql);

            while($row = mysqli_fetch_assoc($Sel_result)){
                echo '
                <tr>
                    <th>'.$row['catg_name'].'</th>
                    <td>
                    <button type="button" class="btn btn-success" id="edit-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      <a class="text-white text-decoration-none" href="?edit='.$row['id'].'">Edit</a>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            ...
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" name="?save='.$row['id'].'" class="btn btn-primary">Save changes</button>
                          </div>
                        </div>
                      </div>
                    </div></td>
                <td><button type="button" class="btn btn-danger"><a class="text-white text-decoration-none" href="?delet='.$row['id'].'">Delet</a></button></td>
                </tr>
                ';

            }
            ?>
            
        </tbody>
    </table>
    </tbody>
    </table>
</div>

    </body>

    </html>