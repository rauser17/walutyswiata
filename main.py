import mysql.connector
import requests

class waluta:
    nazwa=""
    kurs=""
    def __init__(self,nazwa_arg,kurs_arg):
        self.nazwa=nazwa_arg
        self.kurs=kurs_arg
    def dane(self):
        print(self.nazwa, self.kurs)

class tab_waluty:
    numer=""
    data=""
    def __init__(self,numer_arg,data_arg):
        self.numer=numer_arg
        self.data=data_arg
    def dane(self):
        print(self.numer, self.data)

def wybrane(tablica,nazwa):
  #  print(tablica)
    query = "INSERT INTO "+nazwa+" VALUES (NULL,'"+xml.numer+"','"+xml.data+"',"+tablica[0].kurs+");"
    print(query)
    kursor.execute(query)


path = 'http://api.nbp.pl/api/exchangerates/tables/A?format=xml'
r = requests.get(path)
# dane
with open('dane.xml', 'wb') as f:
    f.write(r.content)

from xml.etree import ElementTree

tree = ElementTree.parse("dane.xml")
root = tree.getroot()

tabela = []
for element in root.findall(".//Rate"):
    nazwa = element.find('Code').text
    kurs = element.find('Mid').text
    wal = waluta(nazwa,kurs)
    tabela.append(wal)
# print(tabela)

# nazwa i data
for element in root.findall('ExchangeRatesTable'):
    nr_tabeli = element.find('No').text
    data = element.find('EffectiveDate').text
    xml = tab_waluty(nr_tabeli,data)
# print(nr_tabeli)
# print(data)

# sprawdzanie danych, zeby sie nie powtarzały

baza = mysql.connector.connect(host='localhost', user='root', password='', database='waluty')
kursor = baza.cursor()
query = "SELECT nr_tabeli,id_wiersza FROM kursy GROUP BY id_wiersza ORDER BY id_wiersza desc LIMIT 1;"
kursor.execute(query)
nr_tabeli_w_bazie = str(kursor.fetchall()).replace("'", "").replace(")", "").replace("(", "").replace("[", "").replace("]", "").split(",")[0]
# print(nr_tabeli_w_bazie)
baza.commit()
error = 0
if nr_tabeli_w_bazie == xml.numer:
    error = 1
    print("Dane w bazie są aktualne!")

# wysyłanie danych do bazy wszystkich walut
if error == 0:
    print('Zapytania do tabeli "kursy"')
    for i in tabela:
        baza = mysql.connector.connect(host='localhost', user='root', password='', database='waluty')
        kursor = baza.cursor()
        query = "INSERT INTO kursy VALUES (NULL,'"+xml.numer+"','"+xml.data+"','"+i.nazwa+"',"+i.kurs+");"
        kursor.execute(query)
        baza.commit()
        print(query)
    print(80*'-')

# wybrane waluty i wysłanie ich do bazy
if error == 0:
    GBP = []
    USD = []
    EUR = []
    for i in tabela:
        if i.nazwa == 'USD':
            USD.append(i)
            continue
        if i.nazwa == 'GBP':
            GBP.append(i)
            continue
        if i.nazwa == 'EUR':
            EUR.append(i)
            continue
   # print(GBP)
   # print(USD)
   # print(EUR)
    print('Zapytania do tabel z wybranymi walutami')
    baza = mysql.connector.connect(host='localhost', user='root', password='', database='waluty')
    kursor = baza.cursor()
    wybrane(GBP,'gbp')
    wybrane(USD, 'usd')
    wybrane(EUR, 'eur')
    baza.commit()
    print(80 * '-')

    print("Dane zostały wysłane do bazy danych!")
#print(tabela)