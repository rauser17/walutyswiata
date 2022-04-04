<?php
    session_start()
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styl_v2.css">
    <title>Waluty świata - euro</title>
    <script src="zamiana_waluty.js"></script>
</head>
<body>
    <div class="baner">
        <div class="nazwa"><h2>Euro</h2></div>
        <div class="baner_pole"><a id="banp" href="usa.php">dolar</a></div>
        <div class="baner_pole"><a id="banp" href="anglia1.php">funt</a></div>
        <div class="baner_pole"><a id="banp" href="swiat.php">waluty świata</a></div>
        <div class="kreska"><hr></div>
    </div>
    <div class="main">
        <div class="element">
            <div class="element_nazwa">Kalkulator</div>
            <div class="element_obiekt2">
            <form id="formularz" action="przelicz_eur.php" method="GET">
            <table id="tabela_kal">
                <tr><td></td><td>Obliczanie z EUR na PLN</td></tr>
                <tr><td>EUR</td>
                <td>
                <?php
                        if(isset($_SESSION['euro'])){
                            echo '<input type="number" name = "EURO1" min="0" value="'.$_SESSION['euro'].'" >' ;
                        }else{
                            echo '<input type="number" name = "EURO1" min="0" value="0">';
                        }
                    ?>
                </td></tr>
                <tr><td>PLN</td>
                <td>
                    <?php
                        if(isset($_SESSION['euro_pln'])){
                            echo '<input type="number" min="0" value="'.$_SESSION['euro_pln'].'" disabled>' ;
                        }else{
                            echo '<input type="number" min="0" value="0" disabled>';
                        }
                    ?>
                </td></tr>
            </table><br>
            <table id="tabela_kal">
                <tr><td></td><td>Obliczanie z PLN na EUR</td></tr>
                <tr><td>PLN</td>
                <td>
                <?php
                        if(isset($_SESSION['pln'])){
                            echo '<input type="number" name = "PLN1" min="0" value="'.$_SESSION['pln'].'">' ;
                        }else{
                            echo '<input type="number" name = "PLN1" min="0" value="0">';
                        }
                    ?>
                </td></tr>
                <tr><td>EUR</td>
                <td>
                <?php
                        if(isset($_SESSION['pln_euro'])){
                            echo '<input type="number" min="0" value="'.$_SESSION['pln_euro'].'" disabled>' ;
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
                <img src="eurasek.jpg" id="bank">
            </div>
        </div>
        <div class="element">
            <div class="element_nazwa">Kursy euro z ostatnich dni</div>
            <div class="element_obiekt1">
                <table id="tabelka_kurs">
                    <thead><td>Data</td><td>Kurs</td></thead>
                    <?php
                        $connect = mysqli_connect('localhost','root','','waluty');
                        $wynik = $connect->query("SELECT * FROM EUR");
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
                    require "wykres_euro.php"
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