#php qr decoder 
> php识别二维码, 不需要安装扩展 从哪里弄来的我也忘了，毕竟好几年了

### 安装
`composer require zxing/qr-reader`

### 使用
```
include __DIR__.'/vendor/autoload.php';

$qrcode = new \Zxing\QrReader('./qr.png');  //图片路径
$text = $qrcode->text(); //返回识别后的文本
echo $text;
```

### API接口使用
```
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
```


### 需要
```
PHP >= 5.3
GD Library
```
