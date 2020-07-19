---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#User management


<!-- START_ba35aa39474cb98cfb31829e70eb8b74 -->
## login
> Example request:

```bash
curl -X POST \
    "http://localhost/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"login":"sapiente","password":"deserunt"}'

```

```javascript
const url = new URL(
    "http://localhost/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "login": "sapiente",
    "password": "deserunt"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST login`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `login` | string |  optional  | User login or email.
        `password` | User |  optional  | password.
    
<!-- END_ba35aa39474cb98cfb31829e70eb8b74 -->

<!-- START_e65925f23b9bc6b93d9356895f29f80c -->
## logout
> Example request:

```bash
curl -X POST \
    "http://localhost/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST logout`


<!-- END_e65925f23b9bc6b93d9356895f29f80c -->

#general


<!-- START_c6c5c00d6ac7f771f157dff4a2889b1a -->
## _debugbar/open
> Example request:

```bash
curl -X GET \
    -G "http://localhost/_debugbar/open" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/_debugbar/open"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[]
```

### HTTP Request
`GET _debugbar/open`


<!-- END_c6c5c00d6ac7f771f157dff4a2889b1a -->

<!-- START_7b167949c615f4a7e7b673f8d5fdaf59 -->
## Return Clockwork output

> Example request:

```bash
curl -X GET \
    -G "http://localhost/_debugbar/clockwork/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/_debugbar/clockwork/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET _debugbar/clockwork/{id}`


<!-- END_7b167949c615f4a7e7b673f8d5fdaf59 -->

<!-- START_01a252c50bd17b20340dbc5a91cea4b7 -->
## _debugbar/telescope/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/_debugbar/telescope/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/_debugbar/telescope/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": "No query results for model [Laravel\\Telescope\\Storage\\EntryModel]."
}
```

### HTTP Request
`GET _debugbar/telescope/{id}`


<!-- END_01a252c50bd17b20340dbc5a91cea4b7 -->

<!-- START_5f8a640000f5db43332951f0d77378c4 -->
## Return the stylesheets for the Debugbar

> Example request:

```bash
curl -X GET \
    -G "http://localhost/_debugbar/assets/stylesheets" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/_debugbar/assets/stylesheets"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET _debugbar/assets/stylesheets`


<!-- END_5f8a640000f5db43332951f0d77378c4 -->

<!-- START_db7a887cf930ce3c638a8708fd1a75ee -->
## Return the javascript for the Debugbar

> Example request:

```bash
curl -X GET \
    -G "http://localhost/_debugbar/assets/javascript" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/_debugbar/assets/javascript"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET _debugbar/assets/javascript`


<!-- END_db7a887cf930ce3c638a8708fd1a75ee -->

<!-- START_0973671c4f56e7409202dc85c868d442 -->
## Forget a cache key

> Example request:

```bash
curl -X DELETE \
    "http://localhost/_debugbar/cache/1/" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/_debugbar/cache/1/"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE _debugbar/cache/{key}/{tags?}`


<!-- END_0973671c4f56e7409202dc85c868d442 -->

<!-- START_dc1a46498df72e9aafe15e7e324fcdfb -->
## __clockwork/{id}/extended
> Example request:

```bash
curl -X GET \
    -G "http://localhost/__clockwork/1/extended" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/__clockwork/1/extended"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": ""
}
```

### HTTP Request
`GET __clockwork/{id}/extended`


<!-- END_dc1a46498df72e9aafe15e7e324fcdfb -->

<!-- START_f321e7ef878849ba9f117b781657de2a -->
## __clockwork/{id}/{direction?}/{count?}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/__clockwork/1//" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/__clockwork/1//"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": ""
}
```

### HTTP Request
`GET __clockwork/{id}/{direction?}/{count?}`


<!-- END_f321e7ef878849ba9f117b781657de2a -->

<!-- START_d7436c1279fc7951f71bd08d03b7d432 -->
## __clockwork
> Example request:

```bash
curl -X GET \
    -G "http://localhost/__clockwork" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/__clockwork"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": ""
}
```

### HTTP Request
`GET __clockwork`


<!-- END_d7436c1279fc7951f71bd08d03b7d432 -->

<!-- START_e36bb2e75991fba5b6c2732a5665826b -->
## __clockwork/app
> Example request:

```bash
curl -X GET \
    -G "http://localhost/__clockwork/app" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/__clockwork/app"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": ""
}
```

### HTTP Request
`GET __clockwork/app`


<!-- END_e36bb2e75991fba5b6c2732a5665826b -->

<!-- START_df0f94a5cc73457003ea9d7e7e8ffca9 -->
## __clockwork/{path}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/__clockwork/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/__clockwork/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": ""
}
```

### HTTP Request
`GET __clockwork/{path}`


<!-- END_df0f94a5cc73457003ea9d7e7e8ffca9 -->

<!-- START_e306f94114f4245b3fff5b2bbdc5f6e1 -->
## __clockwork/auth
> Example request:

```bash
curl -X POST \
    "http://localhost/__clockwork/auth" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/__clockwork/auth"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST __clockwork/auth`


<!-- END_e306f94114f4245b3fff5b2bbdc5f6e1 -->

<!-- START_0c068b4037fb2e47e71bd44bd36e3e2a -->
## Authorize a client to access the user&#039;s account.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/oauth/authorize" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/oauth/authorize"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/authorize`


<!-- END_0c068b4037fb2e47e71bd44bd36e3e2a -->

<!-- START_e48cc6a0b45dd21b7076ab2c03908687 -->
## Approve the authorization request.

> Example request:

```bash
curl -X POST \
    "http://localhost/oauth/authorize" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/oauth/authorize"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST oauth/authorize`


