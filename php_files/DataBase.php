<?php
require "Advertisements.php";
class DataBase{
    private $hostName = "localhost";
    private $userName = "root";
    private $password = "MuRYS7GtmQ";
    private $dbName = "database";
    private $port = 3308;

    public function getPort():int{
        return $this->port;
    }

    public function getHostName():string{
        return $this->hostName;
    }

    public function getUserName():string{
        return $this->userName;
    }

    public function getPassword():string{
        return $this->password;
    }

    public function getDbName():string{
        return $this->dbName;
    }

    public function setPort($port)
    {
        $this->port = $port;
    }

    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    public function setHostName($hostName)
    {
        $this->hostName = $hostName;
    }

    public function setDbName($dbName)
    {
        $this->dbName = $dbName;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function check2(){
        if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
            echo 'We don\'t have mysqli!!!';
        } else {
            echo 'Phew we have it!';
        }
    }

    public function installcheck():string{
        if(function_exists('mysqli_connect')){
            return "mysqli is installed <br>";
        }
        else{
            return "Enable mysqli support in your PHO install<br>";
        }
    }

    public function createUserTable():string{
        $conn = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());

        try{
            $sql = "CREATE TABLE Users 
            (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(30) NOT NULL
            )";
            if($conn->query($sql) === true){
                return "Users Table created successfully<br>";
            }
        }
        catch (mysqli_sql_exception $ex){
            return "Users Table is already created<br>";
        }

