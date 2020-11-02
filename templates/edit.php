<?php

$tblUsers = new TblUsers;
$userInfos = $tblUsers->getUserByid($_GET["id"]);

if (isset($_POST["submit"])) {
    $lastname = htmlspecialchars($_POST["lname"]);
    $isValidLastname = !empty($lastname);

    $firstname = htmlspecialchars($_POST["fname"]);
    $isValidFirstname = !empty($firstname);

    $email = htmlspecialchars($_POST["email"]);
    $isValidEmail = !empty($email);

    $password = htmlspecialchars($_POST["password"]);
    $password_confirm = htmlspecialchars($_POST["password_confirm"]);
    $isValidPassword = $password === $password_confirm;
    $passwordHash = !empty($password) ? password_hash($password, PASSWORD_DEFAULT) : "";

    $status = htmlspecialchars($_POST["status"]);

    $success = $isValidLastname && $isValidFirstname && $isValidEmail && $isValidPassword;

    if ($success) {
        $user = [
            "lname" => $lastname,
            "fname" => $firstname,
            "email" => $email,
            "password" => $passwordHash,
            "status" => $status
        ];
        $id = $_GET["id"];
        $tblUsers->updateUserAtId($user, $id);
        header("Location: home.php");
    }
}

?>

<div class="col-12">
    <h1 class="title">EDIT</h1>
    <form action="" method="POST">
        <div class="form-group">
            <label for="lname">Nom</label>
            <input type="text" name="lname" class="form-control" id="lname" <?= "value=" . $userInfos["lname"] ?>>
        </div>
        <div class="form-group">
            <label for="fname">Prénom</label>
            <input type="text" name="fname" class="form-control" id="fname" <?= "value=" . $userInfos["fname"] ?>>
        </div>
        <div class="form-group">
            <label for="email">e-Mail</label>
            <input type="text" name="email" class="form-control" id="email" <?= "value=" . $userInfos["email"] ?>>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="text" name="password" class="form-control" id="password">
            <small>Laisser cet zone vide pour conserver votre mot de passe.</small>
        </div>
        <div class="form-group">
            <label for="password_confirm">Confirmer mot de passe</label>
            <input type="text" name="password_confirm" class="form-control" id="password_confirm">
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" id="regStatus" value="0" <?= (int) $userInfos["status"] === 0 ? "checked" : "" ?>>
            <label class="form-check-label" for="regStatus">Particulier</label>
        </div>
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="proStatus" value="1" <?= (int) $userInfos["status"] === 1 ? "checked" : "" ?>>
                <label class="form-check-label" for="proStatus">Professionnel</label>
            </div>
        </div>
        <button type="submit" name="submit" class="btn btn-primary mt-4">Envoyer</button>
    </form>
</div>