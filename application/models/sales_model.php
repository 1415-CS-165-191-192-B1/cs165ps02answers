<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sales_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  /*
  * Summary of Product Sales given a date range.
  * * Given: start date, end date
  * * Output: Category, Product, Sales
  * * Sort by Category; for each Category sort product sales from highest to
  *   lowest sales
  */
  function get_product_sales($start, $end) {
    $query_string =
      'SELECT C."CategoryName" AS "Category",
            P."ProductName" AS "Product",
              "ProductSales"."Sales" AS "Sales"
      FROM categories C NATURAL JOIN products P NATURAL JOIN
          (SELECT
            OD."ProductID",
            SUM(OD."UnitPrice"* (1 - OD."Discount") * OD."Quantity") AS "Sales"
          FROM
            Order_details OD NATURAL JOIN
            Orders O
          WHERE O."ShippedDate" BETWEEN ? AND ? AND O."ShippedDate" IS NOT NULL
          GROUP BY OD."ProductID") AS "ProductSales"
          ORDER BY "Category" ASC, "Sales" DESC';
    $product_sales = $this->db->query($query_string, array($start, $end));
    return $product_sales;
  }

  /*
  * Sales per month (from the earliest shipment to the latest)
  * * Output: Month Year (e.g., August 1994), Total Sales
  * * Sort by Month (include all months even those with no sales)
  * * Hint: You may create a table for Months
  * *
  * * Clarifications:
  * * * For the define the months table as follows:
  * * * CREATE TABLE months(
  * * *     "MonthID" smallint,
  * * *     "MonthName" character varying(10)
  * * * );
  * * *
  * * * INSERT INTO months VALUES
  * * * (1, 'January'),
  * * * (2, 'February'),
  * * * (3, 'March'),
  * * * (4, 'April'),
  * * * (5, 'May'),
  * * * (6, 'June'),
  * * * (7, 'July'),
  * * * (8, 'August'),
  * * * (9, 'September'),
  * * * (10, 'October'),
  * * * (11, 'November'),
  * * * (12, 'December');
  */
  function get_monthly_sales() {
    $query_string =
      'SELECT M."MonthName" || $$ $$ || "SalesPerMonth"."Year" AS "Month",
              "Total Sales"
      FROM Months M LEFT OUTER JOIN
          (SELECT EXTRACT(Month FROM O."ShippedDate") AS "Month",
                  EXTRACT(YEAR FROM O."ShippedDate") AS "Year",
                  SUM("Sales") AS "Total Sales"
          FROM Orders O NATURAL JOIN
              (SELECT OD."OrderID",
                      SUM(OD."UnitPrice" * (1 - OD."Discount") * OD."Quantity")
                      AS "Sales"
              FROM Order_Details OD
              GROUP BY OD."OrderID") AS "OrderSales"
          WHERE O."ShippedDate" IS NOT NULL
          GROUP BY EXTRACT(MONTH FROM O."ShippedDate"),
                  EXTRACT(YEAR FROM O."ShippedDate")) AS "SalesPerMonth"
          ON (M."MonthID" = "SalesPerMonth"."Month")
      ORDER BY ("Year", M."MonthID")';
    $monthly_sales = $this->db->query($query_string);
    return $monthly_sales;
  }

  /*
  * Sales of Employees per month (from the earliest shipment to the latest)
  * * Output: Employee, Month (e.g., August 1994), Sales
  * * Sort by Month per Employee (include all months for each employee even
  *   those month-employee pairs with no sales)
  */
  function get_sales_by_employee() {
    $query_string =
      'SELECT "Stats"."Employee",
              M."MonthName" || $$ $$ || "Stats"."Year" AS "Month",
              "Total Sales"
      FROM (SELECT E."EmployeeID", E."LastName" || $$, $$ || E."FirstName" AS "Employee",
            "Dates"."Month", "Dates"."Year"
            FROM Employees E,
                (SELECT DISTINCT EXTRACT(MONTH FROM O."ShippedDate") AS "Month",
                                EXTRACT(YEAR FROM O."ShippedDate") AS "Year"
                FROM Orders O) AS "Dates"
          ) AS "Stats" LEFT OUTER JOIN
          (SELECT O."EmployeeID",
                  EXTRACT(Month FROM O."ShippedDate") AS "Month",
                  EXTRACT(YEAR FROM O."ShippedDate") AS "Year",
                  SUM("Sales") AS "Total Sales"
          FROM Orders O NATURAL JOIN
              (SELECT OD."OrderID",
                      SUM(OD."UnitPrice" * (1 - OD."Discount") * OD."Quantity")
                      AS "Sales"
              FROM Order_Details OD
              GROUP BY OD."OrderID") AS "OrderSales"
          WHERE O."ShippedDate" IS NOT NULL
          GROUP BY EXTRACT(MONTH FROM O."ShippedDate"),
                  EXTRACT(YEAR FROM O."ShippedDate"),
                  O."EmployeeID") AS "SalesPerMonth"
          ON ("SalesPerMonth"."EmployeeID" = "Stats"."EmployeeID"
              AND "SalesPerMonth"."Month" = "Stats"."Month"
              AND "SalesPerMonth"."Year" = "Stats"."Year")
          JOIN Months M ON ("Stats"."Month" = M."MonthID")
      WHERE "Stats"."Month" IS NOT NULL
      ORDER BY ("Stats"."Employee", "Stats"."Year", "Stats"."Month")';
    $sales_by_employee = $this->db->query($query_string);
    return $sales_by_employee;
  }

}
