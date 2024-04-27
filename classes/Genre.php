<?php
class Genre extends DB
{
    function getGenre()
    {
        $query = "SELECT * FROM genre";
        return $this->execute($query);
    }

    function getGenreById($id)
    {
        $query = "SELECT * FROM genre WHERE genre_id=$id";
        return $this->execute($query);
    }

    function addGenre($data)
    {
        $query = "INSERT INTO genre VALUES ('', '$data[genre_name]')";
        return $this->executeAffected($query);
    }

    function updateGenre($id, $data)
    {
        $query = "UPDATE genre SET genre_name='$data[genre_name]' WHERE genre_id=$id";
        return $this->executeAffected($query);
    }

    function deleteGenre($id)
    {
        $query = "DELETE FROM genre WHERE genre_id=$id";
        return $this->executeAffected($query);
    }
}
?>