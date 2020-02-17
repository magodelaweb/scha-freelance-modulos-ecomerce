<?php 
include "include/config_seguro.php";
$sql_contenido = db_query("SELECT * FROM contenido c, contenidodetalle d WHERE c.ccodcontenido=d.ccodcontenido and c.ccodcontenido = '" . $_GET['IDpro'] . "'");
while ($row_contenido = db_fetch_array($sql_contenido))
{
	$pageweb =	$row_contenido['ccodpage'];
}
?>
<script type="text/javascript">// <![CDATA[
$(document).ready(function() {
	
});


// ]]>
</script>



<!--form name="frm_galeria_new" method="post"  action="galeriafotos_new.php" enctype="multipart/form-data"-->
<input type="hidden" name="pagina" id="pagina" value="<?=$pageweb?>" />
<input type="hidden" name="selectpage" id="selectpage" value="<?=$pageweb?>" />
<input type="hidden" name="IDpro" id="IDpro" value="<?=$_GET['IDpro']?>">

<table border="0"  align="center" cellpadding="0" cellspacing="0" class="tableborderfull" >
	<tr>
		<td class='titulo'  colspan="2">
			<div class="formtitulo">Subir Fotos</div>
			<div class="formcerrar"><a href="<?=$retorno?>?IDpro=<?=$_GET['IDpro']?>"><img src="estilos/images/form_close.png" border="0" /></a></div>
		
		</td>
	</tr>
	<tr >
		<td class='colgrishome'  valign="top" align="right">Item</td>
		<td class='colgrisend' >&nbsp;
		</td>
	</tr>
		
	<tr>
		<td class='colgrishome'   valign="top" align="right">Archivos</td>
		<td class='colgrisend' valign="top">
			<div class="container" id="containerNewUpdate">
				<div id="actions" class="row">
					<div class="col-lg-7">
						<!-- The fileinput-button span is used to style the file input field as button -->
					<span class="btn btn-success fileinput-button dz-clickable">
						<i class="glyphicon glyphicon-plus"></i>
						<span>Add files...</span>
					</span>
						<button type="submit" class="btn btn-primary start">
							<i class="glyphicon glyphicon-upload"></i>
							<span>Start upload</span>
						</button>
					</div>

					<div class="col-lg-5">
						<!-- The global file processing state -->
					<span class="fileupload-process">
					<div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
						<div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress=""></div>
					</div>
					</span>
					</div>
				</div>
				<div class="table table-striped files" id="previews">
					<div id="template" class="file-row">
						<!-- This is used as the file preview template -->
						<div>
							<span class="preview"><img data-dz-thumbnail /></span>
						</div>
						<div>
							<p class="name" data-dz-name></p>
							<strong class="error text-danger" data-dz-errormessage></strong>
						</div>
						<div>
							<p class="size" data-dz-size></p>
							<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
								<div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
							</div>
						</div>
						<div>
							<button class="btn btn-primary start">
								<i class="glyphicon glyphicon-upload"></i>
								<span>Start</span>
							</button>
							<button data-dz-remove class="btn btn-warning cancel">
								<i class="glyphicon glyphicon-ban-circle"></i>
								<span>Cancel</span>
							</button>
						</div>
					</div>
				</div>
			</div>
      </td>
	</tr>
	<td  colspan="2" class='formpie' align="center" >
   	<!--input type="button" name="enviar" id="enviar"  value="enviar"/-->
	<input type="Button" value="Cerrar" onclick="javascript:window.location = '<?=$retorno?>?IDpro=<?=$_GET['IDpro']?>'" >	
	</td>
	</tr>
</table>
<!--/form-->
<script>
	$(document).on('ready', function () {
		var previewNode = document.querySelector("#template");
      	previewNode.id = "";
      	var previewTemplate = previewNode.parentNode.innerHTML;
      	previewNode.parentNode.removeChild(previewNode);

      	var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
			paramName: "Filedata",
			url: "galeriasupload.php", // Set the url
      		thumbnailWidth: 80,
      		thumbnailHeight: 80,
      		parallelUploads: 20,
      		previewTemplate: previewTemplate,
      		maxFilesize: 2,
      		autoQueue: false, // Make sure the files aren't queued until manually added
      		previewsContainer: "#previews", // Define the container to display the previews
      		clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
			init: function() {
				this.on("sending", function(file, xhr, formData) {
				var valuepagina = $('input[name=pagina]').val();
				var valueselectpage = $('input[name=selectpage]').val();
				var valueIDpro = $('input[name=IDpro]').val();
				//debugger;
				formData.append("selectpage", valueselectpage); // Append all the additional input data of your form here!
				formData.append("pagina", valuepagina);
				formData.append("item", valueIDpro);
				});
			},
      	});

      	myDropzone.on("addedfile", function(file) {
      		// Hookup the start button
      		file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); };
      	});

      	// Update the total progress bar
      	myDropzone.on("totaluploadprogress", function(progress) {
      		document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
      	});

      	myDropzone.on("sending", function(file) {
      		// Show the total progress bar when upload starts
      		document.querySelector("#total-progress").style.opacity = "1";
      		// And disable the start button
      		file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
      	});

      	// Hide the total progress bar when nothing's uploading anymore
      	myDropzone.on("queuecomplete", function(progress) {
      		document.querySelector("#total-progress").style.opacity = "0";
      	});

      	// Setup the buttons for all transfers
      	// The "add files" button doesn't need to be setup because the config
      	// `clickable` has already been specified.
      	document.querySelector("#actions .start").onclick = function() {
      		myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
      	};
	});
</script>