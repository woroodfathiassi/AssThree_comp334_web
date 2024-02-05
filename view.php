<?php

// Check if the 'id' parameter is present in the URL
if (isset($_GET['id'])) {
    include 'dbconfig.in.php';

    $db = new Database();
    $db->createConnection();
    
    $data = $db->getStudent($_GET['id']);
    
    if ($data !== null && !empty($data)) { // Check if the student exists

        foreach ($data as $row) { 
            $imageSrc = 'images/' . htmlspecialchars($_GET['id']) . '.jpeg';
            $studentImage = '<img height="80px" width="80px" src="' . $imageSrc . '" alt="Image">';
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>View</title>
</head>
<body >
    <header>
        <?php echo $studentImage; ?>
    </header>
    <main>
        <h1>Student ID: <?php echo $row['id'] . ', Name ' . $row['name'] ?></h1>
        <ul>
            <li>Average: <?php echo $row['average']?> </li>
            <li>Department: <?php echo $row['department']?> </li>
            <li>Date of Birth: <?php echo $row['date_of_birth']?> </li>
        </ul>
        <h2>Contact</h2>
        <a href="mailto:<?php echo $row['email']?>"><?php echo 'Send Email to: ' . $row['email']?></a>
        <br><br>
        <a href="tel:<?php echo $row['tel']?>"><?php echo 'Tel. +97' . $row['tel']?></a>
        <br><br>
    </main>  
    <footer>
        <i><?php echo 'Address: ' . $row['city'] . ', ' . $row['country']?></i>
    </footer>
</body>
</html>

<?php 
    } else {
        // If 'id' parameter is not present or student does not exist, display an error message
        echo "Error: Student not found.";
    }
} else {
    // If 'id' parameter is not present, display an error message
    echo "Error: Student ID not specified in the URL.";
}
?>
