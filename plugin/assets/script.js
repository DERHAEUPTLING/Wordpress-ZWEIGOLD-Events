document.addEventListener("DOMContentLoaded", function (event) {
  const lists = document.querySelectorAll(".sc_zweigold_eventlist");
  lists.forEach((node) => {
    loadData(node);
  });
});

/* load Data */
const loadData = (node) => {
  fetch(node.dataset.url, {
    method: "GET",
    headers: { Authorization: "Basic " + btoa(node.dataset.user + ":" + node.dataset.pass) },
    redirect: "follow",
  })
    .then((response) => response.json())
    .then((json) => buildList(json, node));
};

/* build event list */
const buildList = (json, node) => {
  let eventList = "";
  let schemaList = "";
  json.forEach(event => {
    eventList += templateEvent(event) + templateSchema(event);
  });
  node.innerHTML = eventList + schemaList;
};

/* Templates */

const templateEvent = (event) => {
  const date = new Date(event.dateEvent);
  const dateDay   = date.toLocaleDateString('de-DE', {day: '2-digit'});
  const dateMonth = date.toLocaleDateString('de-DE', {month: 'short'});
  const dateYear  = date.toLocaleDateString('de-DE', {year: 'numeric'});
  const _html = `
    ${event.ticketsAdvancesaleInternet 
      ? `<a class=event data-id=${event.id} href=${event.ticketsAdvancesaleInternet.replace(/^\uFEFF/gm, '')} target="_blank">`
      : `<div class=event data-id=${event.id}>`
    }
    
      <div class=date data-date=${event.dateEvent}>
        <div class=day>${dateDay}</div>
        <div class=month>${dateMonth}</div>
        <!--<div class="month_year">
          <div class=month>${dateMonth}</div>
          <div class=year>${dateYear}</div>
        </div> -->
      </div>
      <div class=description>
        <div class=title>"${event.programName}" – ${event.locationCityName}</div>
        <!--<div class=location>${event.locationCityName}</div>-->
      </div>

    ${event.ticketsAdvancesaleInternet 
      ? `</a>`
      : `</div>`
    }

  `
  return _html;
};

const templateSchema = (event) => {
  const schema = `
  <script type="application/ld+json">
    {
      "@context":"http:\/\/www.schema.org",
      "@type":"Event",
      "name":"${event.programName}",
      "url":"${event.ticketsAdvancesaleInternet}",
      "description":"${event.programName}",
      "startDate":"${event.dateEvent}",
      "endDate":"${event.dateEvent}",
      "location": {
        "@type":"Place",
        "name":"${event.locationName}",
        "address":"${event.locationCityName}, ${event.locationStreetAddress}"
      },
      "performer": {
        "@type":"Person",
        "name":"${event.artistName}"
      }
    }                        
  </script>`
  return schema;
};

