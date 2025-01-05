<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Backend logic untuk memproses permintaan
    header("Content-Type: application/json");

    $input = json_decode(file_get_contents("php://input"), true);
    $apiUrl = "https://api.wizconnected.com/path/to/control"; // Ganti dengan URL API Wiz
    $apiToken = "your-api-token-here"; // Ganti dengan API token Anda

    if (!$input || !isset($input['action'])) {
        echo json_encode(["error" => "Invalid request"]);
        http_response_code(400);
        exit;
    }

    $action = $input['action'];
    $value = isset($input['value']) ? $input['value'] : null;

    // Tentukan data yang akan dikirim ke API berdasarkan aksi
    $body = [];
    switch ($action) {
        case "on":
            $body = ["method" => "setPilot", "params" => ["state" => true]];
            break;
        case "off":
            $body = ["method" => "setPilot", "params" => ["state" => false]];
            break;
        case "brightness":
            $body = ["method" => "setPilot", "params" => ["dimming" => intval($value)]];
            break;
        case "color":
            $rgb = sscanf($value, "#%02x%02x%02x");
            $body = ["method" => "setPilot", "params" => ["r" => $rgb[0], "g" => $rgb[1], "b" => $rgb[2]]];
            break;
        default:
            echo json_encode(["error" => "Unknown action"]);
            http_response_code(400);
            exit;
    }

    // Kirim permintaan ke API menggunakan cURL
    $options = [
        CURLOPT_URL => $apiUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "Authorization: Bearer $apiToken"
        ],
        CURLOPT_POSTFIELDS => json_encode($body),
    ];

    $curl = curl_init();
    curl_setopt_array($curl, $options);

    $response = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    if ($httpCode >= 200 && $httpCode < 300) {
        echo $response;
    } else {
        echo json_encode(["error" => "Failed to control lamp", "details" => $response]);
        http_response_code($httpCode);
    }

    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wiz Connected Lamp Control</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .controls { margin: 10px 0; }
    </style>
</head>
<body>
    <h1>Control Lampu Wiz Connected</h1>
    <div class="controls">
        <button id="turnOn">Turn On</button>
        <button id="turnOff">Turn Off</button>
    </div>
    <div class="controls">
        <label for="brightness">Brightness:</label>
        <input type="range" id="brightness" min="1" max="100">
    </div>
    <div class="controls">
        <label for="color">Color:</label>
        <input type="color" id="color">
    </div>

    <script>
        const sendRequest = (data) => {
            fetch("wiz.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => console.log(data))
            .catch(error => console.error("Error:", error));
        };

        document.getElementById("turnOn").addEventListener("click", () => {
            sendRequest({ action: "on" });
        });

        document.getElementById("turnOff").addEventListener("click", () => {
            sendRequest({ action: "off" });
        });

        document.getElementById("brightness").addEventListener("input", (event) => {
            sendRequest({ action: "brightness", value: event.target.value });
        });

        document.getElementById("color").addEventListener("input", (event) => {
            sendRequest({ action: "color", value: event.target.value });
        });
    </script>
</body>
</html>
