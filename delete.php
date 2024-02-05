<?php
// Check if the 'id' parameter is present in the URL
if (isset($_GET['id'])) {
    include 'dbconfig.in.php';

$iid = $_GET['id'];

    $db = new Database();

    //delete the old one then insert the new:
    $folderPath = "images/"; // Replace with the actual path to your folder
    $imageName = $_GET['id'].".jpeg"; // Replace with the actual image name and extension

    $filePath = $folderPath . $imageName;

    if (file_exists($filePath)) {
        // Attempt to delete the file using unlink()
        if (unlink($filePath)) {
            echo "Image deleted successfully.";
        } else {
            echo "Error deleting image.";
        }
    } else {
        echo "Image not found.";
    }

    //create connection with my database:
    $db->createConnection();
    
    $data = $db->deleteStudent($_GET['id']);
    
    if($data == null){ //chick if the student existed

    ?>
  
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>
  </head>
  <body>
        <header>
            
        </header>
        <main>
            <br>
            <h1>The student with <?php echo $iid .'ID'; ?> <span style="color: red;">DELETED</span></h1>
            <br>
        </main>  
        <footer>
            
        </footer>
  </body>
  </html>

<?php 
    } else {
        // If 'id' parameter is not present, display an error message
        echo "Error: Student ID not specified in the URL.";
    }
}
?>
