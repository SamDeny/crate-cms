CItrus - Dependency Injection
=============================

Citrus provides a really basic dependency injection, supporting two really common ways to receive 
the classes you need. The first one is based on Typings / Type-Hinting, where you declare the 
required class within the arguments block of your function, method or constructor. The second one 
uses basic aliases, assigned to the respective classes.

However, you can always receive a class by using the global `citrus()` function anywhere:

```php
$instance = citrus(\Path\To\Your\Class::class);

// or by using it's alias

$instance = citrus('class-alias');
```

Alternatively you can also use the application method `make()` to create or receive the respective 
class. Classes, received by Citrus' Application container, are either created each time you call 
them, or just once. The last one are so-called Singletons, and more or less also, Multitons. The 
difference between these both are: Singletons are single instances per class while Multitons are 
single instances per class per passed arguments. For example: Crate's Mailer class is a Multiton, 
since you can "make" them with different contructor arguments depending on the mail driver you need. 
The same applies for Crate's Connection pool, while The Session handler is a singleton... since you 
cannot manage more then one Session object at the same time, similar to the ModuleRegistry.

While simple bindings and Singetons are either created by Citrus' application container directly, or 
passed as already created instance, Multitons require an own Factory class which takes over the 
class creation and returns them to the Container.
