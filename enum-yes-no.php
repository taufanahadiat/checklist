<?php
$options = array(
    'yes' => 'Yes',
    'no' => 'No',
);

foreach ($options as $value => $label) {
    echo "<option value=\"$value\">$label</option>";
}
?>
</select>
<?php
return null;
?>