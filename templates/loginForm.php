<?php
if (isset($_POST["submit"])) {

    $email = htmlspecialchars($_POST["email"]);
    $isValidEmail = !empty($email);

    $password = htmlspecialchars($_POST["password"]);
    $isValidPassword = !empty($password);

    $isValidAll = $isValidEmail && $isValidPassword;

    if ($isValidAll) {
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);
        $tblUsers = new TblUsers;
        $access = $tblUsers->verifyAccess($email, $password);
        if ($access) {
            session_start();
            $_SESSION["email"] = $email;
            header("Location: home.php");
        }
    }
}
?>

<div class="col-12">
    <form action="" method="post">
        <div class="form-group">
            <label for="login">Email :</label>
            <input type="text" name="email" id="login" class="form-control">
        </div>
        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="text" name="password" id="password" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" value="Envoyer" name="submit" class="btn btn-primary">
        </div>
    </form>
</div>