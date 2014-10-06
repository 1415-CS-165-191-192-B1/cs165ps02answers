<div class="ui breadcrumb">
  <a class="section">Sales</a>
  <i class="right arrow icon divider"></i>
  <a class="section">Summary of Sales</a>
</div>

<h2 class="ui header">
  Summary of Sales
  <div class="sub header">Summary of Product Sales given a date range.</div>
</h2>

<?php
  $attributes = array(
    'class' => 'ui small form segment',
    'method' => 'GET',
  );
  echo form_open('sales/summary', $attributes);
?>

  <div class="ui error message">
    <div class="header">We noticed some issues</div>
  </div>
  <div class="ui two fields">
    <div class="inline field">
      <label>Start Date</label>
      <div class="ui left labeled icon input">
        <input id="start-date" name="start" placeholder="Enter Start Date..."
        type="text"/>
        <i class="calendar icon"></i>
      </div>
    </div>
    <div class="inline field">
      <label>End Date</label>
      <div class="ui left labeled icon input">
        <input id="end-date" name="end" placeholder="Enter End Date..."
        type="text"/>
        <i class="calendar icon"></i>
      </div>
    </div>
  </div>
  <input class="ui submit button inline field" type="submit"
  value="View Summary"/>

<?php echo form_close(); ?>

<?php
  if (isset($caption)) {
    echo heading($caption, 3, 'class="ui header"');
  }
  if (isset($result)) {
    echo $result;
  }
