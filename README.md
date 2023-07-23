## About
<p>This is a permission based CRUD operations work depending on the user_type. This project consists of two types of users , Admin and User. The users with user_type Admin have all the permissions to create, update, view and delete any user, where as the users with user_type User can only view . </p>

### The modules in the project along with their respective permissions are as follows :
### Authentication:
As soon as a user is logged, in it's user_type is checked . If user_type turns out to be Admin all the permissions for CRUD operations are  assigned to the user. The delete type implemented here is a soft delete. If the user_type turns out to be User then the only permission allowed is to view the data.

### Register User:
A new user can only be added by an Admin, if the user_type is User the permission for this operation isn't allowed. 

# Technologies Used
* Frontend: HTML, CSS, Boostrap 5,javascript
* Backend: PHP,Laravel
# DATABASE DESIGN
![ER  Diagram](snapshots/D.png)
