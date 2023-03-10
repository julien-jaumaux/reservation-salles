<?php
//include('header.php');
include_once("dbconnect.php");
@$login = htmlspecialchars($_POST['login']);
        

       
 //récupère les données du compte 

        $req = $bdd->prepare('SELECT * FROM utilisateurs  WHERE id  = :id');
        $req->execute(array('id' => $_SESSION['id']));
        $donnees = $req->fetch();
        ?>
        
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Page modification profil</title>
</head>

    
<body>
        <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
  
  <a class="navbar-brand" href="#">Reservation de salles</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse " id="navbarNav">
    <ul class="navbar-nav mx-auto">
      <!--<li class="nav-item">
        <a class="nav-link active" aria-current="page" href="livre-or.php">Livre d'or</a>
      </li>-->
      <li class="nav-item">
        <a class="nav-link text-dark" href="index.php">Accueil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="planning.php">Planning</a>
      </li>
      </ul>
  </div>

</nav>
    <div class="parallax_profil">
        <h2 class="text-center pt-5">Modifiez votre profil ici !!</h2>
        <div class="container "  id="page_centrale_connexion">
            <div class="row h-100  ">
                <div class="col-12 h-100 d-flex justify-content-center align-items-center">
                    <form class="w-50" action="profil.php" method="post">
                        <div class="form-group " >
                            <label for="login">Modifier votre pseudo</label>
                            <input type="login" name="login" class="form-control form-control-lg" style="border:1px solid black;"id="login" value="<?php echo $donnees['login'];   ?>">
                        </div>
                       <div class="form-group">
                            <label for="password">Modifier votre password</label>
                            <input type="password" name="password" class="form-control form-control-lg" style="border:1px solid black;"id="password">
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirmer la modification du password</label>
                            <input type="password" name="confirm_password" style="border:1px solid black;" class="form-control form-control-lg" id="confirm_password">
                        </div><br>
                        <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="submit" name="submit" class="btn btn-success d-block">Modifier</button></div>
                    </form>
                </div>
            </div>
        </div>

        <?php if (isset($_POST['submit'])) //verif d'envoi du formulaire
        {
            if (!$_POST['password'] == NULL or !$_POST['confirm_password'] == NULL) //verif pour le password
            {
                if (!$_POST['password'] == NULL and $_POST['confirm_password'] == NULL) { ?>
                    <p style="font-size:30px;text-align:center;margin-top:20px;">Vous devez confirmer votre mot de passe</p></div></div> 

                    <?php }
                if ($_POST['password'] == NULL and !$_POST['confirm_password'] == NULL) { ?>
                    <p style="font-size:30px;text-align:center;margin-top:20px;">Vous n'avez pas saisi le champs " Modifier votre password "</p></div></div> 

                    <?php }
                if (!$_POST['password'] == NULL and !$_POST['confirm_password'] == NULL and $_POST['password'] !== $_POST['confirm_password']) { ?>
                    <p style="font-size:30px;text-align:center;margin-top:20px;">Vous devez saisir deux mots de passe identiques</p></div></div> 


                    <?php }
                if ($_POST['password'] === $_POST['confirm_password']) //modification du password
                {
                    $password = $_POST['password'];
                    $password = ($_POST['password']);
                    $req = $bdd->prepare('UPDATE utilisateurs SET password = :password WHERE id  = :id');
                    $req->execute(
                        array(
                            'password' => $password,
                            'id' => $donnees['id']
                        )
                    ); 
                    header('Location: logout.php');

                }
            }
            if (!$_POST['login'] == NULL) //verif  changement pour le login
            {
                $req = $bdd->prepare('UPDATE utilisateurs SET login = :login WHERE id  = :id');
                $req->execute(
                    array(
                        'login' => $_POST['login'],
                        'id' => $donnees['id']
                    )
                );
                $_SESSION['login'] = $_POST['login'];
            }
        }
        ?>
    </div>
    <footer>
  <div class="row">
    <div class="col">
      <h5>&copy; 2023 | Reservation de salles</h5>
    </div>
    <div class="col">
      <h6 style="padding-top:5px;">By Julien.Jaumaux && Richard.Schulze</h6>
    </div>
  </div>
</footer>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>
</html>
