<?php
$connection=new mysqli('localhost','root','201734','revision',3306);

if($connection->connect_error)
{
    print "There is an error in connecting to Database";
    die();
}

echo "Database is Connected!";

if($_SERVER['REQUEST_METHOD']=="POST")
{
    $name=$_POST['name'];
    $cnic=$_POST['cnic'];
    $password=md5($_POST['password']);
    $city=$_POST['city'];

    $query="insert into record(name,cnic,password,city)values('$name','$cnic','$password','$city')";

    $outcome=mysqli_query($connection,$query);
    if($outcome==true)
    {
        echo "Data is Inserted!!";
    }
}

$sql="select * from record";

$result=mysqli_query($connection,$sql);
// var_dump($result);
$record;
if($result->num_rows>0)
{
    while($row=$result->fetch_assoc())
    {
        $record[]=$row;
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Create</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" placeholder="Enter Your Name!!">
        <br>
        <label for="cnic">CNIC</label>
        <input type="text" name="cnic" id="cnic" placeholder="Enter Your CNIC!!">
        <br>
        <label for="password">Password</label>
        <input type="text" name="password" id="password" placeholder="Enter Your password!!">
        <br>
        <label for="city">City</label>
        <input type="text" name="city" id="city" placeholder="Enter Your city!!">
        <br>

        <input type="submit" value="Submit form!">
    </form>


    <table border="1">
        <th>ID</th>
        <th>Name</th>
        <th>CNIC</th>
        <th>Password</th>
        <th>City</th>
        <?php
        if(!empty($record))
        {
            foreach($record as $data)
            {
                echo "<tr>";
                echo "<td>". $data['id']."</td>";
                echo "<td>". $data['name']."</td>";
                echo "<td>". $data['cnic']."</td>";
                echo "<td>". $data['password']."</td>";
                echo "<td>". $data['city']."</td>";
                echo "</tr>";
            }
        }
        else
        {
            echo "No Record is Found!";
        }
        ?>
    </table>
</body>
</html>