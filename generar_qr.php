<?php
include "phpqrcode/qrlib.php"; // Ajusta la ruta según la ubicación de phpqrcode

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdfUrl = $_POST['pdfUrl'];
    $qrCodePath = 'ruta/del/qr/codes/' . uniqid() . '.png'; // Ajusta la ruta según tus necesidades

    QRcode::png($pdfUrl, $qrCodePath, QR_ECLEVEL_L, 10);

    echo $qrCodePath;
}
