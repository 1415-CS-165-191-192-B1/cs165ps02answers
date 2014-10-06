<div class="ui breadcrumb">
  <a class="section">Products</a>
  <i class="right arrow icon divider"></i>
  <a class="section">Quota Sales</a>
</div>

<h2 class="ui header">
  Quota Sales
  <div class="sub header">Products Exceeding Quota Sales for a given year</div>
</h2>

<?php
  $attributes = array(
    'class' => 'ui small form segment',
    'method' => 'GET',
  );
  echo form_open('products/quota_sales', $attributes);
?>

  <div class="ui error message">
    <div class="header">We noticed some issues</div>
  </div>
  <div class="ui two fields">
    <div class="inline field">
      <label>Year</label>
      <div class="ui left labeled icon input">
        <input id="year" name="year" placeholder="Enter Year" type="text"/>
        <i class="calendar icon"></i>
      </div>
    </div>
    <div class="inline field">
      <div class="ui left labeled icon input">
        <input id="quota" name="quota" placeholder="Enter Quota" type="text"/>
        <i class="money icon"></i>
      </div>
    </div>
  </div>
  <input class="ui submit button field" type="submit"
  value="View Products"/>

<?php echo form_close(); ?>

<?php
  if (isset($caption)) {
    echo heading($caption, 3, 'class="ui header"');
  }
  if (isset($result)) {
    echo $result;
  }
