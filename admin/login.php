<?php
include("../inc/config.inc");

if (is_logged()) {
    header("location:index.php");
    die();
}

$titlePage = "Pour commencer il faut se connecter";
?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <?php
        include("inc/head.inc");
        ?>
        <title><?php echo $titlePage; ?></title>
    </head>

    <body class="bg-gradient-primary">

        <div class="container">
            <!-- Outer Row -->
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5 justify-content-center">
                        <div class="card-body p-0">
                            <img class="ml-3" id="logoLogin" src='<?php echo SITE_URL; ?>/images/logo.png' alt='logoSPIE' />
                            <div class="text-center">
                            
                            <h1 class="h4 text-gray-900 mb-4 text-center"><?php echo $titlePage; ?></h1>
                            <div>
                            <!-- Nested Row within Card Body -->
                            <div class="row justify-content-center">
                                <div class="p-5 col-6 justify-content-center">


                                    <?php
                                    //debug($_SESSION);
                                    if (isset($_SESSION["erreur"])) {
                                        ?>
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                <?php
                                                foreach ($_SESSION["erreur"] as $e) {
                                                    echo "<li>" . $e . "</li>";
                                                }
                                                unset($_SESSION["erreur"]);
                                                ?>
                                            </ul>
                                        </div>    
                                        <?php
                                    }
                                    ?> 
                                    <form  method="post" action="<?php echo SITE_URL_ADMIN; ?>/users/connection.php" class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="login" id="InputLogin" value="<?php echo (isset($_SESSION["post"]["login"])) ? $_SESSION["post"]["login"] : ""; ?>" placeholder="Saisir login">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password"  id="InputPassword" placeholder="Mot de passe">
                                        </div>

                                        <input type="submit" value="Se connecter" class="btn btn-primary btn-user btn-block">
                                    </form>
                                    <?php
                                    unset($_SESSION["post"]);
                                    ?>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript; Core plugin JavaScript; Custom scripts for all pages-->
        <?php
        include("inc/bottom.inc");
        ?>

    </body>

</html>


