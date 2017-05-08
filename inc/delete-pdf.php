<?php
// Delete file converted and original
$chmoding = @chmod( dirname(__FILE__) . '/uploads/' . $_POST['deleteFile'], 0777 );
$chmoding = @chmod( dirname(__FILE__) . '/uploads/' . str_replace('converted-', '', $_POST['deleteFile']), 0777 );
$deleting = @unlink(  dirname(__FILE__) . '/uploads/' . $_POST['deleteFile'] );
$deleting = @unlink(  dirname(__FILE__) . '/uploads/' . str_replace('converted-', '', $_POST['deleteFile']) );
// var_dump($chmoding, $deleting);

exit();