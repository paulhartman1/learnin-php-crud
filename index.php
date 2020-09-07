<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - CRUD Exercise</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"></link>
    <scrip src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets\css\index.css"></link>
</head>
<body>
<?php require_once 'process.php'; ?>

<?php if(isset($_SESSION['message'])): ?>
<div class="alert alert-<?php echo $_SESSION['msg_type'];?>">
    <?php 
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    ?>
</div>
<?php endif; ?>

<?php
    $mysqli = new mysqli('localhost','root','1234','crud') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT id, name, location from data") or die($mysqli->error);
?> 
<div class="container">
    <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>

            <?php 
                while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['name'];?></td>
                        <td><?php echo $row['location'];?></td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['id'];?>" class="btn btn-info">Edit</a>
                            <a href="process.php?delete=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a>
                        </td>
            <?php endwhile; ?>
        </table>
    </div>
</div>

<div class="row justify-content-center">
    <form action="process.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" value="<?php echo $name ?>" placeholder ="Enter your name"id="name">
        </div>
        <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" name="location" class="form-control" value="<?php echo $location;?>" placeholder ="Enter your location" id="location">
        </div>
        <div class="form-group">
        <?php
            if($update) {
                $btnClass = 'btn btn-info';
                $btnText = 'Update';
                $btnName = 'update';
            } else {
                $btnClass = 'btn btn-primary';
                $btnText = 'Save';
                $btnName = 'save';
            }
            echo '<button type="submit" class="'.$btnClass.'" name="'. $btnName .'">'.$btnText .'</button>'
        ?>
           
        </div>
    </form>
</div>
</body>
</html> 