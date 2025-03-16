<?php
                        $indicator = 0; // Default to FALSE
                        $lt = 1.05;
                        $ut = 0.95;

                        if (isset($_GET['selectedDate']) && isset($article_1) && isset($article_1[$fieldName])) {
                            $std = $article_1[$fieldName];
                        } elseif (isset($_GET['selectedDate']) && isset($article_2) && isset($article_2[$fieldName])) {
                            $std = $article_2[$fieldName];
                        } elseif (isset($_GET['selectedDate']) && isset($article_3) && isset($article_3[$fieldName])) {
                            $std = $article_3[$fieldName];
                        } elseif (isset($existing_record) && isset($existing_record[$fieldName])){
                            $std = $existing_record[$fieldName];
                        }
                        
                        if ((isset($existing_record) && isset($existing_record[$fieldName])) || (isset($article_1) && isset($article_1[$fieldName])) || (isset($article_2) && isset($article_2[$fieldName])) || (isset($article_3) && isset($article_3[$fieldName]))) {                            
                            if ($index === 0 && !($std >= 6.0 && $std <= 7.5)) {
                                $indicator = 2;
                            } else if ($index === 0 && ($std >= 6.0 && $std <= 6.0*$lt ||$std >= 7.5*$ut && $std <= 7.5)){
                                $indicator = 1;
                            }

                            if ($index === 1 && !($std == 'B')) {
                                $indicator = 2;
                            }
                            
                            if ($index === 2 && !($std == 'TA')) {
                                $indicator = 2;
                            }
                            if ($index === 3 && !($std == 'TA')) {
                                $indicator = 2;
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