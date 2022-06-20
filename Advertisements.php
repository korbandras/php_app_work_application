<?php
class Advertisements extends Users{
    private $userId;
    private $advertisement;

    /**
     * @return mixed
     */
    public function getAdvertisement()
    {
        return $this->advertisement;
    }

    /**
     * @param mixed $advertisement
     */
    public function setAdvertisement($advertisement)
    {
        $this->advertisement = $advertisement;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
}