# countX test task 2024 for Back-End Developer

## Task

You need to design and implement an endpoint(s) for a new feature.

The project contains a skeleton of an application that serves REST API for a front-end application. Imagine we decided
to build a new feature for our web-portal, and your task is to create one of several endpoints that will allow to
implement the feature.

## Feature

We want to create a possibility to overview of the invoice book for a customer. The invoice book - is a list of all
sales invoices of a customer for a given period.
Invoices are stored in two tables in the database: `turnover` and `turnover_item`. The `turnover` table contains the
top-level information about the invoice, and the `turnover_item` table contains amounts of the invoices, group by the
vat rates. A single line in a `turnover_item` table represents a single line in the invoice book in the resulting
web-application.

Some invoices 

![Invoice Book](https://github.com/countxvat/dev-task/blob/63db8efb0814af1ccda86fd1ec191cdc485686d2/public/img/invoice_book_example.png?raw=true)

![Countries Dropdown](https://github.com/countxvat/dev-task/blob/63db8efb0814af1ccda86fd1ec191cdc485686d2/public/img/invoice_book_example_countries.png?raw=true)

![Periods Dropdown](https://github.com/countxvat/dev-task/blob/63db8efb0814af1ccda86fd1ec191cdc485686d2/public/img/invoice_book_example_periods.png?raw=true)

## Installation

```
docker compose up -d
docker exec -it dev-task-app /bin/bash

# copy env file
cp .env.dist .env

composer install

./bin/console doctrine:schema:create
./bin/console hautelook:fixtures:load -n
```
