<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <title>MovieSeries DB</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">MovieSeries DB</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'movies.php' ? 'active' : '' ?>" href="movies.php">Movies</a>
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'series.php' ? 'active' : '' ?>" href="series.php">Series</a>
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'genre.php' ? 'active' : '' ?>" href="genre.php">Genre</a>
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'country.php' ? 'active' : '' ?>" href="country.php">Country</a>
                </div>
            </div>
        </div>
    </nav>