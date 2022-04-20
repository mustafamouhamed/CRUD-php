<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'traning_company';
$conection = mysqli_connect('localhost', 'root', '', 'traning_company');
###################   //create ##########################

if (isset($_POST['send'])) {
    $course =  $_POST['courseName'];
    $cost =  $_POST['courseCost'];
    $insert = "INSERT INTO `courses` VALUES (null,'$course', $cost)";
    $i = mysqli_query($conection, $insert);
    if ($i) {
        echo "<div class='alert alert-info mx-auto w-50'>
    insert Done into database
      </div>";
    } else {
        echo "<div class='alert alert-danger mx-auto w-50'>
    insert False into database
      </div>";
    }
}
###########################   REd  #####################################################################
$select = "SELECT * FROM `courses`";
$s = mysqli_query($conection, $select);

############## DELETE#################
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    $delete = "DELETE FROM `courses` WHERE id = $id ";
    $p = mysqli_query($conection,  $delete);
    header("location:index.php");
}
############## UPDATE #################################  
$name = '';
$cost = '';
$update = false;
if (isset($_GET['Edit'])) {
    $update = true;
    $id = $_GET['Edit'];
    $select = "SELECT * FROM `courses` WHERE id=$id";
    $ss = mysqli_query($conection, $select);
    $data = mysqli_fetch_assoc($ss);
    $name = $data['name'];
    $cost = $data['cost'];
    if (isset($_POST['update'])) {
        $course = $_POST['courseName'];
        $cost = $_POST['courseCost'];
        $update = "UPDATE  `courses` SET `name`= '$course', cost= $cost  WHERE id = $id ";
        $UP = mysqli_query($conection,  $update);
        header("location:index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <link rel="stylesheet" href="./css/main.css">
    <style>
        body {
            background-color: black;
            color: white;
        }

        .card {
            background-color: #333;
            color: white;
        }
    </style>
</head>


<body>


    <div class="container col-md-6">
        <div class="card">
            <div class="card-body">
                <form method="POST">
                    <div class="form-group">
                    <label for=""> course name</label>
                        <input type="text" value = "<?php echo $name ?>" name="courseName" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for=""> course Cost</label>
                        <input type="text" value = "<?php echo $cost ?> "name="courseCost" class="form-control">
                    </div>
                    <?php if ($update) { ?>
                        <button name="update" class="btn btn-info btn-block">update Data</button>
                    <?php } else { ?>
                        <button name="send" class="btn btn-info btn-block">Send Data</button>
                    <?php }  ?>


                </form>
            </div>

        </div>
    </div>
    <div class="container col-md-6 mt-4">
        <div class="card">
            <div class="card-body">
                <table class="table table-dark">
                    <tr>
                        <th>ID</th>
                        <th>course</th>
                        <th>cost</th>
                        <th>action</th>
                    </tr>
                    <?php foreach ($s as $data) { ?>

                        <tr>
                            <td> <?php echo $data['id']  ?></td>
                            <td> <?php echo $data['name']  ?></td>
                            <td> <?php echo $data['cost']  ?></td>
                            <td> <a onclick="return confirm('are you sure')" href=" index.php?del=<?php echo $data['id']  ?>" class="btn btn-danger">delete </a></td>
                            <td> <a href=" index.php?Edit=<?php echo $data['id'] ?>" class="btn btn-info">Edit </a></td>


                        </tr>
                    <?php  } ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>