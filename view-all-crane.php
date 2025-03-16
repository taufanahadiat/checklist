<?php
$lineAll = $_GET['selectedLineAll'];
$tanggal = isset($_GET['selectedMonth']) ? $_GET['selectedMonth'] : null;
$area = 'crane';
$bulan = $tanggal;

require 'database.php';

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
?>


<!DOCTYPE html>
<html>
<head>
    <title>View Checklist Crane</title>
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
    </style>

</head>

<body>
<?php include 'header.php'; ?>
<main>
<?php include 'weeklyReport.php'?>

    <?php 
$line4 = array(
    "crane_21,die,line_4" => "singlegirder",
    "crane_22ab,proses,line_4" => "doublegirder",
    "crane_23ab,big_slitter_n,line_4" => "doublegirder",
    "crane_24,repack,line_4" => "singlegirder",
    "crane_25,repack,line_4" => "singlegirder"
);

$line5 = array(
    "crane_39,die,line_5" => "singlegirder",
    "crane_38ab,proses,line_5" => "doublegirder",
    "crane_37ab,big_slitter_v,line_5" => "doublegirder",
    "crane_36,repack,line_5" => "singlegirder",
    "crane_41,repack,line_5" => "singlegirder",
    "crane_43,cargolift_die,line_5" => "cargolift"
);

$line6 = array(
    "crane_53ab,proses,line_6" => "doublegirder",
    "crane_54ab,big_slitter_aa,line_6" => "doublegirder",
    "crane_55,mdo,line_6" => "singlegirder",
    "crane_56,cargolift_die,line_6" => "cargolift",
    "crane_57,small_slitter_ab,line_6" => "singlegirder",
    "crane_58,repack,line_6" => "singlegirder",
    "crane_59,repack,line_6" => "singlegirder",
    "crane_60,repack,line_6" => "singlegirder",
    "crane_61,repack,line_6" => "singlegirder",
    "crane_62,ruang_filter,line_6" => "singlegirder",
    "crane_63,die,line_6" => "singlegirder",
    "crane_64,cargo_lift_tdo,line_6" => "cargolift",
    "crane_65,filter,line_6" => "singlegirder",
    "crane_80,erema,line_6" => "monorail",
    "crane_94,loading_material,line_6" => "monorail"
);

$line7 = array(
    "crane_73ab,proses,line_7" => "doublegirder",
    "crane_74ab,big_slitter_bb,line_7" => "doublegirder",
    "crane_75,repack,line_7" => "singlegirder",
    "crane_76,repack,line_7" => "singlegirder",
    "crane_77,repack,line_7" => "singlegirder",
    "crane_78,repack,line_7" => "singlegirder",
    "crane_79,die,line_7" => "singlegirder",
    "crane_95,die,line_7" => "monorail"
);

$line8 = array(
    "crane_86ab,big_slitter_cc,line_8" => "doublegirder",
    "crane_87ab,proses,line_8" => "doublegirder",
    "crane_88,mdo,line_8" => "singlegirder",
    "crane_89,die,line_8" => "singlegirder",
    "crane_90,repack,line_8" => "singlegirder",
    "crane_91,repack,line_8" => "singlegirder",
    "crane_92,repack,line_8" => "singlegirder",
    "crane_93,repack,line_8" => "singlegirder"
);

$bopet = array(
    "crane_30ab,big_slitter_ta,line_bopet" => "doublegirder",
    "crane_31ab,proses,line_bopet" => "doublegirder",
    "crane_32,repack,line_bopet" => "singlegirder",
    "crane_33,repack,line_bopet" => "singlegirder",
    "crane_29,small_slitter,line_bopet" => "singlegirder",
    "crane_37,cargo_lift_winder,line_bopet" => "cargolift",
    "crane_38,cargo_lift_die,line_bopet" => "cargolift",
    "crane_34,feeding_trance,line_bopet" => "monorail",
    "crane_35,feeding_trance,line_bopet" => "monorail"
);

$metalize = array(
    "crane_45,proses,metalize_1" => "monorail",
    "crane_46,slitter,metalize_1" => "monorail",
    "crane_47,repack,metalize_1" => "singlegirder",
    "crane_50,slitter,metalize_2" => "monorail",
    "crane_51,proses,metalize_2" => "monorail",
    "crane_52,repack,metalize_2" => "singlegirder",
    "crane_69,intermedite,metalize_2" => "singlegirder",
    "crane_70,proses,metalize_3" => "monorail",
    "crane_71,slitter,metalize_3" => "monorail",
    "crane_72,repack,metalize_3" => "singlegirder",
    "crane_83,proses,metalize_4" => "singlegirder",
    "crane_84,slitter,metalize_4" => "singlegirder",
    "crane_85,repack,metalize_4" => "singlegirder"
);

$coating = array(
    "crane_26,pvdc,coating_1" => "monorail",
    "crane_27,pvdc,coating_1" => "monorail",
    "crane_66,intermedite,coating_1" => "singlegirder",
    "crane_44,intermedite,coating_3&4" => "singlegirder",
    "crane_40,mesin_r_coating,coating_3&4" => "monorail",
    "crane_67,unwind,coating_3" => "monorail",
    "crane_68,rewind,coating_3" => "monorail",
    "crane_96,rewind,coating_4" => "monorail"
);

$small_slitter = array(
    "crane_14,ex_slitter_c,line_3" => "singlegirder",
    "crane_15,small_slitter,mesin_mm/p" => "singlegirder",
    "crane_16,small_slitter,mesin_d.e.f.g" => "singlegirder",
    "crane_17,small_slitter,mesin_h.i.j" => "singlegirder",
    "crane_81,small_slitter_aa_1" => "singlegirder",
    "crane_82,small_slitter_aa_2.3" => "singlegirder",
    "crane_48,repack,warehouse_bopet" => "singlegirder",
    "crane_49,repack,warehouse_bopet" => "singlegirder",
    "crane_97,repack,warehouse_ngr" => "singlegirder"
);

$lineTitle = str_replace('_', ' ', $lineAll); 
$lineTitle = str_replace('line', '', $lineTitle); 
$lineTitle = strtoupper(trim($lineTitle)); 

        echo "<h2 style='margin-bottom: -5px; text-decoration: underline;'>VIEW ALL CRANE LINE $lineTitle</h2>";
        $date = DateTime::createFromFormat('Y-m', $tanggal);
        $formattedDate = strtoupper($date->format('F Y'));
        echo "<h2 style=\"margin-top: 10px; margin-bottom: -5px; font-size: 18px; font-weight:550;\">── $formattedDate ──</h2>";
        //include 'pilih-tanggal.php';
        $firstKey = key($$lineAll); 
        foreach ($$lineAll as $key => $value) {
            $line = $key;
            switch ($value){
                case 'singlegirder':
                    $unit = 'crane_single_girder';
                    break;
                case 'doublegirder':
                    $unit = 'crane_double_girder';
                    break;
                case 'monorail':
                    $unit = 'crane_monorail';
                    break;
                case 'cargolift':
                    $unit = 'crane_cargo_lift';
                    break;
                }
            include "view-crane-$value.php"; 
            echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
        }
    ?>
    
</main>
<script>
        document.getElementById("exit").onclick=function (){
            location.href = 'selection.php'
        }
        $(".enum").prop("selectedIndex", -1);
        $(".input-field").val('');
    </script>
</body>
</html>
