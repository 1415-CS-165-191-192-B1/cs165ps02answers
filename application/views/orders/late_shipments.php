<div class="ui breadcrumb">
  <a class="section">Orders</a>
  <i class="right arrow icon divider"></i>
  <a class="section">Late Shipments</a>
</div>

<h2 class="ui header">
  Late Shipments
  <div class="sub header">Late Shipments by Employee</div>
</h2>

<?php
  $attributes = array(
    'class' => 'ui small form segment',
    'method' => 'GET',
  );
  echo form_open('orders/late_shipments', $attributes);
?>

  <div class="ui error message">
    <div class="header">We noticed some issues</div>
  </div>
  <div class="ui two fields">
    <div class="inline field">
      <label>Last Name</label>
      <div class="ui left labeled icon input">
        <input id="last-name" name="lastName" placeholder="Enter Last Name..."
        type="text"/>
        <i class="user icon"></i>
      </div>
    </div>
    <div class="inline field">
      <label>First Name</label>
      <div class="ui input">
        <input id="first-name" name="firstName"
        placeholder="Enter First Name..." type="text"/>
      </div>
    </div>
  </div>
  <input class="ui submit button inline field" type="submit"
  value="View Late Shipments"/>

<?php echo form_close(); ?>

<?php
  if (isset($caption)) {
    echo heading($caption, 3, 'class="ui header"');
  }
  if (isset($result)) {
    echo $result;
  }
