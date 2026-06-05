<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

// Test 1: Homepage
$response1 = $kernel->handle(
    $request1 = \Illuminate\Http\Request::create('/', 'GET')
);
echo "Homepage Status: " . $response1->status() . "\n";

// Test 2: Category page (which binds Category model parameter)
$response2 = $kernel->handle(
    $request2 = \Illuminate\Http\Request::create('/kategori/rumah-primary-bintaro-jaya', 'GET')
);
echo "Category Page Status: " . $response2->status() . "\n";

if ($response2->status() === 200) {
    $content = $response2->content();
    // Check if JSON is printed or if we have the clean name instead
    if (strpos($content, '{"id":') !== false) {
        echo "WARNING: Raw JSON found in response!\n";
    } else {
        echo "SUCCESS: No raw JSON model serialization found in the rendered HTML!\n";
    }
}

$kernel->terminate($request1, $response1);
$kernel->terminate($request2, $response2);
