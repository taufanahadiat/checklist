<!-- Verification Form -->
<div class="verif">
    <form id="verificationForm" method="POST" action="verifikasi.php">
        <?php if (isset($bulan)): ?>
            <input type="hidden" name="bulan" value="<?php echo htmlspecialchars($bulan); ?>">
        <?php else: ?>
            <input type="hidden" name="tanggal" value="<?php echo htmlspecialchars($tanggal); ?>">
        <?php endif; ?>

        <input type="hidden" name="name" value="<?php echo htmlspecialchars($baris[0]); ?>">
        <input type="hidden" name="time" value="<?php echo date('d/m/Y H:i'); ?>">

        <?php if (isset($line)): ?>
            <input type="hidden" name="line" value="<?php echo htmlspecialchars($line); ?>">
        <?php endif; ?>

        <?php if (isset($unit_trane)): ?>
            <input type="hidden" name="unit" value="<?php echo htmlspecialchars($unit_trane); ?>">
        <?php else: ?>
            <input type="hidden" name="unit" value="<?php echo htmlspecialchars($unit); ?>">
        <?php endif; ?>

        <?php 
        $showCheckButton = true;
        $latestVerifiedStage = 0;
        $verificationDetails = "";

        for ($i = 1; $i <= 4; $i++) {
            if (isset($line)) {
                $query = "SELECT verifikasi_name_$i, verifikasi_time_$i FROM `$unit` WHERE line = '$line' AND tanggal = '$tanggal' LIMIT 1";
            } else if (isset($unit_trane)) {
                $query = "SELECT verifikasi_name_$i, verifikasi_time_$i FROM `$unit_trane` WHERE tanggal = '$tanggal' LIMIT 1";
            } else if (isset($bulan)){
                $query = "SELECT verifikasi_name_$i, verifikasi_time_$i FROM `$unit` WHERE bulan = '$bulan' LIMIT 1";
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
        </div>

        <?php if ($latestVerifiedStage < 4): ?>
            <div class="verif-btn">
            <button style="float:right; margin-top:10px;" type="button" id="verifikasiButton" 
                <?php 
                if (
                    (isset($_SESSION['sesi_user']) && $_SESSION['sesi_user'] === 'guest') || 
                    !isset($_SESSION['type_user']) || 
                    ($_SESSION['type_user'] != 36 && $_SESSION['type_user'] != 2)
                ) {
                    echo 'disabled';
                }
                ?> 
                onclick="showPasswordModal()">Check</button></div>
        <?php endif; ?>
    </form>


<!-- Password Modal -->
<div id="passwordModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closePasswordModal()">&times;</span>
        <p>Masukan Password:</p>
        <input type="password" id="passwordInput" name="password" placeholder="Password">
        <button onclick="verifyPassword()">OK</button>
    </div>
</div>
