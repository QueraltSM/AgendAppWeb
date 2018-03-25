<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AgendApp | Registration</title>
    </head>
    <body>
        
        <form method="post">
        <input type="text" name="username" placeholder="Username" required><br><br><br>
        <input type="text" name="email" placeholder="Email" required><br><br><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Register account"><br><br><br>
        </form>
            
         <?php
            include_once '../Database/ConnectionDB.php';
            include_once '../User/User.php';
            
            if(isset($_POST['username'])){
                
                $email = $_POST['email'];
                $nombre = $_POST['username'];
                $clave= $_POST['password'];
                
                $crear = new PDO("sqlite:./data.db");
                $crear-> beginTransaction();
        
                $res = DB::execute_sql("INSERT INTO usuarios (cuenta, clave, nombre) VALUES (?,?,?)",
                            array($email, $clave, $nombre));
                if ($res) {
                    $crear-> commit();
                    echo "<h2><br><br><br>User <i>$nombre</i> has been registered</h2>";
                    echo "<br><br><br><a href='login.php'>Login</a>";
                    
                } else {
                    echo "<h2><br><br><br>Email <i>$email</i> is already registered</h2>";
                    echo "<br><br><br><a href='login.php'>Login</a>";
                }
            }
        ?>
    </body>
</html>