 
<!--
<div id="custom-content" class="white-popup-block" style="max-width:600px; margin: 20px auto;">
    <h1>HTML content, loaded via ajax</h1>
    <style>
    #custom-content img {max-width: 100%;margin-bottom: 10px;}
    </style>
    <p>This is dummy copy. It is not meant to be read. It has been placed here solely to demonstrate the look and feel of finished, typeset text. Only for show. He who searches for meaning here will be sorely disappointed.  These words are here to provide the reader with a basic impression of how actual text will appear in its final presentation. </p>
    <p>This is dummy copy. It's Greek to you. Unless, of course, you're Greek, in which case, it really makes no sense. Why, you can't even read it!  It is strictly for mock-ups. You may mock it up as strictly as you wish.</p>
  <img src="http://farm9.staticflickr.com/8242/8558295633_f34a55c1c6_b.jpg" />
  <img src="http://farm9.staticflickr.com/8382/8558295631_0f56c1284f_b.jpg" />
</div>

-->

<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width-device-width, initial-scale-1.0">

<!--
  <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet" media="screen">

  <link href="<?= base_url('css/bootstrap-responsive.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('css/docs.css') ?>" rel="stylesheet">

  <link href="<?= base_url('css/datepicker.css') ?>" rel="stylesheet">
-->



  <title>Bienvenido</title>
  </head>
  <body>



<form>
  <fieldset>  
    <legend></legend> 
  

        <div class="control-group">  
            <label class="control-label" for="input01">Identificador:</label>  
            <div class="controls">  
              <span class="uneditable-input">  <?= $identificador ?> </span>
            </div>  
        </div> 

        <div class="control-group">  
            <label class="control-label" for="input01">Nombre habilidad :</label>  
            <div class="controls">  
              <span class="uneditable-input">  <?= $query['nombre'] ?> </span>
            </div>  
        </div>

        <div class="control-group">  
            <label class="control-label" for="input01">Descripción :</label>  
            <div class="controls">  
              <span class="uneditable-input">  <?= $query['descripcion'] ?> </span>
            </div>  
        </div>



    </fieldset>  
</form>  



<script src="<?= base_url('js/jquery.js') ?>"></script>

<script src="<?= base_url('js/bootstrap-datepicker.js') ?>"></script>
  </body>
</html>  

