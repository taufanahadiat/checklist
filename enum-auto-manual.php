<?php
$options = array(
    'auto' => 'Auto',
    'manual' => 'Manua',
);

foreach ($options as $value => $label) {
    echo "<option value=\"$value\">$label</option>";
}
?>
</select>
<?php
return null;
?>