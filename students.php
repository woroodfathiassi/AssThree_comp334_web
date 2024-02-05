<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 3: PHP</title>

    <link rel="stylesheet" href="css.css">
</head>
<body>
    <header>

    </header>
    <main>
        <p>
            To register a new student, click on the following link <a href="register.php">Register</a>.
        </p>
        <p>
            Or use the actions below to edit or delete a student's record.
        </p><br>
        <table>
            <caption><h1>Students Table Result</h1></caption>
            <thead>
                <tr>
                    <th>Student Photo</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Average</th>
                    <th>Department</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'dbconfig.in.php';

                $db = new Database();
                $db->createConnection();
                $data = $db->tableData();

                foreach ($data as $row) { 
                    $imageSrc = 'images/' . htmlspecialchars($row['id']) . '.jpeg';
                    $studentImage = '<img height="80px" width="80px" src="' . $imageSrc . '" alt="Image">';

                    echo '<tr>';
                    echo '<td>' . $studentImage . '</td>';
                    // Using Query Strings in Hyperlinks to make it dynamic script
                    echo '<td><a href="view.php?id=' . $row['id'] . '">' . $row['id'] . '</a></td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['average'] . '</td>';
                    echo '<td>' . $row['department'] . '</td>';
                    
                    echo '<td>
                            <a href="edit.php?id=' . $row['id'] . '" style="text-decoration: none;">
                                <button>
                                    <img src="./img/edit.png" alt="edit">
                                </button>
                            </a>

                            <a href="delete.php?id=' . $row['id'] . '" style="text-decoration: none;">
                                <button>
                                    <img src="./img/delete.png" alt="delete">
                                </button>
                            </a>
                        </td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </main>
    <footer>

    </footer>
</body>
</html>
