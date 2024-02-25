<?php

session_start();
$z = 0;
$xml = simplexml_load_file("korisnici.xml") or die("Error: Nemoguće kreirati objekt");
foreach($xml->korisnik as $korisnik){
    if($_SESSION['username'] == $korisnik->korisnicko_ime){
        $username = $_SESSION['username'];
        $z = 1;
        break;
    }
}

if($z == 0){
    header("Location: login.php");
    die;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>OzrenPetrovic_XML</title>
    <link rel="stylesheet" type="text/css" href="style.css?v=<?php echo time(); ?>">
</head>
<body>

<h1>Dobrodošli, <?php echo $username; ?></h1>
<hr>
<a href="logout.php">Odjavi se</a>

</body>
</html>