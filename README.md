# ePrint

Koristim Skeleton boilerplate
http://getskeleton.com/

Font Awesome font
https://fontawesome.com/

### Plan

Sone :baby_chick:
- [] SKLONITI UPLOAD DUGME ZA KOD OMOTA SPISA I STANDARDNIH KOVERTI
- [x] Push
- [x] Zavrsi ostale usluge i njihove forme
- [x] Dodaj navigaciju u uslugama 
- [x] Bolje stilizuj forme i "prihvatam uslove" ispod posalji dugmeta
- [x] Napravi modal za Registraciju
- [x] Upload dugme
- [x] Spusti kada stiklira
- [ ] Promeni font style i testiraj font size (pogotovo naslov i navigacija u headeru)
- [ ] Napravi Admin panel
- [x] style css za sve browsere
- [ ] Da moze da se klikne na ikonicu
- [ ] 2 dugmeta u stampanje, upload za korice
- [x/ ] Proveri metatagove, dodaj za Face/Twit, promeni favicon - URADI ZA SVAKU STRANICU
- [ ] Za login forme dodati da se zatvara na ESC

Tile :rabbit:
- [x] Dodati da prilikom slanja, ako dodje do greske, ostanu zapamceni podaci iz forme
- [ ] Zakljucavanje slike prilikom transakcije
- [ ] Slanje kopije uplatnice korisniku

##### Korisni linkovi za mene:
http://formvalidation.io/examples/supporting-skeleton-framework/

https://stackoverflow.com/questions/29682670/how-to-send-form-using-skeleton-boilerplate

stilizovanje dugmeta upload
https://tympanus.net/codrops/2015/09/15/styling-customizing-file-inputs-smart-way/

prihvatam uslove + pojavljuje se forma
https://codepen.io/chriscoyier/pen/LEGXOK
https://css-tricks.com/exposing-form-fields-radio-button-css/

meta tagovi
https://github.com/joshbuchea/HEAD#recommended-minimum
https://css-tricks.com/essential-meta-tags-social-media/
https://blog.kissmetrics.com/open-graph-meta-tags/
http://ogp.me/




### Organizacija


### Nesto
	- Jako puno merge-a, do 12 uvece. Pogledaj da li je sve tvoje jos uvek tu. :D

### Pitanja za advokata
1. Kako da nazovem heading "Ostalo" gde se nalaze cenovnik, o nama i kontakt? Ostalo je bzvz.
2. Standardne koverte - pitaj da li je dobro za "na poledjini" i "na adresnoj strani" - da li treba sve popuniti?

odgovor: Ne mora

3. Omoguciti kacenje vise razlicitih fajlova (sekcija stampanje)?

odgovor: Moze da se desi, ali je realnije da ce onda morati opet novu formu da popunjava jer ce najverovatnije biti drugaciji podaci

4. Pitanje za "prihvatam uslove"

odgovor: Neka pise - narudzbinom prihvatam uslove poslovanja pored dugmete posalji (DAKLE BEZ STIKLIRANJA)

### Update za 22. i 23. februar
###### 1	
	Treba promeniti putanju za uplatnice u zavisnosti od toga gde ce se nalaziti.

###### 2
	Mozda je bolje da "posalji kopiju sebi" bude opcija samo za registrovane?  Da bude disabled za neregistrovane?

###### 3
	Reci ako nesto ne radim dobro!
	Na primer, nisam siguran da li mora value da bude unikatan kroz ceo sajt? I u dostavnicama i omotu spisa postoji label="forInput" Kapiram da ga ti povlacis iz odredjenog fajla, da je nebitno sto postoji jos neki forInput u drugom fajlu.. ako gresim, reci da ispravim

###### 4 
	Pogledaj omot spisa kod na liniji 100 pa do 118 - je l sam ih dobro nazvao? :D To se provlaci kroz vise formi, pa radim samo copy-paste

###### 5 
	Ne registruje mi promene u CSS-u, sto je cudnovato. 
	Meni je pomoglo ovo: https://stackoverflow.com/questions/18543776/why-is-my-css-not-updating-in-web-browser  
