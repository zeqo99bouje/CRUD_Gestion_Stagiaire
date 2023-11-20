<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter stagiaire</title>
    
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
    if(isset($_POST['ajouter'])){
        $nom=$_POST['nom'];
        $prenom=$_POST['prenom'];
        $dateNaissance=$_POST['dateNaissance'];
        $idFiliere=$_POST['idFiliere'];
        if(!empty($nom) && !empty($prenom) && !empty($dateNaissance) && !empty($idFiliere) && isset($_FILES['photoProfil'])){
            $tmpName=$_FILES['photoProfil']['tmp_name'];
            $image=$_FILES['photoProfil']['name'];
            move_uploaded_file($tmpName,"images/".$image);
            $sqlstate=$pdo->prepare('INSERT INTO stagiaire VALUES(null,?,?,?,?,?)');
            $sqlstate->execute([$nom,$prenom,$dateNaissance,$image,$idFiliere]);
            header('location:spaceprivee.php');
        }else{
            $errorMessage = "Veuillez remplir tous les Champs !!!";
        }
    }
    ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <a href="spaceprivee.php" class="text-success text-decoration-none">&lt;--- retour</a>
                        <h3 class="card-title text-center">Ajouter un stagiaire</h3>

                       
                        <?php if (isset($errorMessage)): ?>
                            <div class="alert alert-danger text-center">
                                <?php echo $errorMessage; ?>
                            </div>
                        <?php endif; ?>

                        <form method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom :</label>
                                <input type="text" name="nom" class="form-control" id="nom">
                            </div>
                            <div class="mb-3">
                                <label for="prenom" class="form-label">Prénom :</label>
                                <input type="text" name="prenom" class="form-control" id="prenom">
                            </div>
                            <div class="mb-3">
                                <label for="dateNaissance" class="form-label">Date de Naissance :</label>
                                <input type="date" name="dateNaissance" class="form-control" id="dateNaissance">
                            </div>
                            <div class="mb-3">
                                <label for="photoProfil" class="form-label">Photo de Profil :</label>
                                <input type="file" name="photoProfil" class="form-control" id="photoProfil">
                            </div>
                            <div class="mb-3">
                                <label for="idFiliere" class="form-label">Filière :</label>
                                <select name="idFiliere" class="form-select" id="idFiliere">
                                    <option value="">Sélectionnez une filière</option>
                                    <?php
                                    $filieres=$pdo->query('select *from filiere')->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($filieres as $filiere){
                                        $intitule=$filiere['intitule'];
                                        $idFiliere=$filiere['idFiliere'];
                                        echo "<option value='$idFiliere'>$intitule</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success form-control" name="ajouter">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