<!-- END_e48cc6a0b45dd21b7076ab2c03908687 -->

<!-- START_de5d7581ef1275fce2a229b6b6eaad9c -->
## Deny the authorization request.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/oauth/authorize" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/oauth/authorize"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE oauth/authorize`


<!-- END_de5d7581ef1275fce2a229b6b6eaad9c -->

<!-- START_a09d20357336aa979ecd8e3972ac9168 -->
## Authorize a client to access the user&#039;s account.

> Example request:

```bash
curl -X POST \
    "http://localhost/oauth/token" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/oauth/token"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST oauth/token`


<!-- END_a09d20357336aa979ecd8e3972ac9168 -->

<!-- START_d6a56149547e03307199e39e03e12d1c -->
## Get all of the authorized tokens for the authenticated user.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/oauth/tokens" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/oauth/tokens"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/tokens`


<!-- END_d6a56149547e03307199e39e03e12d1c -->

<!-- START_a9a802c25737cca5324125e5f60b72a5 -->
## Delete the given token.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/oauth/tokens/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/oauth/tokens/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE oauth/tokens/{token_id}`


<!-- END_a9a802c25737cca5324125e5f60b72a5 -->

<!-- START_abe905e69f5d002aa7d26f433676d623 -->
## Get a fresh transient token cookie for the authenticated user.

> Example request:

```bash
curl -X POST \
    "http://localhost/oauth/token/refresh" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/oauth/token/refresh"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST oauth/token/refresh`


<!-- END_abe905e69f5d002aa7d26f433676d623 -->

<!-- START_babcfe12d87b8708f5985e9d39ba8f2c -->
## Get all of the clients for the authenticated user.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/oauth/clients" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/oauth/clients"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/clients`


<!-- END_babcfe12d87b8708f5985e9d39ba8f2c -->

<!-- START_9eabf8d6e4ab449c24c503fcb42fba82 -->
## Store a new client.

> Example request:

```bash
curl -X POST \
    "http://localhost/oauth/clients" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/oauth/clients"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST oauth/clients`


<!-- END_9eabf8d6e4ab449c24c503fcb42fba82 -->

<!-- START_784aec390a455073fc7464335c1defa1 -->
## Update the given client.

> Example request:

```bash
curl -X PUT \
    "http://localhost/oauth/clients/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/oauth/clients/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT oauth/clients/{client_id}`


<!-- END_784aec390a455073fc7464335c1defa1 -->

<!-- START_1f65a511dd86ba0541d7ba13ca57e364 -->
## Delete the given client.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/oauth/clients/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/oauth/clients/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE oauth/clients/{client_id}`


<!-- END_1f65a511dd86ba0541d7ba13ca57e364 -->

<!-- START_9e281bd3a1eb1d9eb63190c8effb607c -->
## Get all of the available scopes for the application.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/oauth/scopes" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/oauth/scopes"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/scopes`


<!-- END_9e281bd3a1eb1d9eb63190c8effb607c -->

<!-- START_9b2a7699ce6214a79e0fd8107f8b1c9e -->
## Get all of the personal access tokens for the authenticated user.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/oauth/personal-access-tokens" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/oauth/personal-access-tokens"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET oauth/personal-access-tokens`


<!-- END_9b2a7699ce6214a79e0fd8107f8b1c9e -->

<!-- START_a8dd9c0a5583742e671711f9bb3ee406 -->
## Create a new personal access token for the user.

> Example request:

```bash
curl -X POST \
    "http://localhost/oauth/personal-access-tokens" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/oauth/personal-access-tokens"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST oauth/personal-access-tokens`


<!-- END_a8dd9c0a5583742e671711f9bb3ee406 -->

<!-- START_bae65df80fd9d72a01439241a9ea20d0 -->
## Delete the given token.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/oauth/personal-access-tokens/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/oauth/personal-access-tokens/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE oauth/personal-access-tokens/{token_id}`


<!-- END_bae65df80fd9d72a01439241a9ea20d0 -->

<!-- START_6e3a68104e6332202d7aae1a30757fa5 -->
## languages
> Example request:

```bash
curl -X GET \
    -G "http://localhost/languages" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/languages"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
[
    {
        "name": "Исландский",
        "label": "Исландский",
        "flag": "http:\/\/api.scandinaver.local\/img\/is_round.png",
        "letter": "is",
        "cards": 174,
        "value": "https:\/\/is.scandinaver.local"
    },
    {
        "name": "Шведский",
        "label": "Шведский",
        "flag": "http:\/\/api.scandinaver.local\/img\/sw_round.png",
        "letter": "sw",
        "cards": 0,
        "value": "https:\/\/sw.scandinaver.local"
    }
]
```

### HTTP Request
`GET languages`


<!-- END_6e3a68104e6332202d7aae1a30757fa5 -->

<!-- START_33a68736a7ed80bda0c3ae4e6ca4a990 -->
## assets/{language}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/assets/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/assets/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET assets/{language}`


<!-- END_33a68736a7ed80bda0c3ae4e6ca4a990 -->

<!-- START_f497f1f7d005ed681f077661b5a3f11b -->
## logs
> Example request:

