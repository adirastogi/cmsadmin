<html>
<head>
	<title>Editor</title>
	<script type="text/javascript" src="http://localhost/wwwroot/cmsadmin/ckeditor/ckeditor.js"></script>
</head>
<body>
	<form method="post" action="http://localhost/wwwroot/cmsadmin/process.php?op=2&id=0">
		<p>
			<br />
			<textarea name="editor">
			
			</textarea>
			<script type="text/javascript">
				CKEDITOR.replace( 'editor',
					{
						fullPage : true
					});
			</script>
		</p>
		<p>
			<input type="submit" value="Save" name="save"/>
            <input type="submit" value="Discard" name="disc"/>
		</p>
	</form>
</body>
</html>