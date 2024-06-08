<?php
$unit = $_GET['selectedUnit']; // Get the 'unit' parameter from the query string
require 'database.php';
require 'request.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Checklist</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <script src="jquery-3.7.1.min.js"></script>
    <style>
        td {
            text-align: center;
        }
        .enum, .input-field {
            width: 100%;
            max-width: 65px;
            height: 25px;
            text-align: center;
            font-weight: 700;
            cursor: pointer;
        }
        .input-field {
            cursor: text;
        }
        .clear-btn {
            float: right;
            background: none;
            border: none;
            color: red;
            font-size: 16px;
            cursor: pointer;
        }
        .clear-btn:hover {
            border: 1px solid red;
            border-radius: 4px;
        }
    </style>
</head>

<body>
<?php include 'header.php' ?>
<main>
    <h2>Kebocoran Fuel Tank</h2>
    <table>
        <thead>
            <tr>
                <th colspan="3">Time</th>
                <th>08.00</th>
                <th>10.00</th>
                <th>12.00</th>
                <th>14.00</th>
                <th>16.00</th>
                <th>18.00</th>
                <th>20.00</th>
                <th>22.00</th>
                <th>0.00</th>
                <th>2.00</th>
                <th>4.00</th>
                <th>6.00</th>
            </tr>
        </thead>
        <form method="post">
            <tbody>
                <?php
                require 'database.php';
                date_default_timezone_set('Asia/Jakarta'); // Replace 'YOUR_TIMEZONE' with the appropriate timezone

                // Determine if the current time is between 00:00-06:00
                $currentHour = (int) date('H');
                if ($currentHour >= 0 && $currentHour < 6) {
                    $tanggal = date("Y-m-d", strtotime("-1 day")); // Yesterday's date
                } else {
                    $tanggal = date("Y-m-d"); // Today's date
                }
                $sql_select = "SELECT * FROM $unit WHERE tanggal = CURDATE()";
                $result_select = mysqli_query($conn, $sql_select);
                if (!$result_select) {
                    die("Query failed: " . mysqli_error($conn));
                }      
                $existing_record = mysqli_fetch_assoc($result_select);          

                $times = array("8", "10", "12", "14", "16", "18", "20", "22", "0", "2", "4", "6");
                $tanks = array(
                    "HFO Day Tank" => "hfo_day_tank",
                    "LFO Day Tank" => "lfo_day_tank",
                    "HFO Storage Tank" => "hfo_storage_tank",
                    "LFO Storage Tank" => "lfo_storage_tank"
                );

                foreach ($tanks as $tank_name => $field_prefix) {
                    echo "<tr>";
                    echo "<th class='measure'>{$tank_name}</th>";
                    echo "<th class='parameter'>A/TA/RS</th>";
                    echo "<th class='parameter-setting'>-</th>";

                    foreach ($times as $time) {
                        $field_name = "{$field_prefix}_{$time}";
                        if ($existing_record && isset($existing_record[$field_name])) {
                            echo    '<td>';
                            echo htmlspecialchars($existing_record[$field_name]);
                            echo "<button type='button' class='clear-btn' data-field='$field_name'>X</button>";
                            echo    '</td>';
                            } else {
                        echo "<td><select class='enum' name='{$field_name}'>";
                        include 'enum-kebocoran.php';
                        echo "</select></td>";
                            }
                    }

                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <br>
        <button class="btn">SAVE</button>
        </form>
    </main>
    <script>
        document.getElementById("exit").onclick = function () {
            location.href = 'selection.php';
        }
        $(".enum").prop("selectedIndex", -1);
        $(".input-field").val('');

        $(document).ready(function() {
        $('.clear-btn').click(function() {
            var fieldToClear = $(this).data('field');
            var confirmed = confirm('Are you sure you want to clear this field?');

            if (confirmed) {
                // Send an AJAX request to update the field to NULL
                $.ajax({
                    url: 'clear_field.php',
                    method: 'POST',
                    data: {
                        field_to_clear: fieldToClear,
                        unit: '<?php echo $unit; ?>' // Pass the unit parameter
                    },
                    success: function(response) {
                        // Reload the page after clearing the field
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
    </script>
</body>
</html>
