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
  <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark" id="menu">
    
    <a href="#" class="clr-white fa-solid fa-bars hidden" id="menu"></a>
    <div id="liens">
      <a class="nav-link active" href="index.php?action=accueil">Accueil</a>
      <a class="nav-link active" href="index.php?action=categorie">Catégorie</a>
      <a class="nav-link active" href="index.php?action=listeActeurs">Acteurs</a>
      <a class="nav-link active" href="index.php?action=listeRealisateurs">Réalisateurs</a>
    </div>
    
  
</nav>
<div id="wrapper">
        <main>
            <div id=contenu>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js" integrity="sha512-b+nQTCdtTBIRIbraqNEwsjB6UvL3UEMkXnhzd8awtCYh0Kcsjl9uEgwVFVbhoj3uu1DO1ZMacNvLoyJJiNfcvg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="public/js/script.js"></script>
</body>
</html>