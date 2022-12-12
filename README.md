<b>Deployment:</b><br/><hr/>
    - Extract the archive and put it in the folder you want  
    - Run `cp .env.example .env` file to copy example file to `.env`  
    - Then edit your `.env` file with DB credentials and other settings.  
    - Run `composer install` command  
    - Run `php artisan migrate --seed` command.  
    - Notice: seed is important, because it will create the first admin user for you.  
    - Run `php artisan key:generate` command.  
    - Run `php artisan storage:link command`.  

<br>
<b>Default credentials:</b><br/><hr/>
    <i>Email:</i> <b>admin@admin.com</b>  <br>
    <i>Password:</i> <b>password</b>

<hr/>

**ExpenseTracker.postman_collection.json** contains API Postman Collection with prebuilt sample requests. Import it using <i>Postman</i>
