<?php
require_once 'app.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Load Env</title>
    <!-- TailwindCSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <main class="container mx-auto p-4">
        <h1 class="text-2xl mb-4">Environment Variable Example</h1>
        <section class="mt-6 bg-gray-100 p-4 rounded">
            <h2 class="text-xl mb-2">API Information</h2>
            <div class="mb-2">
                <span class="font-bold">API Key:</span>
                <span class=""><?= API_KEY ?></span>
            </div>
        </section>
        <section class="mt-6 bg-gray-100 p-4 rounded">
            <h2 class="text-xl mb-2">Database Information</h2>
            <div class="mb-2">
                <span class="font-bold">DB Host:</span>
                <span class=""><?= DB_HOST ?></span>
            </div>
            <div class="mb-2">
                <span class="font-bold">Name:</span>
                <span class=""><?= DB_NAME ?></span>
            </div>
            <div class="mb-2">
                <span class="font-bold">User:</span>
                <span class=""><?= DB_USER ?></span>
            </div>
            <div class="mb-2">
                <span class="font-bold">Password:</span>
                <span class=""><?= DB_PASSWORD ?></span>
            </div>
        </section>
    </main>
</body>

</html>