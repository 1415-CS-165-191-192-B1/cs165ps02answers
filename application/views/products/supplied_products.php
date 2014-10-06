<div class="ui breadcrumb">
  <a class="section">Products</a>
  <i class="right arrow icon divider"></i>
  <a class="section">Supplied Products</a>
</div>

<h2 class="ui header">
  Products that are still Supplied
  <div class="sub header">Products Still Supplied by Supplier (products that
    are still available)</div>
</h2>

<?php
  $attributes = array(
    'class' => 'ui small form segment',
    'method' => 'GET',
  );
  echo form_open('products/supplied', $attributes);
?>

  <div class="ui error message">
    <div class="header">We noticed some issues</div>
  </div>
  <div class="ui two fields">
    <div class="inline field">
      <label>Supplier</label>
      <div class="ui left labeled icon input">
        <?php
          if (isset($selected)) {
            echo custom_form_dropdown('supplierid', $supplier_options,
            $selected, 'id="country" class="ui selection dropdown"',
            'class="item"');
          } else {
            echo custom_form_dropdown('supplierid', $supplier_options, '',
            'id="country" class="ui selection dropdown"', 'class="item"');
          }?>
        <i class="user icon"></i>
      </div>
    </div>
    <input class="ui submit button field" type="submit"
    value="Show Products"/>
  </div>

<?php echo form_close(); ?>

<?php
  if (isset($caption)) {
    echo heading($caption, 3, 'class="ui header"');
  }
  if (isset($result)) {
    echo $result;
  }
