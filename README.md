# Technologies Used
* Frontend: HTML, CSS, Bootstrap 5, javascript
* Backend: PHP, Laravel
* Database: Mysql

# Client Features
* User-login
* Profile-edit
* Logout

# Admin Features
* Admin-login
* Register-User List
* Technology 
Perform CRUD (Create, Read, Update, Delete) operations for managing technologies.

* Registration Report
* Technology Report
* Map Report
* Logout

# Steps to Run The project

Commands : 
* composer install
* Php artisan key:generate
* cp .env.example .env
* php artisan migrate:fresh
* php artisan db:seed
* php artisan serve
* php artisan optimize:clear (optional :  Laravel's cache)
# Admin Login Credentials 
Email :  admin@gmail.com
Password : admin

# imporant Notes
# Map Report

The Map Report feature allows admins to visualize user locations on a map. To enable this feature:

1. **Register a New User:**
   - Create a new user account with basic information.

2. **Update User with Map Details:**
   - After registering the user, navigate to the user details page and update the map details.
   - Ensure to provide accurate latitude and longitude for precise location mapping.

3. **Access the Admin Panel:**
   - Log in to the admin panel to access various reports and features.

4. **Navigate to Map Report:**
   - Once logged in, go to the Map Report section to view the map.

5. **View User Locations:**
   - The map will display markers representing the locations of registered users with valid map details.

6. **No Data Display for Default View:**
   - If no user has accurate map details, the map will default to a standard view, indicating no data available.

By following these steps, admins can visualize user locations on the map and gain insights into the geographical distribution of registered users.



