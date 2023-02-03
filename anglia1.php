<?php
    session_start();
    $command = escapeshellcmd('python main.py');
    $message = shell_exec($command);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styl_v2.css">
    <title>Waluty świata - funt</title>
    <script src="zamiana_waluty.js"></script>
</head>
<body>
    <div class="baner">
        <div class="nazwa"><h2>Funt brytyjski</h2></div>
        <div class="baner_pole"><a id="banp" href="usa.php">dolar</a></div>
        <div class="baner_pole"><a id="banp" href="europa.php">euro</a></div>
        <div class="baner_pole"><a id="banp" href="swiat.php">waluty świata</a></div>
        <div class="kreska"><hr></div>
    </div>
    <div class="main">
        <div class="element">
            <div class="element_nazwa">Kalkulator</div>
            <div class="element_obiekt2">
            <form id="formularz" action="przelicz_gbp.php" method="GET">
            <table id="tabela_kal">
                <tr><td></td><td>Obliczanie z GBP na PLN</td></tr>
                <tr><td>GBP</td>
                <td>
                <?php
                        if(isset($_SESSION['gbp'])){
                            echo '<input type="number" name = "GBP1" min="0" value="'.$_SESSION['gbp'].'">' ;
                        }else{
                            echo '<input type="number" name = "GBP1" min="0" value="0">';
                        }
                    ?>
                </td></tr>
                <tr><td>PLN</td>
                <td>
                    <?php
                        if(isset($_SESSION['gbp_pln'])){
                            echo '<input type="number" min="0" value="'.$_SESSION['gbp_pln'].'" disabled>' ;
                        }else{
                            echo '<input type="number" min="0" value="0" disabled>';
                        }
                    ?>
                </td></tr>
            </table><br>
            <table id="tabela_kal">
                <tr><td></td><td>Obliczanie z PLN na GBP</td></tr>
                <tr><td>PLN</td>
                <td>
                <?php
                        if(isset($_SESSION['pln'])){
                            echo '<input type="number" min="0" name = "PLN1" value="'.$_SESSION['pln'].'">' ;
                        }else{
                            echo '<input type="number" min="0" name = "PLN1" value="0">';
                        }
                    ?>
                </td></tr>
                <tr><td>GBP</td>
                <td>
                <?php
                        if(isset($_SESSION['pln_gbp'])){
                            echo '<input type="number" min="0" value="'.$_SESSION['pln_gbp'].'" disabled>' ;
                        }else{
                            echo '<input type="number" min="0" value="0" disabled>';
                        }
                    ?>
                </td></tr>
            </table>
            <p><input type="submit" value="oblicz"></p>
            </form>
            </div>
            <div class="element_nazwa">Przykładowy banknot</div>
            <div class="element_obiekt">
                <img src="funcik.jpg" id="bank">
            </div>
        </div>
        <div class="element">
            <div class="element_nazwa">Kursy funta z ostatnich dni</div>
            <div class="element_obiekt1">
                <table id="tabelka_kurs">
                    <thead><td>Data</td><td>Kurs</td></thead>
                    <?php
                        $connect = mysqli_connect('localhost','root','','waluty');
                        $wynik = $connect->query("SELECT * FROM GBP ORDER BY data desc");
                        foreach($wynik as $w){
                            echo '<tr id="trs" value='.$w['kurs'].'><td>'.$w['data'].'</td><td>'.$w['kurs'].'</td></tr>';
                        }
                        $connect->close();
                    ?>
                </table>
            </div>
            <div class="element_nazwa">Wykres waluty</div>
            <div class="element_obiekt">
            <?php
                    require "wykres_funt.php"
            ?>
            </div>
        </div>
    </div>
    <div class="kreska"><hr></div>
    <div class="stopka">@ Bartosz Dworaźny - 2022</div>
</body>
</html>
<?php
    session_destroy()
?>