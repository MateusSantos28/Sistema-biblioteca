# Passo a Passo: Conexão do Git no Visual Studio Code

Este guia orienta como configurar o ambiente para visualizar e colaborar no projeto **Sistema-biblioteca**.

## 1. Permissões de Colaborador
Para enviar alterações (dar `push`), você precisa ser um colaborador oficial do repositório.
*   **Como participar:** Enviem seus nomes de usuário do GitHub para eu adicionar. 
*   **Status atual:** Até agora, apenas o **Nycolas** e o **Lírio** têm acesso de escrita.
*   **Acesso público:** Não precisa ser colaborador apenas para baixar o código. Qualquer pessoa pode acessar por aqui: [https://github.com/MateusSantos28/Sistema-biblioteca.git](https://github.com/MateusSantos28/Sistema-biblioteca.git)

## 2. Instalação das ferramentas
Você precisará de dois programas instalados:

*   **Visual Studio Code (Editor):** Baixe e instale para o seu sistema operacional.
    *   [https://visualstudio.com](https://visualstudio.com)
*   **Git (Motor do Terminal):** Obrigatório para rodar os comandos no terminal do VS Code ou no Git Bash.
    *   [https://git-scm.com](https://git-scm.com)


## 3. Conexão da Conta
Sua conta do GitHub precisa estar vinculada ao seu computador. Para confirmar qual nome de usuário está ativo na sua máquina, use:

```bash
git config --global user.name
```
> **Nota:** Se for sua primeira vez, o VS Code abrirá uma janela no navegador pedindo autorização para logar no GitHub ao tentar enviar algo.

## 4. Como baixar o código (Clone)
Para ter uma cópia do código na sua máquina, escolha uma pasta, abra o terminal e digite:

```bash
git clone https://github.com/MateusSantos28/Sistema-biblioteca.git
```

---

## Fluxo do Projeto (Para Colaboradores)
Após fazer suas modificações no código, é preciso seguir esta ordem de comandos para enviar as alterações ao GitHub:

### Passo A: Preparar os arquivos
Este comando "avisa" ao Git quais arquivos você alterou:
```bash
git add .
```

### Passo B: Criar o Commit
Descreva o que você mudou entre as aspas:
```bash
git commit -m "Explique o que você modificou"
```

### Passo C: Enviar para o repositório
Para mandar tudo pro GitHub:
```bash
git push origin main
```

---
**Dica de Ouro:** Antes de começar a trabalhar, use sempre o comando `git pull origin main` para garantir que seu código está atualizado com o que os outros colegas enviaram!
