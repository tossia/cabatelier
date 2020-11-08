<?php
include("../../../inc/config.inc");

if (!is_logged()) {
    header("location:../../index.php");
    die();
}
if (is_user()) {
    header("location:../../../index.php");
    die();
}
$titlePage = "Modifier un client";

$id = $_GET["id"];

$clients = 'SELECT client.id, client.client, pays.nom_fr_fr as pays, client.adresse, client.contact_person, '
        . 'client.email, client.phone, client.commentaire '
        . 'FROM (client LEFT JOIN pays on client.pays=pays.id) '
        . 'WHERE client.id=' . $id;
$stmt_client = $bdd->prepare($clients);
$stmt_client->execute();
$one_client = $stmt_client->fetch(PDO::FETCH_ASSOC);

$pays = "SELECT nom_fr_fr FROM pays";
$stmt = $bdd->prepare($pays);
$stmt->execute();
$list_pays = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'nom_fr_fr');
?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <title><?php $titlePage; ?></title>
        <?php
        include("../../inc/head.inc");
        ?>
    </head>

    <body class="bg-gradient-primary">

        <div class="container">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <img class="ml-3" id="logoLogin" src='<?php echo SITE_URL; ?>/images/logo.png' alt='logoSPIE' />
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-11 mx-auto">
                            <div class="p-5">
                                <div class="text-center">
                                    <h4 class="text-gray-900 mb-4"><?php echo $titlePage; ?> ID = <?php echo $one_client['id']; ?>, '<b><?php echo $one_client['client']; ?></b>'</h4>
                                </div>

                                <!-- Formulaire -->
                                <form method="post" action="update.php" class="user" name='form'>
                                    <input type="hidden" name="id" value='<?php echo $one_client["id"]; ?>'>
                                    <div class="form-group d-flex">
                                        <div class="col-6">
                                            <lable for="client">Client</lable>
                                            <input type="text" class="form-control form-control-user" name="client" id="client" value="<?php echo $one_client["client"]; ?>">
                                        </div>
                                        <div class="col-6">
                                            <label for="pays">Pays</label>
                                            <select name="pays" class="form-control">
                                                <option></option>
                                                <?php
                                                foreach ($list_pays as $pays) {
                                                    if ($pays == $one_client['pays']):
                                                        echo "<option selected value='" . $pays . "'>" . $pays . "</option>";
                                                    else:
                                                        echo "<option value='" . $pays . "'>" . $pays . "</option>";
                                                    endif;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group d-flex">
                                        <div class="col-6">
                                            <label for="adresse">Adress</label>
                                            <input type="text" class="form-control form-control-user" name="adresse" id="adress" value="<?php echo $one_client['adresse']; ?>">
                                        </div>
                                        <div class="col-6">
                                            <label for="contact">Personne de contact</label>
                                            <input type="text" class="form-control form-control-user" name="contact" id="contact" value="<?php echo $one_client['contact_person']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group d-flex">
                                        <div class="col-6">
                                            <label for="email">E-mail</label>
                                            <input type="email" class="form-control form-control-user" name="email" id="email" value="<?php echo $one_client['email']; ?>">
                                        </div>
                                        <div class="col-6">
                                            <label for="phone">Numéro de téléphone</label>
                                            <input type="text" class="form-control form-control-user" name="phone" id="phone" value="<?php echo $one_client['phone']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="commentaire">Commentaires</label>
                                        <input type="text" class="form-control" name="commentaire" id="comment" value="<?php echo $one_client['commentaire']; ?>">
                                    </div>
                                    <hr>
                                    <input type="submit" value="Enrégistrer" class="btn btn-primary btn-user btn-block font-weight-bold">

                                </form>
                                <hr>
                                <a class="small btn btn-info btn-user btn-block text-dark" href="index.php">Retourner sur la liste des clients. <b>Ce client ne sera pas enrégistré</b></a>
                                <!-- fin p-5 -->
                            </div>
                            <!--fin col-9  -->
                        </div>
                        <!--fin row -->
                    </div>
                    <!-- Fin card body-->
                </div>
                <!--Card hidden -->
            </div>
            <!-- Fin de container -->
        </div>
        <!-- Bootstrap core JavaScript Core plugin JavaScript Custom scripts for all pages-->
        <?php
        include("../../inc/bottom.inc");
        ?>
    </body>
</html>

