
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
