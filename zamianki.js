function zam(){
    pln1 = document.getElementById('pln1').value
    pln2 = document.getElementById('pln2').value

    kur1 = document.getElementById('zag1').value
    kur2 = document.getElementById('zag2').value

    wyn1 = document.getElementById('wyn1')
    wyn2 = document.getElementById('wyn2')

    wynik1 = pln1*kur1
    wynik1 = wynik1.toFixed(2)
    wyn1.value = wynik1

    wynik2 = pln2/kur2
    wynik2 = wynik2.toFixed(2)
    wyn2.value = wynik2
}
