# About
<p>This is a permission-based CRUD operation that works depending on the user_type. This project consists of two types of users, Admin and User. The users with user_type Admin have all the permissions to create, update, view, and delete any user, whereas the users with user_type User can only view. </p>

The modules in the project along with their respective permissions are as follows :
# Modules:
* Login
* Register: EmailOtp verification With Dummy OTP I have randomly created :
* Logout
* Permissions: As soon as a user is logged, in its user_type is checked. If user_type turns out to be Admin all the permissions for CRUD operations are  assigned to the user. The delete type implemented here is a soft delete. If the user_type turns out to be User then the only permission allowed is to view the data.
  


# Register User:
A new user can only be added by an Admin, if the user_type is User the permission for this operation isn't allowed. 

# Technologies Used
* Frontend: HTML, CSS, Bootstrap 5, javascript
* Backend: PHP, Laravel
* Database: Mysql
# Steps to Run The project

Commands : 
* composer install
* Php artisan key:generate
* cp .env.example .env
* php artisan migrate:fresh
* php artisan db:seed
* php artisan serve
* php artisan optimize:clear (optional :  Laravel's cache)
# Login Credentials 
Email :  admin@gmail.com
Password : 123456
  

