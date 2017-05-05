<?php
// var_dump( $_POST['deleteFiles'] );
// if( !$_POST['deleteFiles'] ):
	if ( 0 < $_FILES['file']['error'] ) {
		echo 'Error: ' . $_FILES['file']['error'] . '<br>';
	} else {
		$moved = move_uploaded_file($_FILES['file']['tmp_name'], dirname(__FILE__) .'/uploads/' . $_FILES['file']['name']);
		if( $moved ){
	        	// echo 'File: ' . $_FILES['file']['name'] . ' uploaded successfully.';
			$result = shell_exec( dirname(__FILE__) . '/convert-pdf.sh '. $_FILES['file']['name'] .' converted-' . $_FILES['file']['name']);
			echo 'inc/uploads/converted-' . $_FILES['file']['name'];
		}else{
	        // echo 'Something goes wrong';
		}
	}
// else:
	// Delete file if 404
	// @chmod( dirname(__FILE__) .'/uploads/converted-'. $_FILES['file']['name'], 0777 );
	// @unlink( dirname(__FILE__) .'/uploads/converted-'. $_FILES['file']['name'] );
// endif;

exit;