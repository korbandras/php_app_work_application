<?php
require "Advertisements.php";
class DataBase{
    private $hostName = "localhost:3308";
    private $userName = "username";
    private $password = "password";
    private $dbName = "DataBase";
    private $port = 3306;

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
            return "Mysqli is installed <br>";
        }
        else{
            return "Enable Mysqli support in your PHO install<br>";
        }
    }

    public function createUserTable():string{
        $connect = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());

        try{
            $sql = "CREATE TABLE Users 
            (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(30) NOT NULL
            )";
            if($connect->query($sql) === true){
                return "Users Table created successfully<br>";
            }
        }
        catch (mysqli_sql_exception $ex){
            return "Users Table is already created<br>";
        }

        $connect->close();
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
}