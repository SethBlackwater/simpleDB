# simpleDB
A simple PHP MySQL Library

# Usage
## Example Usage 1
```
<?php
require_once "simpleDB.php";

$simpleDB = new simpleDB();
$data = $simpleDB->selectRowWhere('username','SethBlackwater','users');
echo $data['name']; //Seth
```

### insertRow()
Single column usage
```
$simpleDB->insertRow('username','SethBlackwater','users');
```
Multiple column usage
```
$simpleDB->insertRow(['username','firstname'],['SethBlackwater','Seth'],'users');
```
#### insertRow() Usage
```
<?php
require_once "simpleDB.php";

$simpleDB = new simpleDB();
if($simpleDB->insertRow('username','SethBlackwater','users')){
    echo "Row created!";
}

```

### selectRowWhere()
```
$simpleDB->selectRowWhere('username','SethBlackwater','users');
```
#### insertRow() Usage
```
<?php
require_once "simpleDB.php";

$simpleDB = new simpleDB();
$row = $simpleDB->selectRowWhere('username','SethBlackwater','users');
echo $row['name']; //Seth
```


# Functions
Here is a list of all available functions for simpleDB

* __insertRow__(*columns, values, table*);
* __selectRowWhere__(*column, value, table*);
* __selectRowsWhere__(*column, value, table*);
