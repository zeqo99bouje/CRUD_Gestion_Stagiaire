<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        .custom-bg-gray {
            background-color: #D3D3D3;
        }
    </style>
</head>
<body class="custom-bg-gray">
    <?php 
    if(isset($_POST['connexion'])){
        $login=$_POST['login'];
        $password=$_POST['password'];
        if(!empty($login) && !empty($password)){
            require_once 'database.php';
            $sqlstate = $pdo->prepare('SELECT * FROM compteadministrateur
                                      WHERE loginAdmin=? AND motPasse=? ') ;
            $sqlstate->execute([$login,$password]);
            if ($sqlstate->rowCount()>=1){
                session_start();
                $_SESSION['user']=$sqlstate->fetch(PDO::FETCH_ASSOC);
                header('location:spaceprivee.php');
            } else {
                $errorMessage = 'Les données d’authentification sont incorrectes!!!';
            }
        } else {
            $errorMessage = 'Les données d’authentification sont obligatoires!!';
        }
    }
    ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center">Authentification</h3>

                        <?php if (isset($errorMessage)): ?>
                            <div class="alert alert-danger text-center">
                                <strong>Erreur:</strong> <?php echo $errorMessage; ?>
                            </div>
                        <?php endif; ?>

                        <form method="post">
                            <div class="mb-3">
                                <label for="login" class="form-label">Login :</label>
                                <input type="text" name="login" class="form-control" id="login">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe :</label>
                                <input type="password" name="password" class="form-control" id="password">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary form-control" name="connexion">S'authentifier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
