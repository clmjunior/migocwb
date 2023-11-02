<?php
class Functions {

    public function dateToTextConversor($date, $time = 0) {

        $diasSemana = array('Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb');

        $meses = array('', 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');

        $date = new DateTime($date);

        $diaSemana = $date->format('w');
        $dia = $date->format('j');
        $mes = $date->format('n');
        $ano = $date->format('Y');

        $textData = $diasSemana[$diaSemana] . ', ' . $dia . ' de ' . $meses[$mes] . ' de ' . $ano . ($time === 0 ? "" : ' às ' . $time);

        return $textData;
    }


    public function addressConversor($street = '', $number = '', $hood = '', $uf = '', $cep = '') {
        
        $addressComponents = array_filter([$street, $number, $hood, $uf, $cep]);
        $address = implode(' ', $addressComponents);
    
        if (!empty($number)) {
            $address = str_replace($number, $number . ',', $address);
        }
    
        return $address;
    }


    
}

