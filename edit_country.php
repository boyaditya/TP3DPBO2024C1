<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Country.php');
include('classes/Template.php');

$country = new Country($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$country->open();

// Fetch the current country data
$country_id = $_GET['id']; // Get the country id from the URL
$country->getCountryById($country_id);
$current_country = $country->getResult();


if (isset($_POST['submit'])) {
    if ($country->updateCountry($country_id, $_POST) > 0) {
        echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'country.php';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'country.php';
            </script>";
    }
}


$form = '<form action="" method="post">
      <div class="col-md-6">
        <h3 class="mb-4">Edit Country</h3>
        <input type="hidden" name="country_id" value="' . $current_country['country_id'] . '">
        <div class="form-group">
          <label for="name">Name Country</label>
          <input type="text" class="form-control" name="country_name" value="' . $current_country['country_name'] . '" id="name">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>';



$country->close();

$home = new Template('templates/skin_form.php');
$home->replace('FORM_DATA', $form);
$home->write();
