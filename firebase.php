
<?php

require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Factory;


$storage = (new Factory())
->withServiceAccount('ecommerceuploads-firebase-adminsdk-yl1a2-7e99a4e8d5.json')
    ->withDefaultStorageBucket('ecommerceuploads.appspot.com/files')
    ->createStorage();

    $bucket = $storage->getBucket();
?>