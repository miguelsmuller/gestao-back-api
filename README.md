# **Plataforma de Gestão Interna - RME**
> Plataforma de Gestão Interna - Plataforma de Gestão Interna - Plataforma de Gestão Interna - Plataforma de Gestão Interna - Plataforma de Gestão Interna - Plataforma de Gestão Interna - Plataforma de Gestão Interna - Plataforma de Gestão Interna - Plataforma de Gestão Interna - Plataforma de Gestão Interna - Plataforma de Gestão Interna - Plataforma de Gestão Interna

**Versão Estável:** 0.1.1  
**Licensa:** Proprietário - Usu Privado  
Todos os direitos reservados.  
É estritamente proibida a cópia não autorizada de qualquer arquivo deste projeto, por qualquer meio.  


___


### [Funcionamento da API](#funcionamento-da-api-1)  
* [Informações Gerais](#informações-gerais)  
* [Endpoint Envirioments](#endpoint-envirioments)  
* [Métodos HTTP](#métodos-http)  
* [Códigos de Retorno](#códigos-de-retorno)  
* [Autenticação](#autenticação)  
* [Resource e Collections](#resource-e-collections)  
* [Parâmetros](#parâmetros)  
* [Rotas](#rotas)  
### [Desenvolvimento e Operação](#desenvolvimento-e-operação-1)  
* [Laravel Framework](#laravel-framework)  
* [Trabalhando com o docker](#trabalhando-com-o-docker)  
* [Iniciando o projeto localmente](#iniciando-o-projeto-localmente)
* [Git Workflow](#git-workflow)  
* [Enviado atualizações](#enviado-atualizações)  
* [Precauções de contribuição](#precauções-de-contribuição)
* [Deploy e Integração Continua](#deploy-e-integração-continua)  
### [Análise e Recursos](#análise-e-recursos-1)  
* [Modelo Relacional](#modelo-relacional)  
### [Pendências do Projeto](#pendências-do-projeto-1)  
### [Changelog](#changelog-1)  


___


# **Funcionamento da API**
## **Informações Gerais**
* Todo o conteúdo passado para API deve ser no formato JSON.
* Todos os endpoints retornam um objeto JSON ou um Array
* Toda collection é retornada por padrão em ordem **crescente**. Do mais novo para o mais antigo.
* Todas as datas devem ser enviadas no formato americado YYYY/MM/dd HH:mm com a parte da hora sendo opcional.



## **Endpoint Envirioments**
Para questão de isolamento e segurança dessa API ela pode estar sendo rodada em 3 ambiente independentes.  

- **Local** - Possui url prórpia
- **Teste** - [https://api.teste.url](https://api.teste.url)  
- **Desenvolvimento** - [https://api.url](https://api.url)

Em ambiente de teste e produção todo acesso a API é feito através das URLs informadas acima devem ser feitos através HTTPS .



## **Métodos HTTP**
Verbo        | Descrição
------------ | -------------
GET          | Usado para recuperar um ou vários recursos
POST         | Usado para criar um recurso.
PUT	         | Usado para atualizar um recurso.



## **Códigos de Retorno**
* HTTP `2xx` Código de retorno - Sucesso - Ação executada com sucesso.
* HTTP `401` Código de retorno - Erro - Usuário não autenticado.
* HTTP `403` Código de retorno - Erro - Usuário sem permissão para executar a ação.
* HTTP `404` Código de retorno - Erro - URL não encontrada.
* HTTP `405` Código de retorno - Erro - Método não permitido.
* HTTP `409` Código de retorno - Erro - Violação de integridade de dados.
* HTTP `5XX` Código de retorno - Erro - Erro interno do servidor.

### Formato de retorno de um erro
```json
{
  "erro": "Descrição do erro",
  "code": 500
}
```


## **Autenticação**
A autenticação é feita através da URL de login e conteúdo da requisição HTTP deve ter um **`username`** e **`password`** e caso o login seja efetuado com sucesso uma resposta contendo um token de acesso será retornado.


## **Resource e Collections**
Uma **`resource`** representa o retorno de um único registro no formato JSON, enquanto uma **`collection`** representa um conjunto de **`resources`** em uma estrutura JSON diferente.

### **Resource**
```json
{
  "data": {
    "atributo_1": "",
    "atributo_2": ""
  }
}
```

### **Collection**
```json
{
  "data": [
    {
      "atributo_1": "",
      "atributo_2": ""
    },
    {
      "atributo_1": "",
      "atributo_2": ""
    }
  ],
  "links": {
    "first": "",
    "last": "",
    "prev": "",
    "next": ""
  },
  "meta": {
    "current_page": 0,
    "from": 0,
    "last_page": 0,
    "path": "",
    "per_page": 0,
    "to": 0,
    "total": 0
  }
}
```



## **Parâmetros**
### Parâmetros de Header
- **X-Requested-With = XMLHttpRequest**
- **content = application/json**
- **Authorization = Baerer ACCESS_TOKEN**

No caso do método Post and Put um parâmetro header extra deve ser inclúido para informar que o conteúdo da requisição é do tipo JSON.
- **Content-Type = application/json**

### Parâmetros de URL
No caso de requisições de listagem é possível passar parametros através da URL de forma a poder obter resultados diferentes.
- **q** - Parametro que faz uma pesquisa atráves por meio de palavra chave
- **order** - Define o campo pelo qual a ordenação deve ser feita. Padrão: create_at
- **sort** - Permite ordernar de forma crescrente ou decrescente. Padrão: asc
- **per_page** - Quantidade de resultados por página. Padrão: 10
- **with** - Quando disponível no resource requisitado serve para incluir relações filhas.

## **Rotas**
O conjunto completo de rotas da API podem ser importadas diretamente para o Insomnia através [desse arquivo](/docs/insomnia/workspace.json) disponpível na pasta docs do repositório.

Execute o Insomnia e importe através de Insominia > Import/Export > Import Data > From URL e entre com o endereço RAW do arquivo disponível aqui no repositório.


___


# **Desenvolvimento e Operação**
## **Laravel Framework**
Projeto implementado usando [**`laravel/framework`**](https://laravel.com/docs/7.x)  com módulo de autenticação [**`**`laravel/passport`**`**](https://laravel.com/docs/7.x/passport).

- **Laravel** - *Version: 7.0*
- **Passport** - *Version: 8.4*


## **Trabalhando com o docker**
Esse projeto utiliza **`docker`** e os beneficios do **`docker-compose`**. Docker não é um sistema de virtualização tradicional. Docker facilita a criação e o gerenciamento de ambientes isolados e o docker-compose é a ferramenta para definir e executar aplicações docker com múltiplos containers e isso permite trabalhar em vários ambientes: Produção, Desenvolvimento, Teste assim como um agiliza um fluxo de trabalho de integração continua.

- **Cria, recria ou inicia os contêineres**
```shell
docker-compose up --detach --force-recreate --build
```  

- **Acessa um container**  
```shell
docker-compose exec {{CONTAINER_NAME}} bash
```  

- **Ver a porta em execução em um determinado container**  
```shell
docker-compose port {{CONTAINER_NAME}} {{PORT}}
```  

## **Iniciando o projeto localmente**
- **Instalando as dependencias**  
```shell
docker-compose exec app composer install
```  

- **Copiar arquivo .env e gerar app key da framework**  
```shell
docker-compose exec app cp .env.example .env
```  
```shell
docker-compose exec app php artisan key:generate
```

- Criar o esquema do Banco de Dados  
```shell
docker-compose exec app php artisan migrate
```  

- Preparar o módulo do Passport/OAuth  
```shell
docker-compose exec app php artisan passport:install
```  

- Preencher o banco de dados com conteúdo de teste  
```shell
docker-compose exec app php artisan db:seed
```  

- Iniciando containers existentes  
```shell
docker-compose restart
```  



## **Git Workflow**  
Esse fluxo de trabalho usa duas branchs principais para registrar o histórico do projeto. O branch **`master`** armazena o histórico oficial de releases, e o branch **`develop`** serve como um ramo de integração de recursos.

O branch **`master`** é o branch que roda no ambiente de produção. Todos os commits no branch **`master`** devem possuir um número de versão.

Cada novo recurso deve residir em sua própria branch e devem partir do branch **`develop`**. Quando um recurso é concluído, ele é mesclado novamente no **`develop`**. Os recursos nunca devem  interagir diretamente com o mestre.

O branch **`develop`** é o branch que roda no ambiente de teste. Ele armazena as últimas funcionalidades incluídas no projetos e que ainda não estão aptas a entrarem no branch **`master`**.



## **Enviado atualizações**
1. [Clone o repositório!](https://help.github.com/articles/fork-a-repo/)
2. [Sincronize](https://help.github.com/articles/syncing-a-fork/) seu fork com a última versão
3. Crie uma branch para sua funcionalidade: `git checkout -b feature-123`
4. Commit suas alterações: `git commit -m 'Commit message'`
5. Envie as alterações pra sua branch: `git push origin feature-123`
6. [Envie sua pull request](https://help.github.com/articles/using-pull-requests/)


## **Precauções de contribuição**  
Antes de enviar sua colaboração verifique seu código e as conveções adotadas no projeto e tome as seguintes providências:  

- **Sempre verifique a branch que está sendo usada**  
```shell
git status
```

- **Faça uma atualização prévia do seu chechout**  
```shell
git pull
```

- **Veja as diferenças antes de commitar**  
```shell
git diff --cached
```

- **Não commite antes de rodar o projeto localmente**
- **Veja as mudanças implementadas sendo executadas**  
- **E principalmente tenha certeza que essas alterações funcionam**  
- **[Comandos úteis do git](https://gist.github.com/leocomelli/2545add34e4fec21ec16)**




## **Deploy e Integração Continua**
O projeto usa deploy automático através do git e da ferramenta [Buddy Works](https://app.buddy.works).

Deploybot credentials:
- **Deploybot URL:** [Account Buddy Works](DeployCustomURL)  
- **Usuário:** DeployUser  


___


# **Análise e Recursos**
### **Modelo Relacional**
A imagem a seguir ilustra o diagrama de relacionamentos entre as principais entidades do sistema assim com sua convenção de nomemclatura.
Por questões de segurança as entidades relacionadas a segurança foram propositalmente suprimidas.

O atributo **com_tempo_criação** refere-se a 2 atributos extras (**create_at** e **update_at**) criados pelo Frameworkque representam respectivamente a data de criação e a últilma data de atualização do registro no banco de dados.

![Diagrama do Modelo de Entidade e Relacionamento](/docs/modelo-relacional/modelo-relacional.png "Diagrama de Entidade e Relacionamento")


___


# **Pendências do Projeto**
- [ ] Documentação do Projeto
- [ ] Testes Unitários


___


# **Changelog**  
= **0.1.1** - 15/04/2020  
Refatoração geral com implementação do oauth e dos módulos iniciais  

= **0.1.0** - 21/03/2020  
Cadastros principais finalizados  

= **0.0.2** - 21/03/2020  
Adicionando Laravel Framework ao projeto  

= **0.0.1** - 21/03/2020  
Scaffolding do Projeto  