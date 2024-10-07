<?php

include 'database.php';
$tanggal = "" . $_GET['selectedMonth'];
$line = "" . $_GET['selectedLine'];
$unit = "" . $_GET['selectedUnit'];

include 'request-view-crane.php';

?>


<!DOCTYPE html>
<html>
<head>
    <title>View Crane Monorail</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="../../img/icon.ico">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <style>
        td {
            text-align: center;
            width: 300px;
        }
    </style>
</head>

<body>
<?php include 'header.php'?>
<main>

<h2>
    <strong>CRANE MONORAIL</strong>
    <br>
</h2>
    <h4 style="text-align:left;">UNIT: <?php
    // Convert the string to uppercase
    $formattedUnit = strtoupper($line);

    // Replace underscores with spaces
    $formattedUnit = str_replace('_', ' ', $formattedUnit);

    // Find the position of the first comma
    $commaPos = strpos($formattedUnit, ',');

    // If there is a comma, process it
    if ($commaPos !== false) {
        // Remove the first comma
        $formattedUnit = substr_replace($formattedUnit, '', $commaPos, 1);

        // Insert "AREA" and a line break before what was the first comma
        $formattedUnit = substr_replace($formattedUnit, "&nbsp;|&nbsp;AREA: ", $commaPos, 0);
        
        // Replace remaining commas with comma followed by a space
        $formattedUnit = str_replace(',', ', ', $formattedUnit);
    }

    echo $formattedUnit;
