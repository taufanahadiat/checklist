<?php
                        $indicator = 0; // Default to FALSE
                        $lt = 1.02;
                        $ut = 0.98;
                        
                        if (isset($_GET['selectedDate'])) {
                            $std = $article[$field_key];
                        } elseif (isset($existing_record) && isset($existing_record[$field_key])) {
                            $std = $existing_record[$field_key];
                        } 
                        
                        if ((!isset($_GET['selectedDate']) && isset($existing_record) && isset($existing_record[$field_key]))) {
                            if ($field_name === 'kebocoran_fuel' && !($std == 'TA')) {
                                $indicator = 2;
                            }
                            if ($field_name === 'kebocoran_oil' && !($std == 'TA')) {
                                $indicator = 2;
                            }
                            if ($field_name === 'lube_oil_sump_lvl' && !($std >= 14 && $std <= 17)) {
                                $indicator = 2;
                            } else if ($field_name === 'lube_oil_sump_lvl' && (($std >= 14 && $std <= 14*$lt) ||($std >= 17*$ut && $std <= 17))){
                                $indicator = 1;
                            }

                            if ($field_name === 'prelube_pump_press' && !($std >= 0.6)) {
                                $indicator = 2;
                            } else if ($field_name === 'prelube_pump_press' && ($std >= 0.5 && $std <= 50*$lt)){
                                $indicator = 1;
                            }

                            if ($field_name === 'ht_water_outlet_temp' && !($std > 50)) {
                                $indicator = 2;
                            } else if ($field_name === 'ht_water_outlet_temp' && ($std >= 50 && $std <= 50*$lt+2)){
                                $indicator = 1;
                            }

                            if ($field_name === 'ht_expantion_tank_lvl' && !($std >= 50 && $std <= 95)) {
                                $indicator = 2;
                            } else if ($field_name === 'ht_expantion_tank_lvl' && (($std >= 50 && $std <= 50*$lt+2) ||($std >= 95*$ut-2 && $std <= 95))){
                                $indicator = 1;
                            }

                            if ($field_name === 'lt_expantion_tank_lvl' && !($std >= 50 && $std <= 95)) {
                                $indicator = 2;
                            } else if ($field_name === 'lt_expantion_tank_lvl' && (($std >= 50 && $std <= 50*$lt+2) ||($std >= 95*$ut-2 && $std <= 95))){
                                $indicator = 1;
                            }

                            if ($field_name === 'fuel_oil_inlet_pressure' && !($std >= 4.0 && $std <= 7.0)) {
                                $indicator = 2;
                            } else if ($field_name === 'fuel_oil_inlet_pressure' && (($std >= 4.0 && $std <= 4.0*$lt+0.2) ||($std >= 7.0*$ut-0.2 && $std <= 7.0))){
                                $indicator = 1;
                            }
                        }

                        if (isset($_GET['selectedDate']) && (isset($article) && isset($article[$field_key]))) {
                            if (isset($t) && $field_key === "kebocoran_fuel_$t" && !($std == 'TA')) {
                                $indicator = 2;
                            }
                            if (isset($t) && $field_key === "kebocoran_oil_$t" && !($std == 'TA')) {
                                $indicator = 2;
                            }
                            if (isset($range) && $field_key === "lube_oil_sump_lvl_$range" && !($std >= 14 && $std <= 17)) {
                                $indicator = 2;
                            } else if ($field_key === "lube_oil_sump_lvl_$range" && (($std >= 14 && $std <= 14*$lt) ||($std >= 17*$ut && $std <= 17))){
                                $indicator = 1;
                            }

                            if ($field_key === 'prelube_pump_press' && !($std >= 0.6)) {
                                $indicator = 2;
                            } else if ($field_key === 'prelube_pump_press' && ($std >= 0.5 && $std <= 50*$lt)){
                                $indicator = 1;
                            }

                            if ($field_key === 'ht_water_outlet_temp' && !($std > 50)) {
                                $indicator = 2;
                            } else if ($field_key === 'ht_water_outlet_temp' && ($std >= 50 && $std <= 50*$lt+2)){
                                $indicator = 1;
                            }

                            if ($field_key === 'ht_expantion_tank_lvl' && !($std >= 50 && $std <= 95)) {
                                $indicator = 2;
                            } else if ($field_key === 'ht_expantion_tank_lvl' && (($std >= 50 && $std <= 50*$lt+2) ||($std >= 95*$ut-2 && $std <= 95))){
                                $indicator = 1;
                            }

                            if ($field_key === 'lt_expantion_tank_lvl' && !($std >= 50 && $std <= 95)) {
                                $indicator = 2;
                            } else if ($field_key === 'lt_expantion_tank_lvl' && (($std >= 50 && $std <= 50*$lt+2) ||($std >= 95*$ut-2 && $std <= 95))){
                                $indicator = 1;
                            }

                            if ($field_key === 'fuel_oil_inlet_pressure' && !($std >= 4.0 && $std <= 7.0)) {
                                $indicator = 2;
                            } else if ($field_key === 'fuel_oil_inlet_pressure' && (($std >= 4.0 && $std <= 4.0*$lt+0.2) ||($std >= 7.0*$ut-0.2 && $std <= 7.0))){
                                $indicator = 1;
                            }
                
                        }
                        // Set the style based on the indicator
                        $style = "";
                        if ($indicator == 2) {
                            $style = "style='color: red;'";//red
                        } elseif ($indicator == 1) {
                            $style = "style='color: #FFBF00'";//yellow

                        }
?>