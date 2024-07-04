    <div class="custom-label-sub">
        <form method="GET" action="">
            <div class ="custom-label-form">
                <label for="selectedDate" >Pilih Tanggal:</label>
            <div class="unitfield-form">
                <input type="date" id="selectedDate" class="input-container" name="selectedDate">
            </div>
            <?php
            if (isset($_GET['selectedUnit'])) {
                echo '<input type="hidden" name="selectedUnit" value="' . htmlspecialchars($_GET['selectedUnit']) . '">';
            }
            if (isset($_GET['selectedLine'])) {
                echo '<input type="hidden" name="selectedLine" value="' . htmlspecialchars($_GET['selectedLine']) . '">';
            }
            if (isset($_GET['selectedUnit2'])) {
                echo '<input type="hidden" name="selectedUnit2" value="' . htmlspecialchars($_GET['selectedUnit2']) . '">';
            }
            ?>


                <input style="margin-left: -30px;" type="submit" class="btn-view" value="SUBMIT">
            </div>
        </form>
    </div>