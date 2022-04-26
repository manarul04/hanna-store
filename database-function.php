<?php

function Insert($table, $data){
    global $conn;
    //print_r($data);
    $fields = array_keys( $data );  
    $values = array_map( array($conn, 'real_escape_string'), array_values( $data ) );
    
    return mysqli_query($conn, "INSERT INTO $table(".implode(",",$fields).") VALUES ('".implode("','", $values )."');") or die( mysqli_error($conn) );
}

function Cek($table,$id){
    global $conn;
    // mengambil data barang dengan kode paling besar
    $query = mysqli_query($conn, "SELECT max($id) as kodeTerbesar FROM $table");
    $data = mysqli_fetch_array($query);
    $kode = $data['kodeTerbesar'];

    // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
    // dan diubah ke integer dengan (int)
    // $urutan = (int) substr($kode, 3, 3);

    // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
    $kode++;

    
    return $kode;
}

function Update($table_name, $form_data, $where_clause=''){   
    global $conn;
    // check for optional where clause
    $whereSQL = '';
    if(!empty($where_clause)){
        // check to see if the 'where' keyword exists
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE'){ //substring
                // not found, add key word
                $whereSQL = " WHERE ".$where_clause;
        } else{
            $whereSQL = " ".trim($where_clause); //trim where clause
        }
    }
    // start the actual SQL statement
    $sql = "UPDATE ".$table_name." SET ";
    
    // loop and build the column /
    $sets = array();
    foreach($form_data as $column => $value){
         $sets[] = "`".$column."` = '".$value."'";
    }
    $sql .= implode(', ', $sets);
    
    // append the where statement
    $sql .= $whereSQL;
             
    // run and return the query result
    return mysqli_query($conn,$sql);
}
function Delete($table_name, $where_clause=''){   
    global $conn;
    // check for optional where clause
    $whereSQL = '';
    if(!empty($where_clause)){
        // check to see if the 'where' keyword exists
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE'){
            // not found, add keyword
            $whereSQL = " WHERE ".$where_clause;
        }else{
            $whereSQL = " ".trim($where_clause);
        }
    }
    // build the query
    $sql = "DELETE FROM ".$table_name.$whereSQL;
         
    // run and return the query result resource
    return mysqli_query($conn,$sql);
}  
function Tanggal($tanggal){
    $tgl= substr($tanggal,10,1);
    if($tgl=="T"){
            $t = explode("T", $tanggal);
            echo $t[0]." ".$t[1]; //10
        }else{
            $t = explode(" ", $tanggal);
            echo $t[0]."T".$t[1];
        }
    }

function isset_file($name) {
    return (isset($_FILES[$name]) && $_FILES[$name]['error'] != UPLOAD_ERR_NO_FILE);
}


?>