<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Country.php');
include('classes/Template.php');

$country = new Country($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$country->open();


// jika tombol submit ditekan
if (isset($_POST['submit'])) {
    // jika data country berhasil ditambah
    if ($country->addCountry($_POST) > 0) {
        echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'country.php';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'country.php';
            </script>";
    }
}

$form = '<form action="" method="post">
      <div class="col-md-6">
        <h3 class="mb-4">Add Country</h3>
        <div class="form-group">
          <label for="name">Name Country</label>
          <input type="text" class="form-control" name="country_name" id="name">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>';



$country->close();

$home = new Template('templates/skin_form.php');
$home->replace('FORM_DATA', $form);
$home->write();
