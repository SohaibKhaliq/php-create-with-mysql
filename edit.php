<?php
$connection = new mysqli('localhost', 'root', '201734', 'revision', 3306);
if ($connection->connect_error) {
    echo "there is an error in connecting to database";
    die();
}
echo "database is connected";


if($_SERVER['REQUEST_METHOD']=="GET")
{
    if(isset($_GET['edit']))
    {
        $id=$_GET['edit'];
        $sql="select * from record where id=$id";
        $result=mysqli_query($connection,$sql);
        if($result->num_rows==0)
        {
            echo "No record is available in the database!!!";
        }
        $data=mysqli_fetch_assoc($result);

    }
}

if($_SERVER['REQUEST_METHOD']=="POST")
{
    $id=$_POST['id'];
    $name=$_POST['name'];
    $cnic=$_POST['cnic'];
    $password=md5($_POST['password']);
    $city=$_POST['city'];

    $sql="update record set name='$name',cnic='$cnic',password='$password',city='$city' where id=$id";
    $result=mysqli_query($connection,$sql);
    if($result==true)
    {
        echo "<script>alert('data is updated')</script>";
        header("Location: task.php");
    }
    else
    {
        echo "<script>alert('data is not updated')</script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <input type="text" name="id" id="id" hidden value="<?php echo $data['id'] ?>">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" value="<?php echo $data['name'] ?>">
    <label for="cnic">CNIC</label>
    <input type="text" name="cnic" id="cnic" value="<?php echo $data['cnic'] ?>">
    <label for="password">Password</label>
    <input type="text" name="password" id="password" >
    <label for="city">City</label>
    <input type="text" name="city" id="city" value="<?php echo $data['city'] ?>">
    <br>
    <input type="submit" value="Update Data">
    </form>
</body>
</html>