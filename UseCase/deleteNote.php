<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AgendApp | Delete note</title>
    </head>
    <body>
        
         <?php
            include_once '../Database/ConnectionDB.php';
            include_once '../User/User.php';
            
            $autorinfo = User::getLoggedUser();
            $id=$autorinfo['id'];
        
            $title = $_GET['titulo'];
            $time = $_GET['fecha'];
            $content = $_GET['contenido'];

            $crear = new PDO("sqlite:./data.db");
            $crear-> beginTransaction();
        
            $res = DB::execute_sql("DELETE FROM notas WHERE titulo='$title' AND fecha='$time' AND contenido='$content'"
                    . "AND idusuario='$id'");
            
        if ($res) {
            $crear-> commit();
            echo "<h3><br><br><br>$title has been deleted</h3>";
            echo "<br><br><br><a href='../User/home.php'>Home</a>";
            
        } else {
            echo "<h3><br><br><br>$title has not been deleted</h3>";
            echo "<br><br><br><a href='../User/home.php'>Home</a>";
        }
            
        ?> 
    </body>
</html>