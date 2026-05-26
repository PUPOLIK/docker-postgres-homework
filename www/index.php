<!-- put in ./www directory -->

<html>
<head>
    <title>Hello... Databases</title>

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h1>MySQL + PostgreSQL </h1>
    <p>
    Во время выполнения задания у меня возникла проблема со старыми Docker volumes PostgreSQL,
    из-за чего не устанавливалось подключение к базе данных.
    После очистки старых volumes и пересоздания контейнеров проблема была решена (из-за этого прикола я несколько часов сидел у монитора и прожигал свою жизнь).</p>

    <!-- MYSQL -->

    <h2>MySQL</h2>

    <?php

    $mysql_conn = mysqli_connect('db', 'user', 'test', 'myDb');

    if (!$mysql_conn) {

        echo "<div class='alert alert-danger'>
                Failed to connect to MySQL: " . mysqli_connect_error() . "
              </div>";

    } else {

        echo "<div class='alert alert-success'>
                Connected to MySQL!
              </div>";

        $mysql_query = "SELECT * FROM Person";

        $mysql_result = mysqli_query($mysql_conn, $mysql_query);

        if ($mysql_result) {

            echo '<table class="table table-striped table-bordered">';

            echo '<thead>';
            echo '<tr><th></th><th>ID</th><th>Name</th></tr>';
            echo '</thead>';

            echo '<tbody>';

            while ($row = mysqli_fetch_assoc($mysql_result)) {

                echo '<tr>';

                echo '<td>
                        <span class="glyphicon glyphicon-search"></span>
                      </td>';

                echo '<td>' . htmlspecialchars($row['id']) . '</td>';

                echo '<td>' . htmlspecialchars($row['name']) . '</td>';

                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';

            mysqli_free_result($mysql_result);

        } else {

            echo "<div class='alert alert-danger'>
                    MySQL query failed
                  </div>";
        }

        mysqli_close($mysql_conn);
    }

    ?>

    <hr>

    <!-- POSTGRESQL -->

    <h2>PostgreSQL</h2>

    <?php

    $pg_conn = pg_connect(
        "host=postgres_container user=postgres_user password=postgres_password dbname=postgres_db"
    );

    if (!$pg_conn) {

        echo "<div class='alert alert-danger'>
                Failed to connect to PostgreSQL
              </div>";

    } else {

        echo "<div class='alert alert-success'>
                Connected to PostgreSQL!
              </div>";

        $pg_query = "SELECT * FROM Person ORDER BY id";

        $pg_result = pg_query($pg_conn, $pg_query);

        if ($pg_result) {

            echo '<table class="table table-striped table-bordered">';

            echo '<thead>';
            echo '<tr><th></th><th>ID</th><th>Name</th></tr>';
            echo '</thead>';

            echo '<tbody>';

            while ($row = pg_fetch_assoc($pg_result)) {

                echo '<tr>';

                echo '<td>
                        <span class="glyphicon glyphicon-search"></span>
                      </td>';

                echo '<td>' . htmlspecialchars($row['id']) . '</td>';

                echo '<td>' . htmlspecialchars($row['name']) . '</td>';

                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';

            pg_free_result($pg_result);

        } else {

            echo "<div class='alert alert-danger'>
                    PostgreSQL query failed
                  </div>";
        }

        pg_close($pg_conn);
    }


    ?>

</div>

</body>
</html>
