<?php
$unit = htmlspecialchars($_GET['selectedUnit']);
$line = htmlspecialchars($_GET['selectedLine']); 
require 'database.php';
require 'request-boiler.php';

// The allowed IP address
if ($line == '4&5-a' || $line == '4&5-b' || $line == '8'){
    $allowed_ip = array('131.107.7.212');
}else if ($line == '6' || $line == '7' || $line == '6&7-central'){
    $allowed_ip = array('131.107.7.216');
}else if($line == 'bopet-a' || $line == 'bopet-b'){
    $allowed_ip = array('131.107.7.214');
} else if ($line == 'coating-a' || $line == 'coating-b' || $line == 'coating-c' || $line == 'coating-d'){
    $allowed_ip = array('131.107.7.213');  
}
$user_ip = $_SERVER['REMOTE_ADDR'];

// Check if the user's IP matches the allowed IP
if ($_SESSION["type_user"] !== '2' && !in_array($user_ip, $allowed_ip)) {
    // If not, set an error message and redirect to selection.php
    echo "<script>alert('Anda sedang tidak terhubung dengan WiFi Arghapedia sesuai lokasi checklist. Pastikan koneksi WiFi anda tidak terputus'); window.location.href = './selection.php';</script>";
    exit();
}

// Function to format the value
function formatValue($value) {
    if (is_numeric($value)) {
        // If the value is a float and has .00 as decimals, return it as an integer
        if (floor($value) == $value) {
            return number_format(intval($value));
        } else {
            // Return the value formatted with commas but preserving its decimal part
            return number_format($value, 2);
        }
    } else {
        // Otherwise, return the original value
        return $value;
    }
}

// Example usage:
$value = 10.00;
//echo formatValue($value); // Output: 10

$value = 10.50;
//echo formatValue($value); // Output: 10.5
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Checklist</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="../../img/icon.ico">
    <script src="jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <style>
    td{
        text-align: center;
    }
    .enum , .input-field{
        width: 100%;
        max-width: 65px;
        height: 25px;
        text-align: center;
        font-weight:700;
        cursor: pointer;
    }

    .input-field{
        cursor: text;
    }

    table {
      width: 100%;
      height: 1000px; /* Set the height of the scrollable area */
      overflow-y: auto; /* Enable vertical scrolling */
    }

    thead{
      position: sticky; /* Make the header sticky */
      top: 0; /* Stick to the top of the container */
      z-index: 2; /* Ensure the header is above the body content */
    }

    tbody th {
      position: sticky; /* Make the first column sticky */
      left: 0; /* Stick to the left of the container */
      z-index: 1; /* Lower z-index for the first column */
    }
 
    </style>
</head>

<body>
<?php include 'header.php'; ?>    
<main>
    
