<?php
include('includes/config.php');
if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $gender = $_POST['gender'];
    $mobileno = $_POST['mobileno'];

    $notitype = 'Create Account';
    $reciver = 'Admin';
    $sender = $email;

    $sqlnoti = "insert into notification (notiuser,notireciver,notitype) values (:notiuser,:notireciver,:notitype)";
    $querynoti = $dbh->prepare($sqlnoti);
    $querynoti->bindParam(':notiuser', $sender, PDO::PARAM_STR);
    $querynoti->bindParam(':notireciver', $reciver, PDO::PARAM_STR);
    $querynoti->bindParam(':notitype', $notitype, PDO::PARAM_STR);
    $querynoti->execute();

    $sql = "INSERT INTO users(name,email, password, gender, mobile, status) VALUES(:name, :email, :password, :gender, :mobileno, 1)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->bindParam(':gender', $gender, PDO::PARAM_STR);
    $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);

    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        echo "<script type='text/javascript'>alert('Reģistrēšanās notika veiksmīgi');</script>";
        echo "<script type='text/javascript'> document.location = 'login.php'; </script>";
    } else {
        $error = "Kaut kas nogāja greizi. Lūdzu meģiniet vēlreiz";
    }

}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <script type="text/javascript">
    </script>
</head>

<body>
<h1>Reģistrēšanās forma</h1>
<form method="post" enctype="multipart/form-data" name="regform">
    <label>Vārds<span style="color:red">*</span></label>
    <div class="col-sm-5">
        <input type="text" name="name" required>
    </div>
    <label>E-pasts<span style="color:red">*</span></label>
    <div class="col-sm-5">
        <input type="email" name="email" required>
    </div>
    <label>Telefona numurs<span style="color:red">*</span></label>
    <div class="col-sm-5">
        <input type="number" name="mobileno" required>
    </div>
    <label>Parole<span style="color:red">*</span></label>
    <div class="col-sm-5">
        <input type="password" name="password" id="password" required>
    </div>

    <label>Dzimums<span style="color:red">*</span></label>
    <div class="col-sm-5">
        <select name="gender" required>
            <option value="">Izvēlēties</option>
            <option value="Male">Vīrietis</option>
            <option value="Female">Sieviete</option>
        </select>
    </div>
    <br>
    <button name="submit" type="submit">Piereģistrēties</button>
</form>
<p>Jums jau ir profils? <a href="login.php">Ieiet profilā</a></p>
<p>Atgriezties sākuma lapā <a href="/">Sākumlapa</a></p>
</body>
</html>