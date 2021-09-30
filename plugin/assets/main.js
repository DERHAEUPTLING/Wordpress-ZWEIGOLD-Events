var myHeaders = new Headers();
myHeaders.append("Authorization", "Basic dXNlcjpUOVM1R2xxeXhwQzVncTA4dU54OU55R1J6RDI=");

var requestOptions = {
  method: "GET",
  headers: myHeaders,
  redirect: "follow",
};

fetch("https://www.agentur-zweigold.de/api/integrations/termins/89ed7519-5040-4a0a-8537-cece93403ce5", requestOptions)
  // .then((response) => {
	// 	response.text();
	// 	console.log(response);
	// 	throw response;
	// })
	.then(response => response.json())
	.then(result => init(result))
  .catch((error) => console.warn(error));


const init = (data) => {
	console.log(data[0].artistName);
}