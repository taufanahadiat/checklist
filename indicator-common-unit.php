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
                            
                            if ($measurement[3] === 'dc_system_volt_' && !($std >= 110 && $std <= 125)) {
                                $indicator = 2;
                            } else if ($measurement[3] === 'dc_system_volt_' && (($std >= 110 && $std <= 110*$lt) ||($std >= 125*$ut && $std <= 125))){
                                $indicator = 1;
                            }

                            if ($measurement[3] === 'lv_switchgear_' && !($std >= 380 && $std <= 410)) {
                                $indicator = 2;
                            } else if ($measurement[3] === 'lv_switchgear_' && ($std >= 380 && $std <= 380*$lt ||$std >= 410*$ut && $std <= 410)){
                                $indicator = 1;
                            }

                            if ($measurement[3] === 'start_air_press1_' && !($std >= 20 && $std <= 30)) {
                                $indicator = 2;
                            } else if ($measurement[3] === 'start_air_press1_' && ($std >= 20 && $std <= 20*$lt+2 ||$std >= 30*$ut-2 && $std <= 30)){
                                $indicator = 1;
                            }

                            if ($measurement[3] === 'start_air_press1_' && !($std >= 20 && $std <= 30)) {
                                $indicator = 2;
                            } else if ($measurement[3] === 'start_air_press1_' && ($std >= 20 && $std <= 20*$lt+2 ||$std >= 30*$ut-2 && $std <= 30)){
                                $indicator = 1;
                            }
                            
                            if ($measurement[3] === 'kebocoran_oil1_' && !($std == 'TA')) {
                                $indicator = 2;
                            }
                            if ($measurement[3] === 'kebocoran_oil2_' && !($std == 'TA')) {
                                $indicator = 2;
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