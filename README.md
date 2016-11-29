Google Cloud Java Pub/Sub Client
================================

PHP idiomatic client for [Google Cloud Pub/Sub](https://cloud.google.com/pubsub/) services.
This client supports the following Google Cloud Platform services:

- [Publisher API](https://michaelbausor.github.io/master/Google/Cloud/PubSub/V1/PublisherClient.html)
- [Subscriber API](https://michaelbausor.github.io/master/Google/Cloud/PubSub/V1/SubscriberClient.html)

Prerequisites
----------

Installation
----------


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

use Google\Cloud\PubSub\V1\PublisherApi;

try {
    $publisherApi = new PublisherApi();
    $formattedName = PublisherApi::formatTopicName("[PROJECT_ID]", "[TOPIC_ID]");
    $response = $publisherApi->createTopic($formattedName);
    echo "Created topic with name " . $response->getName() . "\n";
} finally {
    if (isset($publisherApi)) {
        $publisherApi->close();
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

