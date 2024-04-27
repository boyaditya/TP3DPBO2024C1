<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Series.php');
include('classes/Template.php');

$series = new Series($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$series->open();
$data = null;

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  if ($id > 0) {
    $series->getSeriesById($id);
    $row = $series->getResult();

    $data .= '
          <div class="container mt-3 mb-3 ">
            <a href="edit_series.php?id=' . $row['series_id'] . '">
              <button type="button" class="btn btn-primary">Edit</button>
            </a>
            <a href="delete_series.php?id=' . $row['series_id'] . '" onclick="return confirm(\'Are you sure you want to delete this series?\')">
              <button type="button" class="btn btn-danger">Delete</button>
            </a>
          </div>
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-4">
                <img src="assets/images/' . $row['series_image'] . '" class="img-fluid">
              </div>
              
              <div class="col-md-8">
                <ul class="list-group">
                  <li class="list-group-item"><h3>' . $row['series_title'] . '</h3></li>
                  <li class="list-group-item">Creator : ' . $row['series_creator'] . '</li>
                  <li class="list-group-item">Actors : ' . $row['series_cast'] . '</li>
                  <li class="list-group-item">Genre : ' . $row['series_genre'] . '</li>
                  <li class="list-group-item">TV Networks : ' . $row['series_network'] . '</li>
                  <li class="list-group-item">First Air Date: ' . $row['series_first_air_date'] . '</li>
                  <li class="list-group-item">Last Air Date: ' . $row['series_last_air_date'] . '</li>
                  <li class="list-group-item">Average Duration : ' . $row['series_average_duration'] . ' minutes</li>
                  <li class="list-group-item">Seasons : ' . $row['series_seasons'] . '</li>
                  <li class="list-group-item">Episodes : ' . $row['series_episodes'] . '</li>
                  <li class="list-group-item">Country : ' . $row['country_name'] . '</li>
                  <li class="list-group-item">Synopsis : ' . $row['series_synopsis'] . '</li>
                </ul>
              </div>
          </div>';
  }
}

$series->close();
$detail = new Template('templates/skin_detail.php');
$detail->replace('DATA_DETAIL', $data);
$detail->write();
