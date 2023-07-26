<?php

namespace Tests\Unit;

use App\Domain\Pessoa\Cpf;
use PHPUnit\Framework\TestCase;

class CpfTest extends TestCase
{
    
    public function test_cpf_valido(): void
    {
        $cpf = '353.705.190-56';
        $cpfTestado = new Cpf($cpf);
        $this->assertEquals($cpf, $cpfTestado);
    }

    public function test_cpf_invalido(): void
    {
        $cpf = '353.705.190-50';
        $cpfTestado = new Cpf($cpf);
        $this->assertNotEquals($cpf, $cpfTestado);
    }
}
