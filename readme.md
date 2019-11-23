# Admin panel with Laravel and Admin lte 3

This project can be used for almost any web system for administration.
It can be easily configured with documentation down below.

## It includes

- Admin panel with some CRUD tables.
- It has working permission system with easy access to configure.
- Demo CRUD table: product management
- Everything that is needed for CRUDs: model+migration+controller+requests+views

From this template you can freely expand more CRUD tables.

__Notice__: In this project AdminLTE is in version[v3.0.0-Alpha 2 release in May 2018](https://github.com/ColorlibHQ/AdminLTE/releases/tag/v3.0.0-alpha.2).


## How to use

1. Clone the repository with __git clone__

	```
	git clone https://github.com/zigcBenx/AdminPanelTemplate.git
	```

2. Go to phpmyadmin or any other administration tool for database that you are used to, and generate new database.

3. Copy __.env.example__ file to __.env__ and edit database credentials that you used in previous step.

4. In terminal run:
	```
	composer install
	```
		
    Run:
	```
	php artisan key:generate
	```
    And finally:
	```
	php artisan migrate --seed
	```
	> It already has some data seeded in database so you will be able to login.

5. You are done!
	Just start your server by executing:
	```
	php artisan serve
	```
	login with us:__admin@admin.com__ pw:__password__ 
	and enjoy modifying your own admin panel!
## License

FREE
