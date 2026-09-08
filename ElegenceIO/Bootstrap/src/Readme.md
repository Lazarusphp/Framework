# Lazarus php BootStrapper

## Usage

**Installation**
```php
composer require elegenceio\bootstrapper
```

**Instantiation**

**Setting BasePath**
```php
$app = Application::configure(dirname(__DIR__));
```

Additional Options can be chained.


**Adding Routers**

```php
    /*
    * stringable or array 
    * @string can be used to provide a single path,


    @array can be used to pass a single or multiple
    */
    
    $app->routers(__DIR__."/../Resources/Routers/web.php")->create();
```

**Adding Aditional Providers**

```php
    /* string or or array
    * @string for the path of loaded Providers.
    * @array array of providers must be in the format of classname::class
    */
    $app->providers([AppProvider::class])->create();
```

all `methods` can be chained  like so $app->providers()->router()->create(). the method `create()` is required in order to Build the Bootstrapper.


