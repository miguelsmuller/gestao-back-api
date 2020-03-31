# **PGI-RME**
Plataforma de Gestão Interna - Plataforma de Gestão Interna - Plataforma de Gestão Interna - Plataforma de Gestão Interna - Plataforma de Gestão Interna - Plataforma de Gestão Interna - Plataforma de Gestão Interna - Plataforma de Gestão Interna - Plataforma de Gestão Interna - Plataforma de Gestão Interna - Plataforma de Gestão Interna - Plataforma de Gestão Interna - Plataforma de Gestão Interna - Plataforma de Gestão Interna - Plataforma de Gestão Interna - Plataforma de Gestão Interna  

**Versão Estável:** 0.1.1  
**Licensa:** Proprietário - Usu Privado  
Todos os direitos reservados - É estritamente proibida a cópia não autorizada de qualquer arquivo deste projeto, por qualquer meio..  

## **Definição do Projeto**
- **URL - Teste:** <http://staging.com.br>
- **URL - Produção:** <http://production.com.br>

## **Workflow do Projeto**
This workflow uses two branches to record the history of the project. The `master` branch stores the official release history, and the `develop` branch serves as an integration branch for features. It's also convenient to tag all commits in the master branch with a version number.

Each new feature should reside in its own branch. But, instead of branching off of `master`, feature branches use `develop` as their parent branch. When a feature is complete, it gets merged back into `develop`. Features should never interact directly with master.

## **Contributing**
1. [Fork it!](https://help.github.com/articles/fork-a-repo/)
2. [Configuring](https://help.github.com/articles/configuring-a-remote-for-a-fork/) a remote for a fork
3. [Syncing](https://help.github.com/articles/syncing-a-fork/) a fork with the latest version
4. Create your feature branch: `git checkout -b feature-123`
5. Commit your changes: `git commit -m 'Commit message'`
6. Push to the branch: `git push origin feature-123`
7. [Submit a pull request](https://help.github.com/articles/using-pull-requests/) :D

##### **Before commit, double check your code. Please dude.**
- Always check a branch that is being used: `git status`
- Execute a `git pull` to keep your checkout up-to-date
- Invoke a `git diff --cached` before committing
- **NOT COMMIT BEFORE RUNNING THE PROJECT LOCALLY AND SEE THE CHANGES RUNNING**
- **MAKE SURE THE CHANGES WORK**

> **[Here is a quick guide to git command](https://gist.github.com/leocomelli/2545add34e4fec21ec16)**

## **Deploy Method**  
This project uses automated deployment using the git and [Buddy Works](https://app.buddy.works) tools.

### Deploybot credentials:
- **Deploybot URL:** [Account Buddy Works](DeployCustomURL)  
- **Usuário:** DeployUser  


## **Putting the project to run**  
This project use `docker` and the benefits of `docker-compose`. Docker is not a traditional virtualization system. Docker facilitates the creation and management of isolated environments. and docker-compose is a tool for defining and running multi-container Docker applications and allows works in all environments: production, staging, development, testing, as well as CI workflows.

### **Working with the container**
- Builds, (re)creates, starts, and attaches to containers for a service - `docker-compose up --detach --force-recreate --build`
- Access the container - `docker-compose exec {{CONTAINER_NAME}} bash`
- See the port container is running - `docker-compose port {{CONTAINER_NAME}} {{PORT}}`

### **Working with project**  
- Install dependencies - `docker-compose exec app composer install`
- .env file and app key - `docker-compose exec app cp .env.example .env && php artisan key:generate`
- Create database schema - `docker-compose exec app php artisan migrate`
- Prepare Passaport/OAuth for use - `docker-compose exec app php artisan passport:install`
- Seed Database with test data - `docker-compose exec app php artisan db:seed`
- Starts existing containers for a service - `docker-compose start`  

### **Using the  application**  
If the contenders project are already allocated in Docker will not be necessary to build them and create, and will not need to also install the several dependencies.  

- Starts existing containers for a service - `docker-compose start`  

## **Changelog**  
= **0.1.1 - 15/04/2020** =  
Refatoracao geral com implementacao do oauth e dos modulos iniciais  

= **0.1.0 - 21/03/2020** =  
Cadastros principais finalizados  

= **0.0.2 - 21/03/2020** =  
Adicionando Laravel Framework ao projeto  

= **0.0.1 - 21/03/2020** =  
Scaffolding do Projeto  