<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$controller = app()->make(App\Http\Controllers\Admin\AnggotaController::class);
$response = $controller->dataTable();

echo $response->getContent();
