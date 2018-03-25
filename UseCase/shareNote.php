<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
       
        <title>AgendApp | Share note</title>
    </head>
    <body>
            
        <h1>Select a user</h1>
        
        <style>
            .userDiv {
                background-color:green;
            }
        </style>
        
        <form method="post">
        <input type="text" name="email" placeholder="Enter an email..." required><br><br><br>
        <input type="submit" value="Share note"><br><br><br>
        </form>
        
         <?php
            include_once '../Database/ConnectionDB.php';
            include_once '../User/User.php';
            
            if (isset($_POST['email'])) {
                
                $id=getUser($_POST['email']);
                $title = $_GET['titulo'];
                $crear = new PDO("sqlite:../Database/data.db");
                $crear-> beginTransaction();
        
                $res = DB::execute_sql("INSERT INTO notas (idusuario, titulo, "
                        . "fecha, contenido) VALUES (?,?,?,?)",
                            array($id,$_GET['titulo'],$_GET['fecha'],$_GET['contenido']));
                if ($res) {
                    $crear-> commit();
                    echo "<h2><br><br><br>Note <i>$title</i> has been "
                            . "shared</h2>";
                    echo "<br><br><br><a href='../User/home.php'>Home</a>";
                    
                } else {
                    echo "<h2><br><br><br>Note <i>$title</i> could not be "
                            . "shared</h2>";
                    echo "<br><br><br><a href='../User/home.php'>Home</a>";
                }          
            }
            
            function getUser($email) {
                $db = new PDO("sqlite:../Database/data.db");
                $db->exec('PRAGMA foreign_keys = ON;'); 
                $res=$db->prepare("SELECT id FROM usuarios WHERE cuenta='$email'");
                $res->execute();

                    if($res){
                        $res->setFetchMode(PDO::FETCH_NAMED);
                        foreach($res as $user){
                            foreach($user as $value){
                             return $value;
                            }    
                        } 
                    }
                }
        ?>
    </body>
</html>