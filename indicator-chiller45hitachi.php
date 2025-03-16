<?php
                        $indicator = 0; // Default to FALSE
                        $lt = 1.01;
                        $ut = 0.99;



                        if (isset($_GET['selectedDate']) && isset($article_hitachi_1) && isset($article_hitachi_1[$inputName])) {
                            $std = $article_hitachi_1[$inputName];
                        } elseif (isset($_GET['selectedDate']) && isset($article_hitachi_2) && isset($article_hitachi_2[$inputName])) {
                            $std = $article_hitachi_2[$inputName];
                        } elseif (isset($_GET['selectedDate']) && isset($article_hitachi_3) && isset($article_hitachi_3[$inputName])) {
                            $std = $article_hitachi_3[$inputName];
                        } elseif (isset($existing_record) && isset($existing_record[$inputName])){
                            $std = $existing_record[$inputName];
                        }
                        
                        if ((isset($existing_record) && isset($existing_record[$inputName])) || (isset($article_hitachi_1) && isset($article_hitachi_1[$inputName])) || (isset($article_hitachi_2) && isset($article_hitachi_2[$inputName])) || (isset($article_hitachi_3) && isset($article_hitachi_3[$inputName]))) {
                                                        
                            if ($field === 'disc_press' && !($std <= 2.45)){
                                $indicator = 1;
                            } else if($field === 'disc_press' && (($std >= 2.2 && $std <= 2.45))){
                                $indicator = 2;
                            }                  

                            if ($field === 'evap_tempcel' && !($std <= 20)){
                                $indicator = 1;
                            } else if($field === 'evap_tempcel' && (($std >= 18 && $std <= 20))){
                                $indicator = 2;
                            }                  

                            if ($field === 'evap_tempcol' && !($std >= 5 && $std <= 13)){
                                $indicator = 1;
                            } else if($field === 'evap_tempcol' && (($std >= 5 && $std <= 5*$lt) ||($std >= 13*$ut && $std <= 13))){
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

                            if ($field === 'evap_pressin' && !($std >= 3 && $std <= 5)){
                                $indicator = 1;
                            } else if($field === 'evap_pressin' && (($std >= 3 && $std <= 3*1.05) ||($std >= 5*0.95 && $std <= 5))){
                                $indicator = 2;
                            }  

                            if ($field === 'evap_pressout' && !($std >= 2.5 && $std <= 4.5)){
                                $indicator = 1;
                            } else if($field === 'evap_pressout' && (($std >= 2.5 && $std <= 2.5*1.05) ||($std >= 4.5*0.95 && $std <= 4.5))){
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

                            if ($field === 'temp_set' && !($std >= 5 && $std <= 10)){
                                $indicator = 1;
                            } else if($field === 'temp_set' && (($std >= 5 && $std <= 5*$lt) ||($std >= 10*$ut && $std <= 10))){
                                $indicator = 2;
                            }    

                            if ($field === 'onoff_diff' && !($std >= 1 && $std <= 2)){
                                $indicator = 1;
                            } else if($field === 'onoff_diff' && (($std >= 1 && $std <= 1*$lt) ||($std >= 2*$ut && $std <= 2))){
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