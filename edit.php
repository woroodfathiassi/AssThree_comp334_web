<?php
    include 'dbconfig.in.php';
    $warningMessage = '';
    $db = new Database();

    $name='';
    $gender='' ;
    $dateb='';
    $depar='';
    $avg='';
    $add='';
    $city='';
    $coun='';
    $phon='';
    $email='';
    $photo='';

    if(isset($_GET['id'])){
        $data = $db->getStudent($_GET['id']);

        if($data){
            foreach($data as $row){
                $name=$row['name'];
                $gender=$row['gender'];
                $dateb=$row['date_of_birth'];
                $depar=$row['department'];
                $avg=$row['average'];
                $add=$row['address'];
                $city=$row['city'];
                $coun=$row['country'];
                $phon=$row['tel'];
                $email=$row['email'];
                $photo=$row['student_photo'];
            }
        }
    }
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST['update'])) {
            $action = $_POST['update'];

            if($action == 'Update'){
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    
                    if ( isset($_POST['stuID']) && isset($_POST['name']) && isset($_POST['gender']) &&            ////to chick if the value is float number or not
                    isset($_POST['date_of_birth']) && isset($_POST['department']) && isset($_POST['average']) && (filter_var($_POST['average'], FILTER_VALIDATE_FLOAT) !== false) == 1 &&
                    isset($_POST['address']) && isset($_POST['city']) && isset($_POST['country']) &&
                    isset($_POST['tel']) && (preg_match('/^05\d{8}$/', $_POST['tel']) === 1) && //// Use preg_match to check if the phone number matches the pattern
                    isset($_POST['email']) && isset($_FILES["student_photo"]) && $_FILES["student_photo"]["error"] == 0) {
                        

                        //delete the old one then insert the new:
                        $folderPath = "images/"; // Replace with the actual path to your folder
                        $imageName = $_POST['stuID'].".jpeg"; // Replace with the actual image name and extension

                        $filePath = $folderPath . $imageName;

                        if (file_exists($filePath)) {
                            // Attempt to delete the file using unlink()
                            // if (unlink($filePath)) {
                            //     echo "Image deleted successfully.";
                            // } else {
                            //     echo "Error deleting image.";
                            // }
                        } else {
                            $warningMessage = "Image not found.";
                        }

                        $targetDirMyFolder = "images/";  // Specify the target directory
                        $newFileName = $_POST['stuID'].".jpeg";  // New file name
                        $targetFile = $targetDirMyFolder . $newFileName;  // Define the target file with the new name

                        // Move the uploaded file to the specified directory with the new name
                        if (move_uploaded_file($_FILES["student_photo"]["tmp_name"], $targetFile)) {
                            $warningMessage = "The file " . htmlspecialchars($newFileName) . " has been uploaded.";  // Display the new file name
                        }
                        
                        $db->createConnection();
                        $db->updateStudent(
                            $_POST['stuID'],
                            $_POST['name'],
                            $_POST['gender'],
                            $_POST['date_of_birth'],
                            $_POST['department'],
                            $_POST['average'],
                            $_POST['address'],
                            $_POST['city'],
                            $_POST['country'],
                            $_POST['tel'],
                            $_POST['email'],
                            $_POST['stuID'].".jpeg"
                        );



                        }else if ( isset($_POST['stuID']) && isset($_POST['name']) && isset($_POST['gender']) &&            ////to chick if the value is float number or not
                            isset($_POST['date_of_birth']) && isset($_POST['department']) && isset($_POST['average']) && (filter_var($_POST['average'], FILTER_VALIDATE_FLOAT) !== false) == 1 &&
                            isset($_POST['address']) && isset($_POST['city']) && isset($_POST['country']) &&
                            isset($_POST['tel']) && (preg_match('/^05\d{8}$/', $_POST['tel']) === 1) && //// Use preg_match to check if the phone number matches the pattern
                            isset($_POST['email']) ){
                                
                                $db->createConnection();
                                $db->updateStudent(
                                $_POST['stuID'],
                                $_POST['name'],
                                $_POST['gender'],
                                $_POST['date_of_birth'],
                                $_POST['department'],
                                $_POST['average'],
                                $_POST['address'],
                                $_POST['city'],
                                $_POST['country'],
                                $_POST['tel'],
                                $_POST['email'],
                                null
                            );
                        }
                    }
                    else{
                        $warningMessage = "Something is erorr";
                    }
            }
        }
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="css.css">
</head>
<body>
    <header>
    <h1 style="text-decoration: underline;">Here You Can Edit Your Information: </h1>
    </header>
    <main>
        <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data" autocomplete="off"> <!-- enctype="multipart/form-data"  ==> to upload files-->
            <fieldset>
                <legend>Student Record:</legend>

                <label for="stuID">Student ID:</label>
                <input type="text" id="stuID" name="stuID" readonly value="<?php echo $_GET['id'] ; ?>" ><br><br>

                <label for="name">Student Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $name; ?>"><br><br>

                <label>Gender:</label>
                <input type="radio" id="male" name="gender" value="M" <?php 
                        if($gender === 'M'){ ?>
                            checked
                        <?php }
                     ?> >
                <label for="male">Male</label>
    
                <input type="radio" id="female" name="gender" value="F" <?php 
                        if($gender === 'F'){ ?>
                            checked
                        <?php }
                     ?> >
                <label for="female">Female</label><br><br>

                <label for="date_of_birth">Date OF Birth</label>
                <input type="date" id="date_of_birth" name="date_of_birth" value="<?php echo htmlspecialchars($dateb); ?>">

                <br><br>
                
                <label for="department">Department:</label>
                <input type="text" id="department" name="department" value="<?php echo $depar; ?>"><br><br>

                <label for="average">Average:</label>
                <input type="text" id="average" name="average" value="<?php echo $avg; ?>"><br><br>

                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="<?php echo $add; ?>"><br><br>

                <label for="city">City:</label>
                <input type="text" id="city" name="city" value="<?php echo $city; ?>"><span>    </span>

                <label for="country">Country:</label>
                <input type="text" id="country" name="country" value="<?php echo $coun; ?>"><br><br>

                <label for="tel">Tel:</label>
                <input type="text" id="tel" name="tel" placeholder="059-1234567" value="<?php echo $phon; ?>"><br><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $email; ?>"><br><br>

                <label for="student_photo">Student Photo:</label>
                <input type="file" id="student_photo" name="student_photo" accept=".jpeg" ><br><br>

                <input type="submit" style="margin-left: 50px;" name="update" value="Update"> 
            </fieldset>
        </form>
    </main>
    <footer>
    <h3 style="color: red;"><?php echo $warningMessage; ?></h3>
    </footer>
</body>
</html>