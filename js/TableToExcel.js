// Fungsi untuk mengekspor tabel HTML ke Excel dengan ExcelJS
function exportTableToExcel(tableID,filename) {
  var table = document.getElementById(tableID);
  var workbook = new ExcelJS.Workbook();
  var worksheet = workbook.addWorksheet("Sheet1");

  // Loop untuk setiap baris tabel HTML
  for (var i = 0; i < table.rows.length; i++) {
      var row = table.rows[i];
      var excelRow = worksheet.addRow([]);

      // Loop untuk setiap sel dalam baris
      for (var j = 0; j < row.cells.length; j++) {
          var cell = row.cells[j];

          // Tentukan nilai sel
          var excelCell = excelRow.getCell(j + 1);
          excelCell.value = cell.innerText;

          // Dapatkan style dari HTML dan terapkan ke ExcelJS
          var bgColor = getCellBackgroundColor(cell);
          var textColor = getCellTextColor(cell);

          // Terapkan style ke cell ExcelJS
          excelCell.fill = {
              type: 'pattern',
              pattern: 'solid',
              fgColor: { argb: bgColor }
          };
          excelCell.font = {
              color: { argb: textColor }
          };
          excelCell.border = {
              top: { style: 'thin' },
              left: { style: 'thin' },
              bottom: { style: 'thin' },
              right: { style: 'thin' }
          };
      }
  }

  // Simpan file Excel menggunakan FileSaver.js
  workbook.xlsx.writeBuffer().then(function(buffer) {
      var blob = new Blob([buffer], { type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" });
      saveAs(blob, filename + ".xlsx");
  });
}

// Fungsi untuk mendapatkan warna background dari sel HTML
function getCellBackgroundColor(cell) {
  var bgColor = window.getComputedStyle(cell, null).getPropertyValue("background-color");
  return rgbToHex(bgColor);
}

// Fungsi untuk mendapatkan warna teks dari sel HTML
function getCellTextColor(cell) {
  var textColor = window.getComputedStyle(cell, null).getPropertyValue("color");
  return rgbToHex(textColor);
}

// Fungsi untuk mengonversi RGB ke Hex untuk warna ExcelJS
function rgbToHex(rgb) {
  var result = /^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/.exec(rgb);
  if (result) {
      return ((1 << 24) + (parseInt(result[1]) << 16) + (parseInt(result[2]) << 8) + parseInt(result[3])).toString(16).slice(1).toUpperCase();
  }
  return "FFFFFFFF"; // Default warna putih jika tidak ada
}