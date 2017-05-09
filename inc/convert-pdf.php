<?php
	if ( 0 < $_FILES['file']['error'] ) {
		echo 'Error: ' . $_FILES['file']['error'] . '<br>';
	} else {
		$filename = str_replace( ' ', '-', strtolower($_FILES['file']['name'] ) );
		$moved = move_uploaded_file( $_FILES['file']['tmp_name'], dirname(__FILE__) .'/uploads/' . $filename ) ;
		if( $moved ){
			$result = shell_exec( dirname(__FILE__) . '/convert-pdf.sh '. $filename .' converted-' . $filename );
			// var_dump($result);
			echo 'converted-' . $filename;
		}else{
	        // echo 'Something goes wrong';
		}
	}
exit;