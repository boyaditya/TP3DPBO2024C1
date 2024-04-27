<!-- 
  Saya Boy Aditya Rohmaulana NIM 2203488 mengerjakan
  soal Tugas Praktikum 3 dalam mata kuliah DPBO untuk keberkahanNya
  maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin. 
 -->

<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Movies.php');
include('classes/Template.php');
include('classes/Series.php');

$listMovies = new Movies($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$listMovies->open();
$listMovies->getMovies();

$listSeries = new Series($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$listSeries->open();
$listSeries->getSeries();



if (isset($_GET['direction'])) {
  $listMovies->sortMovies($_GET['direction']);
  $listSeries->sortSeries($_GET['direction']);
} else {
  $listMovies->getMovies();
  $listSeries->getSeries();
}

if (isset($_POST['cari'])) {
  $listMovies->searchMovies($_POST['keyword']);
  $listSeries->searchSeries($_POST['keyword']);
}

$data_movies = null;
$item = "Movies";

$movies_sort = '
<a href="index.php?direction=asc" class="btn btn-secondary">Sort by Released Date Ascending</a>
<a href="index.php?direction=desc" class="btn btn-secondary">Sort by Released Date Descending</a>
';


$data_movies = null;

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

$data_series = null;

while ($row = $listSeries->getResult()) {
  $data_series .=
    '<div class="col-md-2">
        <div class="card mb-3">
          <img src="assets/images/' . $row['series_image'] . '" class="card-img-top">
          <div class="card-body">
            <h5 class="card-title">' . $row['series_title'] . '</h5>
            <h6 class="card-subtitle mb-2 text-muted">' . date('Y', strtotime($row['series_first_air_date'])) . '</h6>
            <a href="detail_series.php?id=' . $row['series_id'] . '">See Detail</a>
          </div>
        </div>
      </div>
      ';
}

if ($data_series === null) {
  $data_series = '<div class="col-md-12"><p>No series found.</p></div>';
}

$listMovies->close();
$listSeries->close();

$home = new Template('templates/skin.php');
$home->replace('DATA_MOVIES', $data_movies);
$home->replace('DATA_SERIES', $data_series);
$home->replace('MOVIES_SORT', $movies_sort);
$home->write();
