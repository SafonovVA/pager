# Pager

Paginator for PDO, text, files

[![Latest Version](https://img.shields.io/github/tag/safonovva/pager?style=flat-square&label=release)](https://github.com/safonovva/pager)

## Install

Via Composer

``` bash
$ composer require safonovva/pager
```

or add

```json
"safonovva/pages": "*"
```

## Usage

``` php
$obj = new safonovva\pager\DirPager(
  new safonovva\pager\PagesList(),
  'photos',
  3,
  2);
echo "<pre>";
print_r($obj->getItems());
echo "</pre>";
echo "<p>$obj</p>";
```

``` php
$obj = new safonovva\pager\FilePager(
  new safonovva\pager\ItemsRange(),
  'largetextfile.txt');
echo "<pre>";
print_r($obj->getItems());
echo "</pre>";
echo "<p>$obj</p>";
```

``` php
try {
  $pdo = new PDO(
    'mysql:host=localhost;dbname=test',
    'root',
    '',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
  $obj = new safonovva\pager\PdoPager(
    new ISPager\ItemsRange(),
    $pdo,
    'table_name');
  echo "<pre>";
  print_r($obj->getItems());
  echo "</pre>";
  echo "<p>$obj</p>";
}
catch (PDOException $e) {
  echo "Can't connect to database";
}
```