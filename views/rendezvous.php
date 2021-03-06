<?php

require_once('../config.php');
require_once('../models/dataBase.php');
require_once('../controllers/controllerRendezVous.php');

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rendez-vous détaillé</title>
</head>

<body>

    <div class="global">
    <div class="text-center fw-bold">
            <a href="home.php">
                <h1 class="text-center fw-bold title h1">Hôpital Velpo</h1>
            </a>
        </div>


        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid m-0">
                <button class="navbar-toggler border-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon text-white pt-1 pe-5">Menu</span>
                </button>
                <a href="../index.php" class="navbar-toggler text-white border border-dark d-flex d-lg-none text-decoration-none">Accueil</a>

                <div class="collapse navbar-collapse text-start" id="navbarNav">
                    <ul class="navbar-nav container row">
                        <li class="nav-item col-lg-3 d-lg-flex justify-content-lg-end ">
                            <div class="text-start text-lg-center">
                                <a class="menu nav-link active" aria-current="page" href="../index.php"><span class="text text-dark">Accueil</span></a>
                            </div>
                        </li>
                        <li class="nav-item col-lg-3 d-lg-flex justify-content-lg-end">
                            <div class="text-start text-lg-center">
                                <a class="menu nav-link active  text-dark" aria-current="page" href="ajout-patient.php"><span class="text text-dark">Ajouter un client</span></a>
                            </div>
                        </li>
                        <li class="nav-item col-lg-3 d-lg-flex justify-content-lg-end">
                            <div class="text-start text-lg-center">
                                <a class="menu nav-link active text-white" aria-current="page" href="liste-patients.php"><span class="text-dark">
                                        <form action="liste-patients.php" method="POST">
                                            <input type="submit" name="showPatients" class="btn text-dark" value="Voir la liste des clients">
                                        </form>
                                    </span></a>
                            </div>
                        </li>
                        <li class="nav-item col-lg-3 d-lg-flex justify-content-lg-end">
                            <div class="text-start text-lg-center">
                                <a class="menu nav-link active text-white" aria-current="page" href="liste-rendezvous.php"><span class="text-dark">
                                        <form action="liste-rendezvous.php" method="POST">
                                            <input type="submit" name="showRdv" class="btn text-dark" value="Voir la liste des Rendez-vous">
                                        </form>
                                    </span></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>



        <?php if (isset($_POST['goUpdate'])) { ?>
            <?php foreach ($rendezVousArray as $rdv) { ?>

                <div class="row text-center justify-content-center ">
                    <form action="" method="POST" class="col-lg-6 row container-fluid border border-dark justify-content-center pb-2">

                        <label for="lastname" class="pt-3 fw-bold">Nom :</label>
                        <input type="text" name="lastname" id="lastname" placeholder="Ex: Poutine" value="<?= $rdv['lastname'] ?>">

                        <label for="firstname" class="pt-3 fw-bold">Prénom :</label>
                        <input type="text" name="firstname" id="firstname" placeholder="Ex: Vladimir" value="<?= $rdv['firstname'] ?>">

                        <?php foreach ($splitArray as $split) { ?>

                            <label for="dateRdv" class="pt-3 fw-bold">Date du Rendez-vous</label>
                            <input type="date" name="dateRdv" id="dateRdv" min="01-01-2022" max="31-12-2022" value="<?= $split['dateRdv'] ?>">

                            <label for="timeRdv" class="pt-3 fw-bold">Heure du Rendez-vous</label>
                            <input type="time" name="timeRdv" id="timeRdv" step="2" min="08:00:00" max="18:00:00" value="<?= trim($split['timeRdv']) ?>">

                        <?php } ?>

                    <?php } ?>

                </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-success" name="modify" value="Enregistrer les modifications">
                    <a href="liste-rendezvous.php"><button type="button" class="btn btn-danger" data-bs-dismiss="modal">Annuler</button></a>
                </div>

                </form>


            <?php } else { ?>

                <?php if (isset($_POST['modify'])) { ?>

                    <div class="text-center">
                        <div class="fw-bold fs-3 pt-5"> Le rendez-vous a été mis à jour avec succès!</div>
                        <img src="../assets/bien.png" alt=" logo ok vert" class="w-25">
                    </div>

                    <?php } else {


                    if (isset($_POST['delete'])) { ?>

                        <div class="text-center">
                            <div class="fw-bold fs-3 pt-5"> Le rendez-vous a été supprimé avec succès!</div>
                            <img src="../assets/bien.png" alt=" logo ok vert" class="w-25">
                        </div>

                    <?php } else { ?>

                        <?php foreach ($rendezVousArray as $rdv) { ?>
                            <div class="pt-5 text-center">
                                <div class="text-center fw-bold fs-3">Nom: <?= $rdv['lastname'] ?></div>
                                <div class="text-center fw-bold fs-3">Prénom: <?= $rdv['firstname'] ?></div>
                                <div class="text-center fw-bold">Téléphone: <?= $rdv['phone'] ?></div>
                                <div class="text-center fw-bold">Email: <?= $rdv['mail'] ?></div>
                                <div class="text-center fw-bold"> Date et heure du RDV: <?= $rdv['dateHour'] ?></div>
                            </div>
            <?php }
                    }
                }
            } ?>
            <?php if (!isset($_POST['goUpdate'])) { ?>

                <?php if (!isset($_POST['delete'])) { ?>


                    <div class="text-center pb-5 row">

                        <form action="" method="POST" class="pt-3 col-lg-4">
                            <input type="submit" name="goUpdate" value="Mettre à jour le Rdv" class="btn btn-dark">
                        </form>
                        
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger col-lg-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Supprimer le Rendez-vous
                        </button>
                        <a href="liste-rendezvous.php" class="col-lg-4 pt-3">
                            <span class="text-dark">
                                <form action="liste-rendezvous.php" method="POST">
                                    <input type="submit" name="showRdv" class="btn btn-dark" value="Retour a la liste des Rendez-vous">
                                </form>
                            </span>
                        </a>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Supprimer le rendez-vous</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Etes-vous certain de vouloir supprimer le Rendez-vous?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <form action="" method="POST" class="pt-3">
                                        <input type="submit" name="delete" value="Supprimer le Rdv" class="btn btn-danger">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
            <?php if (isset($_POST['delete'])) { ?>
                <div class="text-center">
                    <a href="liste-rendezvous.php"><span class="text-dark">
                            <form action="liste-rendezvous.php" method="POST">
                                <input type="submit" name="showRdv" class="btn btn-dark" value="Retour a la liste des Rendez-vous">
                            </form>
                        </span></a>
                </div>
            <?php } ?>

            <footer class="footer">
            </footer>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>