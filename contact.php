<?php
$servername = "localhost";
$user = "root";
$pass = "";
$db = "web";

$conn = new mysqli($servername,$user,$pass,$db);

if($conn->error){
    echo "DB error ".$conn->error."";
}
else{
    echo "Connection successful";
}

//inserting data into our database

if(isset($_POST['insert'])){
    echo "<br>";

    #$id = $_POST['id'];
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "insert into jordan (name,email,message) values 
    ('$name','$email','$message')";

    if($conn->query($sql)){
        echo '<div class="alert alert-primary" role="alert"> Message Saved SUCCESSFULLY!!!! </div>';
    }
    else{
        echo '<div class="alert alert-danger" role="alert"> Error is here: ".$conn->error." </div>';
    }

}

if(isset($_POST['show'])){


    $sql = "select * from jordan";

    $myquery = $conn->query($sql);
    
    while($result = $myquery->fetch_assoc()){
        
        echo '<footer>';
        echo '<table class="table bg-warning"">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Message</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>';
                    echo '<th scope="row">'.$result['id'].'</th>';
                    echo '<td>'.$result['name'].'</td>';
                    echo '<td>'.$result['email'].'</td>';
                    echo '<td>'.$result['message'].'</td>
                </tr>
                </tbody>
            </table>';
                
        echo '</footer>';
        
    }

}

?>

<!doctype html>
<html lang="en">
<?php include('head.php'); ?>
  <body>
  <?php include('header.php'); ?>

      <form action="contact.php" method="POST">

        <div class="form-group container">
          <label for="name">Name: </label>
          <input type="text" class="form-control" name="name" id="name" placeholder="Enter your Name">
          <label for="email">Email: </label>
          <input type="email" class="form-control" name="email" id="email" placeholder="Enter your Email">
          
          <label for="message">Message: </label>
          
            <textarea class="form-control" name="message" id="message" rows="5" placeholder="Enter your message here!"></textarea>
           <input class="btn btn-success" type="submit" name="insert" value="Send Message"/>
           <input class="btn btn-warning" type="submit" name="show" value="Display Messages"/>
        </div>

      </form>
      <br>

   </body>
</html>