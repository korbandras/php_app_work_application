<html>
    <head>
        <title>Advertisements Page</title>
    </head>
    <body>
        <?php
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
        <header class = "header">
            <div class = "left">
                <img class = "Hamburger_menu" src = "../images/hamburger-menu-bar-icon-flat-black-round-button-vector-illustration-design-isolated-142986835.jpg">
            </div>
            <div class = "middle">
                <tr>
                    <th class = "title">ADVERTISEMENTS</th>
                </tr>
                <button class = "minus">
                    <img class = "Minus" src = "../images/minus.png">
                    <div class = "ToolTip">Remove Data</div>
                </button>
                <input class = "Search" type = "text" placeholder = "Name">
                <button class = "plus">
                    <img class = "Plus" src = "../images/plus.png">
                    <div class = "ToolTip">Add New Data</div>
                </button>
            </div>
            <div class = "right">
                <a href = "Users_page.php"><img class = "Advertisement" src = "../images/user.jfif"></a>
                <div class = "ToolTip">Users</div>
            </div>
        </header>
        <?= consolelog($view_variable); ?>
    </body>
</html>
