# StaffBook

This was built on a fresh Ubuntu Docker container, I added a typical LAMP stack including Apache, MySQL 8.0 and PHP..

## Setup

Ensure Apache, PHP and MySQL are installed (MySQL version 8.0 was used for this).

Change variables in `.env` to match your username/login/host, etc. I used root/pass for this on localhost.

Run following commands to generate DB, etc.

`composer install`

`php bin/console doctrine:database:create`

`php bin/console doctrine:schema:create`

Access via the server @ `http://<host>/symf/public/index.php/hellouser` currently, as no virtual hosts/sites have been setup.

This can easily be changed to an alternative to /hellouser by amending the Route within the `HomeController`

Or access on the local machine by running `symfony server:start` and `symfony open:local`

## Todo

- Correctly format form (css table, css grid, etc)
- Improve Front end validation, and make defensive
- DOB Backend-Validation
	- Prevent from auto-filling 01/01/70 if a datetime wasn't entered
	- Potentially the best fix is to remove entity and use a custom data object
- Move things into individual locations *clean up*

## Extra/Ideas for further development

- Extra entities for relationships, ie. authorisation levels
- CRUD for managing staff relationships
- Include AJAX
- Auto-install script