```bash
curl -X GET \
    -G "http://localhost/logs" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/logs"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "logs": [
        {
            "context": "local",
            "level": "error",
            "level_class": "danger",
            "level_img": "exclamation-triangle",
            "date": "2020-06-26 17:42:26",
            "text": "File does not exist at path \/var\/www\/api\/storage\/debugbar\/1.json {\"exception\":\"[object] (Illuminate\\\\Contracts\\\\Filesystem\\\\FileNotFoundException(code: 0): File does not exist at path \/var\/www\/api\/storage\/debugbar\/1.json at \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Filesystem\/Filesystem.php:41)",
            "in_file": null,
            "stack": "[stacktrace]\n#0 \/var\/www\/api\/vendor\/barryvdh\/laravel-debugbar\/src\/Storage\/FilesystemStorage.php(82): Illuminate\\\\Filesystem\\\\Filesystem->get('\/var\/www\/api\/st...')\n#1 \/var\/www\/api\/vendor\/maximebf\/debugbar\/src\/DebugBar\/OpenHandler.php(106): Barryvdh\\\\Debugbar\\\\Storage\\\\FilesystemStorage->get('1')\n#2 [internal function]: DebugBar\\\\OpenHandler->get(Array)\n#3 \/var\/www\/api\/vendor\/maximebf\/debugbar\/src\/DebugBar\/OpenHandler.php(61): call_user_func(Array, Array)\n#4 \/var\/www\/api\/vendor\/barryvdh\/laravel-debugbar\/src\/Controllers\/OpenHandlerController.php(37): DebugBar\\\\OpenHandler->handle(Array, false, false)\n#5 [internal function]: Barryvdh\\\\Debugbar\\\\Controllers\\\\OpenHandlerController->clockwork('1')\n#6 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Controller.php(54): call_user_func_array(Array, Array)\n#7 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/ControllerDispatcher.php(45): Illuminate\\\\Routing\\\\Controller->callAction('clockwork', Array)\n#8 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Route.php(219): Illuminate\\\\Routing\\\\ControllerDispatcher->dispatch(Object(Illuminate\\\\Routing\\\\Route), Object(Barryvdh\\\\Debugbar\\\\Controllers\\\\OpenHandlerController), 'clockwork')\n#9 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Route.php(176): Illuminate\\\\Routing\\\\Route->runController()\n#10 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php(682): Illuminate\\\\Routing\\\\Route->run()\n#11 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(30): Illuminate\\\\Routing\\\\Router->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#12 \/var\/www\/api\/vendor\/barryvdh\/laravel-debugbar\/src\/Controllers\/BaseController.php(26): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#13 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(145): Barryvdh\\\\Debugbar\\\\Controllers\\\\BaseController->Barryvdh\\\\Debugbar\\\\Controllers\\\\{closure}(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#14 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#15 \/var\/www\/api\/vendor\/barryvdh\/laravel-debugbar\/src\/Middleware\/DebugbarEnabled.php(39): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#16 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): Barryvdh\\\\Debugbar\\\\Middleware\\\\DebugbarEnabled->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#17 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#18 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(104): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#19 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php(684): Illuminate\\\\Pipeline\\\\Pipeline->then(Object(Closure))\n#20 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php(659): Illuminate\\\\Routing\\\\Router->runRouteWithinStack(Object(Illuminate\\\\Routing\\\\Route), Object(Illuminate\\\\Http\\\\Request))\n#21 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php(625): Illuminate\\\\Routing\\\\Router->runRoute(Object(Illuminate\\\\Http\\\\Request), Object(Illuminate\\\\Routing\\\\Route))\n#22 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php(614): Illuminate\\\\Routing\\\\Router->dispatchToRoute(Object(Illuminate\\\\Http\\\\Request))\n#23 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php(176): Illuminate\\\\Routing\\\\Router->dispatch(Object(Illuminate\\\\Http\\\\Request))\n#24 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(30): Illuminate\\\\Foundation\\\\Http\\\\Kernel->Illuminate\\\\Foundation\\\\Http\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#25 \/var\/www\/api\/vendor\/barryvdh\/laravel-debugbar\/src\/Middleware\/InjectDebugbar.php(65): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#26 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): Barryvdh\\\\Debugbar\\\\Middleware\\\\InjectDebugbar->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#27 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#28 \/var\/www\/api\/app\/Http\/Middleware\/Cors.php(39): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#29 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): App\\\\Http\\\\Middleware\\\\Cors->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#30 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#31 \/var\/www\/api\/app\/Http\/Middleware\/ShowDebug.php(32): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#32 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): App\\\\Http\\\\Middleware\\\\ShowDebug->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#33 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#34 \/var\/www\/api\/vendor\/fideloper\/proxy\/src\/TrustProxies.php(57): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#35 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): Fideloper\\\\Proxy\\\\TrustProxies->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#36 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#37 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php(31): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#38 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): Illuminate\\\\Foundation\\\\Http\\\\Middleware\\\\TransformsRequest->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#39 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#40 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php(31): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#41 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): Illuminate\\\\Foundation\\\\Http\\\\Middleware\\\\TransformsRequest->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#42 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#43 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/ValidatePostSize.php(27): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#44 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): Illuminate\\\\Foundation\\\\Http\\\\Middleware\\\\ValidatePostSize->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#45 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#46 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/CheckForMaintenanceMode.php(62): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#47 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): Illuminate\\\\Foundation\\\\Http\\\\Middleware\\\\CheckForMaintenanceMode->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#48 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#49 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(104): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#50 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php(151): Illuminate\\\\Pipeline\\\\Pipeline->then(Object(Closure))\n#51 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php(116): Illuminate\\\\Foundation\\\\Http\\\\Kernel->sendRequestThroughRouter(Object(Illuminate\\\\Http\\\\Request))\n#52 \/var\/www\/api\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Extracting\/Strategies\/Responses\/ResponseCalls.php(307): Illuminate\\\\Foundation\\\\Http\\\\Kernel->handle(Object(Illuminate\\\\Http\\\\Request))\n#53 \/var\/www\/api\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Extracting\/Strategies\/Responses\/ResponseCalls.php(289): Mpociot\\\\ApiDoc\\\\Extracting\\\\Strategies\\\\Responses\\\\ResponseCalls->callLaravelRoute(Object(Illuminate\\\\Http\\\\Request))\n#54 \/var\/www\/api\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Extracting\/Strategies\/Responses\/ResponseCalls.php(47): Mpociot\\\\ApiDoc\\\\Extracting\\\\Strategies\\\\Responses\\\\ResponseCalls->makeApiCall(Object(Illuminate\\\\Http\\\\Request))\n#55 \/var\/www\/api\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Extracting\/Generator.php(172): Mpociot\\\\ApiDoc\\\\Extracting\\\\Strategies\\\\Responses\\\\ResponseCalls->__invoke(Object(Illuminate\\\\Routing\\\\Route), Object(ReflectionClass), Object(ReflectionMethod), Array, Array)\n#56 \/var\/www\/api\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Extracting\/Generator.php(121): Mpociot\\\\ApiDoc\\\\Extracting\\\\Generator->iterateThroughStrategies('responses', Array, Array)\n#57 \/var\/www\/api\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Extracting\/Generator.php(84): Mpociot\\\\ApiDoc\\\\Extracting\\\\Generator->fetchResponses(Object(ReflectionClass), Object(ReflectionMethod), Object(Illuminate\\\\Routing\\\\Route), Array, Array)\n#58 \/var\/www\/api\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Commands\/GenerateDocumentation.php(125): Mpociot\\\\ApiDoc\\\\Extracting\\\\Generator->processRoute(Object(Illuminate\\\\Routing\\\\Route), Array)\n#59 \/var\/www\/api\/vendor\/mpociot\/laravel-apidoc-generator\/src\/Commands\/GenerateDocumentation.php(69): Mpociot\\\\ApiDoc\\\\Commands\\\\GenerateDocumentation->processRoutes(Object(Mpociot\\\\ApiDoc\\\\Extracting\\\\Generator), Array)\n#60 [internal function]: Mpociot\\\\ApiDoc\\\\Commands\\\\GenerateDocumentation->handle(Object(Mpociot\\\\ApiDoc\\\\Matching\\\\RouteMatcher))\n#61 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php(29): call_user_func_array(Array, Array)\n#62 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php(87): Illuminate\\\\Container\\\\BoundMethod::Illuminate\\\\Container\\\\{closure}()\n#63 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php(31): Illuminate\\\\Container\\\\BoundMethod::callBoundMethod(Object(Illuminate\\\\Foundation\\\\Application), Array, Object(Closure))\n#64 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/Container.php(572): Illuminate\\\\Container\\\\BoundMethod::call(Object(Illuminate\\\\Foundation\\\\Application), Array, Array, NULL)\n#65 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php(183): Illuminate\\\\Container\\\\Container->call(Array)\n#66 \/var\/www\/api\/vendor\/symfony\/console\/Command\/Command.php(255): Illuminate\\\\Console\\\\Command->execute(Object(Symfony\\\\Component\\\\Console\\\\Input\\\\ArgvInput), Object(Illuminate\\\\Console\\\\OutputStyle))\n#67 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php(170): Symfony\\\\Component\\\\Console\\\\Command\\\\Command->run(Object(Symfony\\\\Component\\\\Console\\\\Input\\\\ArgvInput), Object(Illuminate\\\\Console\\\\OutputStyle))\n#68 \/var\/www\/api\/vendor\/symfony\/console\/Application.php(1001): Illuminate\\\\Console\\\\Command->run(Object(Symfony\\\\Component\\\\Console\\\\Input\\\\ArgvInput), Object(Symfony\\\\Component\\\\Console\\\\Output\\\\ConsoleOutput))\n#69 \/var\/www\/api\/vendor\/symfony\/console\/Application.php(271): Symfony\\\\Component\\\\Console\\\\Application->doRunCommand(Object(Mpociot\\\\ApiDoc\\\\Commands\\\\GenerateDocumentation), Object(Symfony\\\\Component\\\\Console\\\\Input\\\\ArgvInput), Object(Symfony\\\\Component\\\\Console\\\\Output\\\\ConsoleOutput))\n#70 \/var\/www\/api\/vendor\/symfony\/console\/Application.php(147): Symfony\\\\Component\\\\Console\\\\Application->doRun(Object(Symfony\\\\Component\\\\Console\\\\Input\\\\ArgvInput), Object(Symfony\\\\Component\\\\Console\\\\Output\\\\ConsoleOutput))\n#71 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Application.php(89): Symfony\\\\Component\\\\Console\\\\Application->run(Object(Symfony\\\\Component\\\\Console\\\\Input\\\\ArgvInput), Object(Symfony\\\\Component\\\\Console\\\\Output\\\\ConsoleOutput))\n#72 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Console\/Kernel.php(122): Illuminate\\\\Console\\\\Application->run(Object(Symfony\\\\Component\\\\Console\\\\Input\\\\ArgvInput), Object(Symfony\\\\Component\\\\Console\\\\Output\\\\ConsoleOutput))\n#73 \/var\/www\/api\/artisan(37): Illuminate\\\\Foundation\\\\Console\\\\Kernel->handle(Object(Symfony\\\\Component\\\\Console\\\\Input\\\\ArgvInput), Object(Symfony\\\\Component\\\\Console\\\\Output\\\\ConsoleOutput))\n#74 {main}\n\"} \n"
        },
        {
            "context": "local",
            "level": "error",
            "level_class": "danger",
            "level_img": "exclamation-triangle",
            "date": "2020-06-26 17:24:59",
            "text": "The MAC is invalid. {\"exception\":\"[object] (Illuminate\\\\Contracts\\\\Encryption\\\\DecryptException(code: 0): The MAC is invalid. at \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Encryption\/Encrypter.php:195)",
            "in_file": null,
            "stack": "[stacktrace]\n#0 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Encryption\/Encrypter.php(134): Illuminate\\\\Encryption\\\\Encrypter->getJsonPayload(Array)\n#1 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Support\/Facades\/Facade.php(237): Illuminate\\\\Encryption\\\\Encrypter->decrypt('eyJpdiI6IjJCanN...')\n#2 \/var\/www\/api\/vendor\/rap2hpoutre\/laravel-log-viewer\/src\/controllers\/LogViewerController.php(49): Illuminate\\\\Support\\\\Facades\\\\Facade::__callStatic('decrypt', Array)\n#3 [internal function]: Rap2hpoutre\\\\LaravelLogViewer\\\\LogViewerController->index()\n#4 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Controller.php(54): call_user_func_array(Array, Array)\n#5 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/ControllerDispatcher.php(45): Illuminate\\\\Routing\\\\Controller->callAction('index', Array)\n#6 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Route.php(219): Illuminate\\\\Routing\\\\ControllerDispatcher->dispatch(Object(Illuminate\\\\Routing\\\\Route), Object(Rap2hpoutre\\\\LaravelLogViewer\\\\LogViewerController), 'index')\n#7 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Route.php(176): Illuminate\\\\Routing\\\\Route->runController()\n#8 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php(682): Illuminate\\\\Routing\\\\Route->run()\n#9 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(30): Illuminate\\\\Routing\\\\Router->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#10 \/var\/www\/api\/vendor\/laravel\/passport\/src\/Http\/Middleware\/CreateFreshApiToken.php(49): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#11 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): Laravel\\\\Passport\\\\Http\\\\Middleware\\\\CreateFreshApiToken->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#12 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#13 \/var\/www\/api\/vendor\/laravel-doctrine\/orm\/src\/Middleware\/SubstituteBindings.php(52): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#14 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): LaravelDoctrine\\\\ORM\\\\Middleware\\\\SubstituteBindings->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#15 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#16 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/VerifyCsrfToken.php(75): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#17 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): Illuminate\\\\Foundation\\\\Http\\\\Middleware\\\\VerifyCsrfToken->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#18 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#19 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Session\/Middleware\/AuthenticateSession.php(39): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#20 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): Illuminate\\\\Session\\\\Middleware\\\\AuthenticateSession->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#21 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#22 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/View\/Middleware\/ShareErrorsFromSession.php(49): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#23 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): Illuminate\\\\View\\\\Middleware\\\\ShareErrorsFromSession->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#24 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#25 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Session\/Middleware\/StartSession.php(63): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#26 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): Illuminate\\\\Session\\\\Middleware\\\\StartSession->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#27 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#28 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Cookie\/Middleware\/AddQueuedCookiesToResponse.php(37): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#29 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): Illuminate\\\\Cookie\\\\Middleware\\\\AddQueuedCookiesToResponse->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#30 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#31 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Cookie\/Middleware\/EncryptCookies.php(66): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#32 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): Illuminate\\\\Cookie\\\\Middleware\\\\EncryptCookies->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#33 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#34 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(104): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#35 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php(684): Illuminate\\\\Pipeline\\\\Pipeline->then(Object(Closure))\n#36 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php(659): Illuminate\\\\Routing\\\\Router->runRouteWithinStack(Object(Illuminate\\\\Routing\\\\Route), Object(Illuminate\\\\Http\\\\Request))\n#37 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php(625): Illuminate\\\\Routing\\\\Router->runRoute(Object(Illuminate\\\\Http\\\\Request), Object(Illuminate\\\\Routing\\\\Route))\n#38 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php(614): Illuminate\\\\Routing\\\\Router->dispatchToRoute(Object(Illuminate\\\\Http\\\\Request))\n#39 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php(176): Illuminate\\\\Routing\\\\Router->dispatch(Object(Illuminate\\\\Http\\\\Request))\n#40 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(30): Illuminate\\\\Foundation\\\\Http\\\\Kernel->Illuminate\\\\Foundation\\\\Http\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#41 \/var\/www\/api\/vendor\/barryvdh\/laravel-debugbar\/src\/Middleware\/InjectDebugbar.php(58): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#42 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): Barryvdh\\\\Debugbar\\\\Middleware\\\\InjectDebugbar->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#43 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#44 \/var\/www\/api\/app\/Http\/Middleware\/Cors.php(39): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#45 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): App\\\\Http\\\\Middleware\\\\Cors->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#46 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#47 \/var\/www\/api\/app\/Http\/Middleware\/ShowDebug.php(32): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#48 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): App\\\\Http\\\\Middleware\\\\ShowDebug->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#49 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#50 \/var\/www\/api\/vendor\/fideloper\/proxy\/src\/TrustProxies.php(57): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#51 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): Fideloper\\\\Proxy\\\\TrustProxies->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#52 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#53 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php(31): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#54 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): Illuminate\\\\Foundation\\\\Http\\\\Middleware\\\\TransformsRequest->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#55 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#56 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php(31): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#57 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): Illuminate\\\\Foundation\\\\Http\\\\Middleware\\\\TransformsRequest->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#58 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#59 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/ValidatePostSize.php(27): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#60 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): Illuminate\\\\Foundation\\\\Http\\\\Middleware\\\\ValidatePostSize->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#61 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#62 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/CheckForMaintenanceMode.php(62): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#63 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): Illuminate\\\\Foundation\\\\Http\\\\Middleware\\\\CheckForMaintenanceMode->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#64 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#65 \/var\/www\/api\/vendor\/itsgoingd\/clockwork\/Clockwork\/Support\/Laravel\/ClockworkMiddleware.php(27): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#66 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): Clockwork\\\\Support\\\\Laravel\\\\ClockworkMiddleware->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#67 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#68 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(104): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#69 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php(151): Illuminate\\\\Pipeline\\\\Pipeline->then(Object(Closure))\n#70 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php(116): Illuminate\\\\Foundation\\\\Http\\\\Kernel->sendRequestThroughRouter(Object(Illuminate\\\\Http\\\\Request))\n#71 \/var\/www\/api\/public\/index.php(55): Illuminate\\\\Foundation\\\\Http\\\\Kernel->handle(Object(Illuminate\\\\Http\\\\Request))\n#72 {main}\n\"} \n"
        },
        {
            "context": "local",
            "level": "error",
            "level_class": "danger",
            "level_img": "exclamation-triangle",
            "date": "2020-06-26 17:18:24",
            "text": "Route [login] not defined. {\"exception\":\"[object] (InvalidArgumentException(code: 0): Route [login] not defined. at \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/UrlGenerator.php:389)",
            "in_file": null,
            "stack": "[stacktrace]\n#0 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/helpers.php(822): Illuminate\\\\Routing\\\\UrlGenerator->route('login', Array, true)\n#1 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Exceptions\/Handler.php(221): route('login')\n#2 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Exceptions\/Handler.php(181): Illuminate\\\\Foundation\\\\Exceptions\\\\Handler->unauthenticated(Object(Illuminate\\\\Http\\\\Request), Object(Illuminate\\\\Auth\\\\AuthenticationException))\n#3 \/var\/www\/api\/app\/Exceptions\/Handler.php(61): Illuminate\\\\Foundation\\\\Exceptions\\\\Handler->render(Object(Illuminate\\\\Http\\\\Request), Object(Illuminate\\\\Auth\\\\AuthenticationException))\n#4 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(83): App\\\\Exceptions\\\\Handler->render(Object(Illuminate\\\\Http\\\\Request), Object(Illuminate\\\\Auth\\\\AuthenticationException))\n#5 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(55): Illuminate\\\\Routing\\\\Pipeline->handleException(Object(Illuminate\\\\Http\\\\Request), Object(Illuminate\\\\Auth\\\\AuthenticationException))\n#6 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(104): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#7 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php(684): Illuminate\\\\Pipeline\\\\Pipeline->then(Object(Closure))\n#8 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php(659): Illuminate\\\\Routing\\\\Router->runRouteWithinStack(Object(Illuminate\\\\Routing\\\\Route), Object(Illuminate\\\\Http\\\\Request))\n#9 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php(625): Illuminate\\\\Routing\\\\Router->runRoute(Object(Illuminate\\\\Http\\\\Request), Object(Illuminate\\\\Routing\\\\Route))\n#10 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php(614): Illuminate\\\\Routing\\\\Router->dispatchToRoute(Object(Illuminate\\\\Http\\\\Request))\n#11 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php(176): Illuminate\\\\Routing\\\\Router->dispatch(Object(Illuminate\\\\Http\\\\Request))\n#12 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(30): Illuminate\\\\Foundation\\\\Http\\\\Kernel->Illuminate\\\\Foundation\\\\Http\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#13 \/var\/www\/api\/vendor\/barryvdh\/laravel-debugbar\/src\/Middleware\/InjectDebugbar.php(58): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#14 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): Barryvdh\\\\Debugbar\\\\Middleware\\\\InjectDebugbar->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#15 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#16 \/var\/www\/api\/app\/Http\/Middleware\/Cors.php(39): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#17 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): App\\\\Http\\\\Middleware\\\\Cors->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#18 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#19 \/var\/www\/api\/app\/Http\/Middleware\/ShowDebug.php(32): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#20 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): App\\\\Http\\\\Middleware\\\\ShowDebug->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#21 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#22 \/var\/www\/api\/vendor\/fideloper\/proxy\/src\/TrustProxies.php(57): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#23 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): Fideloper\\\\Proxy\\\\TrustProxies->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#24 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#25 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php(31): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#26 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): Illuminate\\\\Foundation\\\\Http\\\\Middleware\\\\TransformsRequest->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#27 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#28 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php(31): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#29 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): Illuminate\\\\Foundation\\\\Http\\\\Middleware\\\\TransformsRequest->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#30 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#31 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/ValidatePostSize.php(27): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#32 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): Illuminate\\\\Foundation\\\\Http\\\\Middleware\\\\ValidatePostSize->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#33 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#34 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/CheckForMaintenanceMode.php(62): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#35 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): Illuminate\\\\Foundation\\\\Http\\\\Middleware\\\\CheckForMaintenanceMode->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#36 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#37 \/var\/www\/api\/vendor\/itsgoingd\/clockwork\/Clockwork\/Support\/Laravel\/ClockworkMiddleware.php(27): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#38 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(163): Clockwork\\\\Support\\\\Laravel\\\\ClockworkMiddleware->handle(Object(Illuminate\\\\Http\\\\Request), Object(Closure))\n#39 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php(53): Illuminate\\\\Pipeline\\\\Pipeline->Illuminate\\\\Pipeline\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#40 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php(104): Illuminate\\\\Routing\\\\Pipeline->Illuminate\\\\Routing\\\\{closure}(Object(Illuminate\\\\Http\\\\Request))\n#41 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php(151): Illuminate\\\\Pipeline\\\\Pipeline->then(Object(Closure))\n#42 \/var\/www\/api\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php(116): Illuminate\\\\Foundation\\\\Http\\\\Kernel->sendRequestThroughRouter(Object(Illuminate\\\\Http\\\\Request))\n#43 \/var\/www\/api\/public\/index.php(55): Illuminate\\\\Foundation\\\\Http\\\\Kernel->handle(Object(Illuminate\\\\Http\\\\Request))\n#44 {main}\n\"} \n"
        }
    ],
    "folders": [],
    "current_folder": null,
    "folder_files": [],
    "files": [
        "laravel-2020-06-26.log",
        "laravel-2020-06-23.log",
        "laravel-2020-06-21.log",
        "laravel-2020-06-20.log",
        "laravel-2020-06-19.log",
        "laravel-2020-06-18.log",
        "laravel-2020-06-17.log",
        "laravel-2020-06-16.log",
        "laravel-2020-06-12.log",
        "laravel-2020-06-07.log",
        "laravel-2020-06-06.log"
    ],
    "current_file": "laravel-2020-06-26.log",
    "standardFormat": true
}
```

