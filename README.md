## Installation via docker:

```
docker compose up -d

docker exec -it dev-task-app /bin/bash

# copy env file
cp .env.dist .env

composer install

./bin/console doctrine:schema:create

./bin/console hautelook:fixtures:load -n
```

## Task description:
The goal is to show clients their invoices. See screenshots.

As part of this task you have to implement an API endpoint which returns data in json format.

Should be possible to filter documents by:
- VAT country
- Period
- And is invoice marked as an OSS transaction
