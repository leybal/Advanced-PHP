<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
</head>
<body>
<div class="col-md-12">
    <p>Are you sure you want to delete this user?</p>
    <div class="col-md-12">
        <form method="GET" action="index.php">
            <input type="hidden" id="student-id" name="id" value="<?php print $_GET['id'] ?>">
            <input type="hidden" name="action" value="finalDelete"/>
            <button type="submit" class="btn btn-default">Yes</button>
        </form>
    </div>
    <br/>
    <br/>
    <div class="col-md-12">
    <a href="index.php?controller=User">Front page</a>
    </div>
</div>
</body>
</html>