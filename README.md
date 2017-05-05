# Conversor PDF/A

## Sobre

Ferramenta desenvolvida com o intuito de fornecer uma interface simples para a conversão de arquivos no formato PDF, para o formato PDF/A, um derivado da especificação proprietária, em conformidade com a [ISO 19005:2005](https://www.iso.org/standard/38920.html) e [ISO 32000:2008](https://www.iso.org/standard/51502.html).

## Começando

Se você não possui instalado o gulp, rode `npm rm --global gulp` antes de prosseguir.

### Instalale também o `gulp` linha de comando

```sh
npm install --global gulp-cli
```

### Dependências

A tarefa seguinte irá instalar os pacotes necessários para o projeto.

```sh
npm install
```

### Agora basta rodar a tarefa watch

Essa tarefa ficará 'observando' os diretórios de origem - source (/src), em busca de modificações e criará os arquivos finais de distribuição (/dist) automaticamente

```sh
gulp watch
```