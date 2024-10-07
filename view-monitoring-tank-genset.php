<?php
$unit = $_GET['selectedUnit']; // Get the 'unit' parameter from the query string
require 'database.php';

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
 
    </style>
</head>
<body>
<?php include 'header.php'; ?>
<main>
    <h2>MONITORING FUEL DAY TANK GENSET WARTSILA</h2>
    <table>
        <thead>
            <tr>
                <th rowspan="3">No</th>
                <th rowspan="3">Tanggal</th>
                <th colspan="8">SOLAR / LFO</th>
                <th colspan="3">MINYAK BAKAR / HFO</th>
                <th style="font-size:0.8em; width:3%;">Estimasi Pemakaian<br></th>
                <th rowspan="3">Entry By</th>
            </tr>
            <tr>
                <th>Level Tanki</th>
                <th colspan="2">Persentase</th>
                <th>Stock</th>
                <th rowspan="2" style="width: 7%;">Status</th>
                <th colspan="3">Flowrate</th>
                <th>Level Tank</th>
                <th>Storage Tank</th>
                <th>Day Tank</th>
                <th rowspan="2" style="font-size:0.8em;">1 Engine-Full Load (Hours)</th>
            </tr>
            <tr>
                <th>(Cm)</th>
                <th>Tank (%)</th>
                <th>Computer (%)</th>
                <th>Liter</th>
                <th>Awal (m³)</th>
                <th>Akhir (m³)</th>
                <th>Liter</th>
                <th>(Cm)</th>
                <th>Liter</th>
                <th>Liter</th>
            </tr>
        </thead>
            <tbody>
                <?php 
                require 'database.php';
                include 'request-view-monitor-tank-genset.php';
            
?>

<?php if (mysqli_num_rows($results) > 0) : ?>
    <?php while ($article = mysqli_fetch_assoc($results)) : ?>
    <tr>
        <td><?php echo formatValue($article['id']); ?></td>
        <td><?php echo formatValue($article['tanggal']); ?></td>
        <td><?php echo formatValue($article['lfo_lvl_tank']); ?></td>
        <td><?php echo formatValue($article['lfo_percent_tank']); ?></td>
        <td><?php echo formatValue($article['lfo_percent_comp']); ?></td>
        <td><?php echo formatValue($article['stock_liter']); ?></td>
        <td><?php echo formatValue($article['status']); ?></td>
        <td><?php echo formatValue($article['flow_awal']); ?></td>
        <td><?php echo formatValue($article['flow_akhir']); ?></td>
        <td><?php echo formatValue($article['flow_liter']); ?></td>
        <td><?php echo formatValue($article['hfo_lvl_tank']); ?></td>
        <td><?php echo formatValue($article['hfo_st_tank']); ?></td>
        <td><?php echo formatValue($article['hfo_day_tank']); ?></td>
        <td><?php echo formatValue($article['estimasi_pakai']); ?></td>
        <td>
            <?php echo formatValue($article['pic']); ?>
            <br>
            <?php echo formatValue($article['time']); ?>
        </td>
    </tr>
    <?php endwhile; ?>
<?php endif; ?>


            </tbody>
    </table>
</main>
<script>
document.getElementById("exit").onclick = function() {
    location.href = 'selection.php';
}
$(".enum").prop("selectedIndex", -1);
$(".input-field").val('');


</script>
</body>
</html>
