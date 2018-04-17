<?php
/**
 * Created by PhpStorm.
 * User: Kortez
 * Date: 2018-03-25
 * Time: 22:15
 */

namespace app\model;

/**
 * Class DB
 * @package app\model
 * zawiera metody odpytujące baze danych
 */
class DB
{
    protected $db;

    public function __construct()
    {
        $param = $this->getDbParameter('mysql');

        try {
            $this->db = new \PDO($param['dsn'], $param['user'], $param['password']);
            return $this->db;
        } catch (\PDOException $e) {
            //echo $e->getMessage();
            return FALSE;
        }
    }

    public function getActionName(string $actionNumber)
    {
        $query= "SELECT name FROM akcje where action='$actionNumber'";
        if($wynik= $this->db->query($query)){
            if($wynik->rowCount() !==1){
                return FALSE;
            }
            $w= $wynik->fetch(\PDO::FETCH_ASSOC);
            return $w['name'];
        }
        else{
           // die("Execute query error, because: ". print_r($this->db->errorInfo(),FALSE) );
            return FALSE;
        }
    }

    public function getActionNumber(string $actionName)
    {
        $query= "select action from akcje where name='$actionName'";
        if($wynik= $this->db->query($query)){
            if($wynik->rowCount() !==1){
                return FALSE;
            }
            $w= $wynik->fetch(\PDO::FETCH_ASSOC);
            return $w['action'];
        }else {
            //die("Execute query error, because: " . print_r($this->db->errorInfo(), FALSE));
            return FALSE;
        }
    }

    public function setActionName(string $actionNumber, string $newActionName)
    {
        if($actionNumber == 'kontakt'){
            return FALSE;
        }
        if($actionName= $this->getActionName($actionNumber)){
            if($actionName == $newActionName){
                return TRUE;
            }
        }
        $query= "update akcje set name= :newActionName where action= :actionNumber";
        $sql= $this->db->prepare($query);
        $sql->bindParam(':newActionName', $newActionName, \PDO::PARAM_STR);
        $sql->bindParam(':actionNumber', $actionNumber, \PDO::PARAM_STR);
        if(!$sql->execute()){
            return FALSE;
        }
        if($sql->rowCount() !==1){
            return FALSE;
        }
        return TRUE;
    }

    public function getActionTitle(string $actionNumber){
        $query= "select title from strony where action='$actionNumber'";
        if($wynik= $this->db->query($query)){
            echo 'rowCount '.$wynik->rowCount();
            if($wynik->rowCount() !== 1){
                return FALSE;
            }
            return $wynik->fetch(\PDO::FETCH_ASSOC)['title'];
        }else{
            return FALSE;
        }
    }

    public function setActionTitle(){}

    public function getActionMain(){}

    public function setActionMain(){}

    public function getActionCSS(){}

    public function setActionCSS(){}


    public function get_db()
    {
        return $this->db;
    }

    /**
     * @param string $dataBaseType
     * @return array
     * Pobiera parametry z yaml potrzebne do połączenia z wybranym typem bazy danych
     */
    protected function getDbParameter(string $dataBaseType)
    {
        $dataBaseType = strtolower($dataBaseType);
        $config = yaml_parse_file(__DIR__ . '/../config/ConfigDB.yaml');
        foreach ($config as $key => $value) {
            if ($key == $dataBaseType) {
                $dsn = $dataBaseType . ':';
                if (isset($config[$dataBaseType]['host'])) {
                    $dsn .= ';host=' . $config[$dataBaseType]['host'];
                }
                if (isset($config[$dataBaseType]['port'])) {
                    $dsn .= ';port=' . $config[$dataBaseType]['port'];
                }
                if (isset($config[$dataBaseType]['dbname'])) {
                    $dsn .= ';dbname=' . $config[$dataBaseType]['dbname'];
                }
                return array('dsn' => $dsn, 'user' => $config[$dataBaseType]['user'], 'password' => $config[$dataBaseType]['password']);
            }
        }
        return false;
    }

    public function insertTestSite(){
        $wynik= $this->db->query('select count(*) from strony');
        if($wynik->fetch(\PDO::FETCH_NUM )[0] > 0){
            return TRUE;
        }
        $wynik= $this->db->query('select action from akcje');
       $sql= $this->db->prepare('insert into strony set action= ?, title= ?, main= ?, CSS= ?');
        while($row= $wynik->fetch(\PDO::FETCH_ASSOC)) {
            $action= $row['action'];
            $main = serialize("<h3>$action</h3><p>Treść strony $action</p><p>dalsza treść</p>");
            $sql->execute(array($action, "title $action", $main, "css/$action"));
        }
        return TRUE;
    }

    public function deleteTestSite(){
        $this->db->exec('delete * from strony');
    }
}