# StaffBook

This was built on a fresh Ubuntu Docker container, I added a typical LAMP stack including Apache, MySQL 8.0 and PHP..

## Todo

- Transform DOB to and from Date/Text for the form.
- Back end validation
- Front end validation
- Move things into individual locations
- Auto-install script

## Setup

Ensure Apache, PHP and MySQL are installed (MySQL version 8.0 was used for this).

Change variables in `.env` to match your username/login/host, etc. I used root/pass for this on localhost.

Run following commands to generate DB, etc.

`php bin/console doctrine:database:create`
`php bin/console doctrine:schema:create`
