<?php
class Users{
    private $userID;
    private $userName;

    /**
     * @param $id
     * @param $name
     */
    public function construct($id, $name){
        $this->userID = $id;
        $this->userName = $name;
    }

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userID
     */
    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }
}