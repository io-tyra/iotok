<?php
// 1. Define tu Token Secreto (DEBE COINCIDIR EXACTAMENTE con el de Meta)
$VERIFY_TOKEN = "a936bcb0b877e8c8dc05640cf1a82838";

// 2. Verifica que sea una petición GET (para la verificación)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    // Obtener los parámetros enviados por Meta
    $mode = $_GET['hub_mode'];
    $token = $_GET['hub_verify_token'];
    $challenge = $_GET['hub_challenge'];
    
    // 3. Comprobar que los parámetros sean válidos
    if ($mode === 'subscribe' && $token === $VERIFY_TOKEN) {
        
        // 4. Devolver el desafío
        http_response_code(200); // Código de éxito
        echo $challenge; // ESTO ES LA RESPUESTA CRÍTICA
        exit;
    } else {
        // Token o modo incorrecto
        http_response_code(403); 
        echo "Forbidden";
        exit;
    }
}
// Si no es un GET, puedes manejar las notificaciones POST aquí.
?>