<?php

class Db {

    private $connection = null;
    private $mysql_pdo_error = true;

    public function GetConnection() {
        return $this->connection;
    }
    
    function Connect() {
        try {
            $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',);
            $this->connection = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_DATABASE_NAME . "", DB_USER_LOGIN, DB_USER_PASSWORD, $options);

            // nastavit pripojeni na UTF-8 - pro starsi verze PHP
            //$this->connection->exec("SET NAMES UTF8");
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    
    function Disconnect() {
        $this->connection = null;
    }

    // ***********************************************************
    // START UNIVERZALNI METODY

    /**
     * Nacist 1 zaznam z tabulky v DB.
     *
     * @param string $table_name - jméno tabulky
     * @param string $select_columns_string - jména sloupců oddělené čárkami, nebo jiné příkazy SQL
     * @param array $where_array - seznam podmínek<br/>
     * [] - column = sloupec; value - int nebo string nebo value_mysql = now(); symbol
     * @param string $limit_string - doplnit limit string
     */
    public function DBSelectOne($table_name, $select_columns_string, $where_array, $limit_string = "") {
        // PDO - MySQL
        // printr($where_array);
        // vznik chyby v PDO
        $mysql_pdo_error = false;

        // slozit si podminku s otaznikama
        $where_pom = "";

        if ($where_array != null)
            foreach ($where_array as $index => $item) {
                // pridat AND
                if ($where_pom != "")
                    $where_pom .= "AND ";

                $column = $item["column"];
                $symbol = $item["symbol"];

                if (key_exists("value", $item))
                    $value_pom = "?";       // budu to navazovat
                else if (key_exists("value_mysql", $item))
                    $value_pom = $item["value_mysql"];   // je to systemove, vlozit rovnou - POZOR na SQL injection, tady to muze projit


                $where_pom .= "`$column` $symbol  $value_pom ";
            }

        // doplnit slovo where
        if (trim($where_pom) != "")
            $where_pom = "where $where_pom";

        // 1) pripravit dotaz s dotaznikama
        $query = "select $select_columns_string from `" . $table_name . "` $where_pom $limit_string;";
        //echo "$query <br/>";
        // 2) pripravit si statement
        $statement = $this->connection->prepare($query);

        // 3) NAVAZAT HODNOTY k otaznikum dle poradi od 1
        $bind_param_number = 1;

        if ($where_array != null)
            foreach ($where_array as $index => $item) {
                if (key_exists("value", $item)) {
                    $value = $item["value"];
                    //echo "navazuju value: $value jako number: $bind_param_number";

                    $statement->bindValue($bind_param_number, $value);  // vzdy musim dat value, abych si nesparoval promennou (to nechci)
                    $bind_param_number ++;
                }
            }

        // 4) provest dotaz
        $statement->execute();

        // 5) kontrola chyb
        $errors = $statement->errorInfo();
        //printr($errors);

        if ($errors[0] + 0 > 0) {
            // nalezena chyba
            $mysql_pdo_error = true;
        }

        // 6) nacist data a vratit
        if ($mysql_pdo_error == false) {
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            return $row;
        } else {
            echo "Chyba v dotazu - PDOStatement::errorInfo(): ";
            printr($errors);
            echo "SQL dotaz: $query";
        }
    }

    /**
     * Nacist vsechny zaznamy z tabulky.
     * Poznamka: tato metoda je stejna jako DBSelectOne - lisi se to jen posledni casti Fetch vs FetchAll
     *
     * @param unknown_type $table_name
     * @param unknown_type $select_columns_string
     * @param unknown_type $where_array
     * @param unknown_type $limit_string
     * @param array			$order_by_array - pouze pole stringu: [0] => {[column] = "", [sort] => "DESC"}
     * @return mixed
     */
    public function DBSelectAll($table_name, $select_columns_string, $where_array, $limit_string = "", $order_by_array = array()) {
        // PDO - MySQL
        //echo "metoda DBSelectAll"; 
        //printr($this->connection);
        //exit;
        // vznik chyby v PDO
        $mysql_pdo_error = false;

        // slozit si podminku s otaznikama
        $where_pom = "";

        if ($where_array != null)
            foreach ($where_array as $index => $item) {
                // pridat AND
                if ($where_pom != "")
                    $where_pom .= "AND ";

                // pokud neexistuje klic column, tak preskocit
                if (!key_exists("column", $item)) {
                    echo "asi chyba v metode DBSelectAll - chybi klic column <br/>";
                    continue;
                }

                $column = $item["column"];     // pozor na column, mohlo by projit SQL injection
                $symbol = $item["symbol"];

                if (key_exists("value", $item))
                    $value_pom = "";       // budu to navazovat
                else if (key_exists("value_mysql", $item))
                    $value_pom = $item["value_mysql"];   // je to systemove, vlozit rovnou - POZOR na SQL injection, tady to muze projit
    
                //echo "`$column` $symbol  $value_pom ";
                $where_pom .= "$column $symbol $value_pom";
            }

        // doplnit slovo where
        if (trim($where_pom) != "")
            $where_pom = "where $where_pom";


        // pridat si order by - musim to tam dat primo, nelze to dat do prepared statements
        $order_by_pom = "";

        if ($order_by_array != null)
            foreach ($order_by_array as $index => $item) {
                $column = $item["column"];
                $sort = $item["sort"];

                // carku pred
                if (trim($order_by_pom != null))
                    $order_by_pom .= ", ";

                $order_by_pom .= "`$column` $sort";
            }

        // doplnit slovo order by
        if (trim($order_by_pom) != "")
            $order_by_pom = "order by $order_by_pom";


        // 1) pripravit dotaz s dotaznikama
        $query = "select $select_columns_string from " . $table_name . " $where_pom $order_by_pom $limit_string;";
        // echo $query;
        // 2) pripravit si statement
        $statement = $this->connection->prepare($query);

        // 3) NAVAZAT HODNOTY k otaznikum dle poradi od 1
        $bind_param_number = 1;

        if ($where_array != null)
            foreach ($where_array as $index => $item) {
                if (key_exists("value", $item)) {
                    $value = $item["value"];
                    //echo "navazuju value: $value";

                    $statement->bindValue($bind_param_number, $value);  // vzdy musim dat value, abych si nesparoval promennou (to nechci)
                    $bind_param_number ++;
                }
            }

        // 4) provest dotaz
        $statement->execute();

        // 5) kontrola chyb
        $errors = $statement->errorInfo();
        //printr($errors);

        if ($errors[0] + 0 > 0) {
            // nalezena chyba
            $mysql_pdo_error = true;
        }

        // 6) nacist data a vratit
        if ($mysql_pdo_error == false) {
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
            //echo $query;
            return $rows;
        } else {
            echo "Chyba v dotazu - PDOStatement::errorInfo(): ";
            printr($errors);
            echo "SQL dotaz: $query";
        }
    }

    /**
     * 
     * Pridat polozku do DB - zakladni verze bez mysl fci typu now().
     * @param unknown_type $table_name
     * @param array $item - musi byt ve stejne podobe jako DB.
     * 
     * */
    public function DBInsert($table_name, $item) {
        // MySql
        $mysql_pdo_error = false;

        // SLOZIT TEXT STATEMENTU s otaznikama
        $insert_columns = "";
        $insert_values = "";

        if ($item != null)
            foreach ($item as $column => $value) {
                // pridat carky
                if ($insert_columns != "")
                    $insert_columns .= ", ";
                if ($insert_columns != "")
                    $insert_values .= ", ";

                $insert_columns .= "`$column`";
                $insert_values .= "?";
            }

        // 1) pripravit dotaz s dotaznikama
        $query = "insert into `$table_name` ($insert_columns) values ($insert_values);";
        // echo "QUERY = ".$query;
        // 2) pripravit si statement
        $statement = $this->connection->prepare($query);
        if (!$statement) {
            echo "\nPDO::errorInfo():\n";
            print_r($this->connection->errorInfo());
}

        // 3) NAVAZAT HODNOTY k otaznikum dle poradi od 1
        $bind_param_number = 1;

        if ($item != null)
            foreach ($item as $column => $value) {
                $statement->bindValue($bind_param_number, $value);  // vzdy musim dat value, abych si nesparoval promennou (to nechci)
                $bind_param_number ++;
            }

        // 4) provest dotaz
        $statement->execute();

        // 5) kontrola chyb
        $errors = $statement->errorInfo();
        //printr($errors);

        if ($errors[0] + 0 > 0) {
            // nalezena chyba
            $this->mysql_pdo_error = false;
        }
        
        // 6) vratit chybu nebo OK
        if ($this->mysql_pdo_error == true) {
            return true;
        } else {
            //printr($errors);
            //echo "SQL dotaz: $query";
            return false;
        }
    }

    /**
     * Pridat polozku do DB - rozsirena verze.
     *
     * @param string $table_name
     * @param array $item - column = sloupec; value - int nebo string nebo value_mysql
     */
    public function DBInsertExpanded($table_name, $item) {
        // MySql
        // SLOZIT TEXT STATEMENTU s otaznikama
        $insert_columns = "";
        $insert_values = "";

        if ($item != null)
            foreach ($item as $row) {
                // pridat carky
                if ($insert_columns != "")
                    $insert_columns .= ", ";
                if ($insert_columns != "")
                    $insert_values .= ", ";

                $column = $row["column"];

                if (key_exists("value", $row))
                    $value_pom = "?";       // budu to navazovat
                else if (key_exists("value_mysql", $row))
                    $value_pom = $row["value_mysql"];   // je to systemove, vlozit rovnou - POZOR na SQL injection, tady to muze projit


                $insert_columns .= "`$column`";
                $insert_values .= "$value_pom";
            }

        // 1) pripravit dotaz s dotaznikama
        $query = "insert into `$table_name` ($insert_columns) values ($insert_values);";
        // echo $query;
        // 2) pripravit si statement
        $statement = $this->connection->prepare($query);

        // 3) NAVAZAT HODNOTY k otaznikum dle poradi od 1
        $bind_param_number = 1;

        if ($item != null)
            foreach ($item as $row) {
                if (key_exists("value", $row)) {
                    $value = $row["value"];
                    //echo "navazuju value: $value";

                    $statement->bindValue($bind_param_number, $value);  // vzdy musim dat value, abych si nesparoval promennou (to nechci)
                    $bind_param_number ++;
                }
            }

        // 4) provest dotaz
        $statement->execute();

        // 5) kontrola chyb
        $errors = $statement->errorInfo();
        //printr($errors);

        if ($errors[0] + 0 > 0) {
            // nalezena chyba
            $this->mysql_pdo_error = false;
        }

        // 6) vratit chybu nebo OK
        if ($this->mysql_pdo_error == true) {
            return true;
        } else {
            printr($errors);
            echo "SQL dotaz: $query";
            return false;
        }
    }
    
    public function DBUpdate($query) {
        $statement = $this->connection->prepare($query);

        $statement->execute();
        
        $errors = $statement->errorInfo();
        
        $mysql_pdo_error = false;
        if ($errors[0] + 0 > 0) {
            $mysql_pdo_error = true;
        }

        if ($mysql_pdo_error == false) {
            return $statement->rowCount();
        }
        else {
            return 0;
        }
    }

    // KONEC UNIVERZALNI METODY
    // ***********************************************************
}

?>