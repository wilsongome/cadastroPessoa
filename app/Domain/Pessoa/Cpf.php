<?php
namespace App\Domain\Pessoa;

class Cpf{

    public string $cpf;

    public function __construct(string $cpf)
    {
        $this->cpf = $cpf;
        if(!$this->validar()){
            $this->cpf = '';
        }
    }

    private function sequenciaInvalida(string $cpfLimpo): bool
    {
        $lista_invalidos = [
            '11111111111',
            '22222222222',
            '33333333333',
            '44444444444',
            '55555555555',
            '66666666666',
            '77777777777',
            '88888888888',
            '99999999999',
        ];

        return in_array($cpfLimpo, $lista_invalidos);
    }

    private function estruturaInvalida(string $cpf):bool
    {
        $cpf_partes = explode(".", $cpf);
        if( count($cpf_partes) != 3 ){
            return true;
        }

        $cpf_partes = explode('-', $cpf_partes[2]);
        if(strlen($cpf_partes[1]) < 2){
            return true;
        }
        return false;
    }

    private function validar()
    {
        if($this->estruturaInvalida($this->cpf)){
            return false;
        }

        $cpf = preg_replace('/\D/', '', $this->cpf);

        if(strlen($cpf) != 11){
            return false;
        }

        if($this->sequenciaInvalida($cpf)){
            return false;
        }
        
        $baseNumerica = substr($cpf, 0, 9);
        $baseNumerica.= $this->calcularDigitoVerificador($baseNumerica);
        $baseNumerica.= $this->calcularDigitoVerificador($baseNumerica);

        if($baseNumerica != $cpf){
            return false;
        }

        return true;
    }

    private function calcularDigitoVerificador(string $baseNumerica): int
    {
        $quantidadeCaracteres     = strlen($baseNumerica);
        $multiplicador  = $quantidadeCaracteres + 1;
        $resultadoSoma  = 0;

        for($i = 0; $i < $quantidadeCaracteres; $i++){
            $resultadoSoma += ($baseNumerica[$i] * $multiplicador);
            $multiplicador--;
        }

        $mod = $resultadoSoma % 11;

        if($mod < 1){
            return 0;
        }

        return (11 - $mod);
    }

    public function __toString(): string
    {
        return $this->cpf;
    }

}

?>