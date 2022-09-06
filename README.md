# Portofolio Dashboard
Sebuah program untuk menyimpan data portofolio serta kotak masuk yang di perlukan dalam sebuah web portofolio

### made with
- PHP >= 7.3
- PHP laravel ^8
- javascript
- jQuery
- SweetAlert 2
- Bootstrap 5
- CSS native

### feature
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
- Fill URL

##### Send JSON file with format :
```json
{
  "field required 1": "some value",
  "field required 2": "some value"
}
```

##### example POST a Inbox use API

- fill URL
```shell
/api/inbox/:username?apikey=<YOUR APIKEY>
```
- set content or body as JSON
```json
{
  "message": "hello world!",
  "sender": "Fiandev"
}
```
- Send using method POST request

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
