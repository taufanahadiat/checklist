<div class="checker-container" style="z-index: 3;">
<button class="checker-btn" style="width: 120px; margin-bottom: 10px; position: relative;" id="legendBtn" onclick="toggleLegend()">
        Checker Report<br>(for leader)
        <span id="newBadge" style="position: absolute; top: -10px; right: -10px; background: red; color: white; font-size: 10px; padding: 2px 5px; border-radius: 5px;">New Update</span>
    </button>

    
    <div class="tables-container" style="display: flex; gap: 5px; align-items: flex-start;">
        <div class="legend-table" id="legendTable" style="flex: 1;">

            <h2 style="font-size:16px; margin-top:1px;">Form Harian</h2>

            <!-- Date Picker -->
            <div style="margin-top: 15px; display: flex; align-items: center; gap: 10px;">
                <label for="datePicker" style="white-space: nowrap; float:left;">Pilih Tanggal:</label>
                <?php
                $today = new DateTime();
                $sevenDaysAgo = new DateTime('-7 days');
                ?>
    <input type="date" id="datePicker" class="input-container" max="<?php echo $today->format('Y-m-d'); ?>" onchange="updateTable()">
    <p style="font-size: 12px; margin: 0;">*note: halaman ini untuk melihat form-form checklist yang sudah dicek oleh para leader</p>
            </div>
            <table id="tableLeaderCheck">
                <thead>
                    <tr>
                        <th rowspan="2">Area</th>
                        <th colspan="7">Tanggal</th>
                    </tr>
                    <tr class="date-header">
                        <?php
                        // Default table header for the last 7 days
                        $today = new DateTime();
                        $dates_display = array();
                        $dates_data = array();

                        for ($i = 7; $i > 0; $i--) {
                            $date = new DateTime();
                            $date->sub(new DateInterval('P' . $i . 'D'));
                            $dates_display[] = $date->format('d M Y'); // Display format: 'd-M'
                            $dates_data[] = $date->format('Y-m-d');  // Data attribute format: 'Y-m-d'
                        }

                        // Output default dates
                        foreach ($dates_display as $date) {
                            echo "<th class='head-check' style='padding: 2px 10px;'>$date</th>";
                        }
                        ?>
                    </tr>
                </thead>
                <tbody class="table-body">
                    <?php
                    // Default table rows
                    $areas = array('chiller_trane_67bopet', 'compressor', 'genset_man', 'boiler', 'trafo_daily_office');
                    $area_display = array('Chiller', 'Compressor', 'Genset', 'Boiler', 'Pengamanan Trafo');
                    foreach ($areas as $index => $area) {
                        echo "<tr>";
                        echo "<th class='parameter-check'>{$area_display[$index]}</th>";
                        foreach ($dates_data as $date_data) { // Iterate through date data
                            echo "<td class='leaderCheck' data-area='" . strtolower($area) . "' data-tanggal='$date_data'></td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <button id="exportButton" class="btn" style="padding: 3px; margin-top: -10px; margin-bottom: 0px;" onclick="exportTableToExcel('tableLeaderCheck', 'checker_report')">Export to Excel</button>
        </div>

        <!-- Month Table -->
        <div class="legend-table" id="monthTable" style="flex: 1;">
            <h2 style="font-size:16px; margin-top:1px;">Form Bulanan</h2>
            <div style="margin-top: 15px; white-space: nowrap;">
                <label for="datePicker" style="white-space: nowrap;">Pilih Tanggal:</label>
                <input type="month" id="monthPicker" class="input-container" max="<?php echo $today->format('Y-m-d'); ?>" onchange="updateTable()">
            </div>
            <table>
            <thead>
                    <tr>
                        <th rowspan="2" colspan="2">Area</th>
                        <th colspan="3">Bulan</th>
                    </tr>
                    <tr class="month-header">
                        <?php
                        // Default table header for the last 7 days
                        $today = new DateTime();
                        $dates_display = array();
                        $dates_data = array();

                        for ($i = 2; $i >= 0; $i--) {
                            $date = new DateTime();
                            $date->sub(new DateInterval('P' . $i . 'M')); // Subtract months
                            $dates_display[] = $date->format('M Y'); // Display format: short month name (e.g., Oct)
                            $dates_data[] = $date->format('Y-m');  // Data attribute format: 'Y-m-d'
                        }                        

                        // Output default dates
                        foreach ($dates_display as $date) {
                            echo "<th class='head-check' style='padding: 2px 10px;'>$date</th>";
                        }
                        ?>
                    </tr>
                </thead>
                <tbody class="month-body">
                    <?php
                    $areas = array('trafo_monthly', 'panel_lvdp3', 'capbank_lvdp3', 'crane');
                    $area_display = array('PM Trafo', 'Panel LVDP', 'Capacitor Bank', 'Crane');
                    foreach ($areas as $index => $area) {
                        echo "<tr>";
                        if ($area == 'crane'){
                            echo "<th>{$area_display[$index]}</th>";
                            echo "<th style='max-width: 65px; text-align: center;'>
                                    Pilih Line
                                    <select class='selection-compressor' style='min-width:60px; margin-right:0px; padding ='0px' name='crane_checker' id='lineCraneCheck' onchange='updateCraneArea()'>
                                        <option value='crane_single_girder' data-line='crane_21,die,line_4'>Line 4</option>
                                        <option value='crane_single_girder' data-line='crane_39,die,line_5'>Line 5</option>
                                        <option value='crane_double_girder' data-line='crane_53ab,proses,line_6'>Line 6</option>
                                        <option value='crane_double_girder' data-line='crane_73ab,proses,line_7'>Line 7</option>
                                        <option value='crane_double_girder' data-line='crane_86ab,big_slitter_cc,line_8'>Line 8</option>
                                        <option value='crane_double_girder' data-line='crane_30ab,big_slitter_ta,line_bopet'>Line BOPET</option>
                                        <option value='crane_monorail' data-line='crane_45,proses,metalize_1'>Metalize 1~4</option>
                                        <option value='crane_monorail' data-line='crane_26,pvdc,coating_1'>Coating 1, 3, 4</option>
                                        <option value='crane_single_girder' data-line='crane_14,ex_slitter_c,line_3'>Small Slitter</option>
                                    </select>
                                  </th>";
                                  
                            foreach ($dates_data as $date_data) {
                                echo "<td class='craneCheck' data-area='crane_single_girder' data-tanggal='$date_data' data-line='crane_21,die,line_4'></td>";
                            }
                        } else {
                            echo "<th colspan='2' class='parameter-check'>{$area_display[$index]}</th>";
                            
                            foreach ($dates_data as $date_data) {
                                echo "<td class='monthCheck' data-area='" . strtolower($area) . "' data-bulan='$date_data' style='white-space: nowrap;'></td>";
                            }
                        }

                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="legend-table" id="hiddenTable" style="display:none; flex: 1;">
        <h2 style="font-size:16px; margin-top:1px;">Form Hidden</h2>
            <table>
                <thead>
                    <tr>
                        <th rowspan="2" colspan="2">Area</th>
                        <th colspan="3">Bulan</th>
                    </tr>
                    <tr class="hidden-header">
                        <?php
                        foreach ($dates_display as $date) {
                                echo "<th class='head-check' style='padding: 2px 10px;'>$date</th>";
                            }
                        ?>
                    </tr>
                </thead>
                <tbody class="hidden-body">
                    <?php 
                    $craneUnit = array(
                        "crane_21,die,line_4" => "crane_single_girder",
                        "crane_39,die,line_5" => "crane_single_girder",
                        "crane_53ab,proses,line_6" => "crane_double_girder",
                        "crane_73ab,proses,line_7" => "crane_double_girder",
                        "crane_86ab,big_slitter_cc,line_8" => "crane_double_girder",
                        "crane_30ab,big_slitter_ta,line_bopet" => "crane_double_girder",
                        "crane_45,proses,metalize_1" => "crane_monorail",
                        "crane_26,pvdc,coating_1" => "crane_monorail",
                        "crane_14,ex_slitter_c,line_3" => "crane_single_girder"
                    );

                    $craneLine = array(
                        "Line 4", "Line 5", "Line 6", "Line 7", "Line 8", "Line BOPET", "Metalize 1~4", "Coating 1, 3, 4", "Small Slitter"
                    );

                    $i = 0; 
                    foreach ($craneUnit as $key => $areaCrane) {
                        echo "<tr>";
                        echo "<th>Crane</th>";
                        echo "<th>{$craneLine[$i]}</th>";
                        foreach ($dates_data as $date_data) {
                            echo "<td class='craneHidden' data-area='$areaCrane' data-tanggal='$date_data' data-line='$key'></td>";
                        }
                        echo "</tr>";
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="js/exceljs.min.js"></script>
<script>
async function exportTableToExcel(tableID, filename) {
    const hiddenTable = document.getElementById('hiddenTable');
    hiddenTable.style.display = 'block';
    // Load ExcelJS Workbook
    const workbook = new ExcelJS.Workbook();
    await workbook.xlsx.load(fetch("Template/dailyMonthlyCheck.xlsx").then(res => res.arrayBuffer()));

    try {

    const worksheet = workbook.getWorksheet('Sheet1');
    if (!worksheet) {
        console.error("Worksheet tidak ditemukan!");
        return;
    }

    const table = document.getElementById(tableID);
    const rows = table.querySelectorAll("tr");

    // Daily checklist: Start at row 4, column 2
    let startRow = 4;
    let startCol = 2;

    // Add date headers to the Excel sheet for the daily checklist
    const headerRow = rows[1]; // The second row contains the date headers
    const headerCells = headerRow.querySelectorAll("th.head-check");

    headerCells.forEach((cell, index) => {
        let excelCell = worksheet.getCell(startRow, startCol + index);
        excelCell.value = cell.innerText; // Set the date as the header value
    });

    startRow++; // Move to the next row for data

    // Add daily checklist rows
    const areaRows = rows[2].parentElement.querySelectorAll("tr"); // Skip the header rows
    areaRows.forEach((row) => {
        const cells = row.querySelectorAll("td");
        cells.forEach((cell, cellIndex) => {
            let excelCell = worksheet.getCell(startRow, startCol + cellIndex);
            excelCell.value = cell.innerText; // Copy cell values
        });

        startRow++;
    });

    // Monthly checklist: Add space after daily checklist
    startRow += 3; // Leave some rows of space between daily and monthly sections
    startCol +=1;

    // Add month table headers to the Excel sheet
    const monthTable = document.getElementById('monthTable');
    const monthRows = monthTable.querySelectorAll("tr");

    const monthHeaderRow = monthRows[1]; // The second row contains the month headers
    const monthHeaderCells = monthHeaderRow.querySelectorAll("th.head-check");

    monthHeaderCells.forEach((cell, index) => {
        let excelCell = worksheet.getCell(startRow, startCol + index);
        excelCell.value = cell.innerText; // Set the month as the header value
    });

    startRow++; // Move to the next row for data

    // Add month table rows
    const monthAreaRows = monthRows[2].parentElement.querySelectorAll("tr"); // Skip the header rows
    monthAreaRows.forEach((row) => {
        const cells = row.querySelectorAll('.monthCheck');
        cells.forEach((cell, cellIndex) => {
            let excelCell = worksheet.getCell(startRow, startCol + cellIndex);
            excelCell.value = cell.innerText; // Copy cell values
        });

        startRow++;
    });

    startRow -=1;
    // Add hidden table headers to the Excel sheet
    const hiddenRows = hiddenTable.querySelectorAll("tr");

    // Add hidden table rows
    const hiddenAreaRows = hiddenRows[2].parentElement.querySelectorAll("tr"); // Skip the header rows
    hiddenAreaRows.forEach((row) => {
        const cells = row.querySelectorAll('.craneHidden');
        cells.forEach((cell, cellIndex) => {
            let excelCell = worksheet.getCell(startRow, startCol + cellIndex);
            excelCell.value = cell.innerText; // Copy cell values
        });

        startRow++;
    });

    // Write the workbook to a buffer
    const buffer = await workbook.xlsx.writeBuffer();
    const blob = new Blob([buffer], { type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" });
    
    // Create download link and trigger download
    const link = document.createElement("a");
    link.href = URL.createObjectURL(blob);
    link.download = filename + ".xlsx";
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);

} catch (error) {
        console.error("Export failed:", error);
    } finally {
        // Revert the display of hiddenTable to none
        hiddenTable.style.display = 'none';
    }
}

</script>
<script>
function updateCraneArea() {
    // Get the selected option from the dropdown
    const craneSelect = document.getElementById('lineCraneCheck');
    const selectedOption = craneSelect.options[craneSelect.selectedIndex];
    
    // Extract the relevant attributes from the selected option
    const selectedArea = craneSelect.value;
    const selectedLine = selectedOption.getAttribute('data-line');

    // Update all `td` elements with the class `craneCheck`
    const craneCells = document.querySelectorAll('.craneCheck');
    craneCells.forEach(cell => {
        cell.setAttribute('data-area', selectedArea); // Update data-area
        cell.setAttribute('data-line', selectedLine); // Update data-line
    });

    // Fetch data for each updated cell
    craneCells.forEach(cell => {
        const paramValue = cell.getAttribute(`data-tanggal`);
        const area = cell.getAttribute('data-area');
        const line = cell.getAttribute('data-line');

        // Fetch data for each cell
        fetch(`verifReport.php?tanggal=${encodeURIComponent(paramValue)}&area=${encodeURIComponent(area)}&line=${encodeURIComponent(line)}`)
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                if (data.message === 'Form tidak terisi') {
                    // Show "Form tidak terisi" if no data
                    cell.innerHTML = `<span style="color: grey;">Form tidak terisi</span>`;
                } else {
                    // Always display 1, 2, 3, 4 with placeholders if names are null or missing
                    const verifikasiNames = [];
                    for (let i = 1; i <= 4; i++) {
                        const key = `verifikasi_name_${i}`;
                        verifikasiNames.push(`${i}. ${data[0]?.[key] ?? '-'}`);
                    }
                    // Join names with `<br>` for line breaks
                    cell.innerHTML = verifikasiNames.join('<br>');
                }
            })
            .catch(error => {
                console.error(`Error fetching data for ${queryParam}=${paramValue}, area=${area}:`, error);

                // Populate with default placeholders on error
                const fallbackNames = [];
                for (let i = 1; i <= 4; i++) {
                    fallbackNames.push(`${i}. -`);
                }
                cell.innerHTML = fallbackNames.join('<br>');
            });
    });
}


    
function updateTable() {
    const selectedDate = document.getElementById('datePicker').value;
    const selectedMonth = document.getElementById('monthPicker').value;

    if (selectedDate) {
        const endDate = new Date(selectedDate); // End date from the picker
        const tableHeader = document.querySelector('.date-header');
        const tableBody = document.querySelector('.table-body');

        // Clear existing table content
        tableHeader.innerHTML = '';
        tableBody.innerHTML = '';

        // Generate the last 7 days ending at selected date
        let formattedDates = [];
        let displayDates = [];

        for (let i = 6; i >= 0; i--) {
            let date = new Date(endDate);
            date.setDate(date.getDate() - i);

            // Format for data-tanggal attribute: YYYY-MM-DD
            const yyyy = date.getFullYear();
            const mm = String(date.getMonth() + 1).padStart(2, '0');
            const dd = String(date.getDate()).padStart(2, '0');
            formattedDates.push(`${yyyy}-${mm}-${dd}`);

            const displayDate = date.toLocaleDateString('en-GB', { day: '2-digit', month: 'short' , year: 'numeric'});
            displayDates.push(displayDate);
        }

        // Update table headers
        displayDates.forEach(date => {
            tableHeader.innerHTML += `<th class='head-check'>${date}</th>`;
        });

        // Areas for rows
        const areas = ['chiller_trane_67bopet', 'compressor', 'genset_man', 'boiler', 'trafo_daily_office'];
        const area_display = ['Chiller', 'Compressor', 'Genset', 'Boiler', 'Pengamanan Trafo'];

        // Generate rows for each area
        areas.forEach((area, index) => {
            let row = `<tr><th class="parameter-check">${area_display[index]}</th>`;
            formattedDates.forEach(date => {
                row += `<td class='leaderCheck' data-area='${area.toLowerCase()}' data-tanggal='${date}'></td>`;
            });
            row += '</tr>';
            tableBody.innerHTML += row;
        });

        // Fetch and update data for each cell
        const cells = document.querySelectorAll('.leaderCheck');

        // Apply left alignment to each cell
        cells.forEach(cell => {
            cell.style.textAlign = 'left'; // Align text to the left
        });
        cells.forEach(cell => {
            const tanggal = cell.getAttribute('data-tanggal');
            const area = cell.getAttribute('data-area');


            fetch(`verifReport.php?tanggal=${encodeURIComponent(tanggal)}&area=${encodeURIComponent(area)}`)
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    if (data.message === 'Form tidak terisi') {
                    // Show "Form tidak terisi" if no data
                    cell.innerHTML = `<span style="color: grey;">Form tidak terisi</span>`;
                } else {
                    // Always display 1, 2, 3, 4 with placeholders if names are null or missing
                    const verifikasiNames = [];
                    for (let i = 1; i <= 4; i++) {
                        const key = `verifikasi_name_${i}`;
                        verifikasiNames.push(`${i}. ${data[0]?.[key] ?? '-'}`);
                    }
                    // Join names with `<br>` for line breaks
                    cell.innerHTML = verifikasiNames.join('<br>');
                }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);

                    // Populate with default placeholder on error
                    const fallbackNames = [];
                    for (let i = 1; i <= 4; i++) {
                        fallbackNames.push(`${i}. -`);
                    }
                    cell.innerHTML = fallbackNames.join('<br>');
                });
        });
    } 
    
    if (selectedMonth) {
        const endDate = new Date(selectedMonth + '-01'); // End month from the picker
        const monthHeader = document.querySelector('.month-header');
        const monthBody = document.querySelector('.month-body');
        const hiddenHeader = document.querySelector('.hidden-header');
        const hiddenBody = document.querySelector('.hidden-body');

        // Clear existing table content
        monthHeader.innerHTML = '';
        monthBody.innerHTML = '';
        hiddenHeader.innerHTML = '';
        hiddenBody.innerHTML = '';

        // Generate the last 3 months ending at selected month
        let formattedMonths = [];
        let displayMonths = [];

        for (let i = 2; i >= 0; i--) {
            let date = new Date(endDate);
            date.setMonth(date.getMonth() - i);

            // Format for data-tanggal attribute: YYYY-MM
            const yyyy = date.getFullYear();
            const mm = String(date.getMonth() + 1).padStart(2, '0');
            formattedMonths.push(`${yyyy}-${mm}`);

            const displayMonth = date.toLocaleDateString('en-GB', { month: 'short', year: 'numeric' });
            displayMonths.push(displayMonth);
        }

        // Update table headers
        displayMonths.forEach(month => {
            monthHeader.innerHTML += `<th class='head-check'>${month}</th>`;
            hiddenHeader.innerHTML += `<th class='head-check'>${month}</th>`;
        });

        // Areas for rows
        const areas = ['trafo_monthly', 'panel_lvdp3', 'capbank_lvdp3', 'crane'];
        const area_display = ['PM Trafo', 'Panel LVDP', 'Capacitor Bank', 'Crane'];

        // Generate rows for each area
        areas.forEach((area, index) => {
            let row = '';

// If the area is 'crane', display the crane dropdown in a <th>
if (area === 'crane') {
    row = `<tr><th class="parameter-check">${area_display[index]}</th>
        <th style='max-width: 65px; text-align: center;'>
            Pilih Line
            <select class='selection-compressor' style='min-width:60px; margin-right:0px; padding:0px;' 
                    name='crane_checker' id='lineCraneCheck' onchange='updateCraneArea()'>
                <option value='crane_single_girder' data-line='crane_21,die,line_4'>Line 4</option>
                <option value='crane_single_girder' data-line='crane_39,die,line_5'>Line 5</option>
                <option value='crane_double_girder' data-line='crane_53ab,proses,line_6'>Line 6</option>
                <option value='crane_double_girder' data-line='crane_73ab,proses,line_7'>Line 7</option>
                <option value='crane_double_girder' data-line='crane_86ab,big_slitter_cc,line_8'>Line 8</option>
                <option value='crane_double_girder' data-line='crane_30ab,big_slitter_ta,line_bopet'>Line BOPET</option>
                <option value='crane_monorail' data-line='crane_45,proses,metalize_1'>Metalize 1~4</option>
                <option value='crane_monorail' data-line='crane_26,pvdc,coating_1'>Coating 1, 3, 4</option>
                <option value='crane_single_girder' data-line='crane_14,ex_slitter_c,line_3'>Small Slitter</option>
            </select>
        </th>`;
} else {
    // For non-crane areas, use <th> with colspan="2"
    row = `<tr><th class="parameter-check" colspan="2">${area_display[index]}</th>`;
}
            formattedMonths.forEach(month => {
                if (area === 'crane') {
                    row += `<td class='craneCheck' data-area='crane_single_girder' data-tanggal='${month}' data-line='crane_21,die,line_4' style='white-space: nowrap;'></td>`;
                } else {
                    row += `<td class='monthCheck' data-area='${area.toLowerCase()}' data-bulan='${month}'></td>`;
                }
            });
            row += '</tr>';
            monthBody.innerHTML += row;
        });

        const crane_unit = {
            "crane_21,die,line_4": "crane_single_girder",
            "crane_39,die,line_5": "crane_single_girder",
            "crane_53ab,proses,line_6": "crane_double_girder",
            "crane_73ab,proses,line_7": "crane_double_girder",
            "crane_86ab,big_slitter_cc,line_8": "crane_double_girder",
            "crane_30ab,big_slitter_ta,line_bopet": "crane_double_girder",
            "crane_45,proses,metalize_1": "crane_monorail",
            "crane_26,pvdc,coating_1": "crane_monorail",
            "crane_14,ex_slitter_c,line_3": "crane_single_girder"
        };

        const crane_display = ["Line 4", "Line 5", "Line 6", "Line 7", "Line 8", "Line BOPET", "Metalize 1~4", "Coating 1, 3, 4", "Small Slitter"];

        let index = 0; // Index for crane_display
        Object.entries(crane_unit).forEach(([unit, area]) => {
            let row = `<tr><th>Crane</th><th>${crane_display[index]}</th>`;
            formattedMonths.forEach(month => {
                row += `<td class='craneHidden' data-area='${area}' data-tanggal='${month}' data-line='${unit}'></td>`;
            });
            row += '</tr>';
            hiddenBody.innerHTML += row;
            index++;
        });



        // Fetch and update data for each cell
        const monthCells = document.querySelectorAll('.monthCheck');
        const craneCells = document.querySelectorAll('.craneCheck');
        const hiddenCells = document.querySelectorAll('.craneHidden');

        // Apply left alignment to each cell
        [...monthCells, ...craneCells, ...hiddenCells].forEach(cell => {
            cell.style.textAlign = 'left'; // Align text to the left
        });

        [...monthCells, ...craneCells, ...hiddenCells].forEach(cell => {
            const bulan = cell.getAttribute('data-bulan');
            const tanggal = cell.getAttribute('data-tanggal');
            const area = cell.getAttribute('data-area');
            const line = cell.getAttribute('data-line');


            fetch(`verifReport.php?bulan=${encodeURIComponent(bulan)}&tanggal=${encodeURIComponent(tanggal)}&area=${encodeURIComponent(area)}&line=${encodeURIComponent(line)}`)
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {

                    if (data.message === 'Form tidak terisi') {
                    // Show "Form tidak terisi" if no data
                    cell.innerHTML = `<span style="color: grey;">Form tidak terisi</span>`;
                } else {
                    // Always display 1, 2, 3, 4 with placeholders if names are null or missing
                    const verifikasiNames = [];
                    for (let i = 1; i <= 4; i++) {
                        const key = `verifikasi_name_${i}`;
                        verifikasiNames.push(`${i}. ${data[0]?.[key] ?? '-'}`);
                    }
                    // Join names with `<br>` for line breaks
                    cell.innerHTML = verifikasiNames.join('<br>');
                }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);

                    // Populate with default placeholder on error
                    const fallbackNames = [];
                    for (let i = 1; i <= 4; i++) {
                        fallbackNames.push(`${i}. -`);
                    }
                    cell.innerHTML = fallbackNames.join('<br>');
                });
        });
    }
}



