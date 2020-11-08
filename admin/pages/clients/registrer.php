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
$titlePage = "Registrer un client";

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
                                    <h4 class="text-gray-900 mb-4"><?php echo $titlePage; ?></h4>
                                </div>

                                <!-- Formulaire -->
                                <form method="post" action="firstReg.php" class="user" name='form'>
                                    <div class="form-group d-flex">
                                        <div class="col-6">
                                            <lable for="client"></lable>
                                            <input type="text" class="form-control form-control-user" name="client" id="client" placeholder='Saisir le nom de client'>
                                        </div>
                                        <div class="col-6">
                                            <label for="pays">Pays</label>
                                            <select name="pays" class="form-control">
                                                <option value=''>Seléctioner un pays</option>
                                                <?php
                                                foreach ($list_pays as $pays) {
                                                    echo "<option value='" . $pays . "'>" . $pays . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex">
                                        <div class="col-6">
                                            <label for="adresse">Adress</label>
                                            <input type="text" class="form-control form-control-user" name="adresse" id="adress" placeholder="Saisisr l'adress">
                                        </div>
                                        <div class="col-6">
                                            <label for="contact">Personne de contact</label>
                                            <input type="text" class="form-control form-control-user" name="contact" id="contact" placeholder="Le nom du person de contact">
                                        </div>
                                    </div>
                                    <div class="form-group d-flex">
                                        <div class="col-6">
                                            <label for="email">E-mail</label>
                                            <input type="email" class="form-control form-control-user" name="email" id="email" placeholder="Saisir e-mail">
                                        </div>
                                        <div class="col-6">
                                            <label for="phone">Numéro de téléphone</label>
                                            <input type="text" class="form-control form-control-user" name="phone" id="phone" placeholder="Numéro de téléphone">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="commentaire">Commentaires</label>
                                        <input type="text" class="form-control" name="commentaire" id="comment" placeholder="Ajouter des commentaires">
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