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

    private function validar()
    {
        $cpf = preg_replace('/\D/', '', $this->cpf);

        if(strlen($cpf) != 11){
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