<!-- put in ./www directory -->

<html>
 <head>
  <title>Hello... PostgreSQL</title>

  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="container">
        <h1>Hi! I'm happy with PostgreSQL!</h1>

    <?php
    $conn = pg_connect("host=postgres user=postgres_user password=postgres_password dbname=postgres_db");

    if (!$conn) {
      echo "<div class='alert alert-danger'>Failed to connect to PostgreSQL: " . pg_last_error() . "</div>";
      exit();
    }

    echo "<div class='alert alert-success'>Connected to PostgreSQL!</div>";

    $query = "SELECT * FROM Person ORDER BY id";
    $result = pg_query($conn, $query);

    if (!$result) {
        echo "<div class='alert alert-danger'>Query failed: " . pg_last_error($conn) . "</div>";
    } else {
        echo '<table class="table table-striped">';
        echo '<thead>';
        echo '<tr><th></th><th>id</th><th>name</th></tr>';
        echo '</thead>';
        echo '<tbody>';
        
        while ($row = pg_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td><a href="#"><span class="glyphicon glyphicon-search"></span></a></td>';
            echo '<td>' . htmlspecialchars($row['id']) . '</td>';
            echo '<td>' . htmlspecialchars($row['name']) . '</td>';
            echo '</tr>';
        }
        
        echo '</tbody>';
        echo '</table>';
        
        pg_free_result($result);
    }

    pg_close($conn);
    ?>
    </div>
</body>
</html>