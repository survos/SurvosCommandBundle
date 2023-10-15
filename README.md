# Command Bundle

Run Symfony command line programs from a web interface, for easier debugging.

## Purpose

Use assert(), dump() and dd() are quick and easy debug tools when debugging a Symfony web page.  But it's often difficult to use with console commands.

One solution is to create a service that does all the business logic, and a separate route to that url, to b


```bash
composer req survos/command-bundle
```

## Example with Symfony Demo

```bash
symfony new --demo command-demo && cd command-demo
# bump to the latest version of Symfony 6.3, use whatever version of you have installed
sed -i 's/"php": "8.1.0"//' composer.json 
composer config extra symfony.require "^6.3"
composer config extra.symfony.allow-contrib true
composer update 
# allow recipes
composer req survos/command-bundle
```

Now go to /admin/commands
