<?php

namespace app\controllers;

use app\models\Queries;

class SongController {

    private $table = 'songs';

    public function index() {

        $queryBuilder = new Queries;
        $selectFields = $queryBuilder->select($this->table, 

            [
                "songs.name" => "Name",
                "songs.release_date" =>  "Realese", 
                "songs.musical_genre" => "Musical Genre",
                "vocalists.name" =>  "Vocalist Name", 
                "albums.name" => "Album Name",
                "bands.name" => "Band Name"
            ], 
            
        );

        $oneJoin = $queryBuilder->join(
            "songs.vocalist_id = vocalists.id", "vocalists"
        );

        $secondJoin = $queryBuilder->join(
            "songs.album_id = albums.id","albums"
        );

        $thirtJoin = $queryBuilder->join(
            "songs.band_id = bands.id", "bands", "left"
        );
        
        $query = $selectFields." ".$oneJoin." ".$secondJoin." ".$thirtJoin;

        echo json_encode($queryBuilder->get($query));
        die;
    }

    public function show($args) {
        
        $queryBuilder = new Queries;
        $selectFields = $queryBuilder->select($this->table, 

            [
                "songs.name" => "Name",
                "songs.release_date" =>  "Realese", 
                "songs.musical_genre" => "Musical Genre",
                "vocalists.name" =>  "Vocalist Name", 
                "albums.name" => "Album Name",
                "bands.name" => "Band Name"
            ], 
            
        );

        $oneJoin = $queryBuilder->join(
            "songs.vocalist_id = vocalists.id", "vocalists"
        );

        $secondJoin = $queryBuilder->join(
            "songs.album_id = albums.id","albums"
        );

        $thirtJoin = $queryBuilder->join(
            "songs.band_id = bands.id", "bands", "left"
        );

        $where = $queryBuilder->where($this->table, 'id', '=', $args[0]);
        
        $query = $selectFields." ".$oneJoin." ".$secondJoin." ".$thirtJoin." ".$where;

       if($queryBuilder->get($query)) {
            echo json_encode($queryBuilder->get($query));
            die;
       } else {
            echo json_encode([
                "Message" => "data not found",
                "Error" => 404,
            ]);
            die;
       }
       
    }

}