<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width-device-width, initial-scale-1.0">

 <!-- correcto --> 
	<link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet" media="screen">
	<link href="<?= base_url('css/bootstrap-responsive.min.css') ?>" rel="stylesheet">
	<link href="<?= base_url('css/docs.css') ?>" rel="stylesheet">
  <link href="<?= base_url('css/datepicker.css') ?>" rel="stylesheet">


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>




<!-- correcto -->
<script src="<?= base_url('js/jquery-ui.js') ?>"></script>
<script src="<?= base_url('js/jquery.js') ?>"></script>


<script src="<?= base_url('js/bootstrap-datepicker.js') ?>"></script>





	<title>Bienvenido</title>
</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar" style="">

<!-- BARRA NAVBAR -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">Bienvenido <?= $this->session->userdata('nombre');?></a>
        <!--<a class="brand" href="#" <?= $titulo ?>></a> -->
          <div class="nav-collapse collapse">
            <ul class="nav">
              	<?= menu_navbar(); ?>
            </ul>
          </div>
        </div>
      </div>
    </div>


<div class="container">

	<div class="alert alert-success bs-alert-old-docs">
      <center><strong>&copy;</strong>Universidad de Valparaíso </center>
    </div>

  <div class="row">
    <div class="span3 bs-docs-sidebar">
    	<ul class="nav nav-list bs-docs-sidenav">
          <li><a>Bienvenido <?= $this->session->userdata('nombre'); ?></a></li>
          <?= menu_var_administrador(); ?>
         
      </ul>
    </div>
    <div class="span9">
      <?= $this->load->view($contenido); ?>
  	</div>
  </div>
  <hr>

</div>

<!-- Footer
    ================================================== -->
    <footer class="footer" >
      <div class="container">
        <p>Design based Codeigniter - bootstrap Twitter</p>
        <p>Code licensed under <a href="http://www.apache.org/licenses/LICENSE-2.0" target="_blank">Apache License v2.0</a></p>
      </div>
    </footer>



 



<script>
  if (top.location != location) {
    top.location.href = document.location.href ;
  }
    $(function(){
      window.prettyPrint && prettyPrint();
      $('#dp1').datepicker({
        format: 'dd/mm/yyyy'
      });
      $('#dp2').datepicker();
      $('#dp3').datepicker();
      $('#dp3').datepicker();
      $('#dpYears').datepicker();
      $('#dpMonths').datepicker();
      
      
      var startDate = new Date(2012,1,20);
      var endDate = new Date(2012,1,25);
      $('#dp4').datepicker()
        .on('changeDate', function(ev){
          if (ev.date.valueOf() > endDate.valueOf()){
            $('#alert').show().find('strong').text('The start date can not be greater then the end date');
          } else {
            $('#alert').hide();
            startDate = new Date(ev.date);
            $('#startDate').text($('#dp4').data('date'));
          }
          $('#dp4').datepicker('hide');
        });
      $('#dp5').datepicker()
        .on('changeDate', function(ev){
          if (ev.date.valueOf() < startDate.valueOf()){
            $('#alert').show().find('strong').text('The end date can not be less then the start date');
          } else {
            $('#alert').hide();
            endDate = new Date(ev.date);
            $('#endDate').text($('#dp5').data('date'));
          }
          $('#dp5').datepicker('hide');
        });

        // disabling dates
        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

        var checkin = $('#dpd1').datepicker({
          onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
          }
        }).on('changeDate', function(ev) {
          if (ev.date.valueOf() > checkout.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            checkout.setValue(newDate);
          }
          checkin.hide();
          $('#dpd2')[0].focus();
        }).data('datepicker');
        var checkout = $('#dpd2').datepicker({
          onRender: function(date) {
            return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
          }
        }).on('changeDate', function(ev) {
          checkout.hide();
        }).data('datepicker');
    });
  </script>

</body>
</html>