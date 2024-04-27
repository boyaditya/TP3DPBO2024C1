<?php
class Movies extends DB
{
    function getMovies()
    {
        $query = "SELECT * FROM movies";
        return $this->execute($query);
    }

    function getMoviesJoinCountry()
    {
        $query = "SELECT * FROM movies JOIN country ON movies.country_id = country.country_id";
        return $this->execute($query);
    }


    public function getMoviesById($id)
    {
        $query = "SELECT movies.*, country.country_name FROM movies 
              LEFT JOIN country ON movies.country_id = country.country_id 
              WHERE movies_id = $id";
        $this->execute($query);
    }

    function upload()
    {
        $namaFile = $_FILES['movies_image']['name'];
        $error = $_FILES['movies_image']['error'];
        $tmpName = $_FILES['movies_image']['tmp_name'];

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

    function addMovies($data)
    {
        $movies_title = $data['movies_title'];
        $movies_director = $data['movies_director'];
        $movies_cast = $data['movies_cast'];
        $movies_duration = $data['movies_duration'];
        $movies_released_year = $data['movies_released_year'];
        $movies_synopsis = $data['movies_synopsis'];
        $movies_genre = implode(', ', $_POST['movies_genre']);
        $country_id = $data['country_id'];
        $movies_image = $this->upload();

        if (!$movies_image) {
            return false;
        }

        $query = "INSERT INTO movies (movies_id, movies_title, movies_director, movies_cast, movies_duration, movies_released_year, movies_synopsis, movies_genre, country_id, movies_image) VALUES ('', '$movies_title', '$movies_director', '$movies_cast', '$movies_duration', $movies_released_year, '$movies_synopsis', '$movies_genre', $country_id, '$movies_image')";

        return $this->executeAffected($query);
    }

    function updateMovies($data)
    {
        $movies_id = $data['movies_id'];
        $movies_title = $data['movies_title'];
        $movies_director = $data['movies_director'];
        $movies_cast = $data['movies_cast'];
        $movies_duration = $data['movies_duration'];
        $movies_released_year = $data['movies_released_year'];
        $movies_synopsis = $data['movies_synopsis'];
        $movies_genre = implode(', ', $_POST['movies_genre']);
        $country_id = $data['country_id'];
        $movies_image_old = $data['movies_image_old'];

        if ($_FILES['movies_image']['error'] === 4) {
            $movies_image = $movies_image_old;
        } else {
            $movies_image = $this->upload();
        }

        $query = "UPDATE movies SET movies_title='$movies_title', movies_director='$movies_director', movies_cast='$movies_cast', movies_duration='$movies_duration', movies_released_year=$movies_released_year, movies_synopsis='$movies_synopsis', movies_genre='$movies_genre', country_id=$country_id, movies_image='$movies_image' WHERE movies_id=$movies_id";

        return $this->executeAffected($query);
    }

    function deleteMovies($id)
    {
        $query = "DELETE FROM movies WHERE movies_id=$id";
        return $this->executeAffected($query);
    }

    function searchMovies($keyword)
    {
        $query = "SELECT * FROM movies WHERE movies_title LIKE '%$keyword%'";
        return $this->execute($query);
    }

    function sortMovies($direction = 'asc')
    {
        $query = "SELECT * FROM movies ORDER BY movies_released_year $direction";
        return $this->execute($query);
    }
}
