<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier stagiaire</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        .custom-bg-gray {
            background-color: #D3D3D3;
        }
    </style>
</head>
<body class="custom-bg-gray">
    <?php
    require_once 'database.php';
    $errorMessage = "";

    if(isset($_POST['Modifier'])){
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $dateNaissance = $_POST['dateNaissance']; 
        $idFiliere = $_POST['idFiliere'];
        $idStagiaire = $_GET['id']; 

        if(!empty($nom) && !empty($prenom) && !empty($dateNaissance) && !empty($idFiliere) && !empty($idStagiaire))  {
            $sqlstate = $pdo->prepare('UPDATE stagiaire SET nom=?,
                                                       prenom=?, 
                                                       dateNaissance=?, 
                                                       idFiliere=? 
                                                       WHERE idStagiaire=?');
            $sqlstate->execute([$nom, $prenom, $dateNaissance, $idFiliere, $idStagiaire]);
            header('location: spaceprivee.php');
        } else {
            $errorMessage = "Tous les champs sont obligatoires !!!";
        }
    }

    $id = $_GET['id'];
    $sqlstate = $pdo->prepare('SELECT * FROM stagiaire WHERE idStagiaire=?');
    $sqlstate->execute([$id]);
    $stagiaire = $sqlstate->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                         <a href="spaceprivee.php" class="text-success text-decoration-none">&lt;--- retour</a>
                        <h3 class="card-title text-center">Modifier stagiaire</h3>

                        <?php if (!empty($errorMessage)): ?>
                            <div class="alert alert-danger text-center">
                                <?php echo $errorMessage; ?>
                            </div>
                        <?php endif; ?>

                        <form method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                                <label for="idStagiaire" class="form-label">idStagiaire :</label>
                                <input type="text" name="idStagiaire" class="form-control" value="<?php echo $stagiaire['idStagiaire'] ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom :</label>
                                <input type="text" name="nom" class="form-control" value="<?php echo $stagiaire['nom'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="prenom" class="form-label">Prénom :</label>
                                <input type="text" name="prenom" class="form-control" value="<?php echo $stagiaire['prenom'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="dateNaissance" class="form-label">Date de Naissance :</label>
                                <input type="date" name="dateNaissance" class="form-control" value="<?php echo $stagiaire['dateNaissance'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="idFiliere" class="form-label">Filière :</label>
                                <select name="idFiliere" class="form-select">
                                    <option value="">Sélectionnez une filière</option>
                                    <?php
                                    $filieres = $pdo->query('SELECT * FROM filiere')->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($filieres as $filiere) {
                                        $intitule = $filiere['intitule'];
                                        $idFiliere = $filiere['idFiliere'];
                                        $selected = $idFiliere == $stagiaire['idFiliere'] ? 'selected' : '';
                                        echo "<option $selected value='$idFiliere'>$intitule</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success form-control" name="Modifier">Modifier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
