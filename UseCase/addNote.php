<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel = 'stylesheet' type='css' href='CSS.css'>
        <title>AgendApp | New note</title>
    </head>
    <body>
        
        <form method="post">
        <input type="title" name="title" placeholder="Write a title..." required><br><br><br>
        <input type="content" name="content" placeholder="Write a content..." required><br>
        <input type="submit" value="Add note"><br><br><br>
        </form>
        
   
        <style>
            body {
            text-align:center;
            background: rgba(212,228,239,1);
            background: -moz-linear-gradient(left, rgba(212,228,239,1) 0%, rgba(48,173,131,1) 100%);
            background: -webkit-gradient(left top, right top, color-stop(0%, rgba(212,228,239,1)), color-stop(100%, rgba(48,173,131,1)));
            background: -webkit-linear-gradient(left, rgba(212,228,239,1) 0%, rgba(48,173,131,1) 100%);
            background: -o-linear-gradient(left, rgba(212,228,239,1) 0%, rgba(48,173,131,1) 100%);
            background: -ms-linear-gradient(left, rgba(212,228,239,1) 0%, rgba(48,173,131,1) 100%);
            background: linear-gradient(to right, rgba(212,228,239,1) 0%, rgba(48,173,131,1) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#d4e4ef', endColorstr='#30ad83', GradientType=1 );
            }
        </style>
        
        
         <?php
            include_once '../Database/ConnectionDB.php';
            include_once '../User/User.php';
            
            if(isset($_POST['title'])){
                $crear = new PDO("sqlite:../Database/data.db");
                $crear-> beginTransaction();
                
                $title=$_POST['title'];
                $autor = User::getLoggedUser();
        
                $res = DB::execute_sql("INSERT INTO notas (idusuario, titulo, fecha, contenido) VALUES (?,?,?,?)",
                            array($autor['id'],$title,time(), $_POST['content']));
                if ($res) {
                    $crear-> commit();
                    echo "<h2><br><br><br>Note <i>$title</i> has been added</h2>";
                    echo "<br><br><br><a href='../User/home.php'>Home</a>";
                    
                } else {
                    echo "<h2><br><br><br>Note <i>$title</i> could not be added</h2>";
                    echo "<br><br><br><a href='../User/home.php'>Home</a>";
                }
            }
        ?>
        
    </body>
</html>