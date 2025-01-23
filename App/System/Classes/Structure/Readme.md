# Lazarus Framework Structure Class

The Lazarus PHP Structure class is a temporary and persistent data handler. The class can handle data in both array and INI file formats.

# How it works
The Structure class is coupled with the INI Handler class. [Found here](https://github.com/mbamber1986/phpinihandler). It is designed to read and write INI data from custom-created INI files if required.

## How is the Structure class different from the INI Handler?

While the INI Handler only writes to INI files, the Structure class can also write to arrays using some modified code.

# Examples

Using a database configuration as an example, the following example demonstrates how to use the class methods.

## Creating a new set of values

```php
/**
 *
 * Protected @method create($name, $key, $file = "")
 * @property string $name 
 * @property array $data
 * @property $file
 */

structure::create("Database", [
    "username" => "test",
    "email" => "test@test.com",
]);
```
The above code will generate an array group called "Database" with two key-value pairs: "username" and "email". To store this configuration into a file, use the final parameter.

> Note that you can only store data in either an array or an INI file, not both.

## Reading the values
You can return individual values from the array set or the INI file by using the fetch() method, as shown below.

```php
/**
 *  $name is also the INI section.
 *  @method fetch($name, $key)
 * @property $name 
 * @property $key
 */
echo Structure::fetch("Database", "username");

// Output: test
```

This script is designed to work with the values created on boot and will find the value by looking for the created path location. However, this will not work if an INI file is manually created.

The mapPath() method is used to fix this. This method must be set before using fetch().

```php
Structure::mapPath("Database", ROOT . "/Storage/Configs/Database.ini");
```