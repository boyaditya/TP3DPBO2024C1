

<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Series.php');
include('classes/Template.php');
include('classes/Country.php');
include('classes/Genre.php');

$series = new Series($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$country = new Country($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$genre = new Genre($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$series->open();
$country->open();
$country->getCountry();

$genre->open();
$genre->getGenre();

$data_country = null;

while ($row = $country->getResult()) {
  $data_country .= '<option value="' . $row['country_id'] . '">' . $row['country_name'] . '</option>';
}

$data_genre = null;

while ($row = $genre->getResult()) {
  $data_genre .= '<div class="form-check">
                  <input class="form-check-input" type="checkbox" name="series_genre[]" id="genre' . $row['genre_id'] . '" value="' . $row['genre_name'] . '">
                    <label class="form-check-label" for="genre' . $row['genre_id'] . '">
                      ' . $row['genre_name'] . '
                    </label>
                  </div>';
}


// jika tombol submit ditekan
if (isset($_POST['submit'])) {
  // jika data series berhasil ditambah
  if ($series->addSeries($_POST) > 0) {
    echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'add_series.php';
            </script>";
  } else {
    echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'add_series.php';
            </script>";
  }
}

$form = '<form action="add_series.php" method="post" enctype="multipart/form-data">
      <div class="col-md-6">
        <h3 class="mb-4">Add Series</h3>
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" name="series_title" id="title">
        </div>
        <div class="form-group">
          <label for="creator">Creator</label>
          <input type="text" class="form-control" name="series_creator" id="creator">
        </div>
        <div class="form-group">
          <label for="cast">Cast</label>
          <input type="text" class="form-control" name="series_cast" id="cast">
        </div>
        <div class="form-group">
          <label for="genre">Genre</label>
                   DATA_GENRE
        </div>
        <div class="form-group">
          <label for="tv_networks">TV Networks</label>
          <input type="text" class="form-control" name="series_network" id="tv_networks">
        </div>
        <div class="form-group">
          <label for="first air date">First Air Date</label>
          <input type="date" class="form-control" name="series_first_air_date" id="first air date" required>
        </div>
        <div class="form-group">
          <label for="last air date">Last Air Date</label>
          <input type="date" class="form-control" name="series_last_air_date" id="last air date" required>
        </div>
        <div class="form-group">
          <label for="duration">Average Duration (minutes)</label>
          <input type="number" class="form-control" name="series_average_duration" id="duration">
        </div>
        <div class="form-group">
          <label for="seasons">Seasons</label>
          <input type="number" class="form-control" name="series_seasons" id="seasons">
        </div>
        <div class="form-group">
          <label for="episodes">Episodes</label>
          <input type="number" class="form-control" name="series_episodes" id="episodes">
        </div>

        <div class="form-group">
          <label for="country">Country</label>
          <select class="form-control" name="country_id" id="country">

            DATA_COUNTRY

          </select>
        </div>
        <div class="form-group">
          <label for="synopsis">Synopsis</label>
          <textarea class="form-control" name="series_synopsis" id="synopsis" rows="3"></textarea>
        </div>
        <div class="form-group">
          <label for="image">Image</label>
          <input type="file" class="form-control-file" name="series_image" id="image">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>';



$series->close();
$country->close();
$genre->close();

$home = new Template('templates/skin_form.php');
$home->replace('FORM_DATA', $form);
$home->replace('DATA_GENRE', $data_genre);
$home->replace('DATA_COUNTRY', $data_country);
$home->write();
