# 2019 Diplomarbeit Entsorgungskalenderanzeige Backend
[![quality gate](https://sonarcloud.io/api/project_badges/measure?project=Entsorgungskalenderanzeige_Backend&metric=alert_status)
](https://sonarcloud.io/dashboard?id=Entsorgungskalenderanzeige_Backend) 
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/61a1926ed0d644b3ae34f0d7c89fa6eb)](https://app.codacy.com/app/christianpetri/2019_Diplomarbeit_Entsorgungskalenderanzeige_Webseite?utm_source=github.com&utm_medium=referral&utm_content=christianpetri/2019_Diplomarbeit_Entsorgungskalenderanzeige_Webseite&utm_campaign=Badge_Grade_Dashboard)
[![Maintainability](https://api.codeclimate.com/v1/badges/0a72bd4c3e3425886691/maintainability)](https://codeclimate.com/github/christianpetri/2019_Diplomarbeit_Entsorgungskalenderanzeige_Webseite/maintainability)

## Programmschnittstelle (API) für das Frontend
### /plain/
Die Schnittstelle hat ihren Namen aus dem englischen "content-type: text/plain" auf Deutsch "Inhaltstyp: Klartext" erhalten.  
Er bietet dem Frontend die Möglichkeit den aktuellen Status, ob die Entsorgungsgüter an die Strasse gestellt werden dürfen, abzurufen.  

In der folgenden Tabelle sind die verfügbaren Optionen der API dargestellt:

|URL         |Methode|Parameter|Inhaltstyp|Beschreibung                |Beispiel Resultat|
|------------|-------|---------|----------|----------------------------|-----------------|
|/plain/     |GET	 |circleId |text/plain|Ist Abfuhr, wenn ja, welche?|100100           |
|/plain/test/|GET    |circleId |text/plain|Ist die Kreis-ID korrekt?   |1                |

In der Gemeinde Rapperswil-Jona liegen folgenden Kreise vor (Stand 2019):  
Jeder Kreis der Gemeinde hat eine ID und einen Kreisbeschreibung:  

|Kreis ID|Kreisbeschreibung|
|--------|-----------------|
|1       |1                |
|2       |1a               |
|3       |1b               |
|4       |2                |
|5       |3                |
|6       |4                |
|7       |5                |
|8       |6                |
|9       |7                |
|10      |8                |
|11      |9                |

#### Verwendung von /plain
Bitte geben Sie die korrekte Kreis-ID (circleId) für Ihren Kreis an. (Unten als Beispiel: 6)  
URL: `plain/?circleId=6`  
Anforderungs-URL: [https://www.entsorgungskalenderanzeige.christianpetri.ch/plain/?circleId=6](https://www.entsorgungskalenderanzeige.christianpetri.ch/plain/?circleId=6)  
Anforderungsmethode: GET  

Beispiel Antwort: **100100**  
Content-Type: text/plain;charset=UTF-8

Die erste Zahl ist immer 1, gefolgt von fünft Zahlen, die einen Booleschen Wert darstellen

1 = wahr, 0 = falsch // 1 = LED ist EIN, 0 = LED ist AUS

Die Anwort **101100** bedeutet folgendes:  
`[1] [0] [1] [1] [0] [0]`  
`[1] ["Grüngut"] ["Karton"] ["Kehricht und Sperrgut"] ["Metall"] ["Papier"]`  
Die erste Zahl steht für nichts, es ist ein Platzhalter, um die Sequenz zu starten  

Die zweite Zahl steht für grünen Abfall.  
Die dritte Zahl steht für Karton.  
Die vierte Zahl steht für allgemeiner Abfall und Sperrgut.  
Die fünfte Zahl steht für Metallabfälle.  
Die Nummer sechs steht für Papierabfall.  

istHeuteGrünAbfuhr = 0 = falsch -> Licht ist aus  
istHeuteKartonAbfuhr = 1 = wahr -> Licht ist an  
istHeuteAllgemeinerAbfallundSperrgutAbfuhr = 1 = wahr -> Licht ist an  
istHeuteMetallAbfuhr = 0 = falsch -> Licht ist aus  
istHeutePapierAbfuhr = 0 = falsch -> Licht ist aus  

Diese Informationen auf der Anzeige dargestelle, könnte folgendermassen Aussehen:
![Anzeige](image/Anzeige_beleuchtet.png)

#### Verwendung von /plain/test
Wenn Sie prüfen möchten, ob die Kreis-ID (im Backend) tatsächlich existiert. Geben Sie eine Kreis-ID über einen GET-Request an.

URL: `plain/test/?circleId=6`  
Anforderungs-URL: [https://www.entsorgungskalenderanzeige.christianpetri.ch/plain/test/?circleId=6](https://www.entsorgungskalenderanzeige.christianpetri.ch/plain/test/?circleId=6)  
Anforderungsmethode: GET  

Erwartetes Ergebnis bei Erfolg (Kreis-ID ist korrekt konfiguriert): 1  
Erwartetes Ergebnis bei Misserfolg (Kreis-ID ist nicht korrekt oder sie wurde noch nicht angegeben): 0
## Testseite
Unter `/test` z.B. [https://www.entsorgungskalenderanzeige.christianpetri.ch/test/](https://www.entsorgungskalenderanzeige.christianpetri.ch/test/) können Sie testen, ob die Webseite ordnungsgemäss funktioniert.
## Sonar
   Dieses Projekt verwendet die SonarCloud, um den Code zu überprüfen. Bitte besuchen Sie den Link unten, um die Analyse zu sehen<br/>
     [Sonar Entsorgungskalenderanzeige Backend](https://sonarcloud.io/dashboard?id=Entsorgungskalenderanzeige_Backend)  <br/>
     ![quality gate](https://sonarcloud.io/api/project_badges/measure?project=Entsorgungskalenderanzeige_Backend&metric=alert_status)
1. Installieren Sie den Sonar-Client
  [How to install SonarQube Scanner](https://docs.sonarqube.org/display/SCAN/Analyzing+with+SonarQube+Scanner)
2. Um den Code zur Analyse in die Sonar-Cloud zu verschieben, verwenden Sie bitte den folgenden Befehl  

```console 
sonar-scanner
```
