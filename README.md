# Introdução
Este módulo tem como intenção facilitar a nacionalização da plataforma Magento 2 para o mercado Brasileiro.

# Funcionalidades
- Implementação de validações em campos do tipo texto
  - CPF
  - CNPJ
  - Telefone Brasileiro
  - CEP
- Implementa máscaras em campos de texto 
  - CPF/CNPJ
  - CEP
  - Telefone
- Campo customizado de CPF/CNPJ
- Adapata formulários de endereço
  - Campo de rua em 4 linhas com label e validações corretas
  - Reordena os campos de endereço para o padrão brasileiro
- Autocomplete de Endereço pelo CEP
  - Também inclui busca do CEP pelos dados do endereço
  - API de frontend para busca de Endereço pelo CEP
  - API de frontend para busca de CEP pelo Endereço
  - Inclui busca de CEP e endereço com modelo de Adapter para fácil extensão
