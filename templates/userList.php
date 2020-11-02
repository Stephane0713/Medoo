<?php

$tblUsers = new TblUsers;
if (isset($_GET["mode"]) && isset($_GET["id"])) {
    if ($_GET["mode"] === "del") {
        $tblUsers->deleteUserById($_GET["id"]);
    }
}

$users = $tblUsers->getUsers();

?>

<div class="col-12">
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">E-mail</th>
                <th scope="col">Statut</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) { ?>
                <tr>
                    <td><?= $user["lname"] ?></td>
                    <td><?= $user["fname"] ?></td>
                    <td><?= $user["email"] ?></td>
                    <td><?= (int) $user["status"] === 1 ? "Professionnel" : "Particulier"; ?></td>
                    <td class="text-right">
                        <a href="?mode=edit&id=<?= $user["id"] ?>" class="btn btn-primary">Modifier</a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" data-whatever="<?= $user["id"] ?>">Supprimer</button>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="?mode=add" class="btn btn-primary">Ajouter un utilisateur</a>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Attention</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="modal-message">Souhaitez vous vraiment supprimer cet utilisateur ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <a href="#" class="btn btn-danger">Supprimer</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('whatever')
            var modal = $(this)
            modal.find('.modal-footer a').attr("href", "?mode=del&id=" + recipient)
        })
    </script>
</div>