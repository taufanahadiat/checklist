<?php
$options = array(
    'YES' => 'YES',
    'NO' => 'NO',
);

foreach ($options as $value => $label) {
    echo "<option value=\"$value\">$label</option>";
}
?>
</select>
<?php
return null;
?>