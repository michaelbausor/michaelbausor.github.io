<?php

require __DIR__ . '/vendor/autoload.php';

use Sami\Sami;
use Sami\RemoteRepository\GitHubRemoteRepository;
use Sami\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->in('gapi-pubsub-php/src')
    ->in('gax-php/src')
    ->in('proto-client-php/src');

/*
$versions = GitVersionCollection::create($dir)
    ->addFromTags('0.*')
    ->add('master', 'master branch');
 */

return new Sami($iterator, array(
    'theme'                => 'default',
//    'versions'             => $versions,
    'title'                => 'GAX PHP',
    'build_dir'            => __DIR__.'/%version%',
    'cache_dir'            => __DIR__.'/cache/%version%',
//    'remote_repository'    => new GitHubRemoteRepository('googleapis/gax-php', dirname($dir)),
    'default_opened_level' => 2,
));
