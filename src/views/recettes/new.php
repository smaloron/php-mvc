<div class="col-md-6">
    <h3>Nouvelle recette</h3>

    <?php
    if(isset($errors)){
        $html = "<ul>";
        foreach($errors as $error){
            $html .= "<li>" . $error . "</li>";
        }

        echo $html;
    }

    ?>

<form role="form" method="post" action="<?=$baseUrl?>recette/new">



    <div class="form-group">
        <label for="recette">
            Titre</label>
        <input type="text" name="recette" placeholder="Le titre de votre recette" required class="form-control"/>
    </div>

    <div class="form-group">
        <label for="categorie">
            Catégorie</label>
        <select name="categorie" class="form-control">
            <?php
                $options = "";
                for($i=0; $i< count($listeCategorie); $i++){
                    $options .= "<option value=\"" . $listeCategorie[$i]['categorie_id']."\">" . $listeCategorie[$i]['categorie']."</option>";
                }
                echo $options;
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="difficulte">
            Difficulté</label>
        <select name="difficulte" class="form-control">
            <?php
                $options = "";
                for($i=0; $i< count($listeDifficulte); $i++){
                    $options .= "<option value=\"" . $listeDifficulte[$i]['difficulte_id']."\">" . $listeDifficulte[$i]['difficulte']."</option>";
                }
                echo $options;
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="nbPersonnes">Nombre de personnes</label>
        <input type="number" name="nbPersonnes" required class="form-control">

    </div>

    <div class="form-group">
        <label for="description">Description </label>
        <textarea name="description" class="form-control"></textarea>
    </div>


    <button type="submit" class="btn btn-default">Valider</button>
</form>
</div>