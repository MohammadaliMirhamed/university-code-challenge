

# Setup

In this project, I used Laravel Sail. This means the project should run on Docker. Run the following command after each step is done.


- ```cd university-challenge-espd```
- ```composer install```
- ```vendor/bin/sail up```
- in Laravel container [docker] : ```php artisan migrate --seed```

## Application Monitoring
For monitoring the Application you can go to the following link.
```http://localhost/telescope```

## endpoints
| method         | route |about   | parameters    |
| -------------  | -------------  | ------------- | ------------- |
| ```GET```      | api/v1/courses | get list of courses | ------ |
| ```GET```      | api/v1/courses/```{course_id}``` | get single course | ------ |
| ```GET```      | api/v1/courses/```{course_id}```/registrations | get list of registrations | ------ |
| ```POST```     | api/v1/courses/```{course_id}```/registrations | create new registration | ```student_id => int``` |
| ```GET```      | api/v1/courses/```{course_id}```/registrations/```{registration_id}``` | get single registration | ------ |

```there are many unimplemented endpoints```
