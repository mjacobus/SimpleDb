Koine SimpleDb
---------------------

This project is only an experiment for studying purposes. It was presented at the [PHP Unconference](http://www.php-unconference.de/).

[This](https://github.com/bootev/php_unconference/wiki/PhpUnconf-2015-Vortraege-Samstag) is the agenda for the first day.

[![Build Status](https://travis-ci.org/mjacobus/SimpleDb.svg?branch=master)](https://travis-ci.org/mjacobus/SimpleDb)
[![Code Climate](https://codeclimate.com/github/mjacobus/SimpleDb/badges/gpa.svg)](https://codeclimate.com/github/mjacobus/SimpleDb)

## Usage

### Set up

O Adapter:

```php
<?php

$adapter =  new \Koine\SimpleDb\Adapter\JsonFile("/tmp/posts.json");

// Saving data
$adapter->write(array('foo' => 'bar'));

// Reading data from file
$data = $adapter->read();
```

The database:

```php
<?php

$postDatabase = new \Koine\SimpleDb\SimpleDb($adapter);
```

### Creating records

```php
<?php

$post = array(
  'title' => 'First post',
  'body'  => 'Hello everybody',
);

// Return created id
$id = $postDatabase->create($post);
```

### Getting a record by its id

```php
$postDatabase->find($id);

/*
array(
  'id'    => 1,
  'title' => 'First post',
  'body'  => 'Hello everybody',
);
*/
```

When the record is not found it should throw an exception.

### Updating records

```php
<?php

$postDatabase->update($id, array(
    'body' => 'Updated content',
));
```

When the record is not found it should throw an exception

### Removing records

```php
<?php

$postDatabase->delete($id);
```

### Getting all records

```php
<?php

$postDatabase->findAll();
```


### Finding all records based on a set of criterias

```php
<?php

$drafts = $postDatabase->findAll(array(
  'published' => false
));
```
