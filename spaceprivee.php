    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>spaceprivee</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
    

    </head>
    <style>
    
    .img {
        width: 80px; 
        height: 80px; 
        border-radius: 50%; 
        object-fit: cover; 
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3); 
    }
    .img.with-border {
        border: 3px solid #007bff; 
    }
    .cellule-centree {
        display: flex;
        justify-content: center; 

    }
    table {
            text-align: center;
        }


    </style>
    <body>
        <div class="container">
        <?php 
            require_once 'database.php';
            session_start();
                include_once 'nav.php';
                $heure = date('H');
            // $heure=18;
            // echo $heure;
                $message="";
                if($heure>=17){
                $message='Bonsoir';
                }else{
                $message='Bonjour';

                }

        ?>
            <h1 style='text-align:center;'>
            <?php
                if (isset($_SESSION['user'])) {
                    echo $message . ' <span class="text-primary">' . $_SESSION['user']['nom'] . ' ' . $_SESSION['user']['prenom'] . '</span>';
                } else {
                    echo $message;
                }
            ?>

    </h1>
    <?php
        $stagiaires=$pdo->query('SELECT *from stagiaire
                            INNER JOIN filiere on
                            filiere.idFiliere=stagiaire.idFiliere')->
                            fetchAll(pdo::FETCH_ASSOC);
    ?>
    
    <a href="ajouter.php" class="btn btn-success">+ Ajouter un stagiaire</a>
    <br>
    <table class="table table-striped">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>DateNaissance</th>
            <th>PhotoProfil</th>
            <th>Filiere</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($stagiaires as $stagiaire) { ?>
            <tr>
                <td class="align-middle"><?php echo $stagiaire['nom']; ?></td>
                <td class="align-middle"><?php echo $stagiaire['prenom']; ?></td>
                <td class="align-middle"><?php echo $stagiaire['dateNaissance']; ?></td>
                <td class="align-middle text-center">
                    <img class='img' src="images/<?php echo $stagiaire['photoProfil'] ?>" width="100px">
                </td>
                <td class="align-middle"><?php echo $stagiaire['intitule']; ?></td>
                <td class="align-middle text-center">
                    <a href="Modifier.php?id=<?php echo $stagiaire['idStagiaire']; ?>" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-brush-fill" viewBox="0 0 16 16">
                            <path d="M15.825.12a.5.5 0 0 1 .132.584c-1.53 3.43-4.743 8.17-7.095 10.64a6.067 6.067 0 0 1-2.373 1.534c-.018.227-.06.538-.16.868-.201.659-.667 1.479-1.708 1.74a8.118 8.118 0 0 1-3.078.132 3.659 3.659 0 0 1-.562-.135 1.382 1.382 0 0 1-.466-.247.714.714 0 0 1-.204-.288.622.622 0 0 1 .004-.443c.095-.245.316-.38.461-.452.394-.197.625-.453.867-.826.095-.144.184-.297.287-.472l.117-.198c.151-.255.326-.54.546-.848.528-.739 1.201-.925 1.746-.896.126.007.243.025.348.048.062-.172.142-.38.238-.608.261-.619.658-1.419 1.187-2.069 2.176-2.67 6.18-6.206 9.117-8.104a.5 .5 0 0 1 .596.04z"/>
                        </svg>
                    </a>
                    <a onclick="return confirm('Voulez-vous vraiment supprimer le stagiaire !!')" href="Supprimer.php?id=<?php echo $stagiaire['idStagiaire']; ?>" class="btn btn-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                        </svg>
                    </a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

    </div>

    </body>
    </html>