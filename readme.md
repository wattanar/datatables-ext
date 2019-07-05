# Datatables-ext

- get row selected data
- server side sorting
- text filter
- date filter
- ~~date/time range filter~~
- ~~dropdown filter~~
- ~~checkbox filter~~

## Client

HTML

```html
<!-- CSS -->
<link rel="stylesheet" href="datatables/datatables.min.css" />
<link rel="stylesheet" href="datatables-ext/datatables.ext.css" />

<!-- HTML Table -->
<table id="grid">
  <thead>
    <tr>
      <th>Name</th>
      <th>Email</th>
    </tr>
  </thead>
</table>

<!-- Javascript -->
<script src="datatables/jquery-3.4.1.min.js"></script>
<script src="datatables/datatables.min.js"></script>
<script src="datatables-ext/datatables.ext.js"></script>
```

Javascript

```javascript
jQuery(document).ready(function($) {
  loadGrid({
    el: "#grid",
    processing: true,
    serverSide: true,
    deferRender: true,
    searching: true,
    order: [],
    orderCellsTop: true,
    destroy: true,
    select: {
      style: 'single'
    },
    ajax: {
      url: "http://localhost:3000/server.php",
      method: "post",
    },
    columns: [
      {
        data: "name",
        name: "string",
      },
      {
        data: "email",
        name: "string",
      },
    ],
  });
});
```

## Server

```php
<?php

// Datatables class at server.php
$datatables = new Datatables();

function queryData($query) {

  // example:
  // SELECT * FROM USERS WHERE $query

  $source = [
    [
      "id" => 1,
      "name" => "Leanne Graham",
      "username" => "Bret",
      "email" => "Sincere@april.biz",
      "phone" => "1-770-736-8031 x56442",
      "website" => "hildegard.org",
    ]
  ];

  return $source;
}

// filter and get data
$data = queryData($datatables->filter($_POST));

// format data for datatables
$result = $datatables->format($data, $_POST);

// set header
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json;');

// send json to client
echo json_encode($result);
```
