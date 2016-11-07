<?php

class dbModel{
    
        
            public function __construct()  
            {  

            } 
            
            //zapis do bazy
            public function savetoDB($link, $kierunek)
            {
                $data = date('Y-m-d H:i:s');//data do zapisu w bazie
                
                $mysqli = new mysqli('localhost', 'root', '', 'zad2');
                
                if (!$mysqli) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                
//                $last = "SELECT data FROM przecena ORDER BY id DESC LIMIT 1";
//                $last_date = $mysqli->query($last);
//                
//                if ($last_date->num_rows > 0) {
//                    // output data of each row
//                    while($row = $last_date->fetch_assoc()) {
//                        $ostatnia_data = $row["data"];
//                    }
//                } else {
//                    echo "0 results";
//                }
                
                //jeżeli minął dzień to zapisz do bazy danych
                //if (((strtotime($data) - strtotime($ostatnia_data)) / (60*60*24)) > 0.9)
                //{
                    $query = "INSERT INTO `przecena`(`link`,`kierunek`, `data`) VALUES ('".$link."', '".$kierunek."', '".$data."')";
                
                    $mysqli->query($query);
                //}
                
                $mysqli->close();
            }
        	
	
}

?>