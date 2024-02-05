<?php
    include 'dbconfig.in.php';
    
    $warningMessage = '';

    $db = new Database();
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST['insert'])) {
            $action = $_POST['insert'];

            if($action == 'Insert'){
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if ( isset($_POST['stuID']) && isset($_POST['name']) && isset($_POST['gender']) &&            //to chick if the value is float number or not
                    isset($_POST['date_of_birth']) && isset($_POST['department']) && isset($_POST['average']) &&(filter_var($_POST['average'], FILTER_VALIDATE_FLOAT) !== false) == 1 &&
                    isset($_POST['address']) && isset($_POST['city']) && isset($_POST['country']) &&
                    isset($_POST['tel']) && (preg_match('/^05\d{8}$/', $_POST['tel']) === 1) && //// Use preg_match to check if the phone number matches the pattern
                    isset($_POST['email']) && isset($_FILES["student_photo"]) && $_FILES["student_photo"]["error"] == 0) {
                        
                        
                        $targetDirMyFolder = "images/";  // Specify the target directory
                        $newFileName = $_POST['stuID'].".jpeg";  // New file name
                        $targetFile = $targetDirMyFolder . $newFileName;  // Define the target file with the new name

                        // Move the uploaded file to the specified directory with the new name
                        if (move_uploaded_file($_FILES["student_photo"]["tmp_name"], $targetFile)) {
                            //echo "The file " . htmlspecialchars($newFileName) . " has been uploaded.";  // Display the new file name
                        }

                        $db->createConnection();
                        $db->insert(
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

                        }else{
                            $warningMessage = "Invalid Values.";
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
        <h1 style="text-decoration: underline;">Please Enter Your Correct Values:&#10004 </h1>
    </header>
    <main>
        <form action="register.php" method="post" enctype="multipart/form-data" autocomplete="off"> <!-- enctype="multipart/form-data"  ==> to upload files-->
            <fieldset>
                <legend>Student Record:</legend>

                <label for="stuID">Student ID:</label>
                <input type="text" id="stuID" name="stuID" ><br><br>

                <label for="name">Student Name:</label>
                <input type="text" id="name" name="name" ><br><br>

                <label>Gender:</label>
                <input type="radio" id="male" name="gender" value="Male" >
                <label for="male">Male</label>
    
                <input type="radio" id="female" name="gender" value="Female" >
                <label for="female">Female</label><br><br>

                <label for="date_of_birth">Date OF Birth</label>
                <input type="date" id="date_of_birth" name="date_of_birth"><br><br>
                
                <label for="department">Department:</label>
                <input type="text" id="department" name="department" ><br><br>

                <label for="average">Average:</label>
                <input type="text" id="average" name="average" ><br><br>

                <label for="address">Address:</label>
                <input type="text" id="address" name="address" ><br><br>

                <label for="city">City:</label>
                <input type="text" id="city" name="city" ><span>    </span>

                <label for="country">Country:</label>
                <input type="text" id="country" name="country" ><br><br>

                <label for="tel">Tel:</label>
                <input type="text" id="tel" name="tel" placeholder="059-1234567"><br><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" ><br><br>

                <label for="student_photo">Student Photo:</label>
                <input type="file" id="student_photo" name="student_photo" accept=".jpeg"><br><br>

                <input type="submit" style="margin-left: 50px;" name="insert" value="Insert"> 
            </fieldset>
        </form>
    </main>
    <footer>
        <h3 style="color: red;"><?php echo $warningMessage; ?></h3>
    </footer>
</body>
</html>