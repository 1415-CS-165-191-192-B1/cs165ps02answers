<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  /*
  * Orders not yet shipped by given cut-off date
  * * Given: Cut-off Date
  * * Output: Order ID, Customer, Required Date, Shipped Date
  * * Note: Include all orders that are not yet shipped
  */
  function get_not_yet_shipped($cutoff) {
    $query_string =
      'SELECT O."OrderID", C."CompanyName" AS "Customer",
              O."RequiredDate" AS "Required Date",
              O."ShippedDate" AS "Shipped Date"
      FROM orders O NATURAL JOIN customers C
      WHERE (O."ShippedDate" > ? OR O."ShippedDate" IS NULL)
            AND O."OrderDate" <= ?';
    $biggest_sale = $this->db->query($query_string, array($cutoff,$cutoff));
    return $biggest_sale;
  }

  /*
  * Total Freight Cost Incurred for Delivery per City, Country
  * * Output: Country, City, Total Freight Cost
  * * Sort by Country
  */
  function get_freight_cost() {
    $query_string =
      'SELECT  "ShipCountry", "ShipCity",
        SUM("Freight") AS "Total Freight Cost"
      FROM orders
      GROUP BY "ShipCountry", "ShipCity"
      ORDER BY "ShipCountry", "ShipCity"';
    $freight_cost = $this->db->query($query_string);
    return $freight_cost;
  }

  /*
  * No. of Shipment per Country
  * * Output: Country, No. of Shipment (delivered orders)
  * * Sort alphabetically by Country
  */
  function get_shipment_summary() {
    $query_string =
      'SELECT  O."ShipCountry" AS "Country", COUNT(*) AS "No. of Shipment"
      FROM orders O
      WHERE O."ShippedDate" IS NOT NULL
      GROUP BY O."ShipCountry"
      ORDER BY O."ShipCountry"';
    $shipment_summary = $this->db->query($query_string);
    return $shipment_summary;
  }

  /*
  * Late shipment by Employee
  * * Given: Last Name, First Name
  * * Output: Order ID, Customer, Order Amount, Date Required, Ship Date
  */
  function get_late_shipments($lastName, $firstName) {
    $query_string =
      'SELECT O."OrderID" AS "Order ID", C."CompanyName" AS "Customer",
              "OrderAmount" AS "Order Amount",
              O."RequiredDate" AS "Date Required",
              O."ShippedDate" AS "Ship Date"
      FROM orders O NATURAL JOIN employees E
          JOIN customers C ON (O."CustomerID" = C."CustomerID")
          NATURAL JOIN (SELECT OD."OrderID",
                      SUM(OD."UnitPrice" * (1 - OD."Discount") * OD."Quantity")
                      AS "OrderAmount"
                      FROM order_details OD
                      GROUP BY OD."OrderID") AS "OrderAmounts"
      WHERE O."RequiredDate" < O."ShippedDate"
            AND E."LastName" = ? AND E."FirstName" = ?';
    $late_shipments = $this->db->query($query_string,
      array($lastName, $firstName));
    return $late_shipments;
  }

  /*
  * Latest Order per Customer
  * * Output: Customer, Order ID, Order Date, Ship Date (may be null)
  * * Sort by Order Date (from latest to earliest)
  */
  function get_latest_orders() {
    $query_string =
      'SELECT C."CompanyName" AS "Customer",
              O."OrderID" AS "Order ID",
              "max_orders"."OrderDate" AS "Order Date",
              O."ShippedDate" AS "Ship Date"
      FROM customers C NATURAL JOIN
          orders O JOIN
          (SELECT  O."CustomerID", MAX(O."OrderDate") as "OrderDate"
          FROM orders O
          GROUP BY O."CustomerID") AS "max_orders"
          ON ("max_orders"."CustomerID" = O."CustomerID" AND
          "max_orders"."OrderDate" = O."OrderDate")
      ORDER BY "Order Date" DESC';
    $latest_orders = $this->db->query($query_string);
    return $latest_orders;
  }

}
