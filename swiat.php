<?php
    session_start();
    $connect = mysqli_connect('localhost','root','','waluty');
    $command = escapeshellcmd('python main.py');
    $message = shell_exec($command);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styl_v2.css">
    <title>Waluty świata</title>
    <script src="zamianki.js"></script>
</head>
<body>
    <div class="baner">
        <div class="nazwa"><h2>Waluty świata</h2></div>
        <div class="baner_pole"><a id="banp" href="usa.php">dolar</a></div>
        <div class="baner_pole"><a id="banp" href="anglia1.php">funt</a></div>
        <div class="baner_pole"><a id="banp" href="europa.php">euro</a></div>
        <div class="kreska"><hr></div>
    </div>
    <div class="main">
        <div class="element">
            <div class="element_nazwa">Kalkulator</br>(na postawie aktualnych kursów)</div>
            <div class="element_obiekt2">
            <form id="formularz" action="" method="">
            <table id="tabela_kal">
                <tr><td></td><td>Przeliczanie różnych walut na PLN</td></tr>
                <tr>
                <td><select id="zag1">
                    <?php
                       $date = $connect->query("SELECT data FROM kursy GROUP BY data ORDER By data desc LIMIT 1");
                        foreach($date as $d){
                        $date = $d['data'];
                       }
                        $wynik = $connect->query("SELECT kod_waluty,kurs FROM kursy WHERE data = '".$date."'");
                        foreach($wynik as $w){
                        $kurs = $w['kurs'];
                        echo '<option value="'.$w['kurs'].'">'.$w['kod_waluty'].'</option>';
                       }
                    ?></select>
                </td>
                <td>
                    <input type="number" id="pln1" min="0" value="0">
                </td></tr>
                <tr><td>PLN</td><td>
                    <input type="number" value="0"  min="0" id="wyn1" disabled>
                </td></tr>
            </table><br>
            <table id="tabela_kal">
                <tr><td></td><td>Przeliczanie PLN na różne waluty</td></tr>
                <tr><td>PLN</td><td>
                <input type="number" id="pln2" min="0" value="0">
                </td></tr>
                <tr><td>
                <select id="zag2">
                    <?php
                       $date = $connect->query("SELECT data FROM kursy GROUP BY data");
                        foreach($date as $d){
                        $date = $d['data'];
                       }
                        $wynik = $connect->query("SELECT kod_waluty,kurs FROM kursy WHERE data = '".$date."'");
                        foreach($wynik as $w){
                        $kurs = $w['kurs'];
                        echo '<option value="'.$w['kurs'].'">'.$w['kod_waluty'].'</option>';
                       }
                    ?></select>
                </td><td>
                <input type="number" id="wyn2" min="0" value="0" disabled>
                </td></tr>
            </table>
            <p><input type="button" value="oblicz" onclick="zam();"></p>
            </form>
            </div>
            <div class="element_obiekt4">
              <img src="swiat_1.png" id="bank1">
            </div>
        </div>
        <div class="element">
        <div class="element_nazwa">Kursy walut z dnia
                    <?php
                        if(isset($_SESSION['day'])){
                            echo $_SESSION['day'];
                        }else{
                            $date = $connect->query("SELECT data FROM kursy GROUP BY data");
                            foreach($date as $d){
                            $date = $d['data'];}
                            echo $date;
                        }
                    ?>
        </div>
        <div class="element_nazwa1"><form action="archiwum.php" method="GET"><select name="dataop">
        <option disabled selected value> -- wybierz date -- </option>
                    <?php
                        $wynik = $connect->query("SELECT distinct(data) FROM kursy GROUP BY data");
                        foreach($wynik as $w){
                            echo '<option>'.$w['data'].'</option>';
                        }
                    ?>
            </select> <input type="submit" value="wczytaj"></form></div>
            <div class="element_obiekt3">
                <table id="tabelka_kurs">
                    <thead><td>Kod waluty</td><td>Kurs</td></thead>
                    <?php
                    if(isset($_SESSION['exits_data'])){
                            echo $_SESSION['exits_data'];
                    }else{
                        $date = $connect->query("SELECT data FROM kursy GROUP BY data");
                            foreach($date as $d){
                            $date = $d['data'];
                        }
                            $wynik = $connect->query("SELECT kod_waluty, kurs FROM kursy WHERE data = '".$date."'");
                            foreach($wynik as $w){
                            echo '<tr id="trs"><td>'.$w['kod_waluty'].'</td><td>'.$w['kurs'].'</td></tr>';
                        }
                    }
 
                    ?>
                </table>
            </div>
        </div>
    </div>
    <div class="kreska"><hr></div>
    <div class="stopka">@ Bartosz Dworaźny - 2022</div>
</body>
</html>
<?php
    $connect->close();
    session_destroy()
?>