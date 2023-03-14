# Laravel 9 Project with JWT Authentication without Database

Project created to be used as a base project for APIs with JWT authentication in their requests

## 🚀 Getting Started

Clone the repository and change the following environment variables in the .env file
```file
API_LOGIN=LOGIN_TO_AUTHENTICATE
API_PASSWORD=SHA256_PASSWORD_TO_AUTHENTICATE
JWT_KEY=ALEATORY_STRING_TO_JWT
```

## ⚙️ Executing requests with authentication

Send a post with login and password configured in the .env file

**cURL example:**

```php

<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost/api/authenticate',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('login' => 'LOGIN_TO_AUTHENTICATE','password' => 'PASSWORD_TO_AUTHENTICATE'),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
```

**Guzzle example:**

```php

<?php
$client = new Client();
$options = [
  'multipart' => [
    [
      'name' => 'login',
      'contents' => 'LOGIN_TO_AUTHENTICATE'
    ],
    [
      'name' => 'password',
      'contents' => 'PASSWORD_TO_AUTHENTICATE'
    ]
]];
$request = new Request('POST', 'http://localhost/api/authenticate');
$res = $client->sendAsync($request, $options)->wait();
echo $res->getBody();
```

In this route, if the credentials are valid, a JSON with the token will be returned, similar to this:

```json
{"token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJsb2dpbiI6InAyc2FkbWluIiwiaWF0IjoxNjc4ODE4ODcxLCJleHAiOjE2Nzg4MjAwNzF9.8NveOmv4NeAieYs37YlAyHKK_E8kWLUi8IWWFeZWv4A","status":true}
```

In other requests, this token must be passed in the header as a bearer token, as in the following example:

**cURL example:**

```php
<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost/api/amiauthenticated',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_POSTFIELDS => array('login' => 'LOGIN_TO_AUTHENTICATE','password' => 'PASSWORD_TO_AUTHENTICATE'),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJsb2dpbiI6InAyc2FkbWluIiwiaWF0IjoxNjc4ODE4ODcxLCJleHAiOjE2Nzg4MjAwNzF9.8NveOmv4NeAieYs37YlAyHKK_E8kWLUi8IWWFeZWv4A'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
```

**Guzzle example:**

```php
<?php
$client = new Client();
$headers = [
  'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJsb2dpbiI6InAyc2FkbWluIiwiaWF0IjoxNjc4ODE4ODcxLCJleHAiOjE2Nzg4MjAwNzF9.8NveOmv4NeAieYs37YlAyHKK_E8kWLUi8IWWFeZWv4A'
];
$options = [
  'multipart' => [
    [
      'name' => 'login',
      'contents' => 'LOGIN_TO_AUTHENTICATE'
    ],
    [
      'name' => 'password',
      'contents' => 'PASSWORD_TO_AUTHENTICATE'
    ]
]];
$request = new Request('GET', 'http://localhost/api/amiauthenticated', $headers);
$res = $client->sendAsync($request, $options)->wait();
echo $res->getBody();
```

## 🛠️ Used Projects

* [Laravel](https://github.com/laravel/laravel) - Laravel Framework
* [PHP-JWT](https://github.com/firebase/php-jwt) - PHP-JWT
