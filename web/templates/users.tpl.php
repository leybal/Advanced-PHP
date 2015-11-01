<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
</head>
<body>
<div class="col-md-8">
<h1>Users</h1>
</div>
<div class="col-md-4">
    <br/>
    <br/>
    <a href="index.php?controller=User&action=findBy">Find by...</a>
</div>
<div class="col-md-12">
<table class="table table-bordered">
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>

    <?php
    $users = $_POST['response'];
    foreach($users as $key =>  $value) {
        print "<tr>";
        foreach ($users[$key] as $keyfield => $valuefield) {
            print "<td>" . $valuefield . "</td>";
        };
        $id = $users[$key]['id'];
        print "<td>". "<a href='index.php?controller=User&action=edit&id=$id'" . '>edit </a>' .
          "<a href='index.php?controller=User&action=delete&id=$id'" . '>delete</a>' . '</td>';
        print "</tr>";
    }
    ?>

</table>
<p><a href="index.php?controller=User&action=new">Add a new user</a>.</p>
<p> <a href="index.php?controller=User">Front page</a></p>
</div>
</body>
</html>
