# 2019 Diplomarbeit Entsorgungskalenderanzeige Backend (Webseite)

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/61a1926ed0d644b3ae34f0d7c89fa6eb)](https://app.codacy.com/app/christianpetri/2019_Diplomarbeit_Entsorgungskalenderanzeige_Webseite?utm_source=github.com&utm_medium=referral&utm_content=christianpetri/2019_Diplomarbeit_Entsorgungskalenderanzeige_Webseite&utm_campaign=Badge_Grade_Dashboard)

## Einleitung
Die Anwendung verfügt über /plain  als API-Option

Verwendung von /plain  
Anforderungs-URL: [https://www.entsorgungskalenderanzeige.christianpetri.ch/plain/?circleId=6](https://www.entsorgungskalenderanzeige.christianpetri.ch/plain/?circleId=6)
Anforderungsmethode: GET

|Kreis_ID|Kreisbeschreibung|
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

Beispiel Antwort: **100100**  
Content-Type: text/plain;charset=UTF-8

Die erste Zahl ist immer 1, gefolgt von 5 Zahlen, die einen Booleschen Wert darstellen

1 = wahr, 0 = falsch // 1 = LED ist EIN, 0 = LED ist AUS


Die Anwort **100100** bedeutet folgendes:  
`[1] [0] [0] [1] [0] [0]`  
`[1] ["Grüngut"] ["Karton"] ["Kehricht und Sperrgut"] ["Metall"] ["Papier"]`
Die erste Zahl steht für nichts, es ist ein Platzhalter, um die Sequenz zu starten  

Die zweite Zahl steht für grünen Abfall

Die dritte Zahl steht für Karton

Die vierte Zahl steht für allgemeiner Abfall und Sperrgut.

Die fünfte Zahl steht für Metallabfälle

Die Nummer sechs steht für Papierabfall

istHeuteGrünabfuhr = falsch -> Licht ist aus  
istHeuteKatonAbfuhr = falsch -> Licht ist aus  
istHeutePapierAbfuhr = wahr -> Licht ist an  
und so weiter

## Sonar
   Dieses Projekt verwendet die SonarCloud, um den Code zu überprüfen. Bitte besuchen Sie den Link unten, um die Analyse zu sehen<br/>
     [Sonar Entsorgungskalenderanzeige Backend](https://sonarcloud.io/dashboard?id=Entsorgungskalenderanzeige_Backend)  <br/>
     ![quality gate](https://sonarcloud.io/api/project_badges/measure?project=Entsorgungskalenderanzeige_Backend&metric=alert_status)
1. Installieren Sie den Sonar-Client
  [How to install SonarQube Scanner](https://docs.sonarqube.org/display/SCAN/Analyzing+with+SonarQube+Scanner)
2. Um den Code zur Analyse in die Sonar-Cloud zu verschieben, verwenden Sie bitte den folgenden Befehl  

```
sonar-scanner
```
