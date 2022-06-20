<?php

class Advertisements extends Users{
    private $id;
    private $title;

    public function _construct($id, $userid, $title)
    {
        $this->id = $id;
        $this->userID = $userid;
        $this->title = $title;
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
}