document.addEventListener('DOMContentLoaded', function () {
    // Select all table cells with specific classes
    const leaderCells = document.querySelectorAll('.leaderCheck');
    const monthCells = document.querySelectorAll('.monthCheck');
    const craneCells = document.querySelectorAll('.craneCheck');
    const hiddenCells = document.querySelectorAll('.craneHidden');

    // Combine all cells for alignment
    const allCells = [...leaderCells, ...monthCells, ...craneCells, ...hiddenCells];

    // Apply left alignment to each cell
    allCells.forEach(cell => {
        cell.style.textAlign = 'left'; // Align text to the left
    });

    // Function to fetch and update cell data
    function fetchDataAndUpdateCells(cells, queryParam) {
        cells.forEach(cell => {
            const paramValue = cell.getAttribute(`data-${queryParam}`);
            const area = cell.getAttribute('data-area');
            const line = cell.getAttribute('data-line');

            // Fetch data for each cell
            fetch(`verifReport.php?${queryParam}=${encodeURIComponent(paramValue)}&area=${encodeURIComponent(area)}&line=${encodeURIComponent(line)}`)
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    if (data.message === 'Form tidak terisi') {
                        // Show "Form tidak terisi" if no data
                        cell.innerHTML = `<span style="color: grey;">Form tidak terisi</span>`;
                    } else {
                        // Display only existing names
                        const verifikasiNames = [];
                        for (let i = 1; i <= 4; i++) {
                            const key = `verifikasi_name_${i}`;
                            if (data[0]?.[key]) {
                                verifikasiNames.push(`${i}. ${data[0][key]}`);
                            }
                        }
                        // Join names with `<br>` for line breaks
                        cell.innerHTML = verifikasiNames.join('<br>');
                    }
                })
                .catch(error => {
                    console.error(`Error fetching data for ${queryParam}=${paramValue}, area=${area}:`, error);

                    // Populate with default placeholders on error
                    cell.innerHTML = `<span style="color: grey;">Error fetching data</span>`;
                });
        });
    }

    // Fetch data for leaderCells, monthCells, and craneCells
    fetchDataAndUpdateCells(leaderCells, 'tanggal');
    fetchDataAndUpdateCells(monthCells, 'bulan');
    fetchDataAndUpdateCells(craneCells, 'tanggal');
    fetchDataAndUpdateCells(hiddenCells, 'tanggal');
});

window.onload = function () {
    const badge = document.getElementById("newBadge");
    const button = document.getElementById("legendBtn");

    // Show tooltip
    const tooltip = document.createElement("div");
    tooltip.id = "tooltip";
    tooltip.innerText = "Klik disini untuk melihat weekly/monthly check";
    tooltip.style.cssText = `
        position: absolute;
        top: -35px;
        left: 50%;
        transform: translateX(-35%);
        background: #000;
        color: #fff;
        padding: 5px 10px;
        font-size: 12px;
        border-radius: 5px;
        white-space: nowrap;
        z-index: 4;
    `;
    button.style.position = "relative"; // Ensure relative positioning for the tooltip
    button.appendChild(tooltip);

    // Remove badge and tooltip on click
    button.addEventListener("click", () => {
        badge.style.display = "none";
        tooltip.remove();
    });

    // Auto-remove tooltip after 5 seconds
    setTimeout(() => {
        tooltip.remove();
    }, 5000);
};

</script>
