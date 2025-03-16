<?php
        $showCheckButton = true;
        $latestVerifiedStage = 0;
        $verificationDetails = "";

        for ($i = 1; $i <= 4; $i++) {
            if (isset($line)) {
                $query = "SELECT verifikasi_name_$i, verifikasi_time_$i FROM `$unit` WHERE line = '$line' AND tanggal = '$tanggal' LIMIT 1";
            } else if (isset($unit_trane)) {
                $query = "SELECT verifikasi_name_$i, verifikasi_time_$i FROM `$unit_trane` WHERE tanggal = '$tanggal' LIMIT 1";
            } else {
                $query = "SELECT verifikasi_name_$i, verifikasi_time_$i FROM `$unit` WHERE tanggal = '$tanggal' LIMIT 1";
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

        echo "<div style='margin-top: -90px; align-self: flex-end;'>";
        echo $verificationDetails;
        echo "</div>";
  ?>      