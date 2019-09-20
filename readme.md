# Datatables-ext

- get row selected data
- server side sorting
- text filter
- date filter
- ~~date/time range filter~~
- ~~dropdown filter~~
- ~~checkbox filter~~

## Client side

HTML

```html
<!-- CSS -->
<link rel="stylesheet" href="datatables/datatables.min.css" />
<link rel="stylesheet" href="datatables-ext/datatables.ext.css" />

<!-- HTML Table (if use with bootstrap css table class be like this.)-->
<table id="grid" class="table table-striped table-bordered table-hover table-condensed table-nowrap" style="width:100%;">
  <thead>
    <tr>
      <th>ID</th>
      <th>USERNAME</th>
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
    style: "single",
  },
  ajax: {
    url: 'YOUR_URL',
    method: 'post'
  },
  fnDrawCallback: function(settings, json) {},
  columnDefs: [
    {
      render: function(data, type, row) {}, 
      targets: 0
    }
  ],
  columns: [
    { data: "Id" },
    { data: "Name" }
  ],
});
```

## Add button

```javascript
buttons: [
  {
    extend: 'selectAll',
    text: 'เลือกทั้งหมด'
  },
  {
    extend: 'selectNone',
    text: 'ไม่เลือกทั้งหมด'
  },
  {
    text: 'บันทึก',
    action: function ( e, dt, node, config ) {
      var rowdata = dt.rows( '.selected', { selected: true } ).data();
      if (typeof rowdata[0] !== 'undefined')  {
        console.log(rowdata);
      } else {
        alert("กรุณาเลือกข้อมูล!");
      }
    }
  }
],
```

## Server side 

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
