let serverToken = null;

function getToken() {
  axios.post("http://127.0.0.1:8000/user/getToken").then((response) => {
    serverToken = response.data.results;
    console.log(serverToken)
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

        if (error) console.error(error);
        const form = document.getElementById('payment-form')
        form.addEventListener('submit', event => {
          event.preventDefault();

          dropinInstance.requestPaymentMethod((error, payload) => {
            if (error) console.error(error);
            payload.nonce = 'fake-valid-nonce'

            // Step four: when the user is ready to complete their
            //   transaction, use the dropinInstance to get a payment
            //   method nonce for the user's selected payment method, then add
            //   it a the hidden field before submitting the complete form to
            //   a server-side integration
            document.getElementById('nonce').value = payload.nonce;
            form.submit();
          });
        });
      });
    })
}

getToken();

