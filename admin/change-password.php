<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:login.php');
} else {
// Code for change password	
    if (isset($_POST['submit'])) {
        $password = md5($_POST['password']);
        $newpassword = md5($_POST['newpassword']);
        $username = $_SESSION['alogin'];
        $sql = "SELECT Password FROM admin WHERE UserName=:username and Password=:password";
        $query = $dbh->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        if ($query->rowCount() > 0) {
            $con = "update admin set Password=:newpassword where UserName=:username";
            $chngpwd1 = $dbh->prepare($con);
            $chngpwd1->bindParam(':username', $username, PDO::PARAM_STR);
            $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
            $chngpwd1->execute();
            $msg = "Tava parole tika veiksmīgi nomainīta";
        } else {
            $error = "Tava pašreizējā parole nav atbilstoša";
        }
    }
    ?>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="theme-color" content="#3e454c">

        <title>Admina paroles maiņa</title>

        <script type="text/javascript">
            function valid() {
                if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
                    alert("Jaunā parole ar vēlreiz ievadīto jauno paroli nesakrīt!");
                    document.chngpwd.confirmpassword.focus();
                    return false;
                }
                return true;
            }
        </script>
    </head>

    <body>
    <?php include('includes/header.php'); ?>
    <h2>Mainīt paroli</h2>
    <form method="post" name="chngpwd" onSubmit="return valid();">
        <label>Vecā parole</label>
        <div class="col-sm-8">
            <input type="password" class="form-control" name="password" id="password" required>
        </div>

        <label>Jaunā parole</label>
        <div class="col-sm-8">
            <input type="password" name="newpassword" id="newpassword" required>
        </div>

        <label>Apstiprināt jauno paroli</label>
        <div class="col-sm-8">
            <input type="password" name="confirmpassword" id="confirmpassword" required>
        </div>
        <button name="submit" type="submit">Saglabāt izmaiņas</button>
    </form>
    </body>

    </html>
<?php } ?>