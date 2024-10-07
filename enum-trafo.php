<?php
$options = array(
    'Full' => 'Full',
    'Medium' => 'Medium',
    'Low' => 'Low'
);

foreach ($options as $value => $label) {
    echo "<option value=\"$value\">$label</option>";
}
?>
</select>
<?php
return null;
?>