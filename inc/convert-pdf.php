<?php
	if ( 0 < $_FILES['file']['error'] ) {
		echo 'Error: ' . $_FILES['file']['error'] . '<br>';
	} else {
		$moved = move_uploaded_file($_FILES['file']['tmp_name'], dirname(__FILE__) .'/uploads/' . $_FILES['file']['name']);
		if( $moved ){
			$result = shell_exec( dirname(__FILE__) . '/convert-pdf.sh '. $_FILES['file']['name'] .' converted-' . $_FILES['file']['name']);
			echo 'converted-' . $_FILES['file']['name'];
		}else{
	        // echo 'Something goes wrong';
		}
	}
exit;