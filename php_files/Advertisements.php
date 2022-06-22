<?php
require "Users.php";
class Advertisements extends Users{
    private int $id;
    private string $title;

    /**
     * Add new Advertisement, checking if it has a NULL Id or not
     * @param $id
     * @param $userid
     * @param $title
     * @return string
     */
    public function addNewAdv($id, $userid, $title):string{
        if($userid != NULL){
            $this->userID = $userid;
            $this->id = $id;
            $this->title = $title;
        }
        else{
            return "Already created.\n";
        }
        return "";
    }

    /**
     * Set Advertisement's ID
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get Advertisement's ID
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set Advertisement's title
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get Advertisement's title
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Returns the whole user and advertisement section
     * @return string
     */
    public function getAll():string
    {
        return "Id: " . $this->id . " UserID: " . $this->userID . " Name: " . $this->username . " Title: " . $this->title;
    }
}