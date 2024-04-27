<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Movies.php');
include('classes/Template.php');

$movies = new Movies($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$movies->open();
$data = null;

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  if ($id > 0) {
    $movies->getMoviesById($id);
    $row = $movies->getResult();

    $data .= '
      <div class="container mt-3 mb-3 ">
        <a href="edit_movie.php?id=' . $row['movies_id'] . '">
          <button type="button" class="btn btn-primary">Edit</button>
        </a>
        <a href="delete_movie.php?id=' . $row['movies_id'] . '" onclick="return confirm(\'Are you sure you want to delete this movie?\')">
          <button type="button" class="btn btn-danger">Delete</button>
        </a>
      </div>
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-4">
                <img src="assets/images/' . $row['movies_image'] . '" class="img-fluid">
              </div>
              
              <div class="col-md-8">
                <ul class="list-group">
                  <li class="list-group-item"><h3>' . $row['movies_title'] . '</h3></li>
                  <li class="list-group-item">Director : ' . $row['movies_director'] . '</li>
                  <li class="list-group-item">Actors : ' . $row['movies_cast'] . '</li>
                  <li class="list-group-item">Genre : ' . $row['movies_genre'] . '</li>
                  <li class="list-group-item">Released Year: ' . $row['movies_released_year'] . '</li>
                  <li class="list-group-item">Duration : ' . $row['movies_duration'] . ' minutes</li>
                  <li class="list-group-item">Country : ' . $row['country_name'] . '</li>
                  <li class="list-group-item">Synopsis : ' . $row['movies_synopsis'] . '</li>
                </ul>
              </div>
          </div>';
  }
}

$movies->close();
$detail = new Template('templates/skin_detail.php');
$detail->replace('DATA_DETAIL', $data);
$detail->write();
