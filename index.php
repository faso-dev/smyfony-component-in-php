<?php ini_set('display_errors', 1);

require_once __DIR__ . '/vendor/autoload.php';

use App\Validator\Validator;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

$violations = [];
$form = [];
if (isset($_POST['submit'])) {
    $form['nom'] = $_POST['nom'] ?? null;
    $form['prenom'] = $_POST['prenom'] ?? null;
    $violations = Validator::validate($form)->with([
        'nom' => [
            new NotBlank([
                'message' => 'Le nom est obligatoire'
            ]),
            new Length([
                'min' => 2,
                'minMessage' => 'Le nom doit faire au moins {{ limit }} caractères'
            ])
        ],
        'prenom' => [
            new NotBlank([
                'message' => 'Le prenom est obligatoire'
            ]),
            new Length([
                'min' => 2,
                'max' => 5,
                'minMessage' => 'Le prenom doit faire au moins {{ limit }} caractères',
                'maxMessage' => 'Le prenom doit faire au plus {{ limit }} caractères',
            ])
        ],
    ]);

    if (0 === count($violations)) {
        echo 'Formulaire valide';
    }
}

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Symfony Validator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
<div class="container-md mt-5">
    <div class="row">
        <div class="col-12">
            <form action="" method="post">
                <div class="row">
                    <div class="col-6">
                        <label for="nom">Nom</label>
                        <input
                                class="form-control <?= isset($violations['nom']) ? 'is-invalid' : '' ?>"
                                value="<?= $_POST['nom'] ?? '' ?>"
                                type="text"
                                name="nom"
                                id="nom">
                        <div class="invalid-feedback">
                            <?= $violations['nom'] ?? '' ?>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="prenom">Prénom</label>
                        <input
                                class="form-control <?= isset($violations['prenom']) ? 'is-invalid' : '' ?>"
                                value="<?= $_POST['prenom'] ?? '' ?>"
                                type="text"
                                name="prenom"
                                id="prenom">

                        <div class="invalid-feedback">
                            <?= $violations['prenom'] ?? '' ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <button
                                name="submit"
                                value="submit"
                                type="submit"
                                class="btn btn-primary mt-2">
                            Soumettre
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>
</body>
</html>