<h2><?php echo strtoupper("BOILER GAS LINE $line"); ?></h2>

            
<table>
              <?php include 'pilih-unit-boiler.php' ?>
            <thead>
                <tr>
                <th rowspan="3"style="width:5%; padding: 2px 10px" id="first-thead">Time</th>
                <th colspan="3">Oil Temp (°C)</th>
                <?php if ($line == 'coating-a' || $line == 'coating-b' || $line == 'coating-c' || $line == 'coating-d' || $line == 'bopet-a' || $line == 'bopet-b') :?>
                    <th rowspan="2">Chimney Temp (°C)</th>
                    <th>Burner (%)</th>
                <?php else: ?>
                    <th colspan="2">Burner (%)</th>
                <?php endif;?>
                    <th colspan="2">Oil Pressure Bar (Bar)</th>
                    <th colspan="2">Gas Counter</th>
                    <th colspan="2">Differential Pressure (Bar)</th>
                    <th colspan="2">Oil Level (%)</th>
                    <th colspan="2">Rembesan Oli</th>
                    <th rowspan="3" style="width:8%; padding: 2px 20px">NOTE</th>
                    <th rowspan="3" style="width:8%; padding: 2px 45px">PIC</th>
                </tr>
                <tr>
                    <th>Inlet</th>
                    <th>Outlet</th>
                    <th>Set Point</th>
                <?php if ($line != 'coating-a' && $line != 'coating-b' && $line != 'coating-c' && $line != 'coating-d' && $line != 'bopet-a' && $line != 'bopet-b') :?>
                    <th>Flame Burner</th>
                <?php endif;?>
                    <th>Load Burner</th>
                    <th>Suction Pump</th>
                    <th>Disch Pump</th>
                    <th>Pressure (mBar)</th>
                    <th>Volume (m3)</th>
                    <th>D1</th>
                    <th>D2</th>
                    <th>Storage Tank</th>
                    <th>Expantion Tank</th>
                    <th style="width:2%">Pompa</th>
                    <th style="width:2%">Jalur Pipa</th>
                </tr>
                <tr>
                <?php if ($line == '4&5-a' || $line == '4&5-b'): ?>
                    <th>260±10</th>
                    <th>270±10</th>
                    <th>270±10</th>
                    <th>min 70%</th>
                    <th>10-100%</th>
                    <th>>0</th>
                    <th>4~7</th>
                <?php elseif ($line == '8'): ?>
                    <th>256±5</th>
                    <th>260±5</th>
                    <th>260±5</th>
                    <th>min 70%</th>
                    <th>10-100%</th>
                    <th>>0</th>
                    <th>5~7</th>
                <?php elseif ($line == 'coating-a' || $line == 'coating-b' || $line == 'coating-c' || $line == 'coating-d'): ?>
                    <th>220±10</th>
                    <th>250±15</th>
                    <th>250±5</th>
                    <th>&lt;350</th>
                    <th>35-85%</th>
                    <th>&gt;0</th>
                    <th>4~7</th>
                <?php elseif ($line == 'bopet-a'): ?>
                    <th>295±5</th>
                    <th>305±5</th>
                    <th>305±5</th>
                    <th>&lt;400</th>
                    <th>30-55%</th>
                    <th>1~2</th>
                    <th>5~7</th>
                <?php elseif ($line == 'bopet-b'): ?>
                    <th>295±5</th>
                    <th>308±5</th>
                    <th>308±5</th>
                    <th>&lt;400</th>
                    <th>20-70%</th>
                    <th>1~2</th>
                    <th>5.5~7</th>
                <?php elseif ($line == '6&7-central'): ?>
                    <th>260±5</th>
                    <th>270±5</th>
                    <th>270±5</th>
                    <th>min 70%</th>
                    <th>10-80%</th>
                    <th>&gt;0</th>
                    <th>4~7</th>
                <?php elseif ($line == '6' || $line == '7'): ?>
                    <?php if ($line == '7'): ?>
                    <th>250±5</th>
                    <?php else: ?>
                    <th>246±5</th>
                    <?php endif; ?>
                    <th>260±5</th>
                    <th>260±5</th>
                    <th>min 70%</th>
                    <th>10-60%</th>
                    <th>&gt;0</th>
                    <th>4~7</th>
                <?php endif; ?>

                    <th>10-500</th>
                    <th></th>
                    <th colspan="2">0.1~0.6</th>
                    <th colspan="2">35-65%</th>
                    <th colspan="2">Kering</th>
                
                </tr>
            </thead>
            <tbody>
            <form method="post">
        <?php
            require 'database.php';
            include 'request-view-boiler.php';
            $times = array(
                "8.00", "9.00", "10.00", "11.00", "12.00", "13.00", "14.00",
                "15.00", "16.00", "17.00", "18.00", "19.00", "20.00", "21.00", "22.00",
                "23.00", "0.00", "1.00", "2.00", "3.00", "4.00", "5.00", "6.00", "7.00"
            );
            
            $fields = array(
                'oiltemp_inlet', 'oiltemp_outlet', 'oiltemp_setpoint',
                'flameburner', 'loadburner', 'press_suctionpump',
                'press_discpump', 'counter_press', 'counter_vol',
                'difpress_d1', 'difpress_d2', 'lvl_storage',
                'lvl_exp', 'rembes_pompa', 'rembes_pipa', 'note', 'pic'
            );
            ?>
            <?php foreach ($times as $time) : ?>
                <tr>
                    <th class="measure2" style="widht:100px"><?php echo $time; ?></th>
                    <?php foreach ($fields as $field) : ?>
                        <?php
                            if (($line == 'coating-a' || $line == 'coating-b' || $line == 'coating-c' || $line == 'coating-d' || $line == 'bopet-a' || $line == 'bopet-b') && $field === 'flameburner') {
                                $field = 'chimney_temp';
                            }

                            $fieldName = $field .'_'.str_replace(".00", "", $time);

                            if ($line == '4&5-a' || $line == '4&5-b'){
                                include 'indicator-boiler-45.php';
                            } elseif ($line == '8'){
                                include 'indicator-boiler-8.php'; 
                            } elseif ($line == 'coating-a' || $line == 'coating-b' || $line == 'coating-c' || $line == 'coating-d'){
                                include 'indicator-boiler-coat.php'; 
                            } elseif ($line == 'bopet-a' || $line == 'bopet-b'){
                                include 'indicator-boiler-bopet.php'; 
                            } elseif ($line == '6&7-central'){
                                include 'indicator-boiler-67central.php'; 
                            } elseif ($line == '6' || $line == '7'){
                                include 'indicator-boiler-67.php'; 
                            }
                            if($field === 'pic'){
                                $time_fields = 'time'.'_'.str_replace(".00", "", $time);
                                echo "<td class='pic'>";
                                if($existing_record && $existing_record[$fieldName]){
                                echo "<div>" . htmlspecialchars(formatValue($existing_record[$fieldName])) . "</div>";
                                }
                                if($existing_record && $existing_record[$time_fields]){
                                echo "<div>" . htmlspecialchars(formatValue($existing_record[$time_fields])) . "</div>";
                                }
                                echo "</td>";
                            }else if($field === 'note'){
                                if ($existing_record && isset($existing_record[$fieldName])) {
                                    echo    "<td>";
                                    echo htmlspecialchars(formatValue($existing_record[$fieldName]));
                                    echo "<button type='button' class='clear-btn' data-field='$fieldName'>X</button>";
                                    echo    "</td>";
                                } else {
                                    echo "<td style='text-align:left; padding: 4px;'><textarea name=$fieldName id ='note-textarea' style='height:30px;width:150px;padding:4px;'></textarea></td>";
                                }
                            }else if ($existing_record && isset($existing_record[$fieldName])) {
                                echo    "<td $style>";
                                echo htmlspecialchars(formatValue($existing_record[$fieldName]));
                                echo "<button type='button' class='clear-btn' data-field='$fieldName'>X</button>";
                                echo    "</td>";
                            }else if ($field === 'rembes_pompa' || $field === 'rembes_pipa'){
                                echo "<td><select class='enum' name='$fieldName'><option value='K'>K</option><option value='B'>B</option></td>";
                            }else{
                                echo "<td><input type=number step='0.01' class='input-field' name='$fieldName'></td>";
                            }
                        ?>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>            
            </tbody>
            </table>
            <span class="legalDoc" style="margin-top: -20px;">
            <?php if ($line == 'coating-a'){
                echo 'H1-OCB-02-24R0';
            } elseif ($line == 'coating-b'){
                echo 'H1-OCB-01-24R0';
            } elseif ($line == 'coating-c'){
                echo 'H1-OCB-01-24R0';
            } elseif ($line == 'coating-d'){
                echo 'H1-OCB-04-24R0';
            } elseif ($line == '4&5-a'){
                echo 'H1-OCB-04-24R0';
            } elseif ($line == '4&5-b'){
                echo 'H1-OCB-06-24R0';
            } elseif ($line == '6'){
                echo 'H1-OCB-07-24R0';
            } elseif ($line == '7'){
                echo 'H1-OCB-08-24R0';
            } elseif ($line == '6&7-central'){
                echo 'H1-OCB-09-24R0';
            } elseif ($line == '8'){
                echo 'H1-OCB-10-24R0';
            } elseif ($line == 'bopet-a'){
                echo 'H1-OCB-10-24R0';
            } elseif ($line == 'bopet-b'){
                echo 'H1-OCB-12-24R0';
            }
        ?></span>
        <br>
        <button class="btn" id="save-button">SAVE</button>
    </form>
</main>
<script>
    document.getElementById("exit").onclick=function (){
    location.href = 'selection.php'
    }
    $(document).ready(function() {
        $(".enum").prop("selectedIndex", -1);
    });

    function handleFormSubmit(event, selectId) {
    event.preventDefault();

    var selectElement = document.getElementById(selectId);
    var selectedUnit = selectElement.value;    
              
            console.log('Selected <select> ID:', selectId);
            console.log('Selected Value:', selectedUnit);

            switch (selectedUnit) {
                case '4&5-a':
                case '4&5-b':
                case '6':
                case '7':
                case '6&7-central':
                case '8':
                case 'bopet-a':
                case 'bopet-b':
                case 'coating-a':
                case 'coating-b':
                case 'coating-c':
                case 'coating-d':
                    if (selectId === 'option-form-boiler') {
                        location.href = 'form-boiler.php?selectedUnit=boiler&selectedLine=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-boiler' && selectedDate) {
                        location.href = 'view-boiler.php?selectedUnit=boiler&selectedLine=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;                    
                default:
                    break;
            }
        }

</script>
</body>
</html>