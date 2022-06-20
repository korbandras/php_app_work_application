<html>
    <head>
        <title>Home Page</title>
    </head>
    <body>
        <?php
            include("DataBase.php");
            include("writeDataBase.php");
            $obj = new DataBase();
            $obj0 = new writeDataBase();
            $a = $obj->get_rows(implode(",",array("ID","User","Title")),'',"Users");
            $b = $obj->get_rows(implode(",",array("ID","User","Title")),'',"Advertisement");
            echo "<pre>";
            print_r($a);
            echo "</pre";
            ?>
    </body>
</html>
