Google Cloud PHP Pub/Sub Client
================================

PHP idiomatic client for [Google Cloud Pub/Sub](https://cloud.google.com/pubsub/) services.
This client supports the following Google Cloud Platform services:

- [Publisher Client](https://michaelbausor.github.io/master/Google/Cloud/PubSub/V1/PublisherClient.html)
- [Subscriber Client](https://michaelbausor.github.io/master/Google/Cloud/PubSub/V1/SubscriberClient.html)

Prerequisites
----------

- [PHP 5.5+](http://php.net/downloads.php)
- [Composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)
- Pecl (see the section on how to install Pecl)

Installation
----------

- Copy the google-pubsub.zip file to your project directory (do NOT unzip)
- Copy this [composer.json](https://michaelbausor.github.io/files/composer.json) file to your project directory
- Install grpc package using pecl
  - Run this command in your terminal: `$ sudo pecl install grpc-1.0.0`
  - Add `extension=grpc.so` to your php.ini file if pecl was not able to do so
    automatically. See the Pecl section below for more detailed instructions
- Install the required packages using composer, with the following commands
  depending on how you have install composer:
  - Installed composer locally: `$ php composer.phar install`
  - Installed composer globally: `$ composer install`

Authentication
--------------

To authenticate all your API calls, first install and setup the [Google Cloud SDK](https://cloud.google.com/sdk/).
After that is installed, run the following command in your terminal:

```
$ gcloud auth application-default login
```

NOTE: if you are using an older version of the Google Cloud SDK, you may need to use the following command instead:

```
$ gcloud beta auth application-default login
```

At this point, you are now authenticated to make calls to Pub/Sub and other Google Cloud services.

Documentation
-------------

The documentation is available [here](https://michaelbausor.github.io/master/index.html).
The two main classes for the PubSub API are [Publisher Client](https://michaelbausor.github.io/master/Google/Cloud/PubSub/V1/PublisherClient.html) and [Subscriber Client](https://michaelbausor.github.io/master/Google/Cloud/PubSub/V1/SubscriberClient.html).

Examples
-------------

The [documentation](https://michaelbausor.github.io/master/index.html) includes simple examples for every API method. Please read it through for more usage samples.

```php

<?php

require __DIR__ . '/vendor/autoload.php';

use Google\Cloud\PubSub\V1\PublisherClient;

try {
    $publisherClient = new PublisherClient();
    $formattedName = PublisherClient::formatTopicName("[PROJECT_ID]", "[TOPIC_ID]");
    $response = $publisherClient->createTopic($formattedName);
    echo "Created topic with name " . $response->getName() . "\n";
} finally {
    if (isset($publisherClient)) {
        $publisherClient->close();
    }
}
```

Place the code above in a file alongside your `composer.json` file, for example `PubSubSample.php`


Execution
--------------

To execute your client app from the command line, run the following commands (which assume that you put your app in `PubSubSample.php`):

```
$ php PubSubSample.php
```

Pecl
----

If you have not used pecl to install PHP extensions before, you may encounter some issues the first time you install and use it. Please see below for help installing and troubleshooting pecl.

##### Installing pecl #####

Pecl is provided along with Pear. The instructions for installing Pear are [available here](http://pear.php.net/manual/en/installation.getting.php).

If you are using OS X El Capitan, an easy installation method is given by [this Stack Overflow answer](http://stackoverflow.com/a/34954209).

You can verify that Pecl is available by running `$ pecl version`, or by following the instructions provided [here](http://pear.php.net/manual/en/installation.checking.php).

##### Installing the gRPC Extension #####

There are two steps to install the gRPC extension:
1. Build the extension using Pecl, and 
2. Add the extension to your php.ini file.

###### Build the extension ######

You can build the extension by running this command in your terminal:
```
$ sudo pecl install grpc-1.0.0
```

If you have not used Pecl to build a PHP extension before, you may encounter
some problems. Please see the prerequisites and troubleshooting list below:

Prerequisite for OSX: accept the xcode license agreement.
- If you have not done so, you will get an error similar to: _ERROR: 'phpize' failed_.
- You can accept the license agreement by using one of the command line tools, e.g. by running: `$ m4 --version`

Prerequisite for OSX: disable [System Integrity Protection](https://support.apple.com/en-us/HT204899)
- If SIP is enabled, pecl will be unable to install the grpc.so file at the end of the build process (you will see the _ERROR: failed to write ..._ error message listed in the Troubleshooting section below.
- To disable SIP, follow the instructions [here.](http://stackoverflow.com/a/35301947)

Troubleshooting:
- Error message: _No releases available for package "pecl.php.net/grpc" install failed_
  - Fix: Make sure to run with root access, e.g. `$ sudo pecl install grpc-1.0.0`
- Error message: _Cannot find autoconf. Please check your autoconf installation and the $PHP_AUTOCONF environment variable. Then, rerun this script. ERROR: 'phpize' failed_
  - Fix: You need to install autoconf.
    - On MacOS or OSX you can install autoconf using brew with the command `$ brew install autoconf` or by following [these instructions](http://superuser.com/a/897316).
    - On Ubuntu, install with `$ sudo apt-get install autoconf`
- Error message: _ERROR: failed to write /usr/lib/php/extensions/no-debug-non-zts-20121212/grpc.so (copy(/usr/lib/php/extensions/no-debug-non-zts-20121212/grpc.so): failed to open stream: Operation not permitted)_
  - Make sure you have root access. This can also be caused by [System Integrity Protection](https://support.apple.com/en-us/HT204899), which you can disable by following the instructions [here.](http://stackoverflow.com/a/35301947)

###### Add the extension to you PHP ini file ######

After the grpc extension has been build with pecl, you need to add it to your PHP ini file. If the Pear `php_ini` setting is configured correctly, this will happen automatically, and the pecl installation will print _Extension grpc enabled in php.ini_. Otherwise, you will need manually modify your php ini file, by following these steps:

1. Locate your PHP ini file by running `$ php --ini` from the terminal. You should see a line like:
_Loaded Configuration File:         /etc/php5/cli/php.ini_
2. Edit the file using a text editor. Note you will likely require root access to edit the file. So for example using vi, run:
`$ sudo vi /etc/php5/cli/php.ini`
3. Add the following line anywhere in the file: `extension=grpc.so`

If the grpc extension is not installed or has not been added to your PHP ini file, you will see an error message like:
_Fatal error: Undefined constant 'Grpc\STATUS_ABORTED' in /Users/USERNAME/PROJECT/vendor/google/gax/src/GrpcConstants.php on line 53_
This indicates that you need to follow the steps above to correctly install the gRPC extension and add it to your PHP ini file.

Troubleshooting
-------------

##### Problems running the sample: #####
- Error message: _Fatal error: Uncaught exception 'DomainException' with message 'Could not load the default credentials.'_
  - This indicates that the application-default credentials are not available.
    You need to make sure that the Google Cloud SDK is installed, and run `$ google auth application-default login`
(or `$ google beta auth application-default login` for older versions of the SDK)
- Error message: _Segment Fault 11_
  - This can be caused if the [date.timezone setting](http://php.net/manual/en/datetime.configuration.php#ini.date.timezone) in your php ini file is not set. You can set it by following these steps:
    - Locate your PHP ini file using `$ php --ini`
    - Edit the file and append the following line: `date.timezone = America/Los_Angeles`
    - (You can use any [supported timezone](http://php.net/manual/en/timezones.php))
- Error message: _Client side authentication failure: Credentials failed to get metadata._
  - Make sure you have the grpc-1.0.0 package installed, not grpc-1.0.1 (check with `$ pecl list`)

##### Problems installing composer: #####
- Installation using `brew` failed
  - Fix: run `$ brew update` and `$ brew doctor`, and fix any issues found

