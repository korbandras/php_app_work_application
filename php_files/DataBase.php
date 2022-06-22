<?php
require "Advertisements.php";
class DataBase{
    /**
     * Setting names for values
     */
    private $hostName = "localhost";
    private $userName = "root";
    private $password = "MuRYS7GtmQ";
    private $dbName = "work";
    private $port = 3308;

    /**
     * Get the port
     * @return int
     */
    public function getPort():int{
        return $this->port;
    }

    /**
     * Get the Host's name
     * @return string
     */
    public function getHostName():string{
        return $this->hostName;
    }

    /**
     * Get the Username
     * @return string
     */
    public function getUserName():string{
        return $this->userName;
    }

    /**
     * Get the password
     * @return string
     */
    public function getPassword():string{
        return $this->password;
    }

    /**
     * Get the DataBase's name
     * @return string
     */
    public function getDbName():string{
        return $this->dbName;
    }

    /**
     * Set new port
     * @param $port
     * @return void
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * Set new Username
     * @param $userName
     * @return void
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * Set new Host name
     * @param $hostName
     * @return void
     */
    public function setHostName($hostName)
    {
        $this->hostName = $hostName;
    }

    /**
     * Set new DataBase name
     * @param $dbName
     * @return void
     */
    public function setDbName($dbName)
    {
        $this->dbName = $dbName;
    }

    /**
     * Set new password
     * @param $password
     * @return void
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Checking if the mysqli is installed or not, check-able in console
     * @return string
     */
    public function installcheck():string{
        if(function_exists('mysqli_connect')){
            //console return
            return "mysqli is installed\n";
        }
        else{
            //console return
            return "Enable mysqli support in your PHO install\n";
        }
    }

    /**
     * Creating User Table
     * @return string
     */
    public function createUserTable():string{
        //making the connection
        $conn = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());

        try{
            //create the actual table
            $sql = "CREATE TABLE Users 
            (
                id INT(6) AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(30) NOT NULL
            )";
            //check if the table created or not
            if($conn->query($sql) === true){
                //console message for creation
                return "Users Table created successfully\n";
            }
        }
        catch (mysqli_sql_exception $ex){
            //console message for failed creation
            return "Users Table is already created\n";
        }

