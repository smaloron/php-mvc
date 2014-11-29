<table class="table-bordered table">
    <thead>
    <tr>
        <th>Recette</th>
        <th>Difficulté</th>
        <th>Catégorie</th>
        <th>nb de convives</th>
    </tr>
    </thead>

    <?php foreach ($recettes as $recette): ?>
        <tr>
            <td><?= $recette['recette'] ?></td>
            <td><?= $recette['difficulte'] ?></td>
            <td><?= $recette['categorie'] ?></td>
            <td><?= $recette['nb_personnes'] ?></td>
        </tr>
    <?php endforeach ?>

</table>
<?php