        $conn->close();
        return "";
    }

    public function createAdvTable():string{
        $connect1 = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());

        try{
            $sql = "CREATE TABLE Advertisements 
            (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                userid INT(6) NOT NULL, 
                title VARCHAR(30) NOT NULL
            )";
            if($connect1->query($sql) === true){
                return "Advertisements Table successfully created<br>";
            }
        }
        catch (mysqli_sql_exception $ex){
            return "Advertisements Table already created<br>";
        }
        return "";
    }

    public function writeInUsers(Users $users):string{
        $connect2 = mysqli_connect($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());

        if($connect2->connect_error){
            die("Connection failed: " . $connect2->connect_error . "<br>");
        }

        $id = $users->getUserID();
        $name = $users->getUserName();

        try{
            $sql = "INSERT INTO Users (id, username) VALUES ($id, $name)";
            if($connect2->query($sql) === true){
                return "New entry successfully created<br>";
            }
            else{
                return "An error has occurred: " . $sql . "\n" . $connect2->error . "<br>";
            }
        }
        catch (mysqli_sql_exception $ex){
            return $users->setUserName() . " has already been taken.<br>";
        }

        $connect2->close();
    }

    public function writeInAdvertisement(Advertisements $advertisements):string{
        $connect3 = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());

        if($connect3->connect_error){
            die("Connection failed: " . $connect3->connect_error . "<br>");
        }

        $id = $advertisements->getId();
        $userid = $advertisements->getUserID();
        $title = $advertisements->getTitle();

        try{
            $sql = "INSERT INTO advertisements (id,userid, title) VALUES ($id,'$userid','$title')";
            if($connect3->query($sql) === true){
                return "New entry has been successful <br>";
            }
            else{
                return "Error: " . $sql . "\n" . $connect3->error . "<br>";
            }
        }
        catch (mysqli_sql_exception $ex){
            return $advertisements->getUserName() . " already taken<br>";
        }
        catch (TypeError $tr){

        }

        $connect3->close();
        return "";
    }

    public function getDataUsers():string{
        $connect4 = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());

        if($connect4->connect_error){
            die("Connection failed: " . $connect4->connect_error . "<br>");
        }

        $query = "SELECT * FROM Users;";
        $result = mysqli_query($connect4, $query);
        $resultCheck = mysqli_num_rows($result);

        if($resultCheck > 0){
            while($row = mysqli_fetch_assoc($result)){
                return "Id: " . $row["id"] . ", Name: " . $row["userName"] . "<br>";
            }
        }
        else{
            return "0 result found<br>";
        }

        $connect4->close();
        return "";
    }

    public function getDataAdvertisement():string{
        $connect5 = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());

        if($connect5->connect_error){
            die("Connection failed: " . $connect5->connect_error . "<br>");
        }

        $sql = "SELECT id, userID, title FROM Advertisements";
        $result = $connect5->query($sql);

        if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                return "Id: " . $row["id"] . ", userID: " . $row["userID"] . ", title: " . $row["title"] . "<br>";
            }
        }
        else{
            return "0 results found<br>";
        }
        $connect5->close();
        return "";
    }

    public function deleteUsersByID($id):string{
        $connect6 = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());

        if($connect6->connect_error){
            die("Connection failed: " . $connect6->connect_error . "<br>");
        }

        $sql = "DELETE FROM Users WHERE id = $id";

        if($connect6->query($sql) === true){
            return "Delete successful <br>";
        }
        else{
            return "Delete unsuccessful: " . $connect6->error . "<br>";
        }

        $connect6->close();
        return "";
    }

    public function deleteUsersByuserName($userName):string{
        $connect7 = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());

        if($connect7->connect_error){
            die("Connection failed: " . $connect7->connect_error . "<br>");
        }

        $sql = "DELETE FROM Users WHERE userName = $userName";

        if($connect7->query($sql) === true){
            return "Delete successful <br>";
        }
        else{
            return "Delete unsuccessful: " . $connect7->error . "<br>";
        }

        $connect7->close();
        return "";
    }

    public function deleteAdvertisementByID($id):string{
        $connect8 = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());

        if($connect8->connect_error){
            die("Connection failed: " . $connect8->connect_error . "<br>");
        }

        $sql = "DELETE FROM Advertisements WHERE id = $id";

        if($connect8->query($sql) === true){
            return "Delete successful <br>";
        }
        else{
            return "Delete unsuccessful: " . $connect8->error . "<br>";
        }

        $connect8->close();
        return "";
    }

    public function deleteAdvertisementByTitle($title):string{
        $connect9 = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());

        if($connect9->connect_error){
            die("Connection failed: " . $connect9->connect_error . "<br>");
        }

        $sql = "DELETE FROM Advertisements WHERE title = $title";

        if($connect9->query($sql) === true){
            return "Delete successful <br>";
        }
        else{
            return "Delete unsuccessful: " . $connect9->error . "<br>";
        }

        $connect9->close();
        return "";
    }

    public function deleteAdvertisementByuserID($userID):string{
        $connect10 = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());

        if($connect10->connect_error){
            die("Connection failed: " . $connect10->connect_error . "<br>");
        }

        $sql = "DELETE FROM Advertisements WHERE userID = $userID";

        if($connect10->query($sql) === true){
            return "Delete successful <br>";
        }
        else{
            return "Delete unsuccessful: " . $connect10->error . "<br>";
        }

        $connect10->close();
        return "";
    }

    public function modifyUsersByUserID($userID, $username):string{
        $connect11 = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());

        if($connect11->connect_error){
            die("Connection failed: " . $connect11->connect_error . "<br>");
        }

        $sql = "UPDATE Users SET userName = '$username' WHERE userID = $userID";

        if($connect11->query($sql) === true){
            return "Update successful <br>";
        }
        else{
            return "Update unsuccessful: " . $connect11->error . "<br>";
        }
        $connect11->close();
        return "";
    }

    public function modifyAdvertisementsByUserID($userID, $title):string{
        $connect12 = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());

        if($connect12->connect_error){
            die("Connection failed: " . $connect12->connect_error . "<br>");
        }

        $sql = "UPDATE Advertisements SET title = '$title' WHERE userID = $userID";

        if($connect12->query($sql) === true){
            return "Update successful <br>";
        }
        else{
            return "Update unsuccessful" . $connect12->error . "<br>";
        }
        $connect12->close();
        return "";
    }

    public function createUserPageTable(){
        echo '<table>';
        $connect13 = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());

        if($connect13->connect_error){
            die("Connection failed: " . $connect13->connect_error . "<br>");
        }

        $num = mysqli_num_rows(mysqli_query($connect13, "SELECT * FROM Users"));
        for($i = 0; $i < $num; $i++){
            $row = mysqli_fetch_array(mysqli_query($connect13, "SELECT * FROM Users"));
            $userID = $row['userID'];
            $userName = $row['userName'];
        }

        echo '</table>';
    }

    public function createAdvertisementPageTable(){
        echo '<table>';
        $connect14 = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());

        if($connect14->connect_error){
            die("Connection failed: " . $connect14->connect_error . "<br>");
        }

        $num = mysqli_num_rows(mysqli_query($connect14, "SELECT * FROM Advertisements"));
        for($i = 0; $i < $num; $i++){
            $row = mysqli_fetch_array(mysqli_query($connect14, "SELECT * FROM Advertisemenet"));
            $id = $row['id'];
            $title = $row['title'];
        }

        echo '</table>';
    }
}