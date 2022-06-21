<html>
    <head>
        <link rel = "stylesheet" href = "../css_files/head.css">
        <link rel = "stylesheet" href = "../css_files/basic.css">
        <title>Users Page</title>
    </head>
    <body>
        <header class = "header">
            <div class = "left">
                <h2 class = "title">Users</h2>
            </div>
            <form class = "middle" name = "form" action="" method="post">

                <div class = "minuss">
                    <button class = "Minus">
                        <img class = "Pic" src = "../images/iconmonstr-minus-circle-lined.svg">
                        <div class = "ToolTip">Remove Data</div>
                    </button>
                </div>
                <div class = "search">
                    <input class = "Searchh" type = "text" placeholder = "Name">
                </div>
                <div class = "pluss">
                    <button class = "Plus">
                        <img class = "Pic" src = "../images/iconmonstr-plus-circle-lined.svg">
                        <div class = "ToolTip">Add New Data</div>
                    </button>
                </div>

            </form>
            <form class = "right">
                <button class = "pluss">
                    <img class = "Pic" src = "../images/iconmonstr-compass-12.svg">
                    <div class = "ToolTip">Advertisements</div>
                </button>
            </form>
        </header>
        <table>

        </table>
        <?php
            ini_set ( 'mysqli.default_socket' , '/tmp/mysql5.sock' );
            include "../php_files/console.php";
            include "../php_files/DataBase.php";
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
            //$view_variable .= addNewUser(1, "Example John");
            //$view_variable .= addNewAdvert(1, 1, "title");
            //$view_variable .= readDataBase();
            //modify user and advert
            //$view_variable .= modifyUser(1, "Example John2");
            //$view_variable .= modifyAdvert(1, "Title1");
            //delete
            $obj = new DataBase();
            //$view_variable .= $obj->deleteUsersByID(1);
            //$view_variable .= $obj->deleteAdvertisementByID(1);
            $obj->createUserPageTable();
            //check
            $view_variable .= readDataBase();
            ?>

        <?= consolelog($view_variable); ?>
    </body>
</html>
