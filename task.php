<?php
$connection = new mysqli('localhost', 'root', '201734', 'revision', 3306);
if ($connection->connect_error) {
    echo "there is an error in connecting to database";
    die();
}
echo "database is connected";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $cnic = $_POST['cnic'];
    $password = md5($_POST['password']);
    $city = $_POST['city'];

    // print $name . '</br>' .$cnic . '</br>' .$password . '</br>' .$city . '</br>';
    $sql = "insert into record(name,cnic,password,city)values('$name','$cnic','$password','$city')";
    $result = mysqli_query($connection, $sql);
    if ($result == true) {
        echo "<script>alert('data is inserted')</script>";
    } else {
        echo "<script>alert('data is not inserted')</script>";
    }
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $sql = "delete from record where id=$id";
        $result = mysqli_query($connection, $sql);
    }
}



$sql = "select* from record";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
}
$result = mysqli_query($connection, $sql);
$record;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $record[] = $row;
    }
}
// var_dump($record);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP create</title>
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="name">NAME</label>
        <input type="text" name="name" id="name" placeholder="enter your name">
        </br>
        </br>
        <label for="cnic">cnic</label>
        <input type="text" name="cnic" id="cnic" placeholder="enter your cnic">
        </br>
        </br>
        <label for="password">password</label>
        <input type="text" name="password" id="password" placeholder="enter your password">
        </br>
        </br>
        <label for="city">city</label>
        <input type="text" name="city" id="city" placeholder="enter your city">
        </br>
        </br>
        <input type="submit" value="submit">
    </form>
    <table border="1">
        <th>ID</th>
        <th>NAME</th>
        <th>Cnic</th>
        <th>Password</th>
        <th>City</th>
        <th>action</th>
        <?php
        if (!empty($record))
            foreach ($record as $data) {
                echo "<tr>";
                echo "<td>" . $data['id'] . "</td>";
                echo "<td>" . $data['name'] . "</td>";
                echo "<td>" . $data['cnic'] . "</td>";
                echo "<td>" . $data['password'] . "</td>";
                echo "<td>" . $data['city'] . "</td>";
                echo "<td>" . "<a href='edit.php?edit=" . $data['id'] . "'>Edit</a>" . "</td>";
                echo "<td>" . "<a href='?delete=" . $data['id'] . "'>delete</a>" . "</td>";
                echo "</tr>";
            }
        else {
            echo "no record is found";
        }
        ?>
    </table>

</body>

</html>