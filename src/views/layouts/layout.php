<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title><?php echo $siteTitle ?></title>
    <link rel="stylesheet" href="<?=$baseUrl?>assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?=$baseUrl?>assets/bootstrap/css/bootstrap-theme.min.css" />
    <link rel="stylesheet" href="<?=$baseUrl?>assets/css/site.css" />

</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?php echo $siteTitle ?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">Accueil</a></li>
                <li><a href="<?=$baseUrl?>recette/new">Nouvelle recette</a></li>
                <li><a href="<?=$baseUrl?>recette/showAll">Toutes les recette</a></li>
                <li><a href="<?=$baseUrl?>recette/search">chercher une recette</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php echo $viewContent ?>
        </div>

    </div>

</div>


<script src="<?=$baseUrl?>assets/jquery-1.11.1.min.js" type="application/javascript"></script>
<script src="<?=$baseUrl?>assets/bootstrap/js/bootstrap.min.js" type="application/javascript"></script>
</body>
</html>