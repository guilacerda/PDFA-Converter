(function ($) {
	/**
	 * Aguarda o completo carregamento do documento e inicia a aplicação
	 *
	 */
	$(document).ready(function () {
    	app.init();
    });

    var app = {
        init: function () {

        	$(document).on('change', '#pdf-file', function(){
        		if( $(this).val().replace(/^.*\./, '') === 'pdf' ){
        			$('#convert-pdf').removeClass('red darken-4').addClass('green darken-1').text('Converter PDF!');
        			$('.warning-msg').addClass('hidden');
        		} else {
        			$('#convert-pdf').removeClass('green darken-1').addClass('red darken-4').text('Selecione um PDF');
					$('.warning-msg').removeClass('hidden');
        		}
        	});

	        $(document).on('click', '#download-converted-pdf', function() {
	        	$.fileDownload($(this).prop('href'))
	        		.done(function () { 
				        $('#download-converted-pdf')
				        	.removeClass('teal darken-3')
				        	.addClass('red darken-4')
				        	.text('Download agora!')
				    		.hide();
						$('#convert-pdf').show();

						app.postDownloadProcess( $('#download-converted-pdf').data('download') );
	        		})
	        		.fail(function () { 
	        			console.error('File download failed!'); 
	        		});
	        	return false;
	        });

            $('#convert-pdf').on('click', function(e){
            	e.preventDefault();

	            var file_name = $('#pdf-file').val(),
	            	file_data = $('#pdf-file').prop('files')[0],
                	form_data = new FormData(),
                	extension = file_name.replace(/^.*\./, '');
                
                form_data.append('file', file_data);

                if( extension === 'pdf' ){
                	$('.warning-msg').addClass('hidden');
                	$('.file-path-wrapper > input').removeClass('invalid').addClass('valid');

	                $.ajax({
	                    url: 'inc/convert-pdf.php',
	                    dataType: 'text',
	                    cache: false,
	                    contentType: false,
	                    processData: false,
	                    data: form_data,                         
	                    type: 'POST',
	                    beforeSend: function(php_script_response){
	                    	$('#convert-pdf').hide();
	                    	$('#download-converted-pdf')
	                    		.removeClass('red darken-4')
	                    		.addClass('orange darken-4')
	                    		.text('Processando, aguarde...')
	                    		.show();
	                    },
	                    success: function(php_script_response){
	                        $('#download-converted-pdf')
	                        	.removeClass('orange darken-4')
	                        	.addClass('teal darken-3')
	                        	.text('Baixando')
		                        .attr({
		                        	'href': 'inc/download-pdfa.php?filename='+php_script_response,
		                        	'data-download': 'converted-' + file_data.name
		                        });

                            document.getElementById('download-converted-pdf').click();
	                    }
	                 });
                } else {
                	$('.warning-msg').removeClass('hidden');
                	$('.file-path-wrapper > input').removeClass('valid').addClass('invalid');
                	console.error( 'A extensão do arquivo não parece ser do tipo PDF;', 'Arquivo do tipo: ', extension.toUpperCase() );
                }

            });
        },

        postDownloadProcess: function (filename) {
			$.post( 'inc/delete-pdf.php', { deleteFile: filename } );
        }
    };
})(jQuery);