### HTTP Request
`GET logs`


<!-- END_f497f1f7d005ed681f077661b5a3f11b -->

<!-- START_41ec161bb0631a5e8679f86e04fd290e -->
## Handle a registration request for the application.

> Example request:

```bash
curl -X POST \
    "http://localhost/signup" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/signup"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST signup`


<!-- END_41ec161bb0631a5e8679f86e04fd290e -->

<!-- START_feb40f06a93c80d742181b6ffb6b734e -->
## Send a reset link to the given user.

> Example request:

```bash
curl -X POST \
    "http://localhost/password/email" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/password/email"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST password/email`


<!-- END_feb40f06a93c80d742181b6ffb6b734e -->

<!-- START_e1605a6e5ceee9d1aeb7729216635fd7 -->
## Display the password reset view for the given token.

If no token is present, display the link request form.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/password/reset/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/password/reset/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET password/reset/{token}`


<!-- END_e1605a6e5ceee9d1aeb7729216635fd7 -->

<!-- START_d72797bae6d0b1f3a341ebb1f8900441 -->
## Display the form to request a password reset link.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/password/reset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/password/reset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET password/reset`


<!-- END_d72797bae6d0b1f3a341ebb1f8900441 -->

<!-- START_cafb407b7a846b31491f97719bb15aef -->
## Reset the given user&#039;s password.

