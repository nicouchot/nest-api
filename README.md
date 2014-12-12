Nest API - Data visualisation
============================

Forked from: https://github.com/gboudreau/nest-api

This is a PHP class that will allow you to monitor and control your [Nest Learning Thermostat](http://www.nest.com/), and Nest Protect.

![nest api]
(http://dl.weberantoine.fr/img/NEST_API.png)

Installation:

    git clone https://github.com/TwanoO67/nest-api.git
    cp config.php_example config.php
    vi config.php ( here you have to change password,user and path of your stats folder)
    crontab -e ( to execute or curl your cron.php script every X minutes to get your fresh stats)
    
Use:

    cron.php will be called every X minutes by your crontab to fill a json file with your data
    index.php will show these data in graph with a bootstrap templates for pc/mobile
    wear.php will show your last data, with a Android Wear compatible format

