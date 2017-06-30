<?php
	if ( 0 < $_FILES['file']['error'] ) {
		echo 'Error: ' . $_FILES['file']['error'] . '<br>';
	} else {
		$filename = str_replace( ' ', '-', strtolower($_FILES['file']['name'] ) );
		$moved = move_uploaded_file( $_FILES['file']['tmp_name'], dirname(__FILE__) .'/uploads/' . $filename ) ;
		if( $moved ){
			if( $_POST['ocr-enabled'] ){
				// echo dirname(__FILE__) . '/convert-pdf.sh '. $filename .' converted-' . $filename;
				$result = shell_exec( dirname(__FILE__) . '/ocr.sh '. 'uploads/' .$filename );
				// var_dump($result, $result2);
			} else {
				$result = shell_exec( dirname(__FILE__) . '/convert-pdf.sh '. $filename .' converted-' . $filename );
			}
			$do_chmod = shell_exec( 'chmod 777 -R uploads/' );
			echo 'converted-' . $filename;
			// var_dump($result);
		}else{
	        // echo 'Something goes wrong';
		}
	}
exit;