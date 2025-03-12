# Project Setup

## Introduction
This project is a PHP Laravel application built using XAMPP. It features user and admin roles, allowing users to manage projects and timesheets, while admins have full control over projects, attributes, users, and timesheets.

## Setup Instructions
1. **Clone the Repository:**  
   ```bash
   git clone https://github.com/syedasgarahmed/backend-assessment
   ```

2. **Update .env File:**  
   Replace the following values in your `.env` file:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=eav_project
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. **Create Database:**  
   Go to PHPMyAdmin and create a new database named `eav_project`.

4. **Import Database File:**  
   Import the `.SQL` file located in the `database` folder inside the project. No need to run any migrations or seeders as the database is already updated.

5. **Run the Project:**  
   ```bash
   php artisan serve
   ```
   Access the project via [http://127.0.0.1:8000/](http://127.0.0.1:8000/).

## Initial Role Selection
The welcome page allows you to select your role:
- **Admin:**  
  - Username: `admin@gmail.com`
  - Password: `aaaaaaaa`
  - Login API: `api/admin/login`
- **User:**  
  - You can create an account via the `api/register` endpoint.
  - User login API: `api/user/login`
 
  
![image](https://github.com/user-attachments/assets/601a7cd4-a5c1-43de-8e17-57174f2369b6)



## User Functionalities
- **Projects Page:**  
  - Displays projects assigned to the user.
  - Sorting, searching, and filtering capabilities.


![image](https://github.com/user-attachments/assets/fdf8bc09-4e5c-4100-b6f8-1a602962f765)


- **Timesheets Page:**  
  - Displays timesheets assigned to the user.
  - User can change timesheet status (Pending, In-progress, Completed).
  - Filtering capabilities.
  - Logout API: `/user/logout`


![image](https://github.com/user-attachments/assets/c22f8f9d-6e9a-43b9-b726-df2204a01bf8)


## Admin Functionalities


![image](https://github.com/user-attachments/assets/3a7b4349-dca0-425c-8558-25e9796a22dd)


- **Projects:**  
  - View all projects.
  - Create new projects (Project Name, Status, Department).
  - Edit/Delete projects and assign users.
  - View assigned users per project.


![image](https://github.com/user-attachments/assets/a13cc1ac-eacc-4d1f-96a2-b669363ed6bf)


- **Users:**  
  - View all users.
  - View projects assigned to a user.
  - Edit/Delete user details.
  - Search and filter users.

- **Attributes:**  
  - View all attributes.

- **Timesheets:**  
  - View and manage all timesheets.
  - Change timesheet status.
  - View timesheets by user (popup modal).
  - Create new timesheets with multiple user assignment support.


![image](https://github.com/user-attachments/assets/2292274e-388d-4b61-b999-f70ce2c1ded5)


## Relationships Used
- `Timesheet` belongsTo `User` and `Project`.
- `User` belongsToMany `Project` (Using pivot table) and hasMany `Timesheet`.
- `Project` belongsToMany `User` and hasMany `Timesheet`.

## Example Request/Response
(Images to be attached later)

## Authentication
- Laravel Passport is used for authentication.
- Middleware for CRUD operations:  
  - `auth:user` for user-related operations.  
  - `auth:admin` for admin-related operations.

## Routes
```php
Route::group(['middleware' => ['web']], function () {
    Route::get('/admin/login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login.form');
    Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login');
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('auth:admin');

    Route::get('/user/login', [AuthController::class, 'showUserLoginForm'])->name('user.login.form');
    Route::post('/user/login', [AuthController::class, 'userLogin'])->name('user.login');
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard')->middleware('auth:user');
});

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
```

## File Structure
- User CRUD Blade Files: `resources/views/user/`
- Admin CRUD Blade Files: `resources/views/admin/`
- Auth Files (Login & Register): `resources/views/auth/`

## Controllers
- `AdminController.php` (Admin CRUD operations)
- `AttributeController.php`
- `AuthController.php` (Login & Register handling)
- `ProjectController.php`
- `TimesheetController.php`
- `UserController.php` (User CRUD operations)

## Methodology
- Simple MVC structure.
- Blade files are used for rendering views.
- Controllers handle business logic.
- Models manage data interaction.


## Alert when login success


![image](https://github.com/user-attachments/assets/6041bb00-579f-477d-b574-91974c24e7ee)


## Toast alerts on operation success


![image](https://github.com/user-attachments/assets/812743ad-6968-4b6e-a8b2-f3e06b7bf243)



