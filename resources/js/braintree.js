
let serverToken = null;

function getToken() {
    axios.post("http://127.0.0.1:8000/user/getToken").then((response) => {
        serverToken = response.data.results;
        console.log(nonceKey)
    })
}

getToken();

/*
// Step two: create a dropin instance using that container (or a string
//   that functions as a query selector such as `#dropin-container`)
braintree.dropin.create({
    container: document.getElementById('dropin-container'),
    // ...plus remaining configuration
  }).then((dropinInstance) => {
    // Use `dropinInstance` here
    // Methods documented at https://braintree.github.io/braintree-web-drop-in/docs/current/Dropin.html
  }).catch((error) => {});



braintree.setup(serverToken,
    "dropin", {
    container: "payment-form"
});

*/