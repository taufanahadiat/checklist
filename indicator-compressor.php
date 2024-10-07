<?php
                        $indicator = 0; // Default to FALSE
                        $lt = 1.05;
                        $ut = 0.95;

                        if (isset($existing_record) && isset($existing_record[$fieldName])) {
                            $std = $existing_record[$fieldName];
                        } elseif (isset($article_1) && isset($article_1[$fieldName])) {
                            $std = $article_1[$fieldName];
                        } elseif (isset($article_2) && isset($article_2[$fieldName])) {
                            $std = $article_2[$fieldName];
                        } elseif (isset($article_3) && isset($article_3[$fieldName])) {
                            $std = $article_3[$fieldName];
                        }
                        
                        if ((isset($existing_record) && isset($existing_record[$fieldName])) || (isset($article_1) && isset($article_1[$fieldName])) || (isset($article_2) && isset($article_2[$fieldName])) || (isset($article_3) && isset($article_3[$fieldName]))) {
                            
                            if ($index === 1 && !($std >= 6.4 && $std <= 8)) {
                                $indicator = 2;
                            } else if ($index === 1 && ($std >= 6.4 && $std <= 6.4*$lt ||$std >= 8*$ut && $std <= 8)){
                                $indicator = 1;
                            }

                            if ($index === 2 && !($std >= 80 && $std <= 110)) {
                                $indicator = 2;
                            } else if ($index === 2 && ($std >= 80 && $std <= 80*$lt ||$std >= 110*$ut && $std <= 110)){
                                $indicator = 1;
                            }
                            
                            if ($index === 3 && !($std >= 0 && $std <= 0.8)) {
                                $indicator = 2;
                            } else if ($index === 3 && ($std >= 0 && $std <= 0.15||$std >= 0.7 && $std <= 0.8)){
                                $indicator = 1;
                            }

                            if ($index === 4 && ($std == '1/4')) {
                                $indicator = 2;
                            }
                            if ($index === 5 && !($std == 'H')) {
                                $indicator = 2;
                            }
                            if ($index === 6 && !($std == 'H')) {
                                $indicator = 2;
                            }

                            if ($index === 9 && !($std >= 5 && $std <= 15)) {
                                $indicator = 2;
                            } else if ($index === 9 && ($std >= 5 && $std <= 5*$lt || $std >= 15*$ut && $std <= 15)){
                                $indicator = 1;
                            }

                            if ($index === 10 && !($std >= 80 && $std <= 150)) {
                                $indicator = 2;
                            } else if ($index === 10 && ($std >= 80 && $std <= 80*$lt || $std >= 150*$ut && $std <= 150)){
                                $indicator = 1;
                            }

                            if ($index === 11 && !($std == 'TA')) {
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