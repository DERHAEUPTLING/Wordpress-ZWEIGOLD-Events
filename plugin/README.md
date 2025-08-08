## ZWEIGOLD Events (Kurzfassung)

Einfacher Shortcode zur Anzeige einer Eventliste aus der ZWEIGOLD API.

### Nutzung
1. Plugin hochladen & aktivieren
2. Menü: ZWEIGOLD → API URL, User, Passwort eintragen
3. Shortcode in Seite/Beitrag: `[zweigold_eventlist]`

### Voraussetzungen
WordPress ≥ 5.8, PHP ≥ 7.4

### Was passiert?
Der Shortcode rendert einen Platzhalter. `assets/script.js` lädt Events (Basic Auth), gruppiert nach Monat und ergänzt strukturiertes Daten-Markup.



### Changelog (kurz)
- 1.0.1 Struktur & Sicherheit verbessert
- 1.0.0 Erste Version

### Hinweis
Zugangsdaten liegen als Data-Attribute im HTML. Für sensible Szenarien Proxy/API-Relay verwenden.


