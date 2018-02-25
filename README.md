# Explorador Cifra Club
Experimentações com a API do Cifra Clube para explorar as cifras disponíveis em busca de coisas como ciifras fáceis.

# Execução
```
composer install
php musicas-faceis.php [slug_artista] [numero_maximo_acordes]
```

# Exemplo
```
php musicas-faceis.php padre-marcelo-rossi 5
```

# Sobre Decisões Técnicas

## Todas as classes no mesmo Namespace
Como esta aplicação é muito simples e tem fins didáticos, optei por manter todas as classes no mesmo namespace.
Entendo que isso traz uma sensação de que o software é menos complicado.
Colocar subdiretórios também me oribigaria a nomear conceitos de forma mais clara, por exemplo, ao agrupar Musica, Artista e Acorde, que nome seria melhor? Modelos? Entidades? ValueObjects? DataTransfer?
Para evitar nomear um grupo de classes sobre um conceito, resolvi manter mais simples nessa primeira versão.

## Código em Inglês ou Português?
O domínio da língua inglesa, por mais que seja desejável para um programador não é realidade no Brasil
e este código tem a intenção de apoiar um número maior de pessoas no desenvolvimento de software guiado a testes.
Optei por manter em inglês unicamente nomes de Padrões de Projeto (Design Patterns) altamente consolidados como "Factory" e "Proxy".



