Google Cloud PHP Pub/Sub Client
================================

PHP idiomatic client for [Google Cloud Pub/Sub](https://cloud.google.com/pubsub/) services.
This client supports the following Google Cloud Platform services:

- [Publisher Client](https://michaelbausor.github.io/master/Google/Cloud/PubSub/V1/PublisherClient.html)
- [Subscriber Client](https://michaelbausor.github.io/master/Google/Cloud/PubSub/V1/SubscriberClient.html)

Prerequisites
----------

- [PHP 5.5+](http://php.net/downloads.php)
- [Composer](https://getcomposer.org/download/)

Installation
----------

- Copy the google-pubsub.zip file to your project directory (do NOT unzip)
- Copy this [composer.json](https://michaelbausor.github.io/files/composer.json) file to your project directory
- Install grpc package using pecl by running: `sudo pecl install grpc-1.0.0`
- Install required composer packages by running: `composer install`

Authentication
--------------

To authenticate all your API calls, first install and setup the [Google Cloud SDK](https://cloud.google.com/sdk/).
After that is installed, run the following command in your terminal:

```
$ gcloud auth application-default login
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
php PubSubSample.php
```

Troubleshooting
-------------

##### Problems installing gRPC using pecl: #####
- Error message: `No releases available for package "pecl.php.net/grpc" install failed`
  - Fix: make sure to run with root access, e.g. `sudo pecl install grpc`
- Error message: `Cannot find autoconf. Please check your autoconf installation and the $PHP_AUTOCONF environment variable. Then, rerun this script. ERROR: 'phpize' failed`
  - Fix: Install autoconf, e.g. `brew install autoconf` for Mac
- Error message: `ERROR: failed to write /usr/lib/php/extensions/no-debug-non-zts-20121212/grpc.so (copy(/usr/lib/php/extensions/no-debug-non-zts-20121212/grpc.so): failed to open stream: Operation not permitted)`
  - Make sure you have root access. This can also be caused by [System Integrity Protection](https://support.apple.com/en-us/HT204899), which you can disable by following the instructions [here.](http://stackoverflow.com/a/35301947)

##### Problems installing composer: #####
- Installation using `brew` failed
  - Fix: run `brew update` and `brew doctor`, fix issues found

##### Problems running the sample: #####
- Error message: `Fatal error: Uncaught exception 'DomainException' with message 'Could not load the default credentials. Browse to https://developers.google.com/accounts/docs/application-default-credentials for more information'`
  - Run `google auth application-default login`
- Segmentation fault running sample
  - Set the [date.timezone setting](http://php.net/manual/en/datetime.configuration.php#ini.date.timezone) in your php ini file
- Error message: `Client side authentication failure: Credentials failed to get metadata.`
  - Make sure you have the grpc-1.0.0 package installed, not grpc-1.0.1 (check with `pecl list`)

