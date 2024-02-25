<?php
session_start();
$error = false;
if(isset($_POST['prijava'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $xml = simplexml_load_file("korisnici.xml") or die("Error: Nemoguće kreirati objekt");
    foreach($xml->korisnik as $korisnik){
        if($korisnik->korisnicko_ime == $username){
            if($korisnik->lozinka == $password){
                $_SESSION['username'] = $username;
                header("Location: index.php");
                die;
            }else {
                $error = true;
                $errormsg = "Lozinka nije tocna";
            }
        } else{
            $errormsg ="Korisnik ne postoji.";
            $error = true;
        }
    } 
    
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PRIJAVA</title>
    <link rel="stylesheet" type="text/css" href="style.css?v=<?php echo time(); ?>">
</head>
<body>

<div class="wrapper">
    <div class="login">
        <div class="slika">
            <h1>PRIJAVA</h1>
        </div>
        
        <div class="forma">
            <form method="POST" action="">
                <label for="username">Korisničko ime</label>
                <input type="text" name="username" placeholder="Unesi korisničko ime"><br>
                <label for="password">Lozinka</label>
                <input type="password" name="password" placeholder="Unesite lozinku" id="l"><br>
                <?php
                    if($error){
                        echo "<p style='color: red;text-align: center;'>$errormsg</p>";
                    }
                ?>
                <input name="prijava" type="submit" value="Prijavi se" class="button"/><br> 
                <a href="register.php" id="link">Registriraj se</a>
            </form>
        </div>
    </div>
</div>
    

</body>
</html>