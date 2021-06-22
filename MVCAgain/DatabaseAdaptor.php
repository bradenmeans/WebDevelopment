<?php
// Name: Braden Means

class DatabaseAdaptor {
    private $DB;
    
    public function __construct() {
        $dataBase = 'mysql:dbname=imdb_small;charset=utf8;host=127.0.0.1';
        $user = 'root';
        $password = '';
        try {
            $this->DB = new PDO($dataBase, $user,$password);
            $this->DB->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo ('Error establishing connection');
            exit();
        }
    }
    
    public function getMoviesReleasedSince() {
        $stmt = $this->DB->prepare("SELECT * FROM movies where year >= 2004");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getAllMovies($str) {
        $stmt = $this->DB->prepare("SELECT * FROM movies WHERE movies.name LIKE '%".$str."%'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getAllActors($str) {
        $stmt = $this->DB->prepare("SELECT * FROM actors WHERE actors.first_name LIKE '%".$str."%' OR actors.last_name LIKE '%".$str."%'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getAllRoles($str) {
        $stmt = $this->DB->prepare("SELECT * FROM roles WHERE roles.role LIKE '%".$str."%'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getRoles($first, $last) {
        $stmt = $this->DB->prepare("SELECT roles.role, movies.name FROM actors" .
            " JOIN roles" .
            " ON actors.id = roles.actor_id" .
            " JOIN movies" .
            " ON roles.movie_id = movies.id".
            " WHERE '". $first. "' = actors.first_name".
            " AND '". $last."'= actors.last_name");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }
    
}



?>