<?php
define("DB_NAME", "blood_donation");
define("DB_PASSWORD", "");
define("USER_NAME", "root");
define("HOST_NAME", "localhost");

class Database
{
    private $conn, $qry_frame, $is_insert;

    function __construct()
    {
        $this->is_insert = false;
        $this->conn = mysqli_connect(HOST_NAME, USER_NAME, DB_PASSWORD, DB_NAME);
    }

    public function escapeString(String $str): string
    {
        return mysqli_real_escape_string($this->conn, $str);
    }

    public function select($table_name, $selection, $join, $condition, $temp2, $limit)
    {
        $qry = "SELECT $selection FROM $table_name";

        if ($join) {
            $qry .= " INNER JOIN $join ";
        }

        if ($condition != '') {
            $qry .= " WHERE $condition ";
        }

        if ($limit) {
            $qry .= " LIMIT $limit ";
        }

        $this->qry_frame = $qry;
    }

    public function getResult()
    {
        // echo $this->qry_frame;
        $res = mysqli_query($this->conn, $this->qry_frame);
        if (!$res) {
            die(mysqli_error($this->conn));
            $ptr = fopen("error.txt", "a+");
            fwrite($ptr, "\n\n\n[" . date("Y-m-d H:i:s") . "]    QRY:  " . $this->qry_frame . " \n Error: " . mysqli_error($this->conn));
            return;
        }


        if (!$this->is_insert) {
            $data = mysqli_fetch_all($res, MYSQLI_ASSOC);
            return $data;
        } else {
            $this->is_insert = false;
            return $res;
        }
    }

    public function insert(String $table_name, array $params)
    {
        $qry = "INSERT INTO $table_name ( ";
        $cols = array();
        $values = array();
        foreach ($params as $col => $value) {
            $cols[] = " `$col` ";
            $values[] = " '" . $this->escapeString($value) . "' ";
        }

        $cols = implode(",", $cols);
        $values = implode(",", $values);

        $qry .= $cols . " ) VALUES ( " . $values . " ) ";

        $this->qry_frame = $qry;
        $this->is_insert = true;
    }

    public function pagination(String $table, $temp1, String $condition, String $limit, String $link, Int $offset = 0)
    {
        $this->qry_frame = "SELECT * FROM $table WHERE $condition LIMIT $limit OFFSET $offset";
        $data = $this->getResult();
?>
        <a href="" class="next-page-link <?php echo ($offset == 0) ? "disabled-link" : ""; ?>"><i style="font-size: 0.8rem;" class="fa-solid fa-chevron-left"></i> Prev</a>
        <?php
        $page = 1;
        foreach ($data as $row) {
        ?>
            <a href="<?php echo $link . $page % 10; ?>" class="next-page-link active-link"><?php echo $page ?></a>
        <?php
        }

        ?>
            <a href="" class="next-page-link <?php echo ($page >= count($data)) ? "disabled-link" : ""; ?>">Next <i style="font-size: 0.8rem;" class="fa-solid fa-chevron-right"></i></a>
<?php
        
    }


    public function sql($qry) {
        $this->qry_frame = $qry;
    }


    public function update($table, $params, $condition) {
        $this->is_insert = true;
        $this->qry_frame = "UPDATE $table SET " ;

        $qry_update = "";
        foreach ($params as $col => $val) {
            if ($col == 'id') {
                continue;
            }

            if ($qry_update == '') {
                $qry_update = " $col = '$val' ";
            } else {
                $qry_update .= ", $col = '$val' ";
            }
        }

        $this->qry_frame .= $qry_update . " WHERE " . $condition ;
    }

    public function delete($table, $condition) {
        $this->qry_frame = "DELETE FROM $table WHERE $condition";
        $this->is_insert = true;
    }
}


?>