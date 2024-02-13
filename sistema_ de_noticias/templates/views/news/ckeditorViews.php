<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo CSS . 'dashboard.css?v7' ?>">
  <title>Document</title>
</head>
<body>

<form action="">
  <textarea class="editor" cols="30" rows="10" name="editor" style="" id="editor"></textarea>
</form>


<script src="<?php echo JS . 'ckeditor/build/ckeditor.js'; ?>"></script>
<script>
   ClassicEditor
	.create( document.querySelector( '.editor' ), {
		// Editor configuration.
	} )
	.then( editor => {
		window.editor = editor;
	} )
	.catch( handleSampleError );

function handleSampleError( error ) {
	const issueUrl = 'https://github.com/ckeditor/ckeditor5/issues';

	const message = [
		'Oops, something went wrong!',
		`Please, report the following error on ${ issueUrl } with the build id "e0yemldow9z8-nohdljl880ze" and the error stack trace:`
	].join( '\n' );

	console.error( message );
	console.error( error );
}

</script>

