<?php
/**
 * Created by PhpStorm.
 * User: Kortez
 * Date: 2018-03-25
 * Time: 22:15
 */

namespace app\constructor;


/**
 * Class dbConstructor
 * @package app\model
 * Używany jako narzędzie pomocne w tworzeniu obiektu "page"
 * zawiera metody odpytujące baze danych
 */
class dbConstructor extends Constructor
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

    public function getActionName(string $id)
    {
        $query= "SELECT actionName FROM strony where id=$id";
        if($wynik= $this->db->query($query)){
            if($wynik->rowCount() !==1){
                return FALSE;
            }
            $w= $wynik->fetch(\PDO::FETCH_ASSOC);
            return $w['actionName'];
        }
        else{
           // die("Execute query error, because: ". print_r($this->db->errorInfo(),FALSE) );
            return FALSE;
        }
    }


    public function setActionName()
    {

    }

    public function getActionTitle(string $actionName){
        $query= "select title from strony where actionName='$actionName'";
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

    public function insertTestDataBase(){

        $wynik= $this->db->query('select count(*) from strony');
        if($wynik->fetch(\PDO::FETCH_NUM )[0] > 1){
            return TRUE;
        }
       $sql= $this->db->prepare('insert into strony set actionName= ?, title= ?, main= ?, CSS= ?, js= ?');
        for($i=1; $i<11; $i++) {
            if ($i < 10) {
                $action = "action0$i";
            } else {
            $action = "action$i";
            }
            $main = serialize("<h3>$action</h3><p>Treść strony $action</p><p>dalsza treść</p>");
            $sql->execute(array($action, "title $action", $main, "css/$action", "js/$action"));
        }
        return TRUE;
    }

    public function deleteTestDataBase(){
        $this->db->exec("DELETE FROM strony WHERE id NOT IN (26)");
    }
}