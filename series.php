<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Series.php');
include('classes/Template.php');

$listSeries = new Series($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$listSeries->open();
$listSeries->getSeries();
$action_file = "series.php";

// cari series
if (isset($_POST['cari'])) {
    $listSeries->searchSeries($_POST['keyword']);
}

$data_series = null;
$item = "Series";
$button_add = '    <a href="add_series.php">
      <button type="button" class="btn btn-secondary">Add Series</button>
    </a>';

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


$listSeries->close();

$home = new Template('templates/skin2.php');
$home->replace('DATA_ITEM', $data_series);
$home->replace('ITEM', $item);
$home->replace('ACTION_FILE', $action_file);
$home->replace('BUTTON_ADD', $button_add);
$home->write();
