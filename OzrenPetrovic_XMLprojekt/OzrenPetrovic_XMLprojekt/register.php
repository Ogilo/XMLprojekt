<?php

if(isset($_POST['register'])){

    $ime = $_POST['fname'];
    $prezime = $_POST['lname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $z = 0;
    $xml = simplexml_load_file("korisnici.xml") or die("Error: Nemoguće kreirati objekt");
    foreach($xml->korisnik as $korisnik){
        if($username == $korisnik->korisnicko_ime){
            echo "<script>alert('Korisnik već postoji')</script>";
            $z = 0;
            break;
        } else $z=1;
    }

    if($z==1){
        $korisnik = $xml->addChild('korisnik');

        $korisnik->addchild('ime',$ime);
        $korisnik->addchild('prezime',$prezime);
        $korisnik->addchild('korisnicko_ime',$username);
        $korisnik->addchild('email',$email);
        $korisnik->addchild('lozinka',$password);
        $xml->asXML("korisnici.xml");
        header("Location: login.php");
        die;
    }
    
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>REGISTRACIJA</title>
    <link rel="stylesheet" type="text/css" href="style.css?v=<?php echo time(); ?>">
    <script type="text/javascript" src="jquery-1.11.0.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="js/form-validation.js"></script>

    <script type="text/javascript">

$(function() {
    $("form[name='register']").validate({
      rules: {

        username: {
            required: true,
            minlength: 5,
            maxlength: 12
        },

        fname: {
          required: true,
      },
        lname: {
          required: true,      
        },
        email:{
          required: true,
          email: true,
        },
        password:{
            required: true,
        },
        password1:{
            required: true,
            equalTo: "#pass",
        }
      },
      
      messages: {
        
        username: {
            required: "Korisničko ime nesmije bit prazno",
            minlength: "Korisničko ime mora imati najmanje 5 znakova",
            maxlength: "Korisničko ime mora imati najviše 12 znakova"
        },
        fname: {
          required: "Ime nesmije biti prazno",
        },
        lname: {
          required: "Prezime nesmije biti prazno",
        },
        email:{
            required: "Email nesmije biti prazan",
            email: "Email je neispravan"
        },
        password:{
            required: "Morate unijeti lozinku",
        },
        password1:{
            required: "Morate potvrditi lozinku",
            equalTo: "Lozinke moraju biti iste",
        }
     },

      submitHandler: function(form) {
        form.submit();
      }
    });
});

</script>
</head>
<body>

<div class="wrapper">
    <div class="login">
        <div class="slika">
            <h1>PRIJAVA</h1>
        </div>
        
        <div class="forma">
            <form method="POST" action="" name="register">
                <label for="fname" class="label">Ime</label>
                <input type="text" name="fname" placeholder="Unesite ime" class="input2" ><br>

                <label for="lname" class="label">Prezime</label>
                <input type="text" name="lname" placeholder="Unesite prezime" class="input2" ><br>

                <label for="username" class="label">Korisničko ime</label>
                <input type="text" name="username" placeholder="Unesite korisničko ime" class="input2" ><br>

                <label for="email" class="label">Email</label>
                <input type="email" name="email" placeholder="Unesite email" class="input2" ><br>

                <label for="password" class="label">Lozinka</label>
                <input type="password" name="password" placeholder="Unesite lozinku" class="input2" id="pass"><br>

                <label for="password1" class="label"> Potvrdi lozinku</label>
                <input type="password" name="password1" placeholder="Ponovite lozinku" class="input2" ><br>

                <input name="register" type="submit" value="Registriraj se" class="reg_btn"/> 
            </form>
        </div>
    </div>
</div>

</body>
</html>