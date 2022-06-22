<?php
class Users
{
    protected $userID;
    protected $userName;

    /**
     * Add new User
     * @param $id
     * @param $username
     * @return void
     */
    public function addNew($id,$username){
        $this->userID = $id;
        $this->userName = $username;
    }

    /**
     * Set User's ID, unique
     * @param mixed $userID
     */
    public function setUserID($userID)
    {
        $this->userID = $userID;
    }

    /**
     * Get User's ID
     * @return mixed
     */
    public function getUserID():int
    {
        return $this->userID;
    }

    /**
     * Set User's name
     * @param mixed $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * Get User's name
     * @return mixed
     */
    public function getUserName():string
    {
        return $this->userName;
    }
}