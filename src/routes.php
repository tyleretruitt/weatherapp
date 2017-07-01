<?php
// Routes

$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->get('/forecast/[{zipCode}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/forecast' route");

    $zipCode = $request->getAttribute('zipCode');
    
    $data = file_get_contents("http://api.openweathermap.org/data/2.5/weather?zip=$zipCode&APPID=9bc48743268143ac3107d78b31282339&units=imperial");
    
    $response
        ->withHeader('Access-Control-Allow-Origin', 'http://weatherapp.trucoding.com')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->getBody()->write("$data");

    return $response;
})

?>