<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/sketchy/bootstrap.min.css" integrity="sha384-RxqHG2ilm4r6aFRpGmBbGTjsqwfqHOKy1ArsMhHusnRO47jcGqpIQqlQK/kmGy9R" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/style.css">
    <title><?= $titre ?></title>
</head>
<body>
    
<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
  <div class="container-fluid">
    
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="index.php?action=accueil">Accueil
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="index.php?action=listeFilms&id=1">Action
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="index.php?action=listeFilms&id=2">Drame
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="index.php?action=listeFilms&id=3">Science-Fiction
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="index.php?action=listeFilms&id=4">Comédie
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="index.php?action=listeFilms&id=5">Horreur
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="index.php?action=listeActeurs">Acteurs
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="index.php?action=listeRealisateurs">Réalisateurs
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="index.php?action=gestion">Gestion
          </a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="index.php?action=listeActeurs">Acteurs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?action=listeRealisateurs">Réalisateurs</a>
        </li> -->
        
    </div>
  </div>
</nav>
<div id="wrapper">
        <main>
            <div id=contenu>
                <h2><?= $titre_secondaire ?></h2>
                <?= $contenu ?>
            </div>
        </main>
</div>
    
<footer class="footer">
    <div class="footer-content">
        <nav>
            <h6 class="footer-heading">Services</h6>
            <a class="footer-link">Branding</a>
            <a class="footer-link">Design</a>
            <a class="footer-link">Marketing</a>
            <a class="footer-link">Advertisement</a>
        </nav>
        <nav>
            <h6 class="footer-heading">Company</h6>
            <a class="footer-link">About us</a>
            <a class="footer-link">Contact</a>
            <a class="footer-link">Jobs</a>
            <a class="footer-link">Press kit</a>
        </nav>
        <nav>
            <h6 class="footer-heading">Legal</h6>
            <a class="footer-link">Terms of use</a>
            <a class="footer-link">Privacy policy</a>
            <a class="footer-link">Cookie policy</a>
        </nav>
    </div>
</footer>

    
</body>
</html>