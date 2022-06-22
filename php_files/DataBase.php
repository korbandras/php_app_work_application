<?php
require "Advertisements.php";
class DataBase{
    private $hostName = "localhost";
    private $userName = "root";
    private $password = "MuRYS7GtmQ";
    private $dbName = "work";
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
            return "mysqli is installed\n";
        }
        else{
            return "Enable mysqli support in your PHO install\n";
        }
    }

    public function createUserTable():string{
        $conn = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());

        try{
            $sql = "CREATE TABLE Users 
            (
                id INT(6) AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(30) NOT NULL
            )";
            if($conn->query($sql) === true){
                return "Users Table created successfully\n";
            }
        }
        catch (mysqli_sql_exception $ex){
            return "Users Table is already created\n";
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
                userid INT(6),
                title VARCHAR(30) NOT NULL ,
                foreign key (userid) references Users (id)
            )";
            if($connect1->query($sql) === true){
                return "Advertisements Table successfully created\n";
            }
        }
        catch (mysqli_sql_exception $ex){
            return "Advertisements Table already created\n";
        }
        return "";
    }

    public function writeInUsers(Users $users):string{
        $conn = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());

        // Check connection
        if ($conn->connect_error)
        {
            die("Connection failed: " . $conn -> connect_error."\n"); //Connection failure
        }

        $id=$users->getUserId();
        $name=$users->getusername();
        try //Trying to Create Table in DataBase
        {
            $sql = "INSERT INTO users (id, username) VALUES ($id,'$name')";//Select Data

            if ($conn->query($sql) === TRUE) {
                return "New record created successfully\n"; //Returning Success
            } else {
                return "Error: " . $sql . "\n" . $conn->error . "\n";//Returning error to the log
            }
        }
        catch (mysqli_sql_exception) //Catching errors
        {
            if(mysqli_errno($conn) == 1062)
            {
                $conn->close(); //Closing Connection
                return "Existing found...\n";
            }
            else{
                $result=mysqli_errno($conn); //Catching new error code
                $conn->close(); //Closing Connection
                return "Unknown Error! Number(".$result.")\n";//Returning error code to the log
            }
        }
    }

    public function writeInAdvertisement(Advertisements $advertisements):string{
        $conn = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(),$this->getPort()); //Connecting to DataBase
        // Check connection
        if ($conn->connect_error)
        {
            die("Connection failed: " . $conn -> connect_error."\n"); //Connection failure
        }

        $id=$advertisements->getId();
        $userId=$advertisements->getUserID();
        $title=$advertisements->getTitle();

        try {
            $sql = "INSERT INTO advertisements (id,userid, title) VALUES ($id,'$userId','$title')";//Select Data

            if ($conn->query($sql) === TRUE)
            {
                return "New record created successfully\n"; //Returning Success
            }
            else
            {
                return "Error: " . $sql . "\n" . $conn->error . "\n";//Returning error to the log
            }
        }catch (mysqli_sql_exception) //Catching errors
        {
            //return $advertisements->getusername()." skipped!\n";
            if(mysqli_errno($conn) == 1062)
            {
                $conn->close(); //Closing Connection
                return "Existing found...\n";//Returning Existing Error
            }
            if(mysqli_errno($conn)== 1452)
            {
                $conn->close(); //Closing Connection
                return "User with this Id not found...\n";//Returning ID Error
            }
            else{
                $result=mysqli_errno($conn); //Catching new error code
                $conn->close(); //Closing Connection
                return "Unknown Error! Number(".$result.")\n";//Returning error code to the log
            }
        }
    }

    public function getDataUsers():string{
        $conn = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(),$this->getPort()); //Connecting to DataBase

        // GET CONNECTION ERRORS
        if ($conn->connect_error) {
            die("Connection failed: " . $conn -> connect_error."\n"); //Connection failure
        }

        // SQL QUERY
        $query = "SELECT * FROM users;";//Select Data

        // FETCHING DATA FROM DATABASE
        $result = mysqli_query($conn,$query);//Creating query
        $resultCheck = mysqli_num_rows($result);//Creating Result Checker
        $out="";//Creating return value

        if ($resultCheck>0)//Checking if result exists
        {
            // OUTPUT DATA OF EACH ROW
            while($row = mysqli_fetch_assoc($result))
            {
                $out .= "Id: " ;
                $out .= $row["id"];
                $out .= " - UserName: " ;
                $out .= $row["username"];
                $out .= "\n";
            }
            $conn->close(); //Closing Connection
            return $out;//Sending to console
        }
        else
        {
            $conn->close(); //Closing Connection
            return "0 results\n";//Sending empty database to console
        }
    }

    public function getDataAdvertisement():string{
        $connect5 = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());

        if($connect5->connect_error){
            die("Connection failed: " . $connect5->connect_error . "\n");
        }

        $sql = "SELECT id, userID, title FROM Advertisements";
        $result = $connect5->query($sql);

        if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                return "Id: " . $row["id"] . ", userID: " . $row["userID"] . ", title: " . $row["title"] . "\n";
            }
        }
        else{
            return "0 results found\n";
        }
        $connect5->close();
        return "";
    }

    public function deleteUsersByID($id):string{
        $connect6 = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());

        if($connect6->connect_error){
            die("Connection failed: " . $connect6->connect_error . "\n");
        }

        $sql = "DELETE FROM Users WHERE id = $id";

        if($connect6->query($sql) === true){
            return "Delete successful \n";
        }
        else{
            return "Delete unsuccessful: " . $connect6->error . "\n";
        }

        $connect6->close();
        return "";
    }

    public function deleteUsersByuserName($userName):string{
        $connect7 = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());

        if($connect7->connect_error){
            die("Connection failed: " . $connect7->connect_error . "\n");
        }

        $sql = "DELETE FROM Users WHERE userName = $userName";

        if($connect7->query($sql) === true){
            return "Delete successful \n";
        }
        else{
            return "Delete unsuccessful: " . $connect7->error . "\n";
        }

        $connect7->close();
        return "";
    }

    public function deleteAdvertisementByID($id):string{
        $connect8 = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());

        if($connect8->connect_error){
            die("Connection failed: " . $connect8->connect_error . "\n");
        }

        $sql = "DELETE FROM Advertisements WHERE id = $id";

        if($connect8->query($sql) === true){
            return "Delete successful \n";
        }
        else{
            return "Delete unsuccessful: " . $connect8->error . "\n";
        }

        $connect8->close();
        return "";
    }

    public function deleteAdvertisementByTitle($title):string{
        $connect9 = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());

        if($connect9->connect_error){
            die("Connection failed: " . $connect9->connect_error . "\n");
        }

        $sql = "DELETE FROM Advertisements WHERE title = $title";

        if($connect9->query($sql) === true){
            return "Delete successful \n";
        }
        else{
            return "Delete unsuccessful: " . $connect9->error . "\n";
        }

        $connect9->close();
        return "";
    }

    public function deleteAdvertisementByuserID($userID):string{
        $connect10 = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());

        if($connect10->connect_error){
            die("Connection failed: " . $connect10->connect_error . "\n");
        }

        $sql = "DELETE FROM Advertisements WHERE userID = $userID";

        if($connect10->query($sql) === true){
            return "Delete successful \n";
        }
        else{
            return "Delete unsuccessful: " . $connect10->error . "\n";
        }

        $connect10->close();
        return "";
    }

    public function modifyUsersByUserID($userID, $username):string{
        $connect11 = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());

        if($connect11->connect_error){
            die("Connection failed: " . $connect11->connect_error . "\n");
        }

        $sql = "UPDATE Users SET userName = '$username' WHERE userID = $userID";

        if($connect11->query($sql) === true){
            return "Update successful \n";
        }
        else{
            return "Update unsuccessful: " . $connect11->error . "\n";
        }
        $connect11->close();
        return "";
    }

    public function modifyAdvertisementsByUserID($userID, $title):string{
        $connect12 = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());

        if($connect12->connect_error){
            die("Connection failed: " . $connect12->connect_error . "\n");
        }

        $sql = "UPDATE Advertisements SET title = '$title' WHERE userID = $userID";

        if($connect12->query($sql) === true){
            return "Update successful \n";
        }
        else{
            return "Update unsuccessful" . $connect12->error . "\n";
        }
        $connect12->close();
        return "";
    }

    private function getNameByID($id){
        $conn = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(),$this->getPort()); //Connecting to DataBase

        // GET CONNECTION ERRORS
        if ($conn->connect_error) {
            die("Connection failed: " . $conn -> connect_error."\n"); //Connection failure
        }

        // SQL QUERY
        $query = "SELECT * FROM Users;";//Select Data

        // FETCHING DATA FROM DATABASE
        $result = mysqli_query($conn,$query);//Creating query
        $resultCheck = mysqli_num_rows($result);//Creating Result Checker

        if ($resultCheck>0)//Checking if result exists
        {
            // OUTPUT DATA OF EACH ROW
            while($row = mysqli_fetch_assoc($result))
            {
                if($row["id"]===$id) return $row["username"]; //Returning username to console
            }
            $conn->close(); //Closing Connection
        }
        else
        {
            $conn->close(); //Closing Connection
            return "Not found!\n";//Sending not found to console
        }
    }

    public function usersPageTable(){
        $connect13 = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());

        if($connect13->connect_error){
            die("Connection failed: " . $connect13->error . "\n");
        }

        $result = mysqli_query($connect13, "SELECT * FROM Users");
        echo "
            <table>
                <tr>
                    <th>UserID</th>
                    <th>UserName</th>
                </tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
            echo "</tr>";
        }

        mysqli_close($connect13);
        echo "</table>";
    }

    public function advertisementPageTable(){
        $connect14 = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());
        if($connect14->connect_error){
            die("Connection failed: " . $connect14->error . "\n");
        }

        $result = mysqli_query($connect14, "SELECT * FROM Advertisements");

        echo "
            <table>
                <tr>
                    <th>ID</th>
                    <th>UserName</th>
                    <th>Title</th>
                </tr>
                ";
        while($row = mysqli_fetch_array($result)){
            $obj = new DataBase();
            echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $this->getNameByID($row['userid']) . "</td>";
                echo "<td>" . $row['title'] . "</td>";
            echo "</tr>";
        }
    }


}