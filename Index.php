<html>
    <head>
        <title>Home Page</title>
    </head>
    <body>
    <?php
        include ("console.php");
        include ("DataBase.php");
        $i = 0;
        function first():string{
            $obj = new DataBase();
            $result = "";
            $result .= $obj->installcheck();
            $result .= $obj->createUserTable();
            $result .= $obj->createAdvTable();
            return $result;
        }

        function addNewUser($userID, $userName):string{
            $result = "";
            $obj = new Advertisements();
            $obj1 = new DataBase();
            $result .= $obj->addNew($userID, $userName);
            $result .= $obj1->writeInUsers($obj);
            return $result;
        }

        function addNewAdvert($id, $userID, $adv):string{
            $result = "";
            $obj = new Advertisements();
            $obj1 = new DataBase();
            $result .= $obj->addNewAdv($id, $userID, $adv);
            $result .= $obj1->writeInAdvertisement($obj);
            return $result;
        }

        function readDataBase():string{
            $result = "";
            $obj = new DataBase();
            $result .= $obj->getDataUsers();
            $result .= $obj->getDataAdvertisement();
            return $result;
        }

        function deleteDataByID($id):string{
            $result = "";
            $obj = new DataBase();
            $result .= $obj->deleteUsersByID($id);
            $result .= $obj->deleteAdvertisementByID($id);
            return $result;
        }

        function modifyUser($id, $name):string{
            $result = "";
            $obj = new DataBase();
            $result .= $obj->modifyUsersByUserID($id, $name);
            return $result;
        }

        function modifyAdvert($id, $adv):string{
            $result = "";
            $obj = new DataBase();
            $result .= $obj->modifyAdvertisementsByUserID($id, $adv);
            return $result;
        }

        $view_variable = first();
        //add user and advert
        $view_variable .= addNewUser(1, "Example John");
        $view_variable .= addNewAdvert(1, 1, "title");
        $view_variable .= readDataBase();
        //modify user and advert
        $view_variable .= modifyUser(1, "Example John2");
        $view_variable .= modifyAdvert(1, "Title1");
        //delete
        $obj = new DataBase();
        $view_variable .= $obj->deleteUsersByID(1);
        $view_variable .= $obj->deleteAdvertisementByID(1);
        //check
        $view_variable .= readDataBase();
    ?>
    <?= consolelog($view_variable); ?>
    </body>
</html>
