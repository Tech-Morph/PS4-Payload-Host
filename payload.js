document.addEventListener("DOMContentLoaded", function() {
    let button = document.getElementById("injectBtn");
    if (button) {
        button.addEventListener("click", sendPayload);
    } else {
        console.error("Inject button not found!");
    }
});

function sendPayload() {
    console.log("sendPayload() triggered!");

    let payload = document.getElementById("payload_select").value;
    if (!payload) {
        alert("No payload selected!");
        return;
    }

    fetch("send-payload.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "payload=" + encodeURIComponent(payload)
    })
    .then(response => response.blob())  // Expect binary file
    .then(blob => {
        console.log("Payload sent successfully!");
        alert("Payload Sent!");
    })
    .catch(error => {
        console.error("Error sending payload:", error);
        alert("Error sending payload!");
    });
}