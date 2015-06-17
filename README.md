Laravel 5 API/Scaffold/CRUD Generator

Con esta liberia  podran crear
  - Archivos de Migracion
  - Modelos
  - Respositorios (opcionales)
  - Controladores
  - Vistas (integradas con dataTables y Tablas Responsivas)
     - index.blade.php
     - show.blade.php
     - create.blade.php
     - edit.blade.php
     - fields.blade.php
  - Rutas Personalizadas.php

Guia de instalacion

1. Agrega al archivo composer.json:
  
        "require": {
            "innodite/laravel5-scaffold": "dev-master"
        }
  
2. Ejecuta en consola en la carpeta del proyecto composer update

        composer update
    
3. Agrega los ServiceProviders al archivo config/app.php <br>
       de [illuminate/html](https://github.com/illuminate/html) & [laracasts/flash](https://github.com/laracasts/flash)  
     
   De Todas Maneras Aqui Estan.

        'Illuminate\View\ViewServiceProvider',
        'Illuminate\Html\HtmlServiceProvider',
        'Laracasts\Flash\FlashServiceProvider',
        'Innodite\Generator\GeneratorServiceProvider'
        
   Tambien debes agregas los alias a config/app.php

		'Form'  => 'Illuminate\Html\FormFacade',
		'HTML'  => 'Illuminate\Html\HtmlFacade',
		'Flash' => 'Laracasts\Flash\Flash'

4. Carga del archivo generator.php para que reconozca los comandos de la libreria

        php artisan vendor:publish --provider="Innodite\Generator\GeneratorServiceProvider" --tag=config

5. Estos son Algunos Comandos que puedes usar con la libreria

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
 

Estos son algunos ejemplos de declaracion de tipos de input y respectivas validaciones

        fieldName:fieldType,options:fieldOptions
        
e.g.,

        email:string:unique
        email:string:default('example@innodite.com')
        title:string,100
        price:flat,8,4


La utilizacion del CRUD te creara los archivos siguientes para las vistas

en la ruta /resources/views/model_plural_name/

        index.blade.php - Main Index file for listing records
        create.blade.php - To insert a new record
        edit.blade.php - To edit a record
        fields.blade.php - Common file of all model fields, which will be used create and edit record
        show.blade.php - To display a record
        
Puedes cargar los CRUD desde un archivo externo en formato json usando este comando

         php artisan innodite.generator:scaffold_api Example --fieldsFile="/innodite/laravel5-scaffold/samples/fields.json"
         php artisan innodite.generator:scaffold Example --fieldsFile="vendor/innodite/laravel5-scaffold/samples/fields.json"
         php artisan innodite.generator:scaffold_api Example --fieldsFile="fields.json"

Para la Internacionalizacion deben de crear en su carpeta /resources/lang/es o /resources/lang/en
dependiendo si es multi idioma o no , el archivo application.php

Ejemplo de traduccion<br>

return [

	"model" => [
		/* Ejemplo Traducción de Atributos de Algún Modelo */
		"modelname" => [
			"attributes" => [
				"ex_name"        => "Ej_Nombre",
				"ex_description" => "Ej_Descripción"
			]
		],
]; 

Ejemplo de uso 

{!! trans('application.model.modelname.ex_name') !!}


y alli colocaran las traducciones ejemplo 

Para Poder Usar los dataTables deben Descargar los Siguientes Archivos y copiarlos en

Carpeta /public/js
    https://code.jquery.com/jquery-1.11.3.js

Se recomienda sustituir dentro del archivo /resources/views/app.blade.php

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

Por

    <script src="{{ asset('/js/jquery-1.11.3.min.js') }}"></script>

Carpeta /public/js/datatables/      <br>
    http://cdn.datatables.net/plug-ins/1.10.7/i18n/Spanish.json <br>
    https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js <br>
    https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js <br>

Carpeta /public/css/datatables/ <br>

    http://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css


