<?php
    session_start();
    $waluta = $_GET['GBP1'];
    if ($waluta>0){
        $connect = mysqli_connect('localhost','root','','waluty');
        $date = $connect->query("SELECT data FROM kursy GROUP BY data ORDER BY data DESC LIMIT 1");
        foreach($date as $d){
        $date = $d['data'];
        }
        $wynik = $connect->query("SELECT kod_waluty,kurs FROM kursy WHERE kod_waluty='GBP' AND data = '".$date."'");
        foreach($wynik as $w){
        $kurs = $w['kurs'];
        }
    $connect->close();

    $wartosc = round($waluta*$kurs,2);
    $_SESSION['gbp'] = $waluta;
    $_SESSION['gbp_pln'] = $wartosc;
    echo $wartosc1;
    }
    $polska = $_GET['PLN1'];
    if ($polska>0){
        $connect = mysqli_connect('localhost','root','','waluty');
        $date = $connect->query("SELECT data FROM kursy GROUP BY data ORDER BY data DESC LIMIT 1");
        foreach($date as $d){
        $date = $d['data'];
        }
        $wynik = $connect->query("SELECT kod_waluty,kurs FROM kursy WHERE kod_waluty='GBP' AND data = '".$date."'");
        foreach($wynik as $w){
        $kurs = $w['kurs'];
        }
    $connect->close();

    $wartosc1 = round($polska/$kurs,2);
    $_SESSION['pln'] = $polska;
    $_SESSION['pln_gbp'] = $wartosc1;
    echo $wartosc1;
    }

    header('Location: anglia1.php');
?>