> Example request:

```bash
curl -X POST \
    "http://localhost/password/reset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/password/reset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST password/reset`


<!-- END_cafb407b7a846b31491f97719bb15aef -->

<!-- START_53be1e9e10a08458929a2e0ea70ddb86 -->
## /
> Example request:

```bash
curl -X GET \
    -G "http://localhost/" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET /`


<!-- END_53be1e9e10a08458929a2e0ea70ddb86 -->

<!-- START_47f7fbb6bf98ef4cdc54b10f03cb3bdd -->
## profile
> Example request:

```bash
curl -X GET \
    -G "http://localhost/profile" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/profile"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET profile`


<!-- END_47f7fbb6bf98ef4cdc54b10f03cb3bdd -->

<!-- START_75a0e435e012c8f840b6ee2d74f5c5ec -->
## profile/settings
> Example request:

```bash
curl -X GET \
    -G "http://localhost/profile/settings" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/profile/settings"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET profile/settings`


<!-- END_75a0e435e012c8f840b6ee2d74f5c5ec -->

<!-- START_3075a92e676c21e7a37b7f50b7c38bcc -->
## profile/log
> Example request:

```bash
curl -X GET \
    -G "http://localhost/profile/log" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/profile/log"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET profile/log`


<!-- END_3075a92e676c21e7a37b7f50b7c38bcc -->

