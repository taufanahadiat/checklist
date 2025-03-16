<?php
                        $indicator = 0; // Default to FALSE
                        $lt = 1.01;
                        $ut = 0.99;
                        $inputName = strtolower(str_replace(' ', '', $unit)) . '_' . $field; 

                        if (isset($_GET['selectedDate']) && isset($article_trane_1) && isset($article_trane_1[$inputName])) {
                            $std = $article_trane_1[$inputName];
                        } elseif (isset($_GET['selectedDate']) && isset($article_trane_2) && isset($article_trane_2[$inputName])) {
                            $std = $article_trane_2[$inputName];
                        } elseif (isset($_GET['selectedDate']) && isset($article_trane_3) && isset($article_trane_3[$inputName])) {
                            $std = $article_trane_3[$inputName];
                        } elseif (isset($existing_record) && isset($existing_record[$inputName])){
                            $std = $existing_record[$inputName];
                        }
                        
                        if ((isset($existing_record) && isset($existing_record[$inputName])) || (isset($article_trane_1) && isset($article_trane_1[$inputName])) || (isset($article_trane_2) && isset($article_trane_2[$inputName])) || (isset($article_trane_3) && isset($article_trane_3[$inputName]))) {
                                                        
                            if ($field === 'evap_tempcel' && !($std <= 20)){
                                $indicator = 1;
                            } else if($field === 'evap_tempcel' && (($std >= 18 && $std <= 20))){
                                $indicator = 2;
                            }                  

                            if ($field === 'evap_tempcol' && !($std >= 6 && $std <= 13)){
                                $indicator = 1;
                            } else if($field === 'evap_tempcol' && (($std >= 6 && $std <= 6*$lt) ||($std >= 13*$ut && $std <= 13))){
                                $indicator = 2;
                            }

                            if ($field === 'cond_tempin' && !($std >= 27 && $std <= 37)){
                                $indicator = 1;
                            } else if($field === 'cond_tempin' && (($std >= 27 && $std <= 27*1.1) ||($std >= 37*0.95 && $std <= 37))){
                                $indicator = 2;
                            }  

                            if ($field === 'cond_tempout' && !($std >= 32 && $std <= 42)){
                                $indicator = 1;
                            } else if($field === 'cond_tempout' && (($std >= 32 && $std <= 32*1.03) ||($std >= 42*0.97 && $std <= 42))){
                                $indicator = 2;
                            }    

                            if ($field === 'evap_pressin' && !($std >= 4 && $std <= 7)){
                                $indicator = 1;
                            } else if($field === 'evap_pressin' && (($std >= 4 && $std <= 4*1.05) ||($std >= 7*0.95 && $std <= 7))){
                                $indicator = 2;
                            }  

                            if ($field === 'evap_pressout' && !($std >= 3.5 && $std <= 6)){
                                $indicator = 1;
                            } else if($field === 'evap_pressout' && (($std >= 3.5 && $std <= 3.5*1.05) ||($std >= 6*0.95 && $std <= 6))){
                                $indicator = 2;
                            }  

                            if ($field === 'cond_pressin' && !($std >= 1 && $std <= 3)){
                                $indicator = 1;
                            } else if($field === 'cond_pressin' && (($std >= 1 && $std <= 1*1.05) ||($std >= 3*0.95 && $std <= 3))){
                                $indicator = 2;
                            }                  

                            if ($field === 'cond_pressout' && !($std >= 0.5 && $std <= 2.5)){
                                $indicator = 1;
                            } else if($field === 'cond_pressout' && (($std >= 0.5 && $std <= 0.5*1.05) ||($std >= 2.5*0.95 && $std <= 2.5))){
                                $indicator = 2;
                            }                  

                            if ($field === 'temp_set' && !($std >= 6 && $std <= 10)){
                                $indicator = 1;
                            } else if($field === 'temp_set' && (($std >= 6 && $std <= 6*$lt) ||($std >= 10*$ut && $std <= 10))){
                                $indicator = 2;
                            }    

                            if ($field === 'rla' && !($std >= 60 && $std <= 100)){
                                $indicator = 1;
                            } else if($field === 'rla' && (($std >= 60 && $std <= 60*1.1) ||($std >= 100*0.95 && $std <= 100))){
                                $indicator = 2;
                            }    

                            if ($field === 'approach_temp' && !($std >= 0 && $std <= 7)){
                                $indicator = 1;
                            } else if($field === 'approach_temp' && (($std >= 0 && $std <= 0*$lt) ||($std >= 7*$ut && $std <= 7))){
                                $indicator = 2;
                            }    

                        }
                        // Set the style based on the indicator
                        $style = "";
                        if ($indicator == 1) {
                            $style = "style='color: red;'";//red
                        } elseif ($indicator == 2) {
                            $style = "style='color: #FFBF00'";//yellow
                        }
?>