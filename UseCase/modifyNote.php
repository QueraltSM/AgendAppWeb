<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
       
        <title>AgendApp | Modify note</title>
    </head>
    <body>
        
        <form method="post">
        <input type="title" name="title" placeholder="Write a title..." required><br><br><br>
        <input type="content" name="content" placeholder="Write a content..." required><br>
        <input type="submit" value="Modify note"><br><br><br>
        </form>

         <?php
            include_once '../Database/ConnectionDB.php';
            include_once '../User/User.php';
            
            if(isset($_POST['title'])){
                $autorinfo = User::getLoggedUser();
                
                $oldTitle = $_GET['titulo'];
                $oldTime = $_GET['fecha'];
                $oldContent = $_GET['contenido'];
                
                $title = $_POST['title'];
                $time = time();
                $content = $_POST['content'];
                
                $crear = new PDO("sqlite:../Database/data.db");
                $crear-> beginTransaction();
        
                $res = DB::execute_sql("UPDATE notas SET titulo=?, fecha=?, contenido=?"
                        . "WHERE titulo='$oldTitle' AND fecha = '$oldTime' AND contenido = '$oldContent'",
                array($title, $time, $content));   
                    
            
                    if ($res) {
                        $crear-> commit();
                        echo "<h3><br><br><br>$oldTitle has been updated</h3>";
                        echo "<br><br><br><a href='../User/home.php'>Home</a>";
            
                    } else {
                        echo "<h3><br><br><br>$oldTitle has not been updated</h3>";
                        echo "<br><br><br><a href='../User/home.php'>Home</a>";
                    }
            }
        ?>
    </body>
</html>