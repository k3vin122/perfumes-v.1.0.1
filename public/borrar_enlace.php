<?php
$path = __DIR__ . '/storage';

// Si es enlace simbólico o carpeta normal, intenta eliminarlo
if (is_link($path)) {
    unlink($path);
    echo "✅ Enlace simbólico eliminado.";
} elseif (is_dir($path)) {
    echo "⚠️ La carpeta '/public/storage' existe como carpeta normal. Elimínala manualmente por FTP o cPanel.";
} else {
    echo "ℹ️ No existe ningún enlace ni carpeta en '/public/storage'.";
}
?>
