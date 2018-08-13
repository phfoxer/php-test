### API server requeriments
* PHP 7.0 >=
* Apache2.0 >=
* Rewrite mode On

### Usage: Methods and action
| Verb | Route | Action | Return |
| ------ | ------ | ------ | ------ |
| GET | /exercicio7/api/users/list | list | List all users |
| POST | /exercicio7/api/users/create | create | If the user was created the api returns a object "done" as boolean and a message |
| PUT | /exercicio7/api/users/update | update | 	If the user was created the api returns a object "done" as boolean and a message |
| DELETE | exercicio7/api/users/delete | delete | You must send only the email to delete the user |