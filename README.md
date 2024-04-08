# countX test task 2024 for Back-End Developer

This test task involves the design and implementation of endpoints for a new feature in a pre-existing REST API-driven
web application.

## Task Description

Develop and integrate one or multiple REST API endpoints necessary for the implementation of a new feature within our
web portal. Carefully examine the screenshots provided below, analyze the displayed data, and determine the necessary
endpoints to fully support and implement this feature.

**You must not implement the front-end.**

## Feature: Invoice Book Overview

The goal is to provide users with the ability to view a list of their sales invoices over a specified
period, referred to as the "Invoice Book".
Invoices are stored in two tables in the database: `turnover` and `turnover_item`. The `turnover` table contains the
top-level information about the invoice, and the `turnover_item` table contains amounts of the invoices, group by the
vat rates. A single line in a `turnover_item` table represents a single line in the invoice book in the resulting
web-application.

Users should have the capability to filter their invoice view based on several criteria, including the VAT country,
the time period, and the 'is_oss' property.

Desired outcome screenshots:

![Invoice Book](https://github.com/countxvat/dev-task/blob/master/public/img/invoice_book_example.png?raw=true)

![Countries Dropdown](https://github.com/countxvat/dev-task/blob/master/public/img/invoice_book_example_countries.png?raw=true)

![Periods Dropdown](https://github.com/countxvat/dev-task/blob/master/public/img/invoice_book_example_periods.png?raw=true)

## Development Requirements

- Data Format: JSON.
- Endpoints: Your goal is to create endpoints that address
  the requirements, with the exception of listing periods.
  If implementing all necessary endpoints becomes too challenging or time-consuming, it is acceptable to focus on the
  most critical ones, ensuring they are fully functional and well-developed.
- Design Principles: follow SOLID principles for scalable and maintainable code.
- Extra Tip: You don't need to make an endpoint just for showing the list of periods.

## Submission Guidelines

- Clone this repository into your own account.
- Develop the feature on a new branch and create a pull request to your repository
- Make your repository public or grant access to the following GitHub users: `debesha`, and `michaelcountx`.
- Notify us once the task is completed, providing the link to your repository and the pull request.
- If you decided to omit some endpoints due to complexity or time constraints, please clearly outline what additional
  endpoints would be necessary for a full implementation in your submission. This helps us understand your approach and
  the scope of your solution.

## Environment Setup (via Docker)

Execute the following commands to set up your development environment:

```
docker compose up -d

docker exec -it dev-task-app /bin/bash

# copy env file
cp .env.dist .env

composer install

./bin/console doctrine:schema:create

./bin/console hautelook:fixtures:load -n
```
