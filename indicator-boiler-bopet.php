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
                            if ($field === 'oiltemp_inlet' && !($std >= 290 && $std <= 300)){
                                $indicator = 1;
                            } else if($field === 'oiltemp_inlet' && (($std >= 290 && $std <= 290*$lt) ||($std >= 300*$ut && $std <= 300))){
                                $indicator = 2;
                            }                  

                            if ($line == 'bopet-b'){
                                if ($field === 'oiltemp_outlet' && !($std >= 303 && $std <= 313)){
                                    $indicator = 1;
                                } else if($field === 'oiltemp_outlet' && (($std >= 303 && $std <= 303*$lt) ||($std >= 313*$ut && $std <= 313))){
                                    $indicator = 2;
                                }    

                                if ($field === 'oiltemp_setpoint' && !($std >= 303 && $std <= 313)){
                                    $indicator = 1;
                                } else if($field === 'oiltemp_setpoint' && (($std >= 303 && $std <= 303*$lt) ||($std >= 313*$ut && $std <= 313))){
                                    $indicator = 2;
                                }    

                                if ($field === 'loadburner' && !($std >= 20 && $std <= 70)){
                                    $indicator = 1;
                                } else if($field === 'loadburner' && (($std >= 20 && $std <= 20*$lt) ||($std >= 70*$ut && $std <= 70))){
                                    $indicator = 2;
                                }    
                            }else{
                                if ($field === 'oiltemp_outlet' && !($std >= 300 && $std <= 310)){
                                    $indicator = 1;
                                } else if($field === 'oiltemp_outlet' && (($std >= 300 && $std <= 300*$lt) ||($std >= 310*$ut && $std <= 310))){
                                    $indicator = 2;
                                }    

                                if ($field === 'oiltemp_setpoint' && !($std >= 300 && $std <= 310)){
                                    $indicator = 1;
                                } else if($field === 'oiltemp_setpoint' && (($std >= 300 && $std <= 300*$lt) ||($std >= 310*$ut && $std <= 310))){
                                    $indicator = 2;
                                }    

                                if ($field === 'loadburner' && !($std >= 30 && $std <= 55)){
                                    $indicator = 1;
                                } else if($field === 'loadburner' && (($std >= 30 && $std <= 30*$lt) ||($std >= 55*$ut && $std <= 55))){
                                    $indicator = 2;
                                }    
                            }


                            if ($field === 'chimney_temp' && !($std <= 400)){
                                $indicator = 1;
                            } else if($field === 'chimney_temp' && (($std <= 400 && $std >= (400-10)))){
                                $indicator = 2; 
                            } 


                            if ($field === 'press_suctionpump' && !($std >= 1 && $std <= 2)){
                                $indicator = 1;
                            }  else if($field === 'press_suctionpump' && (($std >= 1 && $std <= 1*$lt) || ($std >= 2*$ut && $std <= 2))){
                                $indicator = 2;
                            }

                            if ($line == 'bopet-a'){
                                if ($field === 'press_discpump' && !($std >= 5 && $std <= 7)){
                                    $indicator = 1;
                                } else if($field === 'press_discpump' && (($std >= 5 && $std <= 5*$lt) || ($std >= 7*$ut && $std <= 7))){
                                    $indicator = 2;
                                }
                            } else {
                                if ($field === 'press_discpump' && !($std >= 5.5 && $std <= 7)){
                                    $indicator = 1;
                                } else if($field === 'press_discpump' && (($std >= 5.5 && $std <= 5.5*$lt) || ($std >= 7*$ut && $std <= 7))){
                                    $indicator = 2;
                                }
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