<!-- START_c8c8518c799b0ec0f84e2a5499828581 -->
## profile/uploadImage
> Example request:

```bash
curl -X POST \
    "http://localhost/profile/uploadImage" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/profile/uploadImage"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST profile/uploadImage`


<!-- END_c8c8518c799b0ec0f84e2a5499828581 -->

<!-- START_643f86ff15dea0155f2a062e1815dc04 -->
## profile/update
> Example request:

```bash
curl -X POST \
    "http://localhost/profile/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/profile/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST profile/update`


<!-- END_643f86ff15dea0155f2a062e1815dc04 -->

<!-- START_552eb83f4fed6da80e2547a2c4dfb678 -->
## pay
> Example request:

```bash
curl -X GET \
    -G "http://localhost/pay" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/pay"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET pay`


<!-- END_552eb83f4fed6da80e2547a2c4dfb678 -->

<!-- START_78e6f1877b9c94042dbbdf6ab946f98a -->
## Start handle process from route
TODO: сделать нормально!

> Example request:

```bash
curl -X POST \
    "http://localhost/pay/success" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/pay/success"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST pay/success`


<!-- END_78e6f1877b9c94042dbbdf6ab946f98a -->

<!-- START_24d82aba5ac9525b0fff0871376af517 -->
## pay/{name}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/pay/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/pay/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET pay/{name}`


