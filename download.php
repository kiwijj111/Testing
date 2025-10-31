<?php
if (isset($_GET['file'])) {
    $file = $_GET['file'];

    // Secure the file path (prevent directory traversal)
    $filePath = __DIR__ . "/Uploadfiles/" . basename($file);

    if (file_exists($filePath)) {
        // Set headers to force download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        flush();
        readfile($filePath);
        exit;
    } else {
        echo "File not found.";
    }
}
?>
