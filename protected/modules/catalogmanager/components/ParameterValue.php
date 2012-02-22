<?php

class ParameterValue {

    static public function getNewParameterModel($work_id, $type_id, $number_id) {

        if (in_array($work_id, array(1, 3))) {

            if (in_array($number_id, array(2, 3))) {
                switch ($type_id) {
                    case in_array($type_id, array(1, 2)): {
                              $model = new ValueSelectable();
                              break;
                        }
                    case 3: {
                             $model = new ValueBoolean();
                             break;
                        }
                }
            } else {
                switch ($type_id) {
                    case 1: {
                            $model = new ValueLiteral();
                             break;
                        }
                    case 2: {
                             $model = new ValueNumeric();
                              break;
                        }
                }
            }
            return $model;
        } else {
            return false;
        }
    }

}

