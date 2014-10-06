<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css"
      href="<?php echo base_url('/packaged/css/semantic.css'); ?>">
    <link rel="stylesheet" type="text/css"
      href="<?php echo base_url('/packaged/css/ui.css'); ?>">

    <link rel="stylesheet" type="text/css"
      href="<?php echo base_url('/packaged/jquery-ui-1.11.1.custom/jquery-ui.min.css'); ?>">
    <link rel="stylesheet" type="text/css"
      href="<?php echo base_url('/packaged/jquery-ui-1.11.1.custom/jquery-ui.structure.min.css'); ?>">
    <link rel="stylesheet" type="text/css"
      href="<?php echo base_url('/packaged/jquery-ui-1.11.1.custom/jquery-ui.theme.min.css'); ?>">


    <script src=
      "<?php echo base_url('/packaged/javascript/jquery-1.10.2.min.js'); ?>">
    </script>
    <script src=
      "<?php echo base_url('/packaged/jquery-ui-1.11.1.custom/jquery-ui.min.js'); ?>">
    </script>

    <script src="<?php echo base_url('/packaged/javascript/semantic.js'); ?>">
    </script>
    <script src="<?php echo base_url('/packaged/javascript/ui.js'); ?>">
    </script>

    <title><?php echo $title; ?> - CS 165 Problem Set 2</title>

  </head>
  <body>

    <h1 class="ui huge block dividing header">
      NorthWind Database
      <div class="sub header">CS 165 Problem Set 2</div>
    </h1>

    <div class="ui grid">
      <div class="four wide column">
        <?php $this->load->view('templates/sidebar'); ?>
      </div>
      <div class="twelve wide column">
        <?php echo $body; ?>
      </div>
  </body>
</html>
