<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.23.4/dist/css/uikit.min.css" />
    <title><?= $titre ?></title>
</head>
<body>
    <div id="wrapper" class="uk-container uk-container-expand">
        <main>
            <div id=contenu>
                <h1 class="uk-heading-divider">PDO Cinema</h1>
                <h2 class="uk-heading-bullet"><?= $titre_secondaire ?></h2>
                <?= $contenu ?>
            </div>
        </main>
    </div>
    
</body>
</html>