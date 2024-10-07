<?php
                        $indicator = 0; // Default to FALSE
                        $lt = 1.02;
                        $ut = 0.98;

                        if (isset($existing_record) && isset($existing_record[$field_name])) {
                            $std = $existing_record[$field_name];
                        } elseif (isset($article_1) && isset($article_1[$field_name])) {
                            $std = $article_1[$field_name];
                        } elseif (isset($article_2) && isset($article_2[$field_name])) {
                            $std = $article_2[$field_name];
                        } elseif (isset($article_3) && isset($article_3[$field_name])) {
                            $std = $article_3[$field_name];
                        }
                        
                        if ((isset($existing_record) && isset($existing_record[$field_name])) || (isset($article_1) && isset($article_1[$field_name])) || (isset($article_2) && isset($article_2[$field_name])) || (isset($article_3) && isset($article_3[$field_name]))) {
                            if ($measurement[3] === 'kebocoran_oil1_' && !($std == 'TA')) {
                                $indicator = 2;
                            }
                            if ($measurement[3] === 'kebocoran_oil2_' && !($std == 'TA')) {
                                $indicator = 2;
                            }

                            if ($measurement[3] === 'kebocoran_oil3_' && !($std == 'TA')) {
                                $indicator = 2;
                            }
                            if ($measurement[3] === 'inlet_pressure_' && !($std >= 3.0 && $std <= 3.0)) {
                                $indicator = 2;
                            } else if ($measurement[3] === 'inlet_pressure_' && (($std >= 3.0 && $std <= 3.0*$lt+0.3) ||($std >= 3.0*$ut-0.3 && $std <= 3.0))){
                                $indicator = 1;
                            }

                            if ($measurement[3] === 'heater_temp_tank1_' && !($std >= 70 && $std <= 90)) {
                                $indicator = 2;
                            } else if ($measurement[3] === 'heater_temp_tank1_' && ($std >= 70 && $std <= 70*$lt ||$std >= 90*$ut && $std <= 90)){
                                $indicator = 1;
                            }

                            if ($measurement[3] === 'heater_temp_tank2_' && !($std >= 70 && $std <= 90)) {
                                $indicator = 2;
                            } else if ($measurement[3] === 'heater_temp_tank2_' && ($std >= 70 && $std <= 70*$lt ||$std >= 90*$ut && $std <= 90)){
                                $indicator = 1;
                            }

                            if ($measurement[3] === 'oil_temp_supply_' && !($std >= 60 && $std <= 90)) {
                                $indicator = 2;
                            } else if ($measurement[3] === 'oil_temp_supply_' && ($std >= 60 && $std <= 60*$lt ||$std >= 90*$ut && $std <= 90)){
                                $indicator = 1;
                            }

                            if ($measurement[3] === 'oil_temp_return_' && !($std >= 50 && $std <= 80)) {
                                $indicator = 2;
                            } else if ($measurement[3] === 'oil_temp_return_' && ($std >= 50 && $std <= 50*$lt ||$std >= 80*$ut && $std <= 80)){
                                $indicator = 1;
                            }

                            if ($measurement[3] === 'hfo_outlet_temp_' && !($std >= 60 && $std <= 90)) {
                                $indicator = 2;
                            } else if ($measurement[3] === 'hfo_outlet_temp_' && ($std >= 60 && $std <= 60*$lt ||$std >= 90*$ut && $std <= 90)){
                                $indicator = 1;
                            }

                            if ($measurement[3] === 'hfo_tank_temp_' && !($std >= 60 && $std <= 90)) {
                                $indicator = 2;
                            } else if ($measurement[3] === 'hfo_tank_temp_' && ($std >= 60 && $std <= 60*$lt ||$std >= 90*$ut && $std <= 90)){
                                $indicator = 1;
                            }
                
                        }
                        // Set the style based on the indicator
                        $style = "";
                        if ($indicator === 2) {
                            $style = "style='color: red;'";//red
                        } elseif ($indicator === 1) {
                            $style = "style='color: #FFBF00'";//yellow

                        }
?>