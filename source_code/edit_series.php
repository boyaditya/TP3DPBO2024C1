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

// Get the series data
$series_id = $_GET['id']; // The series ID should be passed as a GET parameter
$series->getSeriesById($series_id);
$current_series = $series->getResult();

$data_country = null;

$current_country_id = $current_series['country_id']; // Get the current series country_id

while ($row = $country->getResult()) {
    $selected = ($row['country_id'] == $current_country_id) ? 'selected' : '';
    $data_country .= '<option value="' . $row['country_id'] . '" ' . $selected . '>' . $row['country_name'] . '</option>';
}

$current_genres = explode(', ', $current_series['series_genre']);

$data_genre = null;

while ($row = $genre->getResult()) {
    $checked = in_array($row['genre_name'], $current_genres) ? 'checked' : '';
    $data_genre .= '<div class="form-check">
                  <input class="form-check-input" type="checkbox" name="series_genre[]" id="genre' . $row['genre_id'] . '" value="' . $row['genre_name'] . '" ' . $checked . '>
                    <label class="form-check-label" for="genre' . $row['genre_id'] . '">
                      ' . $row['genre_name'] . '
                    </label>
                  </div>';
}

// If the submit button is pressed
if (isset($_POST['submit'])) {
    // If the series data is successfully updated
    if ($series->updateSeries($_POST, $series_id) > 0) {
        echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'edit_series.php?id=$series_id';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'edit_series.php?id=$series_id';
            </script>";
    }
}

$form = '<form action="edit_series.php?id=' . $current_series['series_id'] . '" method="post" enctype="multipart/form-data">
            <div class="col-md-6">
                <input type="hidden" name="series_id" value="' . $current_series['series_id'] . '">
                <input type="hidden" name="series_image_old" value="' . $current_series['series_image'] . '">
                <h3 class="mb-4">Edit Series</h3>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="series_title" id="title" value="' . $current_series['series_title'] . '">
                </div>
                <div class="form-group">
                    <label for="creator">Creator</label>
                    <input type="text" class="form-control" name="series_creator" id="creator" value="' . $current_series['series_creator'] . '">
                </div>
                <div class="form-group">
                    <label for="cast">Cast</label>
                    <input type="text" class="form-control" name="series_cast" id="cast" value="' . $current_series['series_cast'] . '">
                </div>
                <div class="form-group">
                    <label for="genre">Genre</label>
                    DATA_GENRE
                </div>
                <div class="form-group">
                    <label for="tv_networks">TV Networks</label>
                    <input type="text" class="form-control" name="series_network" id="tv_networks" value="' . $current_series['series_network'] . '">
                </div>
                <div class="form-group">
                    <label for="first air date">First Air Date</label>
                    <input type="date" class="form-control" name="series_first_air_date" id="first air date" value="' . $current_series['series_first_air_date'] . '">
                </div>
                <div class="form-group">
                    <label for="last air date">Last Air Date</label>
                    <input type="date" class="form-control" name="series_last_air_date" id="last air date" value="' . $current_series['series_last_air_date'] . '">
                </div>
                <div class="form-group">
                    <label for="duration">Average Duration (minutes)</label>
                    <input type="number" class="form-control" name="series_average_duration" id="duration" value="' . $current_series['series_average_duration'] . '">
                </div>
                <div class="form-group">
                    <label for="seasons">Seasons</label>
                    <input type="number" class="form-control" name="series_seasons" id="seasons" value="' . $current_series['series_seasons'] . '">
                </div>
                <div class="form-group">
                    <label for="episodes">Episodes</label>
                    <input type="number" class="form-control" name="series_episodes" id="episodes" value="' . $current_series['series_episodes'] . '">
                </div>
                <div class="form-group">
                    <label for="country">Country</label>
                    <select class="form-control" name="country_id" id="country">

                        DATA_COUNTRY

                    </select>
                </div>
                <div class="form-group">
                    <label for="synopsis">Synopsis</label>
                    <textarea class="form-control" name="series_synopsis" id="synopsis" rows="3">' . $current_series['series_synopsis'] . '</textarea>
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
$home->replace('DATA_COUNTRY', $data_country);
$home->replace('DATA_GENRE', $data_genre);
$home->write();
