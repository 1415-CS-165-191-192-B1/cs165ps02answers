<div class="ui breadcrumb">
  <a class="section">Employees</a>
  <i class="right arrow icon divider"></i>
  <a class="section">Rank</a>
</div>

<h2 class="ui header">
  Rank of Employees by Year
  <div class="sub header">Ranking of Employees by Sales for a given Year</div>
</h2>

<?php
  $attributes = array(
    'class' => 'ui small form segment',
    'method' => 'GET',
  );
  echo form_open('employees/rank', $attributes);
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
    <input class="ui submit button field" type="submit"
    value="View Ranking"/>
  </div>

<?php echo form_close(); ?>

<?php
  if (isset($caption)) {
    echo heading($caption, 3, 'class="ui header"');
  }
  if (isset($result)) {
    echo $result;
  }
