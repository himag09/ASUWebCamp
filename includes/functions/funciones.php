<?php   
// &= es paso por referencia
    function productos_json(&$boletos, &$camisas = 0, &$etiquetas = 0){
        $dias = array(0 => 'un_dia', 1 => 'pase_completo', 2 => 'pase_2dias');
        unset($boletos['un_dia']['precio']);
        unset($boletos['completo']['precio']);
        unset($boletos['2dias']['precio']);
        //crear array de dias con boletos
        $total_boletos = array_combine($dias, $boletos);
        // $json = array();
        // foreach($total_boletos as $key => $boletos ):
            //     // string a numero
            //     if ((int) $boletos > 0 ) {
                //         $json[$key] = (int) $boletos;
                //     }
                // endforeach;
                $camisas = (int) $camisas;
                if ($camisas > 0) {
                    $total_boletos['camisas'] = $camisas;
                }
                
                $etiquetas = (int) $etiquetas;
                if ($etiquetas > 0) {
                    $total_boletos['etiquetas'] = $etiquetas;
                }
                
                
                return json_encode($total_boletos);
                
    }
    function eventos_json(&$eventos){
        $eventos_json = array();
        foreach($eventos as $evento):
            // se coloca otros corchetes vacios para que imprima más de uno
            $eventos_json['eventos'][] = $evento;
        endforeach;
        return json_encode($eventos_json);
    }

?>