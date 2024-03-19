
## Installation

```
docker compose up -d

# copy env file
cp .env.dist .env

composer install

./bin/console doctrine:schema:create

./bin/console hautelook:fixtures:load -n
```
