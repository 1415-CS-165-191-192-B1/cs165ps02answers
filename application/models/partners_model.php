<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Partners_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  /*
  * Ranking of Customers by orders for a given year
  * * Given: year (e.g., 1995)
  * * Output: Customer ID, Company Name, Total Order Amount
  * * Customer ranking must be from highest to lowest order amount
  */
  function get_customer_ranking($year) {
    $query_string =
      'SELECT C."CustomerID" AS "Customer ID", C."CompanyName" AS "Customer",
              "TotalOrderAmount"
      FROM customers C NATURAL JOIN
          (SELECT O."CustomerID", SUM("OrderAmount") AS "TotalOrderAmount"
          FROM orders O NATURAL JOIN
              (SELECT OD."OrderID",
                  SUM(OD."UnitPrice" * (1 - OD."Discount") * OD."Quantity")
                  AS "OrderAmount"
              FROM Order_Details OD
              GROUP BY OD."OrderID") AS "OrderAmounts"
          WHERE EXTRACT(YEAR FROM O."OrderDate") = ?
          GROUP BY O."CustomerID") AS "CustomerOrderAmounts"
      ORDER BY "TotalOrderAmount" DESC';
    $customer_ranking = $this->db->query($query_string, array($year));
    return $customer_ranking;
  }

  /*
  * List of Customers and Suppliers based on a given country
  * * Given: Country
  * * Output: Company Name, City, Region,
  *   Relationship ("Customer" or "Supplier")
  */
  function get_all_partners($country) {
    $query_string =
      'SELECT "CompanyName" AS "Company Name", "City", "Region",
              $$Customer$$ AS "Relationship"
      FROM customers
      WHERE "Country" = ?
      UNION
      SELECT "CompanyName" AS "Company Name", "City", "Region",
              $$Supplier$$ AS "Relationship"
      FROM suppliers
      WHERE "Country" = ?';
    $all_partners = $this->db->query($query_string, array($country, $country));
    return $all_partners;
  }

  /*
  * Do not touch this function!!!
  */
  function get_country_options() {
    $query_string =
      'SELECT "Country"
      FROM (SELECT "Country" FROM customers
            UNION
            SELECT "Country" FROM suppliers) AS "All Countries"
      ORDER BY "Country"';
    $countries = $this->db->query($query_string);
    $countries = $countries->result_array();
    foreach ($countries as $country) {
      $country_options[$country["Country"]] = $country["Country"];
    }
    return $country_options;
  }

  /*
  * Do not touch this function!!!
  */
  function get_supplier_options() {
    $query_string =
      'SELECT "SupplierID", "CompanyName"
      FROM suppliers
      ORDER BY "SupplierID"';
    $suppliers = $this->db->query($query_string);
    $suppliers = $suppliers->result_array();
    foreach ($suppliers as $supplier) {
      $supplier_options[$supplier["SupplierID"]] = $supplier["CompanyName"];
    }
    return $supplier_options;
  }
}
