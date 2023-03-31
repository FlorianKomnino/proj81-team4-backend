let serverToken = null;
const loader = document.getElementById('braintree-loader');
const submitButton = document.getElementById('payment-submit');

function getToken() {
  axios.post("http://127.0.0.1:8000/user/getToken").then((response) => {
    serverToken = response.data.results;
    console.log(response)
  })
    .finally(function () {
      // Step two: create a dropin instance using that container (or a string
      //   that functions as a query selector such as `#dropin-container`)
      braintree.dropin.create({
        authorization: serverToken,
        container: document.getElementById('dropin-container'),

        // ...plus remaining configuration
      }, (error, dropinInstance) => {
        // Use `dropinInstance` here
        // Methods documented at https://braintree.github.io/braintree-web-drop-in/docs/current/Dropin.html

        if (error) {
          console.error(error)
        }

        const form = document.getElementById('payment-form')

        form.addEventListener('submit', event => {
          event.preventDefault();

          // braintree.client.create({
          //   authorization: 'CLIENT_AUTHORIZATION'
          // }, function (err, clientInstance) {
          //   // Creation of any other components...

          //   braintree.dataCollector.create({
          //     client: clientInstance
          //   }, function (err, dataCollectorInstance) {
          //     if (err) {
          //       // Handle error in creation of data collector
          //       return;
          //     }
          //     // At this point, you should access the dataCollectorInstance.deviceData value and provide it
          //     // to your server, e.g. by injecting it into your form as a hidden input.
          //     var deviceData = dataCollectorInstance.deviceData;
          //   });
          // });

          dropinInstance.requestPaymentMethod((error, payload) => {
            if (error) { console.error(error) };
            console.log(payload)
            // Step four: when the user is ready to complete their
            //   transaction, use the dropinInstance to get a payment
            //   method nonce for the user's selected payment method, then add
            //   it a the hidden field before submitting the complete form to
            //   a server-side integration
            document.getElementById('nonce').value = payload.nonce;
            form.submit()
          });
        });
      })
      loader.classList.toggle('d-none')
      submitButton.classList.toggle('d-none')

    })
}

getToken()



