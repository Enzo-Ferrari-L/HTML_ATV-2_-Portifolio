# HTML_ATV-2_-Portifolio

##  Sobre o projeto

Este projeto foi desenvolvido como parte de uma atividade prática de **PHP e MySQL**.

O objetivo é criar um sistema simples para cadastrar produtos em um banco de dados, utilizando um formulário em PHP e realizando validações antes da inserção.

##  Objetivos

- Criar a tabela `produtos` no banco de dados MySQL.
- Criar um formulário para cadastrar produtos.
- Solicitar o **Nome do Produto** e o **Preço**.
- Validar os dados antes de realizar a inserção.
- Exibir mensagens de sucesso ou erro.

##  Tecnologias utilizadas

-  PHP
-  MySQL
-  HTML
-  Visual Studio Code
-  XAMPP

##  Funcionamento

O sistema possui um formulário com os seguintes campos:

- **Nome do Produto**
- **Preço**

Antes de cadastrar o produto, o sistema verifica:

1. Se o nome do produto não está vazio.
2. Se o preço é um número.
3. Se o preço é maior que zero.

### ✅ Cadastro válido

Quando os dados estão corretos, o produto é inserido no banco de dados e uma mensagem de sucesso é exibida:

> Produto cadastrado com sucesso!

### ❌ Cadastro inválido

Caso algum dado esteja incorreto, o sistema exibe uma mensagem de erro.

Exemplo:

> Erro: O preço deve ser um número positivo.
