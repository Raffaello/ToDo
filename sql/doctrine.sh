sudo rm ToDo.db
sudo ../app/console doctrine:database:create
sudo chown apache.apache ToDo.db
sudo cmod 770 ToDo.db
sudo ../app/console doctrine:schema:create
sudo ../app/console doctrine:schema:update --force
sudo ../app/console doctrine:schema:validate
