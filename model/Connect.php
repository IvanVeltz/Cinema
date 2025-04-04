<?php

namespace Model;

abstract class Connect {

    const HOST = "localhost";
    const DB = "cinema_ivan";
    const USER = "root";
    const PASS = "";

    public static function seConnecter() {
        try {
            return new \PDO("mysql:host=".self::HOST.";dbname=".self::DB.";charset=utf8", self::USER, self::PASS);
        } catch(\PDOExeception $ex) {
            return $ex->getMessage();
        }
    }
}

// PDO : PHP Data Objects

// Couche d'abstraction de données : 
// Permet de séparer les données brutes du front end, ici on ne gère que la connexion à la bdd.
// Cela permet d'interroger plus facilement les données peu importe où elle sont stockées.