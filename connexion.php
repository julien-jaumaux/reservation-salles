<?php 

include_once("dbconnect.php");
        
   
if ( !empty($_POST['login'])AND !empty($_POST['password'])){

    $login = $_POST['login'];
    $password = $_POST['password'];

    //vérification que l'utilisateur existe bien dans la bdd
    $requete = $bdd->prepare('SELECT * FROM utilisateurs WHERE login = ?');
    $requete->execute(array($login));
    $result = $requete->fetch(PDO::FETCH_ASSOC);
   
    
if($result == true){


    if($_POST['password'] == $result['password'] && $_POST['login'] == $result['login']){
                                $req = $bdd->prepare('SELECT * FROM utilisateurs  WHERE login = ? AND password = ?');
                                $req->execute(array($login,$password));
                                if($req->rowCount()>0){
                                $_SESSION = $req->fetch(PDO::FETCH_ASSOC);
           
                                }
                                
                                header('Location: index.php');//redirection
                            } else {
        ?> <p class='alert alert-danger alert-dismissible fade show'> Mot de passe incorrect </p>

	<?php
               
    }       
                }
            }
		?>  





<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Page Connexion</title>
</head>

    <header>
    <nav class="navbar navbar-expand-lg bg-light">
                <div class="container-fluid">
          <a class="navbar-brand" href="#">Reservation de salles</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Retour</a>
              </li>  
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="inscription.php">Inscription</a>
              </li>
              
              
              
             </ul>
            </div>
        </div>
      </nav>
</header>
<body>
<div class="parallax_connexion">  
    <h1 class="text-center pt-5">Bienvenue sur la page de connexion </h1>
    <div class="container  " id="page_centrale_connexion">
<div class="row h-100  ">
    <div class="col-12 h-100 d-flex justify-content-center align-items-center">
            <form class="w-50"  action="connexion.php" method="post">
                        <p class="text-center"> <?php  echo @$mauvaisidentifiants;  ?> </p>
                        <div class="form-group">
                            <label for="login">Login</label>
                            <input  type="login" name="login" required class="form-control" id="login" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" required class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="row">
                        <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="submit" name="submit" class="btn btn-primary mt-3 ">Connexion</button></div>
							<br>
                        <div class="ins">
							
                            <p class="alert alert-info alert-dismissible fade show mt-3 rounded">Vous n'êtes pas encore inscrit ?</p>
                            <div class="d-grid gap-2 col-6 mx-auto">	
                        <a href="inscription.php" class="btn btn-primary mb-3">Inscription</a></div>
            </form>
    </div>
</div>       
</div>
</div>

 

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>
</html>
