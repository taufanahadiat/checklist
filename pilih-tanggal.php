    <div class="custom-label-sub">
        <form method="GET" action="">
            <div class ="custom-label-form">
                <label for="selectedDate" >Pilih Tanggal:</label>
            <div class="unitfield-form">
                <input type="date" id="selectedDate" class="input-container" name="selectedDate">
            </div>
                <input type="hidden" name="selectedUnit" value="<?php echo $_GET["selectedUnit"]; ?>">
                <input style="margin-left: -30px;" type="submit" class="btn-view" value="SUBMIT">
            </div>
        </form>
    </div>