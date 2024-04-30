<?php
$options = array(
    'on' => 'On',
    'off' => 'Off'
);

foreach ($options as $value => $label) {
    echo "<option value=\"$value\">$label</option>";
}
?>
</select>
<?php
return null;
?>