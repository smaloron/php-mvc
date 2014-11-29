<form method="get" action="<?=$baseUrl?>recette/search" class="form-horizontal">
    <div class="form-group">
    <select name="categorie" class="form-control">
        <?php
            $options = "";
            for ($i = 0; $i < count($listeCategorie); $i++) {
                $options .= "<option value=\"" . $listeCategorie[$i]['categorie_id'] . "\">" . $listeCategorie[$i]['categorie'] . "</option>";
            }
            echo $options;
        ?>
    </select>

    <button type="submit" class="btn btn-default">Chercher</button>
    </div>


</form>