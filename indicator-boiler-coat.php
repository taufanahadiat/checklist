<?php
                        $indicator = 0; // Default to FALSE
                        $lt = 1.01;
                        $ut = 0.99;

                        if (isset($_GET['selectedDate'])) {
                            $std = $article[$fieldName];
                        } else{
                            $std = $existing_record[$fieldName];
                        }
                        if ((isset($existing_record) && isset($existing_record[$fieldName])) || (isset($article) && isset($article[$fieldName]))) {
                            if ($field === 'oiltemp_inlet' && !($std >= 210 && $std <= 230)){
                                $indicator = 1;
                            } else if($field === 'oiltemp_inlet' && (($std >= 210 && $std <= 210*$lt) ||($std >= 230*$ut && $std <= 230))){
                                $indicator = 2;
                            }                  

                            if ($field === 'oiltemp_outlet' && !($std >= 235 && $std <= 265)){
                                $indicator = 1;
                            } else if($field === 'oiltemp_outlet' && (($std >= 235 && $std <= 235*$lt) ||($std >= 265*$ut && $std <= 265))){
                                $indicator = 2;
                            }

                            if ($field === 'oiltemp_setpoint' && !($std >= 245 && $std <= 255)){
                                $indicator = 1;
                            } else if($field === 'oiltemp_setpoint' && (($std >= 245 && $std <= 245*$lt) ||($std >= 255*$ut && $std <= 255))){
                                $indicator = 2;
                            }    

                            if ($field === 'chimney_temp' && !($std <= 350)){
                                $indicator = 1;
                            } else if($field === 'chimney_temp' && (($std <= 350 && $std >= (350-10)))){
                                $indicator = 2; 
                            } 

                            if ($field === 'loadburner' && !($std >= 35 && $std <= 85)){
                                $indicator = 1;
                            } else if($field === 'loadburner' && (($std >= 35 && $std <= 35*$lt) ||($std >= 85*$ut && $std <= 85))){
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
                        if ($indicator == 1) {
                            $style = "style='color: red;'";//red
                        } elseif ($indicator == 2) {
                            $style = "style='color: #FFBF00;'";//yellow

                        }
?>