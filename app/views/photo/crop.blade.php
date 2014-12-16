<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">


	<style type="text/css">
	body
	{
		padding-top: 20px;
	}
	</style>
    <style>
      .cropit-image-preview {
        background-color: #f8f8f8;
        background-size: cover;
        border: 5px solid #ccc;
        border-radius: 3px;
        margin-top: 7px;
        width: 973px;
        height: 615px;
        cursor: move;
        margin: 0 auto;
      }

      .cropit-image-background {
        opacity: .2;
        cursor: auto;
      }

      .image-size-label {
        margin-top: 10px;
      }

      input {
        /* Use relative position to prevent from being covered by image background */
        position: relative;
        z-index: 10;
        display: block;
      }

      .export {
        margin-top: 10px;
      }
    </style>
</head>
<body>

	<div class="container">
		<div class="row">


			<div class="col-md-12">
				
			    <form method="post" role="form">
			      <div class="image-editor">
			      	<div class="form-group">
				        <input type="file" class="cropit-image-input form-control">
				    </div>
			        <div class="cropit-image-preview"></div>
			        <div class="image-size-label">
			          Resize image
			        </div>
			        <input type="range" class="cropit-image-zoom-input form-control">
			        <input type="hidden" name="image-data" class="hidden-image-data" />
			        <button type="submit" class="btn btn-primary">Submit</button>
			      </div>
			    </form>

			    <div id="result">
			      <code>$form.serialize() =</code>
			      <code id="result-data"></code>
			    </div>


			</div>
			
		</div>
	</div>


	<script type="text/javascript" src="{{ asset('jquery-1.11.1.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('cropit/jquery.cropit.min.js') }}"></script>
    <script>
      $(function() {
        $('.image-editor').cropit({
          type: 'image/jpeg',
          quality: .9,
          imageBackground: true,
          imageBackgroundBorderWidth: 20
        });

        $('.export').click(function() {
          var imageData = $('.image-editor').cropit('export');
          window.open(imageData);
        });

        $('form').submit(function() {
          // Move cropped image data to hidden input
          var imageData = $('.image-editor').cropit('export',{type: 'image/jpeg'});
          $('.hidden-image-data').val(imageData);

          // Print HTTP request params
          var formValue = $(this).serialize();
          $('#result-data').text(formValue);

          // Prevent the form from actually submitting
          return true;
        });
      });
    </script>
</body>
</html>
