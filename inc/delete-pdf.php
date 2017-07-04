<?php
function scan_dir_for_old_files($dir) {
    $ignored = array('.', '..', '.gitkeep', '.htaccess');

    $files = array();    
    foreach (scandir($dir) as $file) {
        if (in_array($file, $ignored)) continue;
        $files[$file] = filemtime($dir . '/' . $file);

        $file_stats = stat($dir . '/' . $file);
        // Delete files older than 1 day
        if ( $file_stats[9] < ( time() - (43200 * 2) ) ) {
        	// echo "File: " . $file . "\n";
        	$chmoding = @chmod( $dir . '/' . $file, 0777 );
        	$deleting = @unlink(  $dir . '/' . $file );
        }

    }
    // var_dump($chmoding, $deleting);
}
scan_dir_for_old_files( dirname(__FILE__) . '/uploads/' );
exit();