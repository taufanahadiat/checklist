<?php
$options = array(
    'RUNNING' => 'RUNNING',
    'STANDBY' => 'STANDBY',
    'UNLOAD' => 'UNLOAD',
    'STOP' => 'STOP',
    'BREAKDOWN' => 'BREAKDOWN'
);

foreach ($options as $value => $label) {
    echo "<option value=\"$value\">$label</option>";
}
?>
</select>
<?php
return null;
?>