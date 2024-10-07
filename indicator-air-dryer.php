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
                                                        
                            if ($index === 1 && !($std >= 2 && $std <= 10)) {
                                $indicator = 2;
                            } else if ($index === 1 && (($std >= 2 && $std <= 2*$lt+1) ||($std >= 10*$ut-1 && $std <= 10))){
                                $indicator = 1;
                            }

                            if ($index === 2 && !($std >= 4 && $std <= 10)) {
                                $indicator = 2;
                            } else if ($index === 2 && ($std >= 4 && $std <= 4*$lt+1 ||$std >= 10*$ut-1 && $std <= 10)){
                                $indicator = 1;
                            }
                            
                            if ($index === 3 && !($std == 'HJ')) {
                                $indicator = 2;
                            }
                            if ($index === 4 && !($std == 'HJ')) {
                                $indicator = 2;
                            }
                            if ($index === 5 && !($std == 'B')) {
                                $indicator = 2;
                            }
                            if ($index === 6 && ($std == 'T')) {
                                $indicator = 2;
                            }else if ($index === 6 && ($std == 'S')){
                                $indicator =1;
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