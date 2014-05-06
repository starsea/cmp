Cooperation Management Platform For Symfony2
==================


Environment
----------------------
- php5.3+ (best php5.5+)
- composer
- opcache (not must need)



Usage
----------------------
- git clone
- cd cmp && composer install     # install vender
- vim app/config/parameters.yml  # edit u conf
- chmod -R 777 app/cache app/log 
- php app/console assets:install <--env=prod>
- php app/console assetic:dump   <--env=prod>
- php app/console  doctrine:schema:create # create db
 