<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/cfg/config-dev.php';

/**
 * @deprecated Mieux vaut utiliser libDb::connect()
 * Retourne une connexion à la base de données.
 * 
 * @param $params Paramètres de connexion (host, port, ...)
 * 
 * @return PDO Connexion à la base.
 */
function OpenCon(): PDO
{

    $dataSourceName = 'mysql:host=' . ConfigDB::HOST . ';port=' . ConfigDB::PORT . ';dbname=' .  ConfigDB::DBNAME;
    $dbConnection = new PDO($dataSourceName,  ConfigDB::USER,  ConfigDB::PASSWORD);
    //
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $dbConnection;
}
/**Bibliothèque de fonctions dédiées à la base de données */
class libDb
{
    /**Fournit une connexio à la base de données
     * 
     * 
     * @return PDO
     */
    static function connect(): PDO
    {
        $dataSourceName = 'mysql:host=' . ConfigDB::HOST . ';port=' . ConfigDB::PORT . ';dbname=' .  ConfigDB::DBNAME;
        $dbConnection = new PDO($dataSourceName,  ConfigDB::USER,  ConfigDB::PASSWORD);
        //
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $dbConnection;
    }
}
