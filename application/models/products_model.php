<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  /*
  * Products Exceeding Quota Sales for a given year
  * * Given: year (e.g., 1995), Quota Sales (amount)
  * * Output: Category, Product, Sales
  * * Sort by Category; for each Category sort product sales from highest to
  *   lowest sales
  */
  function get_quota_sales($year, $quota) {
    $query_string =
      'SELECT C."CategoryName", P."ProductName" AS "Product", "Quota Sales"
      FROM categories C NATURAL JOIN
          products P NATURAL JOIN
          (SELECT OD."ProductID",
                  SUM(OD."UnitPrice" * (1 - OD."Discount") * OD."Quantity") AS
                  "Quota Sales"
          FROM order_details OD NATURAL JOIN
              (SELECT O."OrderID"
                FROM orders O
                WHERE O."ShippedDate" IS NOT NULL AND
                      EXTRACT(YEAR FROM O."ShippedDate") = ?) AS
                      "ShippedOrders"
          GROUP BY OD."ProductID"
          HAVING (SUM(OD."UnitPrice" * (1 - OD."Discount") * OD."Quantity")
                  > ?)) AS "Products Exceeding Quota Sales"
      ORDER BY C."CategoryName" ASC, "Quota Sales" DESC';
    $quota_sales = $this->db->query($query_string, array($year, $quota));
    return $quota_sales;
  }

  /*
  * No. of Products Per Category and most expensive product Per Category
  * * Output: Category ID, Category Name, No. of Products, Product, Unit Price
  * * Sort by Unit Price (from highest to lowest)
  */
  function get_category_summary() {
    $query_string =
      'SELECT C."CategoryID" AS "Category ID",
              C."CategoryName" AS "Category Name",
              "Stats"."NumProducts" AS "No. of Products",
              P."ProductName" AS "Most Expensive Product",
              "Stats"."UnitPrice" AS "Unit Price"
      FROM Categories C NATURAL JOIN
          Products P JOIN
          (SELECT P."CategoryID", COUNT(*) AS "NumProducts", MAX(P."UnitPrice")
          AS "UnitPrice"
          FROM Products P
          GROUP BY P."CategoryID") AS "Stats" ON
            (P."CategoryID" = "Stats"."CategoryID" AND
            P."UnitPrice" = "Stats"."UnitPrice")
          ORDER BY "Unit Price" DESC';
    $category_summary = $this->db->query($query_string);
    return $category_summary;
  }

  /*
  * Products Still Supplied by Supplier (products that are still available)
  * * Given: Supplier ID
  * * Output: Product ID, Product Name, Category Name
  */
  function get_products_still_supplied($supplierid) {
    $query_string =
      'SELECT P."ProductID" AS "Product ID", P."ProductName" AS "Product Name",
              C."CategoryName" AS "Category Name"
        FROM Suppliers S NATURAL JOIN
              products P NATURAL JOIN
              categories C
        WHERE S."SupplierID" = ? AND
              P."Discontinued" = 0 AND
              P."UnitsInStock" > 0';
    $products_still_supplied = $this->db->query($query_string,
      array($supplierid));
    return $products_still_supplied;
  }

  /*
  * Products that have fallen below reorder level that have not yet been
  * reordered OR products that have fallen below reorder level but do NOT have
  * pending orders (i.e., there are no orders that are still for shipment)
  * * Output: Product, Supplier, Units in Stock, Reorder Level
  */
  function get_products_below_reorder_level() {
    $query_string =
      'SELECT P."ProductName" AS "Product", S."CompanyName" AS "Supplier",
              P."UnitsInStock" AS "Units In Stock",
              P."ReorderLevel" AS "Reorder Level"
        FROM products P NATURAL JOIN suppliers S
        WHERE P."UnitsInStock" < P."ReorderLevel" AND P."UnitsOnOrder" = 0
        UNION
      SELECT P."ProductName" AS "Product", S."CompanyName" AS "Supplier",
              P."UnitsInStock" AS "Units In Stock",
              P."ReorderLevel" AS "Reorder Level"
        FROM orders O NATURAL JOIN order_details OD NATURAL JOIN
            products P NATURAL JOIN suppliers S
        WHERE P."UnitsInStock" < P."ReorderLevel"
          AND O."ShippedDate" IS NULL';
    $products_below_reorder_level = $this->db->query($query_string);
    return $products_below_reorder_level;
  }

  /*
  * List of discontinued products
  * * Output: Category, Product, Supplier
  * * Sort by Category
  */
  function get_discontinued_products() {
    $query_string =
      'SELECT C."CategoryName" AS "Category", P."ProductName" AS "Products",
              S."CompanyName" AS "Supplier"
        FROM categories C NATURAL JOIN products P NATURAL JOIN suppliers S
        WHERE P."Discontinued" = 1
        ORDER BY "Category"';
    $discontinued_products = $this->db->query($query_string);
    return $discontinued_products;
  }
}
