<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Movies.php');
include('classes/Template.php');

$listMovies = new Movies($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$listMovies->open();
$listMovies->getMovies();

$action_file = "movies.php";

// cari movies
if (isset($_POST['cari'])) {
    $listMovies->searchMovies($_POST['keyword']);
}

$data_movies = null;
$item = "Movies";
$button_add = '    <a href="add_movie.php">
      <button type="button" class="btn btn-secondary">Add Movies</button>
    </a>';

while ($row = $listMovies->getResult()) {
    $data_movies .=
        ' <div class="col-md-2">
        <div class="card mb-3">
          <img src="assets/images/' . $row['movies_image'] . '" class="card-img-top">
          <div class="card-body">
            <h5 class="card-title">' . $row['movies_title'] . '</h5>
            <h6 class="card-subtitle mb-2 text-muted">' . $row['movies_released_year'] . '</h6>
            <a href="detail_movie.php?id=' . $row['movies_id'] . '">See Detail</a>
          </div>
        </div>
      </div>

      ';
}

if ($data_movies === null) {
  $data_movies = '<div class="col-md-12"><p>No movies found.</p></div>';
}


$listMovies->close();

$home = new Template('templates/skin2.php');
$home->replace('DATA_ITEM', $data_movies);
$home->replace('ITEM', $item);
$home->replace('ACTION_FILE', $action_file);
$home->replace('BUTTON_ADD', $button_add);
$home->write();
