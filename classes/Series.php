<?php
class Series extends DB
{
    function getSeries()
    {
        $query = "SELECT * FROM series";
        return $this->execute($query);
    }

    function getSeriesById($id)
    {
        $query = "SELECT * FROM series WHERE series_id=$id";
        return $this->execute($query);
    }

    function upload()
    {
        $namaFile = $_FILES['series_image']['name'];
        $ukuranFile = $_FILES['series_image']['size'];
        $error = $_FILES['series_image']['error'];
        $tmpName = $_FILES['series_image']['tmp_name'];

        // cek apakah tidak ada gambar yang diupload
        if ($error === 4) {
            echo " <script>
            alert('Please upload an image!');
        </script>
        ";
            return false;
        }

        // cek apakah yang diupload adalah gambar
        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));

        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            echo " <script>
            alert('The file you uploaded is not an image!');
        </script>
        ";

            return false;
        }

        // lolos pengecekan, gambar siap diupload
        // generate nama gambar baru
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;

        move_uploaded_file($tmpName, 'assets/images/' . $namaFileBaru);

        return $namaFileBaru;
    }

    function addSeries($data)
    {
        $series_title = $data['series_title'];
        $series_creator = $data['series_creator'];
        $series_cast = $data['series_cast'];
        $series_seasons = $data['series_seasons'];
        $series_episodes = $data['series_episodes'];
        $series_average_duration = $data['series_average_duration'];
        $series_first_air_date = DateTime::createFromFormat('Y-m-d', $data['series_first_air_date']);
        $series_last_air_date = DateTime::createFromFormat('Y-m-d', $data['series_last_air_date']);
        $series_synopsis = $data['series_synopsis'];
        $series_network = $data['series_network'];
        $series_genre = implode(', ', $_POST['series_genre']);
        $series_image = $this->upload();
        $country_id = $data['country_id'];

        $series_first_air_date = $series_first_air_date->format('Y-m-d');
        $series_last_air_date = $series_last_air_date->format('Y-m-d');

        if (!$series_image) {
            return false;
        }

        $query = "INSERT INTO series VALUES ('', '$series_title', '$series_creator', '$series_cast', $series_seasons, $series_episodes, $series_average_duration, '$series_first_air_date', '$series_last_air_date', '$series_synopsis', '$series_network', '$series_genre', '$series_image', $country_id)";

        return $this->executeAffected($query);
    }

    function updateSeries($data, $id)
    {
        $series_title = $data['series_title'];
        $series_creator = $data['series_creator'];
        $series_cast = $data['series_cast'];
        $series_seasons = $data['series_seasons'];
        $series_episodes = $data['series_episodes'];
        $series_average_duration = $data['series_average_duration'];
        $series_first_air_date = DateTime::createFromFormat('Y-m-d', $data['series_first_air_date']);
        $series_last_air_date = DateTime::createFromFormat('Y-m-d', $data['series_last_air_date']);
        $series_synopsis = $data['series_synopsis'];
        $series_network = $data['series_network'];
        $series_genre = implode(', ', $_POST['series_genre']);
        $series_image_old = $data['series_image_old'];
        $country_id = $data['country_id'];

        $series_first_air_date = $series_first_air_date->format('Y-m-d');
        $series_last_air_date = $series_last_air_date->format('Y-m-d');

        if ($_FILES['series_image']['error'] === 4) {
            $series_image = $series_image_old;
        } else {
            $series_image = $this->upload();
        }

        $query = "UPDATE series SET series_title='$series_title', series_creator='$series_creator', series_cast='$series_cast', series_seasons=$series_seasons, series_episodes=$series_episodes, series_average_duration=$series_average_duration, series_first_air_date='$series_first_air_date', series_last_air_date='$series_last_air_date', series_synopsis='$series_synopsis', series_network='$series_network', series_genre='$series_genre', series_image='$series_image', country_id=$country_id WHERE series_id=$id";

        return $this->executeAffected($query);
    }


    function deleteSeries($id)
    {
        $query = "DELETE FROM series WHERE series_id=$id";
        return $this->executeAffected($query);
    }

    function searchSeries($keyword)
    {
        $query = "SELECT * FROM series WHERE series_title LIKE '%$keyword%'";
        return $this->execute($query);
    }

    function sortSeries($direction = 'ASC')
    {
        $query = "SELECT * FROM series ORDER BY series_first_air_date $direction";
        return $this->execute($query);
    }
}
