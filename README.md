TritonSystemInfoAPI
===================

**A Restful API to get the representations of system information and metrics.**

Get system information (like *OS*, *hostname*, *public IPs*, *services status*), metrics (like *CPU usage*, *free memory*, *web server load*), 
and even configurations (like *apache2.conf* and *php.ini*) with an easy to navigate and configurable RESTfull web-service, made with Lumen.

`Triton` adopts the `HAL` *(Hypertext Application Language)* convention for representing resources and their relations with hypermedia links.    
Resources are formatted in JSON and have the media type `"application/hal+json"`

Only the `GET` http method is implemented, other methods are not allowed.

### Status ###
*Current status:* **It works on my machine!**    
*Meaning:* It is still under development, and for now only `Debian Gnu/Linux` systems with `systemd` are supported.    
It should work on other `Debian` based systems (with `systemd`) but they are not fully tested yet.

### Warning!! ###
This will expose critical information about your system! *Use it wisely!* 

### Information/metrics - Endpoints ###

* System
    * Information - `/api/system/info`
    * Load average - `/api/system/load`
    * CPU - `/api/system/cpu`
        * Info - `/api/system/cpu/info`
        * Extended info - `/api/system/cpu/extended-info`
        * Usage (%) - `/api/system/cpu/usage`
    * Network - `/api/system/network`
        * Info - `/api/system/network/info`
        * Usage (KiB/Sec)     - `/api/system/network/usage`
    * Memory - `/api/system/memory`
        * Usage - `/api/system/memory/usage`
    * Disk - `/api/system/disk`
        * Info - `/api/system/disk/info`
        * Usage - `/api/system/disk/usage`
* Services - `/api/services`
    * {Service} - e.g. `/api/services/apache2`, `/api/services/mysql`
        * Info - e.g. `/api/services/apache2/info`
        * Status - e.g. `/api/services/apache2/status`
        * Load - e.g. `/api/services/apache2/load`
        * Config - e.g. `/api/services/apache2/config`
            * {Config} - e.g. `/api/services/apache2/config/sites-enabled`, `/api/services/mysql/mysql/config/my.conf`
* Software - `/api/system/software`
    * php - `/api/system/software/php`
        * phpinfo - `/api/system/software/php/phpinfo`
        * Config - `/api/system/software/php/config`
            * {Config} - e.g. `/api/system/software/php/config/php.ini`, `/api/system/software/php/config/php.ini-cli`

### Services ####

An environment variable (`ALLOWED_SERVICES`) defined in the `.env` file, controls which services are allowed to be processed.    
Any other service will result in a 404 error.

### Configs ###

Similar, an environment variable (`ALLOWED_CONF`),  controls which configurations are allowed.

Dynamically defined allowed services, which also have allowed configurations defined, 
must be included in the `TYPES_WITH_SEC_PARAMETER` environment variable, 
and their configurations must be defined with the `ALLOWED_CONF{service_name}` (e.g. `ALLOWED_CONFAPACHE2`) environment variable.

Configuration paths are defined via the `PATH_{conf_name}` variable (e.g. `PATH_MYCNF=/etc/mysql/my.cnf`).


## Install ##

**composer:** (recommended)   

*As standalone:*
```
composer create-project nikoutel/tritonsysteminfoapi
```
*As library:*
```
composer require nikoutel/tritonsysteminfoapi
```

**git:**    

```
git clone https://github.com/nikoutel/TritonSystemInfoAPI.git
```
Use an PSR-4 compatible autoloader. 

### Configuration ###

Create an `.env` configuration file (if not available) according to `.env.example`.

The .env file stores environment variables for the application.

*Environment variable names consist solely of uppercase letters, digits, and the '_' (underscore) (IEEE Std 1003.1-2001)*

## License ##
This software is licensed under the [MPL](http://www.mozilla.org/MPL/2.0/) 2.0:
```
    This Source Code Form is subject to the terms of the Mozilla Public
    License, v. 2.0. If a copy of the MPL was not distributed with this
    file, You can obtain one at http://mozilla.org/MPL/2.0/.
```
