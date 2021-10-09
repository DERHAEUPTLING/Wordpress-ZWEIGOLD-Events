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
  const jsonLength = json.length;
  let eventList = "";
  let schemaList = "";

  
  json.forEach((event, i) => {
    eventList += templateEvent(event, i, jsonLength);
  });
  node.innerHTML = eventList + schemaList;
};

/* Templates */
let currentMonth = "";
const templateEvent = (event, i, jsonLength) => {
  const date = new Date(event.dateEvent);
  const dateDay = date.toLocaleDateString("de-DE", { day: "2-digit" });
  const dateMonth = date.toLocaleDateString("de-DE", { month: "short" });
  const monthHeadline = date.toLocaleDateString("de-DE", { month: "long", year: "numeric" });

  // console.log("currentMonth, dateMonth, i: ", currentMonth, dateMonth, i);
  // console.log(event);

  const eventlistContainerStart = () => {
    let _html = ``;
    
    if (currentMonth != dateMonth && i != 0  ) { 
      // close opended <div class="eventlist-container"> from prior loop
      _html += `</div>`;
    }
    if (currentMonth != dateMonth ) {
        _html += `
          <p class="sc_zweigold_eventlist_headline">${monthHeadline}</p>
          <div class="sc_zweigold_eventlist_container">
        `;
    }
    return _html;
  };

  const eventlistContainerEnd = () => {
    if (i === jsonLength ) {
      return `</div>`;
    } else {
      return ``;
    }
  };

  const _schema = `
  <script type="application/ld+json">
    {
      "@context":"http:\/\/www.schema.org",
      "@type":"Event",
      "name":"${event.name ? event.name: event.programName}",
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
  </script>`;

  const _html = `
    ${eventlistContainerStart()}
      ${
        event.ticketsAdvancesaleInternet
          ? `<a class=event data-id=${event.id} href=${event.ticketsAdvancesaleInternet.replace(
              /^\uFEFF/gm,
              ""
            )} target="_blank" rel="noopener">`
          : `<div class=event data-id=${event.id}>`
      }
      
        <div class=date data-date=${event.dateEvent}>
          <div class=day>${dateDay}</div>
          <div class=month>${dateMonth}</div>
        </div>
        <div class=description>
          <div class=title>"${event.name ? event.name: event.programName}" – ${event.locationCityName}</div>
          <!--<div class=location>${event.locationCityName}</div>-->
        </div>

      ${event.ticketsAdvancesaleInternet ? `</a>` : `</div>`}
      ${_schema}
    ${eventlistContainerEnd()}
  `;

  currentMonth = dateMonth;

  return _html;
};
