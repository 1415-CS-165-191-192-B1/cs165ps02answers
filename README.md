# CS 165 Problem Set 02

## Overview

For this problem set, you will be given a web-based application to work on. The
web application that you will work on is already "working" (there are no errors
  in loading a page, no broken links, etc.). However, the data that is
  displayed on some of the pages are not appropriate. This is because the SQL
  queries that are written for those pages are far from being correct. Your
  task is to provide the right SQL queries so that the application will show
  the appropriate information. For this problem set, we will refer to the
  source code of the application as the project.

## Instructions

### Database

The database that you will use for this problem set is available
[here](https://code.google.com/p/northwindextended/downloads/detail?name=northwind.postgre.sql).
Download this and import the database to your machine. Use PostgreSQL.

You have to check lines 1-276 and lines 3740-3845 of the SQL file so
you can be familiar with the schema. The relationships between the tables are
not given (if you will check the SQL file, you'll see that there are no foreign
key declarations). However, a visualization of the relationships is available
[here](./NorthwindRel.png?raw=true "Visualization").

![visualization](./NorthwindRel.png?raw=true "Visualization")

To understand the specifics of the queries that you have to write, you have to
refer to the following table:

| Term              | Definition                                         |
| ----------------- | -------------------------------------------------- |
| Product           | Product Name of Product                            |
| Category          | Category Name of Category                          |
| Customer          | Company Name of Customer                           |
| Supplier          | Company Name of Supplier                           |
| Employee          | Last Name, First Name                              |
| Order Item Amount | unit price * quantity (consider also the discount) |
| Order Amount      | sum of Order Item Amount per Order                 |
| Sales             | amount of order already shipped                    |

### Setup

This is one of the hardest parts of the problem set.

1. To be able to work on the problem set, you need to install the following:

  * Apache Web Server
  * PHP5
  * PostgreSQL
  * php5-pgsql (php module for communicating with PostgreSQL databases)
  * git (optional, but you may find this useful)

  How these things are installed may depend on the operating system that you
  are using. You may want to ask for some assistance from your friends (some
  seniors are familiar with this). A lot of resources that are helpful for
  installing these prerequisites are available online.

2. Download the entire project. You may use the ```git
clone``` command in doing this.

3. You have to familiarize yourself with
[CodeIgniter](https://ellislab.com/codeigniter). The web application that you
will be working on is written on a modified version of CodeIgniter. In
particular, try to be familiar with the following:

  * The /application/models directory.
  * The ```$config``` variable at /application/config/config.php.
  * The ```$db``` variable at /application/config/database.php.

4. When you're already familiar with CodeIgniter, "make the project work."
(Connect the project to the database and enable your web server to answer
  requests that are directed to your project). When you're done with this, you
  will be able to see something like
  [this](./home_page.png?raw=true "Home Page") when you are viewing your
  project on a web browser:

  ![Home Page](./home_page.png?raw=true "Home Page")

### SQL Queries

As said earlier, your task is to provide the right SQL queries. The folder
/application/models contains the following php files:

  * employees_model.php
  * orders_model.php
  * partners_model.php
  * products_model.php
  * sales_model.php

Each file contains a class with several methods. Each non-constructor
method may correspond to a page in the website and a query string
(```$query_string```) is defined on each. Your task is to replace the
the value of the query string with the appropriate ones.

The [correspondence](./correspondence.png?raw=true "Correspondence") is
straightforward. Each non-constructor method is named after an item on the menu
bar of the project.

![Correspondence](./correspondence.png?raw=true "Correspondence")

You don't need to modify other files. What you need to modify are the query
strings of the functions in the model files. Here is a summary of the queries
that you have to write, arranged according to class.

### Employees
1. List of Employees and who they report to.
  * Output: Employee, Reports To (Employee they report to)

2. Biggest Sale per Employee
  * Output: Employee, Order ID, Customer, Order Amount, Order Date, Ship Date

3. Ranking of Employees by sales for a given year
  * Given: year (e.g., 1995)
  * Output: Employee, Sales
  * Employee ranking must be from highest to lowest sales

### Orders

1. Orders not yet shipped by given cut-off date
  * Given: Cut-off Date
  * Output: Order ID, Customer, Required Date, Shipped Date
  * Note: Include all orders that are not yet shipped

2. Total Freight Cost Incurred for Delivery per City, Country
  * Output: Country, City, Total Freight Cost
  * Sort by Country

3. No. of Shipment per Country
  * Output: Country, No. of Shipment (delivered orders)
  * Sort alphabetically by Country

4. Late shipment by Employee
  * Given: Last Name, First Name
  * Output: Order ID, Customer, Order Amount, Date Required, Ship Date

5. Latest Order per Customer
  * Output: Customer, Order ID, Order Date, Ship Date (may be null)
  * Sort by Order Date (from latest to earliest)

### Partners

1. Ranking of Customers by orders for a given year
  * Given: year (e.g., 1995)
  * Output: Customer ID, Company Name, Total Order Amount
  * Customer ranking must be from highest to lowest order amount

2. List of Customers and Suppliers based on a given country
  * Given: Country
  * Output: Company Name, City, Region, Relationship ("Customer" or "Supplier")

### Products

1. Products Exceeding Quota Sales for a given year
  * Given: year (e.g., 1995), Quota Sales (amount)
  * Output: Category, Product, Sales
  * Sort by Category; for each Category sort product sales from highest to
    lowest sales

2. No. of Products Per Category and most expensive product Per Category
  * Output: Category ID, Category Name, No. of Products, Product, Unit Price
  * Sort by Unit Price (from highest to lowest)

3. Products Still Supplied by Supplier (products that are still available)
  * Given: Supplier ID
  * Output: Product ID, Product Name, Category Name

4. Products that have fallen below reorder level that have not yet been
reordered OR products that have fallen below reorder level but do NOT have
pending orders (i.e., there are no orders that are still for shipment)
  * Output: Product, Supplier, Units in Stock, Reorder Level

5. List of discontinued products
  * Output: Category, Product, Supplier
  * Sort by Category

### Sales

1. Summary of Product Sales given a date range.
  * Given: start date, end date
  * Output: Category, Product, Sales
  * Sort by Category; for each Category sort product sales from highest to
    lowest sales

2. Sales per month (from the earliest shipment to the latest)
  * Output: Month Year (e.g., August 1994), Total Sales
  * Sort by Month (include all months even those with no sales)
  * Hint: You may create a table for Months

3. Sales of Employees per month (from the earliest shipment to the latest)
  * Output: Employee, Month (e.g., August 1994), Sales
  * Sort by Month per Employee (include all months for each employee even those
    month-employee pairs with no sales)

## Deliverables

Submit the following models:

  * employees_model.php
  * orders_model.php
  * partners_model.php
  * products_model.php
  * sales_model.php

Put the files in a zip folder named **CS165PS02Lastname.zip** and send it to
**epfelizmenio@gmail.com** with the subject **CS165PS02 - Lastname**. Submit on
or before **September 22, 2014, 11:59pm**.
