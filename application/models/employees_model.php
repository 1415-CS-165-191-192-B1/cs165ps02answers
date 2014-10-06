<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employees_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  /*
  * List of Employees and who they report to.
  * * Output: Employee, Reports To (Employee they report to)
  */
  function get_all_employees() {
    $query_string =
    'SELECT E."LastName" || $$, $$ || E."FirstName" AS "Name",
            R."LastName" || $$, $$ || R."FirstName" AS "Reports To"
    FROM Employees E LEFT OUTER JOIN
          Employees R ON (E."ReportsTo" = R."EmployeeID")';

    $all_employees = $this->db->query($query_string);
    return $all_employees;
  }

  /*
  * Biggest Sale per Employee
  * * Output: Employee, Order ID, Customer, Order Amount, Order Date, Ship Date
  * * Clue: An order is already shipped if ShippedDate is not null.
  * * Sales = sum of unitprice * (1 - discount) * quantity per product ordered
  */
  function get_biggest_sale() {
    $query_string =
    'SELECT E."LastName" || $$, $$ || E."FirstName" AS "Name",
            "Order Details"."OrderID", C."CompanyName" AS "Customer",
            "Sales" AS "Order Amount", "Order Date", "Shipped Date"
    FROM (SELECT O."EmployeeID", O."OrderID", O."CustomerID", "Sales",
                      O."OrderDate" AS "Order Date",
                      O."ShippedDate" AS "Shipped Date"
              FROM Orders O NATURAL JOIN
                  (SELECT OD."OrderID",
                          SUM(OD."UnitPrice" * (1 - OD."Discount") *
                              OD."Quantity")
                          AS "Sales"
                  FROM Order_Details OD
                  GROUP BY OD."OrderID") AS "OrderSales") AS "Order Details"
          JOIN
              (SELECT O."EmployeeID" AS "EmployeeID",
                    MAX("Sales") AS "Sales"
              FROM Orders O NATURAL JOIN
                  (SELECT OD."OrderID",
                          SUM(OD."UnitPrice" * (1 - OD."Discount") *
                              OD."Quantity")
                          AS "Sales"
                  FROM Order_Details OD
                  GROUP BY OD."OrderID") AS "OrderSales"
              WHERE O."ShippedDate" IS NOT NULL
              GROUP BY O."EmployeeID") AS "Biggest Sale"
          USING ("EmployeeID", "Sales")
          JOIN Employees E USING ("EmployeeID")
          JOIN Customers C USING ("CustomerID")';
    $biggest_sale = $this->db->query($query_string);
    return $biggest_sale;
  }

  /*
  * Ranking of Employees by sales for a given year
  * * Given: year (e.g., 1995)
  * * Output: Employee, Sales
  * * Employee ranking must be from highest to lowest sales
  * * Clue: You have to use SUM and ORDER BY
  */
  function get_rank_by_year($year) {
    $query_string =
    'SELECT E."LastName" || $$, $$ || E."FirstName" AS "Name", "Total Sales"
    FROM (SELECT O."EmployeeID" AS "EmployeeID",
                SUM("OrderAmount") AS "Total Sales"
          FROM Orders O NATURAL JOIN
              (SELECT OD."OrderID",
                      SUM(OD."UnitPrice" * (1 - OD."Discount") * OD."Quantity")
                      AS "OrderAmount"
              FROM Order_Details OD
              GROUP BY OD."OrderID") AS "OrderSales"
          WHERE EXTRACT(YEAR FROM O."ShippedDate") = ?
          GROUP BY O."EmployeeID") AS "Total Sales Per Employee" NATURAL JOIN
          Employees E
    ORDER BY "Total Sales" DESC';
    $rank_by_year = $this->db->query($query_string, array($year));
    return $rank_by_year;
  }

}
