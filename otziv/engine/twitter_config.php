<?php
define('CONSUMER_KEY', 'WW65bbisy9ayccLotSti8zXv7');
define('CONSUMER_SECRET', '4ufGlemrpSHROAwDhhxsqQy8FCqBSHnXKr3bjkx0tGGGubXCvl
');

// адрес получения токена запроса
define('REQUEST_TOKEN_URL', 'https://api.twitter.com/oauth/request_token');
// адрес аутентификации
define('AUTHORIZE_URL', 'https://api.twitter.com/oauth/authorize');
// адрес получения токена доступа
define('ACCESS_TOKEN_URL', 'https://api.twitter.com/oauth/access_token');
// адрес API получения информации о пользователе
define('ACCOUNT_DATA_URL', 'https://api.twitter.com/1.1/users/show.json');

// колбэк, адрес куда должен будет перенаправлен пользователь, после аутентификации
define('CALLBACK_URL', 'http://twitterauth.loc/');
?>