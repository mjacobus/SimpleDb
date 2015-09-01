Koine SimpleDb
---------------------

Este projeto é apenas um experimento com propósitos didáticos. Não deve ser usado em produção.

[![Build Status](https://travis-ci.org/mjacobus/SimpleDb.svg?branch=master)](https://travis-ci.org/mjacobus/SimpleDb)
[![Code Climate](https://codeclimate.com/github/mjacobus/SimpleDb/badges/gpa.svg)](https://codeclimate.com/github/mjacobus/SimpleDb)

### Objetivo

O objetivo deste projeto é ajudar desenvolvedores a entender o processo de desenvolvimento de software utilizando
metodologias e práticas como:

- TDD
- Continuous Integration
- Code Metrics:
  - Code Coverage
  - Code Climate
- Composer:
  - Criando e publicando a sua lib
- SOLID
- Colaboração com github

## Usage

### Set up

O Adapter:

```php
<?php

$adapter =  new \Koine\SimpleDb\Adapter\JsonFile("/tmp/posts.json");

// Salvando dados
$adapter->write(array('foo' => 'bar'));

// Buscando dados
$data = $adapter->read();
```

O banco de dados:

```php
<?php

$postDatabase = new \Koine\SimpleDb\SimpleDb($adapter);
```

### Criando Registros

```php
<?php

$post = array(
  'title' => 'First post',
  'body'  => 'Hello everybody',
);

// Retorna o ID gerado
$id = $postDatabase->create($post);
```

### Buscando registro por ID

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

Quando o registro não é encontrado uma exception deve ser lançada.

### Atualizando registros

```php
<?php

$postDatabase->update($id, array(
    'body' => 'Updated content',
));
```

Quando o registro não é encontrado uma exception deve ser lançada.

### Excluindo Registros

```php
<?php

$postDatabase->delete($id);
```

### Buscando todos os registros

```php
<?php

$postDatabase->findAll();
```


### Buscando registros por critérios

```php
<?php

$drafts = $postDatabase->findAll(array(
  'published' => false
));
```
