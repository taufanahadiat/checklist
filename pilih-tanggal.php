    <div class="custom-label-view">
        <form action="/view-genset.php">
            <div class="">
                <label for="selectedDate" >Pilih Tanggal:</label>
                <input type="date" id="selectedDate" class="input-container" name="selectedDate">

                <input type="hidden" name="selectedUnit" value="<?php echo $_GET["selectedUnit"]; ?>">
                <input type="submit" class="btn-view" value="SUBMIT">
            </div>
        </form>
    </div>