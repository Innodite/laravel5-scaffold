    Laravel5 API/Scaffold/CRUD Generator
    =======================


I enjoy creating API's and I have worked on many projects that required them. But the problem I always faced was setting up all the boilerplate code. For example each end point needs a migration, model, controller, repository, and on and on. I wanted a way to streamline this process and that is how this package was born.

This API generator allows you to use artisan commands to automatically generate all these files saving you time. Not only does it auto generate the files but it will set the namespaces. 

The artisan command can generate the following items:
  * Migration File
  * Model
  * Repository (optional)
  * Controller
  * View
    * index.blade.php
    * show.blade.php
    * create.blade.php
    * edit.blade.php
    * fields.blade.php
  * adjusts routes.php

And your simple CRUD API is ready in mere seconds.


Steps to Get Started
---------------------

1. Add this package to your composer.json:
  
        "require": {
            "innodite/laravel5-scaffold": "1.0.0*"
        }
  
2. Run composer update

        composer update
    
3. Add the ServiceProviders to the providers array in ```config/app.php```.<br>
   As we are using these two packages [illuminate/html](https://github.com/illuminate/html) & [laracasts/flash](https://github.com/laracasts/flash) as a dependency.<br>
   so we need to add those ServiceProviders as well.

        'Illuminate\View\ViewServiceProvider',
        'Illuminate\Html\HtmlServiceProvider',
        'Laracasts\Flash\FlashServiceProvider',
        'Innodite\Generator\GeneratorServiceProvider'
        
   Also for convenience, add these facades in alias array in ```config/app.php```.

		'Form'  => 'Illuminate\Html\FormFacade',
		'HTML'  => 'Illuminate\Html\HtmlFacade',
		'Flash' => 'Laracasts\Flash\Flash'

4. Publish ```generator.php```

        php artisan vendor:publish --provider="Mitul\Generator\GeneratorServiceProvider" --tag=config

5. Fire artisan command to generate API, Scaffold with CRUD views or both API as well as CRUD views.

        php artisan innodite.generator:api ModelName
        php artisan innodite.generator:scaffold ModelName
        php artisan innodite.generator:scaffold_api ModelName
        
    e.g.
    
        php artisan innodite.generator:api Project
        php artisan innodite.generator:api Post
 
        php artisan innodite.generator:scaffold Project
        php artisan innodite.generator:scaffold Post
 
        php artisan innodite.generator:scaffold_api Project
        php artisan innodite.generator:scaffold_api Post
 
6. If you want to use SoftDelete trait with your models then you can specify softDelete option.
 
        php artisan innodite.generator:api ModelName --softDelete
        
    e.g.
    
        php artisan innodite.generator:api Post --softDelete
        
7. Enter the fields with options<br>

8. And you are ready to go. :)


Documentation
--------------

### Generator Config file

Config file (```config/generator.php```) contains path for all generated files

```path_migration``` - Path where Migration file to be generated<br>
```path_model``` - Path where Model file to be generated<br>
```path_repository``` - Path where Repository file to be generated<br>
```path_controller``` - Path where Controller file to be generated<br>
```path_api_controller``` - Path where API Controller file to be generated<br>
```path_views``` - Path where views will be created<br>
```path_request``` -  Path where request file will be created<br>
```path_routes``` - Path of routes.php (if you are using any custom routes file)<br>

```namespace_model``` - Namespace of Model<br>
```namespace_repository``` - Namespace of Repository<br>
```namespace_controller``` - Namespace of Controller<br>
```namespace_api_controller``` - Namespace of API Controller<br>
```namespace_request``` - Namespace for Request<br>

```model_extend``` - Use custom Model extend<br>
```model_extend_namespace``` - Namespace of custom extended model<br>
```model_extend_class``` - Class name to extend<br>

```api_prefix``` - API Prefix

### Field Input

Here is the input for the fields by which you can specify Input.

        fieldName:fieldType,options:fieldOptions
        
e.g.,

        email:string:unique
        email:string:default('example@innodite.com')
        title:string,100
        price:flat,8,4

Parameters will be in the same sequence as ```Blueprint``` class function for all types.
Option will be printed as it is given in input except unique & primary.

### API Response Structure
 
**Remember: This response structure is based on the most of my API response structure, you can change it to your API response after file generation in controller.**
 
**Success**

        {
            "flag":true,
            "message":"success message",
            "data":{}
        }


data can be anything as per response.

**Failure**

        {
            "flag":false,
            "message":"failure message",
            "code": 0
            "data":{}
        }

data will be optional. And code will be error code.

### Generated Views

While generating scaffold, all views are created with basic CRUD functionality.

Views will be created in ```resources/views/modelName``` folder,

        index.blade.php - Main Index file for listing records
        create.blade.php - To insert a new record
        edit.blade.php - To edit a record
        fields.blade.php - Common file of all model fields, which will be used create and edit record
        show.blade.php - To display a record
        
### Using with Custom Application namespace

Sometimes, we are using different namespace rather than default ```App``` namespace.

Generator's ```AppBaseController``` is extending Laravel's ```App\Http\Controllers\Controller```. so while using diff namespace, we need to publish it with custom namespace.

You need to give a full path of default Controller with your namespace as input. For e.g.,

        php artisan mitul.generator.publish:base_controller "MyApp\Http\Controllers\Controller"
             
It will generate AppBaseController again with extending custom namespace controller.

### Customizing generated files

1. Publish templates into ```/resources/api-generator-templates```

        php artisan vendor:publish --provider="Innodite\Generator\GeneratorServiceProvider" --tag=templates

2. Leave only those templates that you want to change. Remove the templates that do not plan to change.

3. Add the remaining files to git and make your magic!

### Passing fields from file

If you want to pass fields from file then you can create fields json file and pass it via command line. Here is the sample [fields.json](https://github.com/mitulgolakiya/laravel-api-generator/blob/1.3/samples/fields.json)

You have to pass option ```--fieldsFile=absolute_file_path_or_path_from_base_directory``` with command. e.g.

         php artisan innodite.generator:scaffold_api Post --fieldsFile="/Users/Innodite/laravel-api-generator/fields.json"
         php artisan innodite.generator:scaffold_api Post --fieldsFile="fields.json"


### Search in Views

Include search functionality in view ```index.php```

You have to pass option ```--search``` with command. e.g.

         php artisan innodite.generator:scaffold_api Post --search"

