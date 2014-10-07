# The official li₃ Site

## Synopsis

This is the repository for the main li3 site. Its goal is to provide
a fresh, modern and lean web entity that makes content around li3 easy
to discover.

It serves the naked DOMAIN. A MySQL database is needed to run the site.

## Development

Currently only Linux and Darwin are supported as deployment and developing
platforms. It is expected that you are running ningx with php-fpm.

To initialize the project for development run the following commands. You
have to run these only once. After running `make install` verify the deta
configuration created for your local development environment.

```
$ make install
$ $EDITOR config/deta/dev.conf
$ cd bin
$ ./deta -c ../config/deta create-config.sh
```

Add the following entry to `/etc/hosts`:
``` 
127.0.0.1 lithium-site.dev
```

Include the generated nginx configuration file in you main nginx.conf and 
restart the server afterwards.
``` 
include /path/to/lithium_site/config/nginx/servers/*.conf;
```

Now the site should be available under [lithium-site.dev](http://lithium-site.dev).

### Updating Dependencies 

PHP dependencies are managed via composer:
```
$ cd app
$ composer update
```

This repository is based off UnionOfRAD/framework. To bring in updates 
fetch from the remote, then merge (no rebase) into our master.

### Assets

Assets are contained in the `assets` directory in the root of the project. That
directory is made accessible via `DOMAIN/assets`. 

Assets within plugins are not used, instead all assets needed by the site and 
its plugins should be placed into `DOMAIN/assets` and name accordingly.

```
css/u1m.css - Base styles used on any entity in the li3 universe.
css/site.css - Contains styles relevant to the site only.
css/li3_bot.css  - Contains styles when using the bot plugin.
css/highlight.css - Extra styles that can be loaded if needed.
```

Use the body class to namespace styles to plugins. The body classes will be
`site`, `li3-bot`, `li3-docs` respectively.

Use public CDN's for JavaScript resources if possible.

### Layouts & Plugin Content

All plugins views are rendered within the main app's layout. 
Do not use the the plugin's layout.  

### Running other Tasks

This project comes with some useful scripts that help with setting up the
application and reaching as far as deploying the whole project. These tasks
can be listed and executed as follows. Tasks are based on [deta](https://github.com/davidpersson/deta), for more
information see the deta projects documentation.

```
$ cd /path/to/project/bin
$ ./deta -c ../config/deta
$ ./deta -c ../config/deta fix-perms.sh
```

## Deployment

To install dependencies for deplyoment run:
```
$ make install-deploy
```

To start interactive deployment run:
```
$ cd /path/to/project/bin
$ ./deta -c ../config/deta deploy.sh
```

## Copyright & License

The li3 Website is Copyright (c) 2014 Union of RAD. The code is
distributed under the terms of the BSD 3-clause License. For the full
license text see the LICENSE.txt file.

## Search

* If the first letter in the query is upper-case, you will only get _classes_ in the results.
* If the query contains a $, only _properties_ will be shown in the results.
* If the query ends with or contains a parenthesis, you'll only be searching _methods_.


