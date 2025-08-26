<?php
$destino = __DIR__ . '/public/storage';

function eliminarTodo($ruta) {
    if (!file_exists($ruta)) return;
    if (is_file($ruta) || is_link($ruta)) {
        unlink($ruta);
    } else {
        $archivos = array_diff(scandir($ruta), ['.', '..']);
        foreach ($archivos as $archivo) {
            eliminarTodo($ruta . '/' . $archivo);
        }
        rmdir($ruta);
    }
}

if (file_exists($destino)) {
    eliminarTodo($destino);
    echo "✅ Carpeta 'public/storage' eliminada correctamente.";
} else {
    echo "ℹ️ La carpeta 'public/storage' no existe.";
}
?>

