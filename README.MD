# Icecast streamer
Icecast-streamer is library for streaming mp3 to icecast.

## Example of stream
```php
require_once __DIR__ . '/vendor/autoload.php';

use IcecastStreamer\Stream;
use IcecastStreamer\Stream\MountPoint;
use IcecastStreamer\Stream\Connection;
use IcecastStreamer\Stream\AuthCredentials;
use IcecastStreamer\Stream\Info;

$mountPoint = new MountPoint('/live', new AuthCredentials('source', 'hackme'));
$connection = new Connection('localhost', 8000, $mountPoint);
$info = new Info();
$info->setContentType('audio/mpeg');
$info->setName('Super cool stream');
$info->setDescription('My first stream');
$info->setGenre('drum and base');
$info->setUrl('http://leequix.xyz');
$stream = new Stream($connection, $info);

try {
    $stream->start();
} catch (Exception $exception) {
    echo $exception->getMessage();
}

$file = fopen('./imperial_march.mp3', 'r');

while ($data = fread($file, 24567)) {
    $stream->write($data);
    echo ('[' . date('H:i:s') . '] I am send ' . strlen($data) . ' bytes of data!' . PHP_EOL);
    sleep(1);
}

fclose($file);
$stream->stop();
```
The documentation is in the *docs* directory.