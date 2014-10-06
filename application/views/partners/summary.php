<div class="ui breadcrumb">
  <a class="section">Partners</a>
  <i class="right arrow icon divider"></i>
  <a class="section">All Partners</a>
</div>

<h2 class="ui header">
  All Partners
  <div class="sub header">List of Customers and Suppliers based on a given
    country</div>
</h2>

<?php
  $attributes = array(
    'class' => 'ui small form segment',
    'method' => 'GET',
  );
  echo form_open('partners/summary', $attributes);
?>

  <div class="ui error message">
    <div class="header">We noticed some issues</div>
  </div>
  <div class="ui two fields">
    <div class="inline field">
      <label>Country</label>
      <div class="ui left labeled icon input">
        <?php
          if (isset($selected)) {
            echo custom_form_dropdown('country', $country_options, $selected, 'id="country" class="ui selection dropdown"', 'class="item"');
          } else {
            echo custom_form_dropdown('country', $country_options, '', 'id="country" class="ui selection dropdown"', 'class="item"');
          }?>
        <i class="globe icon"></i>
      </div>
    </div>
    <input class="ui submit button field" type="submit"
    value="Show Partners"/>
  </div>

<?php echo form_close(); ?>

<?php
  if (isset($caption)) {
    echo heading($caption, 3, 'class="ui header"');
  }
  if (isset($result)) {
    echo $result;
  }
