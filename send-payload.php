<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $payload = $_POST["payload"] ?? "";
    $filePath = "payloads/" . basename($payload);
    
    if (!file_exists($filePath)) {
        http_response_code(404);
        die("Error: Payload not found!");
    }

    // Send payload to the PS4 via socket
    $ps4_ip = "127.0.0.1"; // Change to your PS4's actual IP!
    $ps4_port = 9090; // Default GoldHEN Bin Loader port

    $socket = fsockopen($ps4_ip, $ps4_port, $errno, $errstr, 5);
    if (!$socket) {
        die("Error: Could not connect to PS4 ($errno: $errstr)");
    }

    // Open the binary payload and send it
    $payloadData = file_get_contents($filePath);
    fwrite($socket, $payloadData);
    fclose($socket);

    echo "Payload sent successfully!";
} else {
    die("Invalid request!");
}
?>
