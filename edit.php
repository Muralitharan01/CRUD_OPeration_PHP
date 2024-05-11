<?php 
    $connection = mysqli_connect("localhost", "root", "", "dbcrud");
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $id = $_GET['edit'];

    $sql = "SELECT * FROM student WHERE id = '$id'";
    $run = mysqli_query($connection, $sql);

    if (!$run) {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    } else {
        $row = mysqli_fetch_assoc($run);
        $uid = $row['id'];
        $name = $row['name'];
        $address = $row['address'];
        $mobile = $row['mobile'];
    }

    if(isset($_POST['submit'])){
        $id = $_GET['edit'];
        $name = $_POST['name'];
        $address = $_POST['address'];
        $mobile = $_POST['mobile'];

        $sql = "UPDATE student SET name='$name',
         address='$address', mobile='$mobile' WHERE id='$id'";

        if(mysqli_query($connection, $sql)){
            echo '<script>location.replace("index.php")</script>';
        } else {
            echo "Something went wrong: " . mysqli_error($connection);
        }
    }

    mysqli_close($connection);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h1>Student CRUD Application</h1>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control mt-2" value="<?php echo $name; ?>">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" id="address" name="address" class="form-control mt-2" value="<?php echo $address; ?>">
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input type="text" id="mobile" name="mobile" class="form-control mt-2" value="<?php echo $mobile; ?>">
                            </div>
                            <input type="submit" class="btn btn-primary mt-4" name="submit" value="Edit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
