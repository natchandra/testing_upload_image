

<!DOCTYPE html>
<html lang="en">
<head> 
    <title>PHP</title>
</head>
<body>
    <form action="index.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="image" />
        <input type="submit" name="submit" value="upload"/>
    </form>
   
    <?php
    
        if(isset($_POST["submit"])){

            //connect DB
            $conn = mysqli_connect('localhost', 'root', '', 'nodemysql');
            if(!$conn){
                echo 'connection error: ' . mysqli_connect_error();
            }
           
            //check if it's not image
            if(!isset($_FILES["image"]["tmp_name"])){
                echo "Please select an image";
            }else{
                $file = $_FILES["image"]["tmp_name"];
                $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                $image_name = addslashes($_FILES['image']['name']);
                $image_size = getimagesize($_FILES['image']['tmp_name']);

                if($image_size == FALSE){
                    echo "that is not an image";
                }else{
                    //echo "that is image";
                    $sql = "INSERT INTO images
                            VALUES ('', '$image_name', '$image')";
                    if (mysqli_query($conn, $sql)) {
                        echo "New record created successfully";
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                }
            }
        }
    
    ?>
    <br>
    <hr>
    <p>Search by id: </p>
    <form action="index.php" method="POST">
        <input type="number" name="number" required/>
        <input type="submit" name="submit" value="search" />
    </form>
    <?php
        include "get.php";
    ?>
</body>
</html>