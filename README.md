<div align='center'>
    <img src='https://govassist.com/wp-content/uploads/2022/03/govassist_logo.svg' height="85" />
    <p>Technical Challenge.</p>
    
![PHP](https://badgen.net/badge/Php/8.1/blue?)
![Laravel](https://badgen.net/badge/Laravel/10/red?)
![Vue](https://badgen.net/badge/vue/3/green?)

</div>

---

## 💾 **ABOUT**

This is the GovAssist TECH CHALLENGE.

As an Entity, we have added a "URL" model.
These are only some of the files used. This will create the DB schema, and seed some dummy info into tables, for a better understanding. 

BE AWARE: A MySql server must be installed and running in order to test this challenge.
(docker run --name mysql -d -p 3306:3306 -e MYSQL_ROOT_PASSWORD=change-me --restart unless-stopped mysql:8)

Files created for MODELS SCHEMA:

| Type          | Name                                           | Description
| ------------- | ---------------------------------------------- | -------------------------------- |
| Model         | Url.php                                        |
| Model         | User.php                                       |


| Type          | Name                                           | Description
| ------------- | ---------------------------------------------- | -------------------------------- |
| Factory       | UrlFactory.php                                 |
| Factory       | UserFactory.php                                |


| Type          | Name                                           | Description
| ------------- | ---------------------------------------------- | -------------------------------- |
| Seeder        | UrlSeeder.php                                  | Loads Dummy Urls into DB.


| Type          | Name                                           | Description
| ------------- | ---------------------------------------------- | --------------------------------- |
| Migration     | 2023_08_30_194103_create_url_table.php         |
| Migration     | 2023_08_30_200537_create_users_table.php       | 

<br />

CHALLENGE: 
- Endpoints for authentication using JWT. Also an endpoint for refreshing the JWT access token. (CSRF sanctrum for cookie not added)

	  POST       api/auths/login ............................................ AuthController@login  
	  POST       api/auths/logout ........................................... AuthController@logout  
	  POST       api/auths/refresh .......................................... AuthController@refresh  
	  POST       api/auths/register ......................................... AuthController@register
  
- Endpoints for CRUD URL. It also allows to filter by state.

	Example: http://127.0.0.1:8000/api/urls?per_page=25&state=Active
	Filter for Urls is by State (only added one as an example)
 
	  GET|HEAD  api/urls ..................................... urls.index   › UrlController@index  
	  POST      api/urls ..................................... urls.store   › UrlController@store
	  POST      api/urls/state ............................... urls.state.update   › UrlController@stateUpdate
	  GET|HEAD  api/urls/{url} ............................... urls.show    › UrlController@show 
	  DELETE    api/urls/{url} ............................... urls.destroy › UrlController@destroy
	  GET|HEAD  /{url} ....................................... urls.redirect › UrlController@redirect


- We are using Middlewares for JWT authentication, and to configure JSON responses or VIEWS responses depending on the case. 
- We homogenized the responses for api with a JsonHelper, used in the Global Exception Handler.
- We have implemented: "php-open-source-saver/jwt-auth": "^2.1", (For JWT auth manipulation) and "veelasky/laravel-hashid": "^3.1" (for hashing the slug automatically)
- We are using the LARAVEL-HASHID treat in the url model, to map the hash into the slug. 

<br />

For the FRONT-END vue 3 application. 

- We have added login.
- We have added registration (with minimun fields).
- We have added a CREATE and INDEX VIEW for URLS.
- We have added a simple about screen, to explain the Challenge.
- We have added a logout functionality. 

- We are using AXIOS for endpoints requests, vuetify 3 for styles framework, and vue 3 with script setup notations. 
- We have created 2 middlewares. 1 to add the JWT on all the neccesary requests. And another one to detect whenever the application is logged out, to push user to login screen.

## 🗒️ **INSTALLATION**

### Deployment:

1. clone the repo

```
git clone https://github.com/iciani/govAssist.git
```

2. cd into cloned repo

```
cd gobAssist
cd back
```

3. install dependencies

```
composer install
```

4. Remember to Generate .ENV file.

Parameters here are basic. They can be change regarding environment.

```
cp .env.example .env
```

5. Validate the Code
```
./vendor/bin/phplint
./vendor/bin/phpcs -s
php artisan test
```

6. Execute Migrations (This will create all the DATABASE models)
```
php artisan migrate (you will be asked to create the DB, please type yes)
```

7. Execute Seeders (This will fill in dummy information for testing purposes)
```
php artisan db:seed (you can execute this command, as many times as you wish. This will be adding new lines)
```

8. Load POSTMAN collection to TEST the ENDPOINTS (Found in this folder BACK)
```
govassist.postman_collection.json
```

9. Run Schedules (To validate the execution of the command, we have scheduled every minute.)
```
php artisan schedule:run
```


<br />

### Run the Server App:

1. Execute the App in one Terminal

```
php artisan serve (Being at PWD root of folder BACK)
```

3. If you visit the base url configured (default would be http://localhost:8000) you should now see a welcome screen in /.


<br/>


### Run the Client App:

1. In a new terminal, browse project folder.

```
cd gobAssist
cd front
```

2. Install dependencies.

```
npm install
```

3. Validate the Code.

```
npm run lint
```

4. Run the App.

```
npm run dev
```

5. Run the Tests.

```
npx cypress run
```

6. As default, the DB was seeded with Admin User, or you can Register new user.

```
admin@govassist.com // govassist
```


---

## 🔎 **SHOWCASE**

<img src="https://i.ibb.co/NtVSz0c/govassist-back-welcome.png" alt="looi-server-welcome-screen" border="0">
<br />
<img src="https://i.ibb.co/D1h0pb0/govassist-front-login.png" alt="vue-login-page-looi" border="0">
<br />
<img src="https://i.ibb.co/6H0Wztd/govassist-front-not-found.png" alt="vue-login-page-looi" border="0">
<br />
<img src="https://i.ibb.co/47r9BSm/govassist-front-welcome.png" alt="route-list" border="0">
<br />
<img src="https://i.ibb.co/546pQc1/govassist-routes.png" alt="route-list" border="0">
<br />
<img src="https://i.ibb.co/2h2GhCp/govassist-back-tests.png" alt="looi-tests" border="0">
<br />
<img src="https://i.ibb.co/NmYvh2Y/govassist-front-tests.png" alt="cypress-front-tests" border="0">

<br />

---

## 💻 **TECHNOLOGIES**

![PHP](https://img.shields.io/badge/PHP-lightblue)

![Laravel](https://img.shields.io/badge/laravel-red)

![MySQL](https://img.shields.io/badge/mysql-blue)

![VUE3](https://img.shields.io/badge/vue3-green)

<br />

---