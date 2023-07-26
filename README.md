<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## A aplicação

Essa é uma aplicação simples para cadastro de pessoas. Ela contém um CRUD completo, e também implementa uma API para realização do cadastro.

### API

**POST**
http://localhost/api/cadastro<br />
Recebe um Json como parâmetro no corpo da requisição:
```
{
    "cpf": "xxx.xxx.xxx-xx",
    "email": "exemplo@gmail.com", 
    "data_nascimento": "06/05/1980",
    "nome": "Paulo", 
    "sobrenome": "Barbosa",
    "genero": "Masculino"
}
```
<br />

Retorna 201, e um JSON em caso de sucesso.<br />

Em caso de falha, vai retornar o código de erro e um JSON contendo a mensagem de erro

### Frontend
O Frontend da aplicação está feito com o próprio Laravel, utilizando as views/blades. <br />
As páginas podem ser acessadas através do MENU principal [PESSOAS]. O GRID de pessoas será paginado em 10.