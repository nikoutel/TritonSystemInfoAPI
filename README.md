TritonSystemInfoAPI
===================

**A Restful API to get the representations of system information and metrics.**

**@todo**
Made with Lumen.

`Triton` adopts the `HAL` *(Hypertext Application Language)* convention for representing resources and their relations with hyperlinks.    
Resources are formatted in JSON and have the media type `"application/hal+json"`

Only the `GET` http method is implemented, other methods are not allowed.

### Status ###
*Current status:* **It works on my machine!**    
*Meaning:* It is still under development, and for now only `Debian/Gnu` Linux systems with `systemd` are supported.    
It should work on other `Debian` based systems (with `systemd`) but they are not fully tested yet.

### Warning!! ###
This will expose critical information about your system! *Use it wisely!* 

### Information/metrics - Endpoints ###

* System
    * Information - `/api/system/info`
* Metrics - `/api/metrics`
    * CPU - `/api/metrics/cpu`
        * Info - `/api/metrics/cpu/info`
        * Usage (%) - `/api/metrics/cpu/usage`
    * Network - `/api/metrics/network`
        * Info - `/api/metrics/network/info`
        * Usage (KiB/Sec)     - `/api/metrics/network/usage`
    * Memory - `/api/metrics/memory`
        * Usage - `/api/metrics/memory/usage`
 * Services - `/api/services`
    * {Service} - e.g. `/api/services/apache2`, `/api/services/mysql`
        * Info - e.g. `/api/services/apache2/info`
        * Status - e.g. `/api/services/apache2/status`
        * Load - e.g. `/api/services/apache2/Load`
        * Config - e.g. `/api/services/apache2/config`
            * {Config} - e.g. ' `/api/services/apache2/config/sites-enabled`, `/api/services/mysql/mysql/config/my.conf`

### Services ####
**@todo**

### Configs ###
**@todo**

## Install ##

**composer:**    

*As standalone:*
```
composer create-project nikoutel/tritonsysteminfoapi
```
*As library:*
```
composer require nikoutel/tritonsysteminfoapi
```

**git:**    

*As standalone:*
```
git clone https://github.com/nikoutel/TritonSystemInfoAPI.git
```

## License ##
This software is licensed under the [MPL](http://www.mozilla.org/MPL/2.0/) 2.0:
```
    This Source Code Form is subject to the terms of the Mozilla Public
    License, v. 2.0. If a copy of the MPL was not distributed with this
    file, You can obtain one at http://mozilla.org/MPL/2.0/.
```
