<?php
require "Users.php";
class Advertisements extends Users{
    private int $id;
    private string $title;

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
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    public function getAll():string
    {
        return "Id: " . $this->id . " UserID: " . $this->userID . " Name: " . $this->username . " Title: " . $this->title;
    }
}