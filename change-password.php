<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:login.php');
} else {
    if (isset($_POST['submit'])) {
        $password = md5($_POST['password']);
        $newpassword = md5($_POST['newpassword']);
        $username = $_SESSION['alogin'];
        $sql = "SELECT Password FROM users WHERE email=:username and password=:password";
        $query = $dbh->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        if ($query->rowCount() > 0) {
            $con = "update users set password=:newpassword where email=:username";
            $chngpwd1 = $dbh->prepare($con);
            $chngpwd1->bindParam(':username', $username, PDO::PARAM_STR);
            $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
            $chngpwd1->execute();
            $msg = "Tava parole tika veiksmīgi nomainīta";
        } else {
            $error = "Tava parole neatbilst kritērijiem.";
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

        <title>Paroles mainīšana</title>

        <script type="text/javascript">
            function valid() {
                if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
                    alert("Jauna un vecā parole nesakrīt!");
                    document.chngpwd.confirmpassword.focus();
                    return false;
                }
                return true;
            }
        </script>
        <style>
            .errorWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #dd3d36;
                color: #fff;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }

            .succWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #5cb85c;
                color: #fff;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }
        </style>
    </head>
    <body>
    <h1>Paroles mainīšana</h1>
    <?php include('includes/header.php'); ?>
    <h3>Aizpildiet formu, lai varētu nomainīt savu paroli</h3>
    <form method="post" name="chngpwd" onSubmit="return valid();">
        <?php if ($error) { ?>
            <div class="errorWrap"><strong>Kļūda</strong>:<?php echo htmlentities($error); ?>
            </div><?php } else if ($msg) { ?>
            <div class="succWrap"><strong>Veiksmīgi</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
            <label>Vecā parole</label>
            <div class="col-sm-8">
                <input type="password" name="password" id="password" required>
            </div>
            <label>Jaunā parole</label>
            <div class="col-sm-8">
                <input type="password"name="newpassword" id="newpassword" required>
            </div>
            <label>Apstiprināt jauno paroli</label>
            <div class="col-sm-8">
                <input type="password" name="confirmpassword" id="confirmpassword" required>
            </div>
                <button class="btn btn-primary" name="submit" type="submit">Saglabāt izmaiņas</button>
            </div>
    </form>
    <script type="text/javascript">
        $(document).ready(function () {
            setTimeout(function() {
                $('.succWrap').slideUp("slow");
            }, 3000);
        });
    </script>
    </body>

    </html>
<?php } ?>