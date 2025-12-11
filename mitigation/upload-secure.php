<?php
// Secure File Upload Handler (Educational Example)
// Validates MIME, sanitizes, and stores outside web root

$upload_dir = '/var/uploads/';  // Outside web root
$allowed_types = ['image/jpeg', 'image/png'];
$max_size = 2 * 1024 * 1024;  // 2MB

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    
    // 1. Size check
    if ($file['size'] > $max_size) {
        die('File too large.');
    }
    
    // 2. MIME validation
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    
    if (!in_array($mime, $allowed_types)) {
        die('Invalid file type.');
    }
    
    // 3. Sanitize (resize to strip payloads)
    $img = imagecreatefromjpeg($file['tmp_name']);
    $sanitized = 'sanitized_' . basename($file['name']);
    imagejpeg($img, $upload_dir . $sanitized, 90);  // Strips metadata
    
    echo "Upload successful: $sanitized";
} else {
    // HTML form
    echo '<form method="post" enctype="multipart/form-data">
            <input type="file" name="file" accept="image/*">
            <input type="submit">
          </form>';
}
?>
