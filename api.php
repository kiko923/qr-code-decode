<?php
require __DIR__ . '/vendor/autoload.php';

use Zxing\QrReader;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(['code'=>0,'msg' => '文件上传无效'],448);
        exit;
    }

    $file = $_FILES['file']['tmp_name'];
    
    $qrcode = new QrReader($file);
    $text = $qrcode->text();

    if ($text === null) {
        echo json_encode(['code'=>0,'msg' => '解码二维码失败'],448);
    } else {
        echo json_encode(['code'=>200,'link' => $text],448);
    }
} else {
    echo json_encode(['code'=>0,'msg' => '无效的请求方法'],448);
}
