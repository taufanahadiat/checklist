<?php
$options = array(
    'AUTO' => 'AUTO',
    'MANUAL' => 'MANUAL',
);

foreach ($options as $value => $label) {
    echo "<option value=\"$value\">$label</option>";
}
?>
</select>
<?php
return null;
?>