?></h4>
    <?php include 'pilih-tanggal.php'; ?>

    <h3>Datasheet Preventive Maintenance</h3>
    <?php if ($article === null): ?>
            <p>Form ini belum terisi</p>
        <?php else: ?>

            <?php include 'verification-form.php'?>
    
            <table>
        <thead>
            <tr>
                <th style="width:2%;">No</th>
                <th style="width:22%;" colspan="2">DESCRIPTION</th>
                <th colspan="2">L1</th>
                <th colspan="2">L2</th>
                <th colspan="2">L3</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <article>
        <tbody>
        <?php
            $fields = array(
                '1_hoist_tegangan_l1a', '1_hoist_tegangan_l1b', '1_hoist_tegangan_l2a', '1_hoist_tegangan_l2b', 
                '1_hoist_tegangan_l3a', '1_hoist_tegangan_l3b', '1_hoist_arusfast_l1a', '1_hoist_arusfast_l1b', 
                '1_hoist_arusfast_l2a', '1_hoist_arusfast_l2b', '1_hoist_arusfast_l3a', '1_hoist_arusfast_l3b', 
                '1_hoist_aruslow_l1a', '1_hoist_aruslow_l1b', '1_hoist_aruslow_l2a', '1_hoist_aruslow_l2b', 
                '1_hoist_aruslow_l3a', '1_hoist_aruslow_l3b', '1_hoist_brake', '1_cross_tegangan_l1a', 
                '1_cross_tegangan_l1b', '1_cross_tegangan_l2a', '1_cross_tegangan_l2b', '1_cross_tegangan_l3a', 
                '1_cross_tegangan_l3b', '1_cross_arusfast_l1a', '1_cross_arusfast_l1b', '1_cross_arusfast_l2a', 
                '1_cross_arusfast_l2b', '1_cross_arusfast_l3a', '1_cross_arusfast_l3b', '1_cross_aruslow_l1a', 
                '1_cross_aruslow_l1b', '1_cross_aruslow_l2a', '1_cross_aruslow_l2b', '1_cross_aruslow_l3a', 
                '1_cross_aruslow_l3b', '1_cross_brake', '1_kontaktor_periksa', '1_panel_periksa', 
                '1_pendant_pb', '1_pendant_kabel'
            );
            

            $desc = array(
                "Tegangan (V)", "Arus Motor Fast (A)", "Arus Motor Slow (A)", "Brake System",
                "Tegangan (V)", "Arus Motor Fast (A)", "Arus Motor Slow (A)", "Brake System",
                "Perika & Cleaning", "Periksa & Kencangkan", "Push Button", "Kabel"
            );
        // Keterangan fields array
        $notes = array(
            '1_note_1', '1_note_2', '1_note_3', '1_note_4', '1_note_5', 
            '1_note_6', '1_note_7', '1_note_8', '1_note_9', '1_note_10', 
            '1_note_11', '1_note_12'
        );

        $fieldIndex = 0;

        // Loop through each description
        foreach ($desc as $index => $description) {
            // Determine whether to start a new group (Hoist/Cross/etc.)
            if ($index % 4 == 0 || $index == 9 || $index == 10) {
                echo '<tr>';
                // Set the first column as "Hoist" or "Cross"
                if ($index == 0) {
                    echo '<th class="parameter" rowspan="4">1</th>';
                    echo '<th class="measure2" rowspan="4">Hoist</th>';
                } elseif ($index == 4) {
                    echo '<th class="parameter" rowspan="4">2</th>';
                    echo '<th class="measure2" rowspan="4">Cross</th>';
                } elseif ($index == 8){
                    echo '<th class="parameter">3</th>';
                    echo '<th class="measure2">Kontaktor</th>';
                } elseif ($index == 9){
                    echo '<th class="parameter">4</th>';
                    echo '<th class="measure2">Koneksi Panel</th>';
                } elseif ($index == 10){
                    echo '<th class="parameter" rowspan="2">5</th>';
                    echo '<th class="measure2" rowspan="2">Pendant Switch</th>';
                } 

            }

            // Add the description and corresponding fields
            echo '<th style="width:12%;">' . $description . '</th>';
            for ($i = 0; $i < 6; $i++) {
                if (strpos($fields[$fieldIndex], '_brake') !== false || $index == 8 || $index == 9 || $index == 10 || $index == 11) {
                        echo "<td colspan='6'>";
                        echo htmlspecialchars(formatValue($article[$fields[$fieldIndex]]));
                        echo "</td>";
                        $fieldIndex++;
                        break;
                }else{
                        echo "<td>";
                        echo htmlspecialchars(formatValue($article[$fields[$fieldIndex]]));
                        echo "</td>";
                        $fieldIndex++;
                }
            }
            // Add the corresponding Keterangan field
                echo "<td>";
                echo htmlspecialchars(formatValue($article[$notes[$index]]));
                echo "</td>";
                echo '</tr>';
            
        }
        ?>
            <tr>
                <th class="parameter" colspan="3">Entry By</th>
               <?php 
                    echo "<td colspan='12'style='text-align:left; color:grey; padding: 5px 10px'>";
                    echo htmlspecialchars(formatValue($article['1_pic']));
                    echo "&nbsp&nbsp";
                    echo htmlspecialchars(formatValue($article['1_time']));
                    echo "</td>";
                ?>
            </tr>  

            <tr>
            <th class="parameter" colspan="3">Note Anomali
            </th>
            <?php 
                echo "<td colspan='12' id='note-container' style='text-align:left; padding: 5px 10px'>";
                echo htmlspecialchars(formatValue($article['1_note_anomali']));
                echo "</td>";
            ?>
            </tr>

        </tbody>
        </article>
        </table>
        <h3>Pengecekan Kondisi Crane</h3>
        <table style="width: 80%; margin-left:0; margin-right:0; float:left;">
        <thead>
            <tr>
                <th style="width:15%">Hoisting Unit</th>
                <td style="width:5%">Check</td>
                <th style="width:15%">Troley Unit</th>
                <td style="width:5%">Check</td>
                <th style="width:15%">Structure</th>
                <td style="width:5%">Check</td>
                <th style="width:15%">Electrical System</th>
                <td style="width:5%">Check</td>
            </tr>
        </thead>
        <article>
                <tbody>
            <?php
            $hoist_field = array(
                '2_hoist_body', '2_hoist_panel', '2_chain', '2_chain_pinion', '2_chain_guide',
                '2_chain_bucket', '2_hoist_limit', '', '2_hoist_gear_noise', '2_hoist_gear_leakage', '',
                '2_hoist_motor_rectifier', '2_hoist_motor_coil', '2_hoist_motor_disc',
                '2_hoist_motor_bearing', '2_hoist_motor_fan'
              );
                          
            $hoist_desc = array(
                "1. Hoisting Body Condition", "2. Hoist Panel Condition", "3. Chain", "4. Chain Pinion", "5. Chain Guide",
                "6. Chain Bucket", "7. Hoisting Limit Switch", "8. Hoisting Gearbox", "&nbsp;&nbsp;&nbsp;a. Noise", 
                "&nbsp;&nbsp;&nbsp;b. Leakage", "9. Hoisting Motor", "&nbsp;&nbsp;&nbsp;a. Rectifier", "&nbsp;&nbsp;&nbsp;b. Brale Coil",
                "&nbsp;&nbsp;&nbsp;c. Brake Disc", "&nbsp;&nbsp;&nbsp;d. Bearings", "&nbsp;&nbsp;&nbsp;e. Fan & Cover"
            );

            $trolley_field = array(
                '', '2_trolley_gear_noise','2_trolley_gear_leakage', '', '2_trolley_motor_rectifier', '2_trolley_motor_coil',
                '2_trolley_motor_disc', '2_trolley_motor_bearing', '2_trolley_motor_fan',
                '2_crab_trolley', '', '2_trolley_driving_bearing', '2_trolley_driving_wheel', '',
                '2_trolley_idle_bearing', '2_trolley_idle_wheel'
            );

            $trolley_desc = array (
                "1. Trolley Gearbox", "&nbsp;&nbsp;&nbsp;a. Noise", "&nbsp;&nbsp;&nbsp;b. Leakage", "2. Trolley Motor",
                "&nbsp;&nbsp;&nbsp;a. Rectifier", "&nbsp;&nbsp;&nbsp;b. Brake Coil", "&nbsp;&nbsp;&nbsp;c. Brake Disc",
                "&nbsp;&nbsp;&nbsp;d. Bearings", "&nbsp;&nbsp;&nbsp;e. Fan & Cover", "3. Crab / Trolley condition",
                "4. Trolley Driving Wheel", "&nbsp;&nbsp;&nbsp;a. Bearings", "&nbsp;&nbsp;&nbsp;b. Wheel", "5. Trolley Idle Wheel",
                "&nbsp;&nbsp;&nbsp;a. Bearings", "&nbsp;&nbsp;&nbsp;b. Wheel"
            );

            $structure_field = array (
                '2_girder_welding', '2_girder_plate', '2_runway_rail',
            );

            $structure_desc = array (
                "1. Girder Structure Welding", "2. Girder's Joint Plate", "3. Runway Rail"
            );

            $electrical_field = array (
                '2_main_panel', '2_hoist_troley_panel', '', '2_contactor_hoist', '2_contactor_troley',
                '2_contactor_main', '2_main_breaker', '2_fuses', '2_current_colector',
                '2_inverter_trolley', '2_monitoring', '2_terminal', '2_festoon', '2_bridge_power',
                '2_control_station', '2_cable_other', 
            );

            $electrical_desc = array (
                "1. Main Panel", "2. Hoist and Trolley Panel", "3. Contactors", "&nbsp;&nbsp;&nbsp;a. Hoisting", 
                "&nbsp;&nbsp;&nbsp;b. Trolley", "&nbsp;&nbsp;&nbsp;c. Main", "5. Main Breaker", "6. Fuses", "7. Current Collector",
                "8. Inverter Trolley", "9. Condition Monitoring", "10. Terminals", "11. Festoon System", "12. Bridge Power Supply",
                "13. Control Station (pendant)", "14. Cables (other)"
            );


    $max_rows = max(count($hoist_desc), count($trolley_desc), count($structure_desc), count($electrical_desc));

    for ($i = 0; $i < $max_rows; $i++) {
        echo '<tr>';

        if (isset($hoist_desc[$i])) {
            echo '<th class="measure" style="text-align:left">' . $hoist_desc[$i] . '</th>';
                echo "<td>";
                if($hoist_desc[$i] !== "8. Hoisting Gearbox" && $hoist_desc[$i] !== "9. Hoisting Motor"){
                echo htmlspecialchars(formatValue($article[$hoist_field[$i]]));
                }
                echo "</td>";
        } else {
            echo '<td></td><td></td>';
        }

        if (isset($trolley_desc[$i])) {
            echo '<th class="measure" style="text-align:left">' . $trolley_desc[$i] . '</th>';
                echo "<td>";
                if($trolley_desc[$i] !== "1. Trolley Gearbox" && $trolley_desc[$i] !== "2. Trolley Motor"  && $trolley_desc[$i] !== "4. Trolley Driving Wheel"  && $trolley_desc[$i] !== "5. Trolley Idle Wheel"){
                echo htmlspecialchars(formatValue($article[$trolley_field[$i]]));
                }
                echo "</td>";
        } else {
            echo '<td></td><td></td>';
        }

        if (isset($structure_desc[$i])) {
            echo '<th class="measure" style="text-align:left">' . $structure_desc[$i] . '</th class="measure" style="text-align:left">';
                echo "<td>";
                echo htmlspecialchars(formatValue($article[$structure_field[$i]]));
                echo "</td>";
        } else {
            echo '<td></td><td></td>';
        }

        if (isset($electrical_desc[$i])) {
            echo '<th class="measure" style="text-align:left">' . $electrical_desc[$i] . '</th class="measure" style="text-align:left">';
                echo "<td>";
                if($electrical_desc[$i] !== "3. Contactors"){
                echo htmlspecialchars(formatValue($article[$electrical_field[$i]]));
                }
                echo "</td>";
        } else {
            echo '<td></td><td></td>';
        }

        echo '</tr>';
    }
        ?>
                    <tr>
                <th class="parameter" colspan="2">Entry By</th>
               <?php 
                    echo "<td colspan='12'style='text-align:left; color:grey; padding: 5px 10px'>";
                    echo htmlspecialchars(formatValue($article['2_pic']));
                    echo "&nbsp&nbsp";
                    echo htmlspecialchars(formatValue($article['2_time']));
                    echo "</td>";
                ?>
            </tr>  

            <tr>
            <th class="parameter" colspan="2">Note Anomali
            </th>
            <?php 
                echo "<td colspan='12' id='note-container' style='text-align:left; padding: 5px 10px'>";
                echo htmlspecialchars(formatValue($article['2_note_anomali']));
                echo "</td>";
            ?>
            </tr>

        <?php endif; ?>

        </main>
    <script>
        document.getElementById("exit").onclick=function (){
            location.href = 'selection.php'
        }
    </script>

</body>
</html>