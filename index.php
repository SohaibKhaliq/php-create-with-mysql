<?php
$connection = new mysqli('localhost', 'root', '201734', 'task', 3306);
if ($connection->connect_error) {
    echo 'Server Connection Failed. Please Check your MYSQL Server';
    die();
} else {
    echo "MYSQL Server is working Fine and Connected";
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $id=$_POST['id'];

    $sql="insert into student(id,name,age) values('$id','$name','$age')";
    $result=mysqli_query($connection,$sql);
    if($result==true)
    {
        echo "<script>alert('Data is inserted')</script>";
    }
    else{
        echo "<script>alert('Data is not  inserted')</script>";
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML Forms</title>
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="id">ID</label>
        <input type="text" name="id" id="id" placeholder="Enter Your ID!">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" placeholder="Enter Your Name!">
        <label for="age">Age</label>
        <input type="text" name="age" id="age" placeholder="Enter Your Age!">
        <input type="submit" value="Submit">
    </form>
</body>

</html>