<?php
$options = array(
    'RUN' => 'RUNNING',
    'SBY' => 'STANDBY',
    'U/L' => 'UNLOAD',
    'ST' => 'STOP',
    'B/D' => 'BREAKDOWN'
);

foreach ($options as $value => $label) {
    echo "<option value=\"$value\">$label</option>";
}
?>
</select>
<?php
return null;
?>