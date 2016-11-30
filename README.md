Google Cloud Java Pub/Sub Client
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
- Install grpc package using pecl by running: `pecl install grpc`
- Install required composer packages by running: `composer install`

Authentication
--------------

To authenticate all your API calls, first install and setup the [Google Cloud SDK](https://cloud.google.com/sdk/).
After that is installed, run the following command in your terminal:

```
$ gcloud auth login
```
At this point, you are now authenticated to make calls to Pub/Sub and other Google Cloud services.

Examples
-------------

The [documentation](https://michaelbausor.github.io/master/index.html)
includes simple examples for every API method. Please read it through for more usage samples.


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

Place the code above in a file alongside your `composer.json` file, for example
`PubSubSample.php`


Execution
--------------

To execute your client app from the command line, run the following commands (which assume that
you put your app in `PubSubSample.php`):

```
php PubSubSample.php
```

Troubleshooting
-------------

