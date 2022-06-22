<?php
class Users
{
    protected $userID;
    protected $userName;

    public function addNew($id,$username){
        $this->userID = $id;
        $this->userName = $username;
    }

    /**
     * @param mixed $userID
     */
    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    /**
     * @return mixed
     */
    public function getUserID():int
    {
        return $this->userID;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getUserName():string
    {
        return $this->userName;
    }
}