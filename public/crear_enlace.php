<?php
$target = __DIR__ . '/storage/app/public';
$link = __DIR__ . '/public/storage';

if (file_exists($link)) {
    echo "⚠️ Ya existe algo en '/public/storage'. Bórralo primero.";
} else {
    if (symlink($target, $link)) {
        echo "✅ Enlace simbólico creado exitosamente.";
    } else {
        echo "❌ Error al crear el enlace simbólico. Posiblemente el servidor bloquea 'symlink()'.";
    }
}
?>
