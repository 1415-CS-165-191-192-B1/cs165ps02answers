<div class="ui breadcrumb">
  <a class="section">Orders</a>
  <i class="right arrow icon divider"></i>
  <a class="section">Orders Not Yet Shipped</a>
</div>

<h2 class="ui header">
  Orders Not Yet Shipped
  <div class="sub header">Orders not yet shipped by given cut-off date</div>
</h2>

<?php
  $attributes = array(
    'class' => 'ui small form segment',
    'method' => 'GET',
  );
  echo form_open('orders/not_yet_shipped', $attributes);
?>

  <div class="ui error message">
    <div class="header">We noticed some issues</div>
  </div>
  <div class="ui two fields">
    <div class="inline field">
      <label>Cutoff</label>
      <div class="ui left labeled icon input">
        <input id="cutoff" name="cutoff" placeholder="Enter Cutoff Date..."
        type="text"/>
        <i class="calendar icon"></i>
      </div>
    </div>
    <input class="ui submit button inline field" type="submit"
    value="View Orders Not Yet Shipped"/>
  </div>

<?php echo form_close(); ?>

<?php
  if (isset($caption)) {
    echo heading($caption, 3, 'class="ui header"');
  }
  if (isset($result)) {
    echo $result;
  }
