<?php

class Database{
 
    private $dsn = 'mysql:host=localhost;dbname=students';
    private $user = 'root';
    private $password = '';

    private $pdo;

    public function createConnection() {
        try{
            $this->pdo = new PDO($this->dsn, $this->user, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }catch(PDOException $e){
             echo "Connection failed: " . $e->getMessage();
             //die(' Error connecting to the database');
         }
    }

    public function getAllStudents() {
        $this->createConnection();

        $sql ="SELECT * FROM students";

        $statement = $this->pdo->prepare($sql);
        $statement->execute();

        // Fetch results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $this->pdo = null;

        return $result;
    }

    public function insert($stuID, $name, $gender, $dateb, $depar, $avg, $add, $city, $coun, $phon, $email, $photo){
        $this->createConnection();

        $sql = "INSERT INTO students (id, name, gender, date_of_birth, department, average, address, city, country, tel, email, student_photo) 
            VALUES (:id, :name, :gender, :dateOfBirth, :department, :average, :address, :city, :country, :tel, :email, :studentPhoto)";

        $statement = $this->pdo->prepare($sql);
            
        $statement->bindValue(':id', $stuID);
        $statement->bindValue(':name',$name );
        $statement->bindValue(':gender', $gender);
        $statement->bindValue(':dateOfBirth', $dateb);
        $statement->bindValue(':department', $depar);
        $statement->bindValue(':average', $avg);
        $statement->bindValue(':address', $add);
        $statement->bindValue(':city', $city);
        $statement->bindValue(':country', $coun);
        $statement->bindValue(':tel', $phon);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':studentPhoto', $photo);
        $statement->execute();

        $this->pdo = null;
    }

    public function tableData(){
        $this->createConnection();

        $sql ="SELECT student_photo, id, name,  department, average   FROM  students";

        $statement = $this->pdo->prepare($sql);
        $statement->execute();

        // Fetch results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        $this->pdo = null;

        return $result;

    }

    public function getStudent($id){
        $this->createConnection();

        $sql ="SELECT id, name, gender, date_of_birth, department, average, address, city, country, tel, email, student_photo FROM students WHERE id = :id";

        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        // Fetch results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        $this->pdo = null;

        return $result;
    }

    public function deleteStudent($id){
        $this->createConnection();

        $sql ="DELETE FROM students WHERE id = :id";

        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        // Fetch results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        $this->pdo = null;

        return $result;
    }

    public function updateStudent($stuID, $name, $gender, $dateb, $depar, $avg, $add, $city, $coun, $phon, $email, $photo){
        $this->createConnection();

        if($photo != null){
            $sql = "UPDATE students 
            SET name=:name, 
                gender=:gender, 
                date_of_birth=:dateOfBirth, 
                department=:department, 
                average=:average,
                address=:address, 
                city=:city, 
                country=:country, 
                tel=:tel, 
                email=:email, 
                student_photo=:studentPhoto 
            WHERE id=:id";

            $statement = $this->pdo->prepare($sql);

            $statement->bindValue(':id', $stuID);
            $statement->bindValue(':name', $name);
            $statement->bindValue(':gender', $gender);
            $statement->bindValue(':dateOfBirth', $dateb);
            $statement->bindValue(':department', $depar);
            $statement->bindValue(':average', $avg);
            $statement->bindValue(':address', $add);
            $statement->bindValue(':city', $city);
            $statement->bindValue(':country', $coun);
            $statement->bindValue(':tel', $phon);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':studentPhoto', $photo, PDO::PARAM_LOB);
            $statement->execute();
        }else{
            $sql = "UPDATE students 
            SET name=:name, 
                gender=:gender, 
                date_of_birth=:dateOfBirth, 
                department=:department, 
                average=:average,
                address=:address, 
                city=:city, 
                country=:country, 
                tel=:tel, 
                email=:email 
            WHERE id=:id";

            $statement = $this->pdo->prepare($sql);

            $statement->bindValue(':id', $stuID);
            $statement->bindValue(':name', $name);
            $statement->bindValue(':gender', $gender);
            $statement->bindValue(':dateOfBirth', $dateb);
            $statement->bindValue(':department', $depar);
            $statement->bindValue(':average', $avg);
            $statement->bindValue(':address', $add);
            $statement->bindValue(':city', $city);
            $statement->bindValue(':country', $coun);
            $statement->bindValue(':tel', $phon);
            $statement->bindValue(':email', $email);
            $statement->execute();
        }

        $this->pdo = null;
    }
}

     
?>
