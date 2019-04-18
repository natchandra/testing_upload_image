<?php 

    if (isset($_POST["number"]))
    {
        $conn = mysqli_connect('localhost', 'root', '', 'nodemysql');
        if(!$conn){
            echo 'connection error: ' . mysqli_connect_error();
        }    

        $id = $_POST['number'];

        $sql = "SELECT * from images WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 0){
            echo "no data";
        }else{
            while($row = mysqli_fetch_assoc($result)){
                //echo "id : " . $row['id'] . " - Name : " . $row['name'];
                $imageData = $row['img'];
                //convert data image yang di db kn binary jadi harus diencode 
                echo '<img src="data:image/jpeg;base64,'.base64_encode( $imageData ).'"/>';
    
            }   
        }
 
        mysqli_close($conn);
    }

?>

