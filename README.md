# LOG van alle dingen die ik heb aangepast

Deze repository bevat de broncode voor een educatieve webapplicatie die is ontworpen om studenten te leren over webbeveiligingskwetsbaarheden en beste praktijken voor veilig programmeren. De applicatie simuleert een bankwebsite met verschillende opzettelijke beveiligingsfouten, wat een praktische leerervaring biedt voor onderwerpen zoals SQL-injectie, cross-site scripting (XSS), datavalidatie, cryptografie, gebroken toegangscontrole en meer. Studenten zullen deze kwetsbaarheden onderzoeken, misbruiken en beveiligen als onderdeel van hun cursuswerk.

#Index.php:
- Lijn 15, SQL injection op login pagina opgelost en verifieer hashed pass

#Transacties.php
- Voeg filter input toe om ervoor te zorgen dat id param valid is
- Gebruik htmlspecialchars om XSS te voorkomen
- User id controleren bij transacties laten zien

#Register.php
- Lijn 14 password hashed

Dashboard.php 
-  Controleer of de gebruiker genoeg saldo heeft en sta negatief getal niet toe
  
TO DO :

Session management secure maken
Cookies
