<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AgendApp | Login</title>
    </head>
    <body>
       
        <form method="post">
        <input type="text" name="email" placeholder="Email" required><br><br><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Login"><br><br><br>
        </form>
        

    <?php
    include_once '../Database/ConnectionDB.php';
    include_once '../User/User.php';
    
    if (isset($_POST["email"])){
        $login=User::login($_POST["email"],$_POST["password"]);
        if(!$login){
            echo '<h1>No se puede determinar que los datos proporcionados sean auténticos</h1>';
        } else {
            echo "<META HTTP-EQUIV='Refresh' Content='0; URL=../User/home.php'>";
        }
    }
    ?>
        
    </body>
</html>