<?php
        $showCheckButton = true;
        $latestVerifiedStage = 0;
        $verificationDetails = "";

        $tanggalTables = array('chiller', 'compressor', 'genset', 'boiler', 'trafo');
        $bulanTables = array(
            'trafo_pm', 
            'panel_lvdp', 
            'capbank_lvdp', 
            'crane_line4',
            'crane_line5',
            'crane_line6',
            'crane_line7',
            'crane_line8',
            'crane_bopet',
            'crane_metalize',
            'crane_coating',
            'crane_small_slitter'
        );        
        if (in_array($area, $tanggalTables)) {
            $table = 'verifreport_daily';
        } elseif (in_array($area, $bulanTables)) {
            $table = 'verifreport_monthly';
        }

        for ($i = 1; $i <= 4; $i++) {
            if (isset($bulan)){
                $query = "SELECT verifikasi_name_$i, verifikasi_time_$i FROM `$table` WHERE bulan = '$bulan' AND area = '$area' LIMIT 1";
            } else {
                $query = "SELECT verifikasi_name_$i, verifikasi_time_$i FROM `$table` WHERE tanggal = '$tanggal' AND area = '$area' LIMIT 1";
            }
            $result = mysqli_query($conn, $query);
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $verifikasi_name = htmlspecialchars($row["verifikasi_name_$i"]);
                $verifikasi_time = htmlspecialchars($row["verifikasi_time_$i"]);
                
                if ($verifikasi_name) {
                    $latestVerifiedStage = $i;
                    $verificationDetails = "
                    <div style='margin-top: -15px;'>
                    <br>
                    <p style='display:inline;'>
                        " . 
                            "<i class='fas fa-check-circle'></i>". "
                        &nbsp;Checked by&nbsp;<span style='color:black;'>$verifikasi_name</span></p>&nbsp;<div class='verifShowTime'><p style='display:inline;'>at $verifikasi_time </p></div>
                    </div>" . $verificationDetails;  // Prepend to build reverse order
                } else {
                    $showCheckButton = true;
                    break; // Stop loop to show the Check button for the next unverified stage
                }
            }
        }

//        ($_SESSION['name_user'] === $verifikasi_name ? "
//                            <span class='icon-wrapper'>
//                                <i class='fas fa-check-circle'></i>
//                                <i class='fa-solid fa-circle-xmark' onclick='showPasswordModal()'></i>
//                                <span class='tooltip'>Batalkan Verifikasi</span>
//                            </span>" 
//                        : 
//        " . 
//                                    "<i class='fas fa-check-circle'></i>") . "

$userAgent = $_SERVER['HTTP_USER_AGENT'];

if (strpos($userAgent, 'Firefox') !== false) {
    echo '<br><br>';
}


        echo "<div style='margin-top: -90px; align-self: flex-end;'>";
        echo $verificationDetails;
        echo "</div>";
  ?>      