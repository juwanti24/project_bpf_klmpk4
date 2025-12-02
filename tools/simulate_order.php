<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

// bootstrap the framework
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Http\Request;

// create a POST request like the form would send
$request = Request::create('/pesan/simpan', 'POST', [
    'menu_id' => 1,
    'jumlah' => 2,
    'catatan' => 'Simulated order',
]);

// bind the request into the container so helpers like session() work
$app->instance('request', $request);

try {
    $controller = $app->make(App\Http\Controllers\PesananController::class);
    $response = $controller->simpan($request);
    echo "Controller returned: ";
    if (is_string($response)) {
        echo $response . PHP_EOL;
    } elseif ($response instanceof Illuminate\Http\RedirectResponse) {
        echo "Redirect to " . $response->getTargetUrl() . PHP_EOL;
    } else {
        var_export($response);
        echo PHP_EOL;
    }
} catch (Throwable $e) {
    echo "Exception: " . get_class($e) . ': ' . $e->getMessage() . PHP_EOL;
    echo $e->getTraceAsString() . PHP_EOL;
}
