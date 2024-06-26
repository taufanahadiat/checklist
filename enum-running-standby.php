<?php
$options = array(
    'running' => 'RUNNING',
    'standby' => 'STANDBY',
    'unload' => 'UNLOAD'
);

foreach ($options as $value => $label) {
    echo "<option value=\"$value\">$label</option>";
}
?>
</select>
<?php
return null;
?>