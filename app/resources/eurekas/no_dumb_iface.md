
[Never dumb down the interface](http://www.catb.org/esr/writings/taouu/html/ch01s03.html), they said. 
Not everything can and should be abstracted away. In li3 we allow you to access underlying
objects wherever possible.

```php
// Accessing a memcache adapter's object methods.
Cache::adapter('default')->cas('token', 'key', 'value');

// Accessing a database connections PDO object to 
// enable transactions.
Connections::get('default')->beginTransaction();
```
