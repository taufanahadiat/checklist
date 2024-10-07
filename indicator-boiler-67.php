<?php
                        $indicator = 0; // Default to FALSE
                        $lt = 1.01;
                        $ut = 0.99;

                        if (isset($existing_record) && isset($existing_record[$fieldName])) {
                            $std = $existing_record[$fieldName];
                        } elseif (isset($article) && isset($article[$fieldName])) {
                            $std = $article[$fieldName];
                        }
                        if ((isset($existing_record) && isset($existing_record[$fieldName])) || (isset($article_1) && isset($article_1[$fieldName])) || (isset($article_2) && isset($article_2[$fieldName])) || (isset($article_3) && isset($article_3[$fieldName])) || isset($article) && isset($article[$fieldName])) {
                            if ($field === 'oiltemp_inlet' && !($std >= 241 && $std <= 251)){
                                $indicator = 1;
                            } else if($field === 'oiltemp_inlet' && (($std >= 241 && $std <= 241*$lt) ||($std >= 251*$ut && $std <= 251))){
                                $indicator = 2;
                            }                  

                            if ($field === 'oiltemp_outlet' && !($std >= 255 && $std <= 265)){
                                $indicator = 1;
                            } else if($field === 'oiltemp_outlet' && (($std >= 255 && $std <= 255*$lt) ||($std >= 265*$ut && $std <= 265))){
                                $indicator = 2;
                            }

                            if ($field === 'oiltemp_setpoint' && !($std >= 255 && $std <= 265)){
                                $indicator = 1;
                            } else if($field === 'oiltemp_setpoint' && (($std >= 255 && $std <= 255*$lt) ||($std >= 265*$ut && $std <= 265))){
                                $indicator = 2;
                            }    

                            if ($field === 'flameburner' && !($std >= 70)){
                                $indicator = 1;
                            } else if($field === 'flameburner' && (($std >= 70 && $std <= (70+((100-70)*0.1))))){
                                $indicator = 2; 
                            } 

                            if ($field === 'loadburner' && !($std >= 10 && $std <= 60)){
                                $indicator = 1;
                            } else if($field === 'loadburner' && (($std >= 10 && $std <= 10*$lt) ||($std >= 60*$ut && $std <= 60))){
                                $indicator = 2;
                            }

                            if ($field === 'press_suctionpump' && !($std >= 0.1)){
                                $indicator = 1;
                            } else if($field === 'press_suctionpump' && (($std >= 0.1 && $std <= 0.2))){
                                $indicator = 2;
                            }

                            if ($field === 'press_discpump' && !($std >= 4 && $std <= 7)){
                                $indicator = 1;
                            } else if($field === 'press_discpump' && (($std >= 4 && $std <= 4*$lt) || ($std >= 7*$ut && $std <= 7))){
                                $indicator = 2;
                            }

                            if ($field === 'counter_press' && !($std >= 10 && $std <= 500)){
                                $indicator = 1;
                            } else if($field === 'counter_press' && (($std >= 10 && $std <= 10*$lt) ||($std >= 500*$ut && $std <= 500))){
                                $indicator = 2;
                            }

                            if ($field === 'difpress_d1' && !($std >= 0.1 && $std <= 0.6)){
                                $indicator = 1;
                            } else if($field === 'difpress_d1' && (($std >= 0.1 && $std <= 0.1*$lt) ||($std >= 0.6*$ut && $std <= 0.6))){
                                $indicator = 2;
                            }

                            if ($field === 'difpress_d2' && !($std >= 0.1 && $std <= 0.6)){
                                $indicator = 1;
                            } else if($field === 'difpress_d2' && (($std >= 0.1 && $std <= 0.1*$lt) ||($std >= 0.6*$ut && $std <= 0.6))){
                                $indicator = 2;
                            }

                            if (($field === 'lvl_exp' || $field === 'lvl_storage') && !($std >= 35 && $std <= 65)){
                                $indicator = 1;
                            } else if(($field === 'lvl_exp' || $field === 'lvl_storage') && (($std >= 35 && $std <= 35*$lt) ||($std >= 65*$ut && $std <= 65))){
                                $indicator = 2;
                            }

                            if ($field === 'rembes_pompa' && !($std == 'K')) {
                                $indicator = 2;
                            }
                            if ($field === 'rembes_pipa' && !($std == 'K')) {
                                $indicator = 2;
                            }
                        }
                        // Set the style based on the indicator
                        $style = "";
                        if ($indicator === 1) {
                            $style = "style='color: red;'";//red
                        } elseif ($indicator === 2) {
                            $style = "style='color: #FFBF00;'";//yellow

                        }
?>