<!-- END_24d82aba5ac9525b0fff0871376af517 -->

<!-- START_cc5dc3e9fbf811f5451c602c809013d3 -->
## {language}/state
> Example request:

```bash
curl -X GET \
    -G "http://localhost/1/state" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/1/state"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET {language}/state`


<!-- END_cc5dc3e9fbf811f5451c602c809013d3 -->

<!-- START_3bcedda78ae45ef5c0f4c97a4963b7a1 -->
## user
> Example request:

```bash
curl -X GET \
    -G "http://localhost/user" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/user"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET user`


<!-- END_3bcedda78ae45ef5c0f4c97a4963b7a1 -->

<!-- START_6ced6195e6c39da21a9ac37b11f15624 -->
## info
> Example request:

```bash
curl -X GET \
    -G "http://localhost/info" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/info"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET info`


<!-- END_6ced6195e6c39da21a9ac37b11f15624 -->

<!-- START_9031729176c8de9ae597948c0e0b3cc1 -->
## words
> Example request:

```bash
curl -X GET \
    -G "http://localhost/words" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/words"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET words`


<!-- END_9031729176c8de9ae597948c0e0b3cc1 -->

<!-- START_dd4e0cd1f7a5db3fd9d16b6f0cf07ac3 -->
## {language}/personal
> Example request:

