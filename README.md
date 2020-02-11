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
$obj = new ISPager\DirPager(
  new ISPager\PagesList(),
  'photos',
  3,
  2);
echo "<pre>";
print_r($obj->getItems());
echo "</pre>";
echo "<p>$obj</p>";
```

``` php
$obj = new ISPager\FilePager(
  new ISPager\ItemsRange(),
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
  $obj = new ISPager\PdoPager(
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