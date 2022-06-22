<html>
    <head>
        <link rel = "stylesheet" href = "../css_files/head.css">
        <link rel = "stylesheet" href = "../css_files/basic.css">
        <title>Users Page</title>
    </head>
    <body>
        <!-- Header of HTML, makes the *now without function* buttons,
         but more importantly, the sets apart the main body *table* and the header part,
         also includes links-->
        <header class = "header">
            <div class = "left">
                <h2 class = "title">Users</h2>
            </div>
            <form class = "middle" name = "form" action="" method="post">
                <a href = "Home_page.php">Home</a>
            </form>
            <form class = "right">
                <button class = "advv">
                    <!-- Link to other page -->
                    <a href = "Advertisements_page.php">Advertisements</a>
                </button>
            </form>
        </header>
        <table>

        </table>
        <?php
            //Include the program's php files
            include "../php_files/console.php";
            include "../php_files/DataBase.php";
            //Object DataBase
            $obj = new DataBase();
            function first():string{
                $result = "";
                $obj = new DataBase();
                $result .= $obj->installcheck();
                $result .= $obj->createUserTable();
                //$result .= $obj->createAdvTable();
                return $result;
            }

            $view_variable = first();
            //Add new user, hardcoded test user
            $obh1 = new Users();
            $obh1->addNew(1, "Example John");
            //Write out to html page
            $view_variable .= $obj->writeInUsers($obh1);
            $obj->usersPageTable();
            $view_variable .= $obj->getDataUsers();
            ?>

        <?= consolelog($view_variable); ?>
    </body>
</html>
