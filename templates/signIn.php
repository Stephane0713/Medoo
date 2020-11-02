<?php
if (isset($_POST["submit"])) {
    $lastname = htmlspecialchars($_POST["lname"]);
    $isValidLastname = !empty($lastname);

    $firstname = htmlspecialchars($_POST["fname"]);
    $isValidFirstname = !empty($firstname);

    $email = htmlspecialchars($_POST["email"]);
    $isValidEmail = !empty($email);

    $password = htmlspecialchars($_POST["password"]);
    $password_confirm = htmlspecialchars($_POST["password_confirm"]);
    $isValidPassword = !empty($password) && $password === $password_confirm;
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $status = htmlspecialchars($_POST["status"]);

    $isValidMentions = !empty($_POST["mentions"]);

    $success = $isValidLastname && $isValidFirstname && $isValidEmail && $isValidPassword && $isValidMentions;

    if ($success) {
        $user = [
            "lname" => $lastname,
            "fname" => $firstname,
            "email" => $email,
            "password" => $passwordHash,
            "status" => $status
        ];
        $tblUsers = new TblUsers;
        $tblUsers->insertUser($user);
        header("Location: home.php");
    }
}

?>

<div class="col-12">
    <h1 class="title">ADD</h1>
    <form action="" method="POST">
        <div class="form-group">
            <label for="lname">Nom</label>
            <input type="text" name="lname" class="form-control" id="lname">
        </div>
        <div class="form-group">
            <label for="fname">Prénom</label>
            <input type="text" name="fname" class="form-control" id="fname">
        </div>
        <div class="form-group">
            <label for="email">e-Mail</label>
            <input type="text" name="email" class="form-control" id="email">
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="text" name="password" class="form-control" id="password">
        </div>
        <div class="form-group">
            <label for="password_confirm">Confirmer mot de passe</label>
            <input type="text" name="password_confirm" class="form-control" id="password_confirm">
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="regStatus" value="0" checked>
            <label class="form-check-label" for="regStatus">Particulier</label>
        </div>
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="proStatus" value="1">
                <label class="form-check-label" for="proStatus">Professionnel</label>
            </div>
        </div>
        <p class="form__group">
            <input type="checkbox" name="mentions" id="mentions" class="form__input">
            <label for="mentions">Je reconnais avoir pris connaissance des conditions d’utilisation et y adhère totalement.</label>
        </p>
        <button type="submit" name="submit" class="btn btn-primary mt-4">Envoyer</button>
    </form>
</div>