```bash
curl -X GET \
    -G "http://localhost/1/personal" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/1/personal"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET {language}/personal`


<!-- END_dd4e0cd1f7a5db3fd9d16b6f0cf07ac3 -->

<!-- START_f6d40ad1b35ca50928047c1c710cb542 -->
## {language}/asset/{asset}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/1/asset/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/1/asset/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET {language}/asset/{asset}`


<!-- END_f6d40ad1b35ca50928047c1c710cb542 -->

<!-- START_a1011907e644a7c83e37d5c3b4839061 -->
## {language}/asset
> Example request:

```bash
curl -X POST \
    "http://localhost/1/asset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/1/asset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST {language}/asset`


<!-- END_a1011907e644a7c83e37d5c3b4839061 -->

<!-- START_2b4f1bd73f6bb25cb7bc8a4ca11e2f04 -->
## {language}/asset/{asset}
> Example request:

```bash
curl -X PUT \
    "http://localhost/1/asset/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/1/asset/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT {language}/asset/{asset}`


<!-- END_2b4f1bd73f6bb25cb7bc8a4ca11e2f04 -->

<!-- START_bf54b5093cdd29cc2cf8926f1faef5f7 -->
## {language}/asset/{asset}
> Example request:

```bash
curl -X DELETE \
    "http://localhost/1/asset/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/1/asset/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE {language}/asset/{asset}`


<!-- END_bf54b5093cdd29cc2cf8926f1faef5f7 -->

<!-- START_d32422ff806185e7e4efbdfc54ff04a5 -->
## {language}/favourite/{word}/{translate}
> Example request:

```bash
curl -X POST \
    "http://localhost/1/favourite/1/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/1/favourite/1/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST {language}/favourite/{word}/{translate}`


<!-- END_d32422ff806185e7e4efbdfc54ff04a5 -->

<!-- START_7401caf2481d59ffebd43fa502f7a05b -->
## {language}/favourite/{id}
> Example request:

```bash
curl -X DELETE \
    "http://localhost/1/favourite/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/1/favourite/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE {language}/favourite/{id}`


<!-- END_7401caf2481d59ffebd43fa502f7a05b -->

<!-- START_4d06618b86ef2aea04c6edfa52c0d9f3 -->
## Сохранить результат

> Example request:

```bash
curl -X POST \
    "http://localhost/result/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/result/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST result/{asset}`


<!-- END_4d06618b86ef2aea04c6edfa52c0d9f3 -->

<!-- START_e7f09f37193eb75b46914739e01828a9 -->
## complete/{asset}
> Example request:

```bash
curl -X POST \
    "http://localhost/complete/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/complete/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST complete/{asset}`


<!-- END_e7f09f37193eb75b46914739e01828a9 -->

<!-- START_52c566144c419b093065d6c0c3f665f7 -->
## card/{word}/{translate}/{asset}
> Example request:

```bash
curl -X POST \
    "http://localhost/card/1/1/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/card/1/1/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST card/{word}/{translate}/{asset}`


<!-- END_52c566144c419b093065d6c0c3f665f7 -->

<!-- START_0cb5e144b868ae6069d48f14a50860f5 -->
## {language}/card/{card}
> Example request:

```bash
curl -X DELETE \
    "http://localhost/1/card/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/1/card/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE {language}/card/{card}`


<!-- END_0cb5e144b868ae6069d48f14a50860f5 -->

<!-- START_55d702ad8085b3d4129b78c0c7c46f1e -->
## {language}/translate
> Example request:

```bash
curl -X GET \
    -G "http://localhost/1/translate" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/1/translate"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET {language}/translate`


<!-- END_55d702ad8085b3d4129b78c0c7c46f1e -->

<!-- START_1baa83279f871d68382745d0d0066666 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/word" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/word"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET word`


<!-- END_1baa83279f871d68382745d0d0066666 -->

<!-- START_a4a19a0669d18b74c1720badc6b997e8 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST \
    "http://localhost/word" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/word"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST word`


<!-- END_a4a19a0669d18b74c1720badc6b997e8 -->

<!-- START_146ae736eab6b6891826dd50ba598ba7 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/word/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/word/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET word/{word}`


<!-- END_146ae736eab6b6891826dd50ba598ba7 -->

<!-- START_da29f5420f7d3f449897c64670b22287 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE \
    "http://localhost/word/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/word/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE word/{word}`


<!-- END_da29f5420f7d3f449897c64670b22287 -->

<!-- START_1a6edb4e401f8d26219307fe9d791d5f -->
## {language}/puzzle
> Example request:

```bash
curl -X GET \
    -G "http://localhost/1/puzzle" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/1/puzzle"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET {language}/puzzle`


<!-- END_1a6edb4e401f8d26219307fe9d791d5f -->

<!-- START_8f43cf069b8729aec2ab5b7b772c4c8c -->
## {language}/puzzle/{puzzle}
> Example request:

```bash
curl -X PUT \
    "http://localhost/1/puzzle/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/1/puzzle/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT {language}/puzzle/{puzzle}`

`PATCH {language}/puzzle/{puzzle}`


<!-- END_8f43cf069b8729aec2ab5b7b772c4c8c -->

<!-- START_7691a0c24e5b80703673b9b62fdc518b -->
## {language}/text/{text}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/1/text/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/1/text/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET {language}/text/{text}`


<!-- END_7691a0c24e5b80703673b9b62fdc518b -->


