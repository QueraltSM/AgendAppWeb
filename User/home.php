<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
       
        <title>AgendApp | Home</title>
    </head>
    <body>
        
        <style>
        .note {
            background: rgba(169,3,41,1);
            background: -moz-linear-gradient(left, rgba(169,3,41,1) 0%, rgba(143,2,34,1) 44%, rgba(109,0,25,1) 100%);
            background: -webkit-gradient(left top, right top, color-stop(0%, rgba(169,3,41,1)), color-stop(44%, rgba(143,2,34,1)), color-stop(100%, rgba(109,0,25,1)));
            background: -webkit-linear-gradient(left, rgba(169,3,41,1) 0%, rgba(143,2,34,1) 44%, rgba(109,0,25,1) 100%);
            background: -o-linear-gradient(left, rgba(169,3,41,1) 0%, rgba(143,2,34,1) 44%, rgba(109,0,25,1) 100%);
            background: -ms-linear-gradient(left, rgba(169,3,41,1) 0%, rgba(143,2,34,1) 44%, rgba(109,0,25,1) 100%);
            background: linear-gradient(to right, rgba(169,3,41,1) 0%, rgba(143,2,34,1) 44%, rgba(109,0,25,1) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a90329', endColorstr='#6d0019', GradientType=1 );
         }
        </style>
            
         <?php
            echo "<link rel = 'stylesheet' type='css' href='../CSS/style.css'>";
            include_once '../Database/ConnectionDB.php';
            include_once 'User.php';
            
            $autorinfo = User::getLoggedUser();
            $idautor=$autorinfo['id'];
            
            $db = new PDO("sqlite:../Database/data.db");
            $db->exec('PRAGMA foreign_keys = ON;'); 
            $res=$db->prepare("SELECT fecha,titulo,contenido FROM notas WHERE idusuario=$idautor");
            $res->execute();
            
            if($res){
                $res->setFetchMode(PDO::FETCH_NAMED);
                foreach($res as $note){
                    echo '<div class = "note">';
                        $count = 0;
                        foreach($note as $value){
                            switch($count) {
                                case 0:
                                    $time = $value;
                                    $date = date('d-m-Y', $time);
                                    echo "<b>$date</b><br><br>";
                                    break;
                                case 1:
                                    $title = $value;
                                    echo "$value<br><br>";
                                    break;
                                
                                default:
                                    $content = $value;
                                    echo "$value<br><br>";
                                    break;
                            }
                            $count++;
                        }
                        echo "<a href = '../UseCase/deleteNote.php?fecha=$time&titulo=$title&contenido=$content'>Delete</a>"
                                . "<a href = '../UseCase/modifyNote.php?fecha=$time&titulo=$title&contenido=$content'>Modify</a>"
                                . "<a href = '../UseCase/shareNote.php?fecha=$time&titulo=$title&contenido=$content'>Share</a></div><br><br><br>";
                    } 
            }
             echo "<a href = '../UseCase/addNote.php'>Add note</button><br><br><br>";
        ?>
       
        <a href = "../UseCase/logout.php">Log out</a><br><br><br>
        
    </body>
</html>