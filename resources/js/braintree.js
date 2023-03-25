
function getToken() {
    axios.post("http://127.0.0.1:8000/token", function (response) {
        console.log(response)
    })
}







braintree.setup("CLIENT_TOKEN_FROM_SERVER",
    "dropin", {
    container: "payment-form"
});