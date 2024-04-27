<?php
class Country extends DB
{
    function getCountry()
    {
        $query = "SELECT * FROM country";
        return $this->execute($query);
    }

    function getCountryById($id)
    {
        $query = "SELECT * FROM country WHERE country_id=$id";
        return $this->execute($query);
    }

    function addCountry($data)
    {
        $query = "INSERT INTO country VALUES ('', '$data[country_name]')";
        return $this->executeAffected($query);
    }

    function updateCountry($id, $data)
    {
        $query = "UPDATE country SET country_name='$data[country_name]' WHERE country_id=$id";
        return $this->executeAffected($query);
    }

    function deleteCountry($id)
    {
        $query = "DELETE FROM country WHERE country_id=$id";
        return $this->executeAffected($query);
    }
}
