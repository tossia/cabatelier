<?php
include("../../../inc/config.php");

if (!is_logged()) {
    header("location:../../index.php");
    die();
}

/* Liste deroulante des pays à choisir*/
$pays = "SELECT nom_fr_fr FROM pays";
$stmt = $bdd->prepare($pays);
$stmt->execute();
$list_pays = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'nom_fr_fr');

$titlePage = "Enregistrer un nouveau fabricant";
?>


<!DOCTYPE html>
<html lang="fr">

    <head>
        <?php
        include("../../inc/head.php");
        ?>
    </head>

    <body class="bg-gradient-primary">

        <div class="container">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
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
                                        <div class="col-4">
                                            <label for='nom'>Nom de fabricant</label>
                                            <input type="text" class="form-control form-control-user" name="nom" id="titre" placeholder="Saisir le nom de fabricant">                                            
                                        </div>
                                        <div class='col-4'>
                                            <label for="pays">Pays de fabrication</label>
                                            <select name="pays" class="form-control">
                                                <option disabled selected>Seléctioner un pays</option>
                                                <?php
                                                foreach ($list_pays as $pays) {
                                                    echo "<option value='" . $pays . "'>" . $pays . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class='col-4'>
                                            <label for="adresse">Adresse</label>
                                            <input type="text" class='form-control form-control-user' name='adresse' id='adress' placeholder="Saisir l'adresse du fabricant">
                                        </div>
                                    </div>
                                    <div class="form-group d-flex">
                                        <div class='col-4'>
                                            <label for='contact'>Contact person</label> 
                                            <input type="text" class="form-control form-control-user" name="contact" id="contact" placeholder="Person en contact">
                                        </div>
                                        <div class="col-4">
                                            <label for='email'>E-mail</label>
                                            <input type="email" class="form-control form-control-user" name="email" id="email" placeholder="Saisir e-mail">
                                        </div>
                                        <div class='col-4'>
                                            <label for='phone'>Numéro de téléphone</label> 
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
                                <br>
                                <a class="small btn btn-warning btn-user btn-block text-dark" href="index.php">Retourner sur la liste des fabricants. <b>Ce fabricant ne sera pas enrégistré</b></a>
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
        include("../../inc/bottom.php");
        ?>
    </body>
</html>

