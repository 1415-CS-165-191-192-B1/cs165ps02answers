<div id="menu-items" class="ui vertical menu accordion fluid">
  <div class="item title">
    Employees
    <i class="dropdown icon"></i>
  </div>
  <ul class="ui vertical menu content fluid">
    <li class="item">
      <?php echo anchor('employees/all', 'All Employees'); ?></li>
    <li class="item">
      <?php echo anchor('employees/biggest_sale', 'Biggest Sale'); ?></li>
    <li class="item">
      <?php echo anchor('employees/rank', 'Rank by Year'); ?></li>
  </ul>
  <div class="item title">
    Orders
    <i class="dropdown icon"></i>
  </div>
  <ul class="ui vertical menu content fluid">
    <li class="item">
      <?php echo anchor('orders/not_yet_shipped', 'Not Yet Shipped'); ?></li>
    <li class="item">
      <?php echo anchor('orders/freight_cost', 'Freight Cost Summary'); ?></li>
    <li class="item">
      <?php echo anchor('orders/shipment_summary', 'Shipment Summary'); ?></li>
    <li class="item">
      <?php echo anchor('orders/late_shipments', 'Late Shipments'); ?></li>
    <li class="item">
      <?php echo anchor('orders/latest_orders', 'Latest Orders'); ?></li>
  </ul>
  <div class="item title">
    Partners
    <i class="dropdown icon"></i>
  </div>
  <ul class="ui vertical menu content fluid">
    <li class="item">
      <?php echo anchor('partners/customer_rank', 'Customer Ranking'); ?></li>
    <li class="item">
      <?php echo anchor('partners/summary', 'All Partners'); ?></li>
  </ul>
  <div class="item title">
    Products
    <i class="dropdown icon"></i>
  </div>
  <ul class="ui vertical menu content fluid">
    <li class="item">
      <?php echo anchor('products/quota_sales', 'Quota Sales'); ?></li>
    <li class="item">
      <?php
        echo anchor('products/category_summary', 'Summary of Categories'); ?>
    </li>
    <li class="item">
      <?php echo anchor('products/supplied', 'Products still Supplied'); ?>
    </li>
    <li class="item">
      <?php
        echo anchor('products/below_reorder', 'Products below Reorder Level');
      ?>
    </li>
    <li class="item">
      <?php echo anchor('products/discontinued', 'Discontinued Products'); ?>
    </li>
  </ul>
  <div class="item title">
    Sales
    <i class="dropdown icon"></i>
  </div>
  <ul class="ui vertical menu content fluid">
    <li class="item"><?php echo anchor('sales/monthly', 'Monthly Sales'); ?>
    </li>
    <li class="item">
      <?php echo anchor('sales/view_sales', 'Sales by Employee'); ?></li>
    <li class="item"><?php echo anchor('sales/Summary', 'Summary of Sales'); ?>
    </li>
  </ul>
</div>