        $conn->close();
        return "";
    }

    /**
     * Create Advertisement Table
     * @return string
     */
    public function createAdvTable():string{
        //making the connection
        $connect1 = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());

        //creating the actual Advertisement Table
        try{
            $sql = "CREATE TABLE Advertisements 
            (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                userid INT(6),
                title VARCHAR(30) NOT NULL ,
                foreign key (userid) references Users (id)
            )";
            //console message for creation
            if($connect1->query($sql) === true){
                //console message for creation
                return "Advertisements Table successfully created\n";
            }
        }
        catch (mysqli_sql_exception $ex){
            //console message for failed creation
            return "Advertisements Table already created\n";
        }
        return "";
    }

    /**
     * Write new Users into the Database
     * @param Users $users
     * @return string
     */
    public function writeInUsers(Users $users):string{
        //making the connection
        $conn = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());

        //checking connection
        if ($conn->connect_error)
        {
            die("Connection failed: " . $conn -> connect_error."\n");
        }

        //getting the parameters
        $id=$users->getUserId();
        $name=$users->getusername();
        //Trying to insert new data into the database
        try
        {
            //selecting the data we want to insert
            $sql = "INSERT INTO users (id, username) VALUES ($id,'$name')";

            //console message if the insertion was successful or not
            if ($conn->query($sql) === TRUE) {
                //console message for success
                return "New record created successfully\n";
            } else {
                //console message for unsuccessful insertion
                return "Error: " . $sql . "\n" . $conn->error . "\n";
            }
        }
        //catching errors
        catch (mysqli_sql_exception)
        {
            if(mysqli_errno($conn) == 1062)
            {
                $conn->close();
                return "Existing found...\n";
            }
            else{
                $result=mysqli_errno($conn);
                $conn->close();
                //console return for the error
                return "Unknown Error! Number(".$result.")\n";
            }
        }
    }

    /**
     * Write new Advertisement into the Database
     * @param Advertisements $advertisements
     * @return string
     */
    public function writeInAdvertisement(Advertisements $advertisements):string{
        //making the connection
        $conn = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(),$this->getPort());
        //check connection
        if ($conn->connect_error)
        {
            die("Connection failed: " . $conn -> connect_error."\n");
        }

        //getting parameters
        $id=$advertisements->getId();
        $userId=$advertisements->getUserID();
        $title=$advertisements->getTitle();

        //trying to insert new data into the database
        try {
            //selecting data to insert
            $sql = "INSERT INTO advertisements (id,userid, title) VALUES ($id,'$userId','$title')";

            //console return on success
            if ($conn->query($sql) === TRUE)
            {
                //console return success
                return "New record created successfully\n";
            }
            else
            {
                //console return for failure
                return "Error: " . $sql . "\n" . $conn->error . "\n";//Returning error to the log
            }
        }
        //catching errors
        catch (mysqli_sql_exception)
        {
            if(mysqli_errno($conn) == 1062)
            {
                $conn->close();
                return "Existing found...\n";
            }
            if(mysqli_errno($conn)== 1452)
            {
                $conn->close();
                return "User with this Id not found...\n";
            }
            else{
                $result=mysqli_errno($conn);
                $conn->close();
                return "Unknown Error! Number(".$result.")\n";
            }
        }
    }

    /**
     * Getting the Users Data
     * @return string
     */
    public function getDataUsers():string{
        //making the connection
        $conn = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(),$this->getPort());

        //checking connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn -> connect_error."\n");
        }

        //selecting data from Users
        $query = "SELECT * FROM Users;";

        //getting data from database
        $result = mysqli_query($conn,$query);
        $resultCheck = mysqli_num_rows($result);
        $out="";

        //checking is result has value (exists)
        if ($resultCheck>0)
        {
            //getting data rows from the query
            while($row = mysqli_fetch_assoc($result))
            {
                $out .= "Id: " ;
                $out .= $row["id"];
                $out .= " - UserName: " ;
                $out .= $row["username"];
                $out .= "\n";
            }
            $conn->close();
            return $out;
        }
        else
        {
            $conn->close();
            return "0 results\n";
        }
    }

    /**
     * Getting the data from Advertisements
     * @return string
     */
    public function getDataAdvertisement():string{
        //making the connection
        $connect5 = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());

        //checking connection
        if($connect5->connect_error){
            die("Connection failed: " . $connect5->connect_error . "\n");
        }

        //getting parameters
        $sql = "SELECT id, userID, title FROM Advertisements";
        $result = $connect5->query($sql);

        //checking if data could be excavated from $result
        if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                //console return for success
                return "Id: " . $row["id"] . ", userID: " . $row["userID"] . ", title: " . $row["title"] . "\n";
            }
        }
        else{
            //console return for failure
            return "0 results found\n";
        }
        $connect5->close();
        return "";
    }

    /**
     * Get names using the ID
     * @param $id
     * @return mixed|string|void
     */
    private function getNameByID($id){
        //making the connection
        $conn = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(),$this->getPort()); //Connecting to DataBase

        //checking connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn -> connect_error."\n"); //Connection failure
        }

        //getting the parameters
        $query = "SELECT * FROM Users;";
        $result = mysqli_query($conn,$query);
        $resultCheck = mysqli_num_rows($result);

        //checking if result exists
        if ($resultCheck>0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                //console return for username
                if($row["id"]===$id) return $row["username"];
            }
            $conn->close();
        }
        else
        {
            $conn->close();
            return "Not found!\n";
        }
    }

    /**
     * HTML page table for the User_page
     * @return void
     */
    public function usersPageTable(){
        //making the connection
        $connect13 = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());

        //checking connection
        if($connect13->connect_error){
            die("Connection failed: " . $connect13->error . "\n");
        }

        //creating the parameter using query, and selecting the data from Users
        $result = mysqli_query($connect13, "SELECT * FROM Users");
        //creating the viable table
        echo "
            <table>
                <tr>
                    <th>UserID</th>
                    <th>UserName</th>
                </tr>";
        //getting rows out of mysql
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
            echo "</tr>";
        }

        mysqli_close($connect13);
        echo "</table>";
    }

    /**
     * HTML page table for the Advertisements_page
     * @return void
     */
    public function advertisementPageTable(){
        //making the connection
        $connect14 = new mysqli($this->getHostName(), $this->getUserName(), $this->getPassword(), $this->getDbName(), $this->getPort());

        //checking connection
        if($connect14->connect_error){
            die("Connection failed: " . $connect14->error . "\n");
        }

        //getting the parameter and selecting data from Advertisements
        $result = mysqli_query($connect14, "SELECT * FROM Advertisements");

        //creating the actual table
        echo "
            <table>
                <tr>
                    <th>ID</th>
                    <th>UserName</th>
                    <th>Title</th>
                </tr>
                ";
        //getting the data rows from mysql
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