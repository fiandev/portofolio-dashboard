# API Portfolio
A program for storing portfolio data and inboxes needed in a web portfolio

### made with
- HTML 5
- CSS native
- javascript
- jQuery
- Bootstrap 5
- SweetAlert 2
- PHP >= 7.3
- PHP laravel v8.x.xx

### features
- Manual input data from Dashboard
- Input data using API
- Get data using API

### how to use
- register & login
- edit Your profile
- add your skills
- add your sosial media links
- add a apikey to your account

### endpoint API

#### method GET

- GET PROFILE
```shell
/api/profile/:username?apikey=<YOUR APIKEY>
```

- GET Inbox
```shell
/api/inbox/:username?apikey=<YOUR APIKEY>
```

- GET Links
```shell
/api/links/:username?apikey=<YOUR APIKEY>
```

#### method POST

- POST Inbox
```shell
/api/inbox/:username?apikey=<YOUR APIKEY>
```

- POST links
```shell
/api/links/:username?apikey=<YOUR APIKEY>
```

<hr>

#### how to use method POST

1. Fill URL

##### Send JSON file with format :
```json
{
  "field required 1": "some value",
  "field required 2": "some value"
}
```

##### example POST a Inbox use API

1. fill URL
```shell
/api/inbox/:username?apikey=<YOUR APIKEY>
```
2. set content or body as JSON
```json
{
  "message": "hello world!",
  "sender": "Fiandev"
}
```
3. Send using method POST request

##### response success

```json
{
  "code": 200,
  "message": "success",
  "data": {
      "message": "hello world!",
      "sender": "Fiandev"
  }
}
```

##### response error
```json
{
  "code": 200,
  "status": "failed",
  "message": "data request is invalid",
  "error": {
      "some field": ["error message!"]
  }
}
```

> made with ❤️ by fiandev
