<?php
$unit = $_GET['selectedUnit']; // Get the 'unit' parameter from the query string
require 'database.php';
require 'request.php';

// Function to format the value
function formatValue($value) {
    // Check if the value is a float and has .00 as decimals
    if (is_numeric($value) && floor($value) == $value) {
        return intval($value); // Return integer value
    } else {
        return $value; // Otherwise, return the original value
    }
}

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
<div class="header-img">
    <img id="logo" src="css/logo.png" alt="Logo Argha"><br>
    <img id="exit" src="css/exit.png" alt="Exit"><br>
</div>
<header>
    <h1>ONLINE CHECKLIST</h1>
</header>
<main>
    <h2>Common Unit</h2>
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
                $sql_select = "SELECT * FROM $unit WHERE tanggal = CURDATE()";
                $result_select = mysqli_query($conn, $sql_select);
                if (!$result_select) {
                    die("Query failed: " . mysqli_error($conn));
                }                
                $existing_record = mysqli_fetch_assoc($result_select);
                $times = array('8', '10', '12', '14', '16', '18', '20', '22', '0', '2', '4', '6');

                $measurements = array(
                    array("DC System Voltage", "110~125", "Volt", "dc_system_volt_"),
                    array("LV Switchgear Voltage", "380~410", "Volt", "lv_switchgear_"),
                    array("Starting Air Pressure #1", "20~30", "Bar", "start_air_press1_"),
                    array("Starting Air Pressure #2", "20~30", "Bar", "start_air_press2_"),
                    array("Drain Starting Air Bottle", "-", "-", "drain_start_"),
                    array("Compressor #1", "-", "Hour", "compressor1_"),
                    array("Kebocoran Oil", "A/TA/RS", "-", "kebocoran_oil1_", true),
                    array("Compressor #2", "-", "Hour", "compressor2_"),
                    array("Kebocoran Oil", "A/TA/RS", "-", "kebocoran_oil2_", true),
                    array("Compressor #3", "-", "Hour", "compressor3_"),
                    array("Kebocoran Oil", "A/TA/RS", "-", "kebocoran_oil3_", true),
                    array("Outdoor Temperature", "-", "°C", "outdoor_temp_")
                );

                foreach ($measurements as $measurement) {
                    echo "<tr>";
                    echo "<th class='measure'>{$measurement[0]}</th>";
                    echo "<th class='parameter'>{$measurement[1]}</th>";
                    echo "<th class='parameter-setting'>{$measurement[2]}</th>";

                    foreach ($times as $time) {
                        $field_name = $measurement[3] . $time;
                        echo "<td>";
                        if ($existing_record && isset($existing_record[$field_name])) {
                            echo htmlspecialchars(formatValue($existing_record[$field_name]));
                            echo "<button type='button' class='clear-btn' data-field='$field_name'>X</button>";
                        } else {
                            if (isset($measurement[4]) && $measurement[4]) {
                                echo "<select class='enum' name='$field_name'>";
                                include 'enum-kebocoran.php';
                                echo "</select>";
                            } else {
                                echo "<input type='number' step='0.01' class='input-field' name='$field_name'>";
                            }
                        }
                        echo "</td>";
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
document.getElementById("exit").onclick = function() {
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
