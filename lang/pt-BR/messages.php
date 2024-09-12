<?php

return [
    'success' => [
        'store_message' => ':scope criado(a) com sucesso.',
        'update_message' => ':scope atualizado(a) com sucesso.',
        'delete_message' => ':scope excluído(a) com sucesso.',
        'cancel_message' => ':scope cancelado(a) com sucesso.',
        'approve_message' => ':scope aprovado(a) com sucesso.',
        'show_message' => ':scope encontrado(a) com sucesso.',
        'active_message' => ':scope ativado(a) com sucesso.',
        'confirmation_message' => 'MTR confirmado com sucesso!'
    ],

    'error' => [
        'not_found' => ':scope não encontrado(a).',
        'expired' => ':scope informado(a) está expirado(a).',
        'invalid' => ':scope inválido.',
        'form_validation' => 'Por favor verifique os campos preenchidos.'
    ],

    'verification_code' => [
        'sent' => "Código de verificação enviado com sucesso!",
        'invalid' => "Código de verificação inválido.",
        'expired' => "Código de verificação expirado, por favor solicite novamente.",
        'verified' => "Contato verificado com sucesso!"
    ],

    'token' => [
        'invalid' => "Token inválido.",
        'expired' => "Token expirado.",
        'unauthorized' => "Não autorizado.",
        'not_found' => "Token não encontrado."
    ],

    'entity' => [
        'not_found' => "Entidade não encontrada.",
        'created' => "Entidade criada com sucesso!",
        'updated' => "Entidade atualizada com sucesso!",
        'deleted' => "Entidade deletada com sucesso!"
    ],

    'construction' => [
        'created' => "Obra adicionada com sucesso!"
    ],

    'user' => [
        'not_found' => "Usuário não encontrado.",
        'created' => "Usuário criado com sucesso!",
        'updated' => "Usuário atualizado com sucesso!",
        'deleted' => "Usuário deletado com sucesso!"
    ],

    'login' => [
        'success' => "Login efetuado com sucesso!"
    ],

    'legal_person' => [
        'not_found' => "Pessoa jurídica não encontrada.",
        'exists' => "Não é possível realizar o cadastro desta empresa, pois ela já consta na base de dados." .
            " Por favor entre em contato com o responsável legal da empresa.",
        'not_exists' => "Pessoa jurídica apta para o cadastro."
    ],

    'natural_person' => [
        'exists' => "Pessoa física encontrada na base de dados.",
        'not_exists' => "Pessoa física não encontrada na base de dados."
    ],

    'cpf' => [
        'invalid' => "O CPF informado é inválido."
    ],

    'mtr' => [
        'max_quantity_exceeded' => "O total de quantidade dos itens não pode exceder o valor máximo de :max_quantity kg."
    ],

    'residue_type' => [
        'diff' => "Todas as classes de resíduos devem pertencer ao tipo de :residue_type."
    ]
];
