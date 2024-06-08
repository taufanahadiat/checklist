<?php
$options = array(
    'hfo' => 'HFO',
    'lfo' => 'LFO'
);

foreach ($options as $value => $label) {
    echo "<option value=\"$value\">$label</option>";
}
?>
</select>
<?php
return null;
?>