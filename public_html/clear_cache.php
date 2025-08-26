<?php
echo "<pre>";

// Lista de comandos Artisan a ejecutar
$commands = [
    'php artisan config:clear',
    'php artisan cache:clear',
    'php artisan route:clear',
    'php artisan view:clear'
];

foreach ($commands as $command) {
    echo "Ejecutando: $command\n";
    // Ejecutar comando y capturar salida y errores
    $output = null;
    $return_var = null;
    exec($command . ' 2>&1', $output, $return_var);
    foreach ($output as $line) {
        echo $line . "\n";
    }
    echo "Estado de salida: $return_var\n\n";
}

echo "✅ Cachés limpiadas (o intento realizado).";

echo "</pre>";
