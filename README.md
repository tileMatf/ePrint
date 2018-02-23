# ePrint

Koristim Skeleton boilerplate
http://getskeleton.com/

Font Awesome font
https://fontawesome.com/

### Plan

Sone :baby_chick:
- [x] Push
- [x] Zavrsi ostale usluge i njihove forme
- [x] Dodaj navigaciju u uslugama 
- [ ] Bolje stilizuj forme i "prihvatam uslove" ispod posalji dugmeta
- [ ] Napravi modal za Registraciju
- [ ] Promeni font style i testiraj font size (pogotovo naslov i navigacija u headeru)
- [ ] Napravi Admin panel
- [ ] style css za sve browsere
- [ ] Proveri metatagove, dodaj za Face/Twit, promeni favicon


Tile :rabbit:
- [ ] nesto
- [ ] nesto
- [ ] nesto

##### Korisni linkovi za mene:
http://formvalidation.io/examples/supporting-skeleton-framework/

https://stackoverflow.com/questions/29682670/how-to-send-form-using-skeleton-boilerplate

stilizovanje dugmeta upload
https://tympanus.net/codrops/2015/09/15/styling-customizing-file-inputs-smart-way/

prihvatam uslove + pojavljuje se forma
https://codepen.io/chriscoyier/pen/LEGXOK
https://css-tricks.com/exposing-form-fields-radio-button-css/



### Organizacija


### Pitanja za advokata
1. Kako da nazovem heading "Ostalo" gde se nalaze cenovnik, o nama i kontakt? Ostalo je bzvz.
2. Standardne koverte - pitaj da li je dobro za "na poledjini" i "na adresnoj strani" - da li treba sve popuniti?
odgovor: Ne mora
3. Omoguciti kacenje vise razlicitih fajlova (sekcija stampanje)?
odgovor: Moze da se desi, ali je realnije da ce onda morati opet novu formu da popunjava jer ce najverovatnije biti drugaciji podaci
4. Pitanje za "prihvatam uslove"
odgovor: Neka pise - narudzbinom prihvatam uslove poslovanja pored dugmete posalji (DAKLE BEZ STIKLIRANJA)

### Update 22. februar
###### 1	
	Treba promeniti putanju za uplatnice u zavisnosti od toga gde ce se nalaziti.

###### 2
	da li mislis da je bolje da posalji kopiju sebi bude opcija samo za registrovane? 

###### 3
	Reci ako nesto ne radim dobro!
	Na primer, nisam siguran da li mora value da bude unikatan kroz ceo sajt? I u dostavnicama i omotu spisa postoji label="forInput" Kapiram da ga ti povlacis iz odredjenog fajla, da je nebitno sto postoji jos neki forInput u drugom fajlu.. ako gresim, reci da ispravim

###### 4 
	Pogledaj omot spisa kod na liniji 100 pa do 118 - je l sam ih dobro nazvao? :D To se provlaci kroz vise formi, pa radim samo copy-paste

###### 5 
	Ne registruje mi promene u CSS-u, sto je cudnovato. 
	Sutra cu to da Guglujem, mada ne vidim sta bi mogao da bude problem, dobra je putanja cim registruje CSS, a nove promene ne registruje o.O wtf  