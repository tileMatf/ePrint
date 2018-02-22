# ePrint

Koristim Skeleton boilerplate
http://getskeleton.com/

Font Awesome font
https://fontawesome.com/

### Plan

Sone :baby_chick:
- [x] Push
- [ ] Zavrsi ostale usluge i njihove forme
- [x] Dodaj navigaciju u uslugama 
- [ ] Bolje stilizuj forme
- [ ] JavaScript da mora da chekira "prihvatam uslove"
- [ ] Napravi modal za Registraciju
- [ ] Promeni font
- [ ] Napravi Admin panel
- [ ] Proveri metatagove, dodaj za Face/Twit, promeni favicon


##### Korisni linkovi za mene:
	http://formvalidation.io/examples/supporting-skeleton-framework/

	https://stackoverflow.com/questions/29682670/how-to-send-form-using-skeleton-boilerplate

	stilizovanje dugmeta
	https://tympanus.net/codrops/2015/09/15/styling-customizing-file-inputs-smart-way/

	prihvatam uslove + pojavljuje se forma
	https://codepen.io/chriscoyier/pen/LEGXOK
	https://css-tricks.com/exposing-form-fields-radio-button-css/

Tile :rabbit:
- [ ] nesto
- [ ] nesto
- [ ] nesto


### Organizacija


### Pitanja za advokata
1. Kako da nazovem heading "Ostalo" gde se nalaze cenovnik, o nama i kontakt? Ostalo je bzvz.
	-- Mozda da nema naslova?
2. Uplatnice su nesto istripovane, pitaj ga za "unos podataka", "varijabilna stampa", "upload" na kraju? Greska ili ne u nalogu za prenos?
3. Da li nesto od ponudjenih ne mora da se cekira, ili je sve obavezno izabrati?
4. Standardne koverte - pitaj da li je dobro za "na poledjini" i "na adresnoj strani"


### Update
###### 1	
Dugme za upload sam morala da promenim, jer mora da bude tipa 'file'. Probaj da stilizujes, ali cini se da je 
zeznuto stilizovati to dugme. Ja sam nasla ovde neko objasnjenje: https://tympanus.net/codrops/2015/09/15/styling-customizing-file-inputs-smart-way/

	MOZDA JE NAJBOLJE DA OSTANE DIFOLT, POGOTOVO STO JE CEO SAJT MINIMALISTIC + CITAM KOMENTARE U OVOM LINKU DA POSTOJI PROBLEM NA TELEFONIMA.
###### 2
	U delu stampanje, dodaj da ukoliko korisnik stiklira 'Posalji kopiju sebi' da se pojavi polje za upis email adrese na koju
	se salje kopija.

	OVO MORAM DA PROVERIM DA LI UOPSTE ZELI, ILI SAMO PRIHVATAM USLOVE
	AKO ZELI DA NE ZABORAVIM LINK: 
	https://codepen.io/chriscoyier/pen/LEGXOK
	https://css-tricks.com/exposing-form-fields-radio-button-css/

###### 3
	Ne mogu da verujem, izgleda da nisam aploadovao prekljuce, stampanje je imalo za "heftanje" i "busenje" padajucu opciju, a ne radio button :-(

	Choose file - moze samo jedan fajl da se odabere?
	Kako se pravi folder putanja za uplatnice (ima vise fajlova, uplatnice.php pa podfolder?)
	Ajde pogledaj u "Omotu spisa" - "kolicina" na 133 liniji koda, je l to okej? Tako treba da napravim i za "heftanje" i "busenje" u "Stampanju"



