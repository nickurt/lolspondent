<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

use TwitterOAuth\TwitterOAuth;

// Autoload the vendor
require __DIR__ . '/vendor/autoload.php';

// Database
$dbh = new PDO('sqlite:'. realpath(__DIR__. '/data/lolspondent.db'));

// Twitter
$twitter = new TwitterOAuth([
    'consumer_key'          => '[consumer_key]',
    'consumer_secret'       => '[consumer_secret]',
    'oauth_token'           => '[oauth_token]',
    'oauth_token_secret'    => '[oauth_token_secret]',
    'output_format'         => 'object'
]);

// Params
$params = [
    'q'                     => 'decorrespondent.nl-filter:retweets',
    'lang'                  => 'nl',
    'result_type'           => 'recent',
    'include_entities'      => true,
    'count'                 => 50,
];

// Get the tweets
$response = $twitter->get('search/tweets', $params);

// Foreach the tweets
foreach($response->statuses as $r)
{
    foreach($r->entities->urls as $url)
    {
        $exploded       =   explode("/", $url->expanded_url);

        if($exploded[2] == "decorrespondent.nl" && isset($exploded[5]))
        {
            $check      =   $dbh->prepare("SELECT count(id) as count FROM posts WHERE decorrespondent_id = :cid AND hash = :hash");
            $query      =   $check->execute(array(':cid' => $exploded[3], ':hash' => $exploded[5]));

            if($check->fetch()['count'] < 1) 
            {
                $sth = $dbh->prepare("INSERT INTO posts (decorrespondent_id, url, hash) VALUES (:cid, :url, :hash)");
                $sth->execute(array(':cid' => $exploded[3], ':url' => $url->expanded_url, ':hash' => $exploded[5]));
            }
        }
    }
}