<?php 
    session_start();
    $a_data = $_GET['dataop'];
    if($a_data!=''){
          $connect = mysqli_connect('localhost','root','','waluty');
        $wynik = $connect->query("SELECT kod_waluty, kurs FROM kursy WHERE data = '".$a_data."'");
        $_SESSION['exits_data'] = '';
        $_SESSION['day'] = $a_data;
        foreach($wynik as $w){
            $_SESSION['exits_data'] .='<tr id="trs"><td>'.$w['kod_waluty'].'</td><td>'.$w['kurs'].'</td></tr>';
        }
        $connect->close();  
    }
    header('Location: swiat.php');

?>