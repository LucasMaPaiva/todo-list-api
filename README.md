# Documentação da API de Gerenciamento de Tarefas

## Introdução

Esta documentação descreve a API de Gerenciamento de Tarefas desenvolvida com Laravel. A API permite o gerenciamento de usuários, tarefas, etiquetas (tags) e, opcionalmente, projetos. A autenticação é realizada por meio de um token JWT, garantindo segurança nas operações.

## Estrutura de Tabelas e Relacionamentos

### Tabela `users`
A tabela de usuários armazena as informações dos usuários registrados na API.

**Estrutura**:

```sql
CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Tabela `tasks`
A tabela de tarefas armazena as tarefas criadas pelos usuários. Cada tarefa está associada a um usuário e pode ter uma ou mais etiquetas.

**Estrutura**:

```sql
CREATE TABLE tasks (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    task_situation_id BIGINT,
    user_id BIGINT,
    tag_id BIGINT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (task_situation_id) REFERENCES task_situation(id),
    FOREIGN KEY (tag_id) REFERENCES tags(id)
);
```

### Tabela `tags`
A tabela de etiquetas (tags) armazena as etiquetas que podem ser associadas às tarefas.

**Estrutura**:

```sql
CREATE TABLE tags (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Relacionamentos

- **Usuário - Tarefas**: Um usuário pode ter muitas tarefas. A relação é representada por `user_id` na tabela `tasks`.
- **Tarefas - Etiquetas**: Cada tarefa pode ter uma ou mais etiquetas associadas por meio de `tag_id`.

## Endpoints da API

### Autenticação de Usuários

#### Registro de Usuário
- **Método**: `POST`
- **Endpoint**: `/register`
- **Descrição**: Cria um novo usuário.
- **Requisição**:
    ```json
    {
        "name": "John Doe",
        "email": "john@example.com",
        "password": "123456"
    }
    ```
- **Resposta**:
    ```json
    {
        "message": "User registered successfully.",
        "token": "jwt-token"
    }
    ```

#### Login de Usuário
- **Método**: `POST`
- **Endpoint**: `/login`
- **Descrição**: Autentica o usuário e gera um token JWT.
- **Requisição**:
    ```json
    {
        "email": "john@example.com",
        "password": "123456"
    }
    ```
- **Resposta**:
    ```json
    {
        "message": "Login successful.",
        "token": "jwt-token"
    }
    ```

### Endpoints de Usuários

#### Buscar Usuário
- **Método**: `GET`
- **Endpoint**: `/users/{id}`
- **Descrição**: Retorna as informações de um usuário específico.
- **Resposta**:
    ```json
    {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "created_at": "2023-01-01T00:00:00",
        "updated_at": "2023-01-01T00:00:00"
    }
    ```

#### Atualizar Usuário
- **Método**: `PUT` ou `PATCH`
- **Endpoint**: `/users/{id}`
- **Descrição**: Atualiza as informações do usuário.
- **Requisição**:
    ```json
    {
        "name": "John Doe Updated",
        "email": "john_updated@example.com"
    }
    ```
- **Resposta**:
    ```json
    {
        "message": "User updated successfully."
    }
    ```

#### Excluir Usuário (Opcional)
- **Método**: `DELETE`
- **Endpoint**: `/users/{id}`
- **Descrição**: Exclui um usuário da API.
- **Resposta**:
    ```json
    {
        "message": "User deleted successfully."
    }
    ```

### Endpoints de Tarefas

#### Listar Tarefas
- **Método**: `GET`
- **Endpoint**: `/tasks`
- **Descrição**: Retorna a lista de todas as tarefas do usuário autenticado.
- **Resposta**:
    ```json
    [
        {
            "id": 1,
            "title": "Task 1",
            "description": "Task description",
            "status": "pending",
            "created_at": "2023-01-01T00:00:00",
            "updated_at": "2023-01-01T00:00:00"
        },
        {
            "id": 2,
            "title": "Task 2",
            "description": "Another task description",
            "status": "completed",
            "created_at": "2023-01-02T00:00:00",
            "updated_at": "2023-01-02T00:00:00"
        }
    ]
    ```

#### Criar Tarefa
- **Método**: `POST`
- **Endpoint**: `/tasks`
- **Descrição**: Cria uma nova tarefa para o usuário autenticado.
- **Requisição**:
    ```json
    {
        "title": "New Task",
        "description": "Task description",
        "status": "pending"
    }
    ```
- **Resposta**:
    ```json
    {
        "message": "Task created successfully."
    }
    ```

#### Buscar Detalhes de uma Tarefa
- **Método**: `GET`
- **Endpoint**: `/tasks/{id}`
- **Descrição**: Retorna os detalhes de uma tarefa específica.
- **Resposta**:
    ```json
    {
        "id": 1,
        "title": "Task 1",
        "description": "Task description",
        "status": "pending",
        "created_at": "2023-01-01T00:00:00",
        "updated_at": "2023-01-01T00:00:00"
    }
    ```

#### Atualizar Tarefa
- **Método**: `PUT` ou `PATCH`
- **Endpoint**: `/tasks/{id}`
- **Descrição**: Atualiza as informações de uma tarefa específica.
- **Requisição**:
    ```json
    {
        "title": "Updated Task",
        "status": "in progress"
    }
    ```
- **Resposta**:
    ```json
    {
        "message": "Task updated successfully."
    }
    ```

#### Excluir Tarefa
- **Método**: `DELETE`
- **Endpoint**: `/tasks/{id}`
- **Descrição**: Exclui uma tarefa.
- **Resposta**:
    ```json
    {
        "message": "Task deleted successfully."
    }
    ```

#### Marcar Tarefa como Concluída
- **Método**: `PUT` ou `PATCH`
- **Endpoint**: `/tasks/{id}/complete`
- **Descrição**: Marca uma tarefa como concluída.
- **Resposta**:
    ```json
    {
        "message": "Task marked as complete."
    }
    ```

### Endpoints de Etiquetas (Tags)

#### Listar Etiquetas
- **Método**: `GET`
- **Endpoint**: `/tags`
- **Descrição**: Retorna a lista de todas as etiquetas associadas ao usuário.
- **Resposta**:
    ```json
    [
        {
            "id": 1,
            "name": "Urgent",
            "created_at": "2023-01-01T00:00:00",
            "updated_at": "2023-01-01T00:00:00"
        },
        {
            "id": 2,
            "name": "Work",
            "created_at": "2023-01-02T00:00:00",
            "updated_at": "2023-01-02T00:00:00"
        }
    ]
    ```

#### Criar Etiqueta
- **Método**: `POST`
- **Endpoint**: `/tags`
- **Descrição**: Cria uma nova etiqueta.
- **Requisição**:
    ```json
    {
        "name": "Personal"
    }
    ```
- **Resposta**:
    ```json
    {
        "message": "Tag created successfully."
    }
    ```

#### Excluir Etiqueta
- **Método**: `DELETE`
- **Endpoint**: `/tags/{id}`
- **Descrição**: Exclui uma etiqueta.
- **Resposta**:
    ```json
    {
        "message": "Tag deleted successfully."
    }
    ```

### Endpoints de Projetos (Opcional)

#### Listar Projetos
- **Método**: `GET`
- **Endpoint**: `/projects`
- **Descrição**: Retorna a lista de todos os projetos.
- **Resposta**:
    ```json
    [
        {
            "id": 1,
            "name": "Project 1",


            "created_at": "2023-01-01T00:00:00",
            "updated_at": "2023-01-01T00:00:00"
        }
    ]
    ```

#### Criar Projeto
- **Método**: `POST`
- **Endpoint**: `/projects`
- **Descrição**: Cria um novo projeto.
- **Requisição**:
    ```json
    {
        "name": "New Project"
    }
    ```
- **Resposta**:
    ```json
    {
        "message": "Project created successfully."
    }
    ```

## Exemplo de Fluxo de Trabalho

1. O usuário se registra ou faz login na API.
2. Após o login, o usuário recebe um token JWT, que será usado nas requisições subsequentes.
3. O usuário pode listar, criar, atualizar e excluir tarefas.
4. Cada tarefa pode ser associada a etiquetas (tags) para facilitar a organização.
5. O usuário pode marcar tarefas como concluídas.
6. Opcionalmente, o usuário pode criar projetos para agrupar tarefas relacionadas.

## Considerações Finais

Esta API oferece um sistema completo para gerenciamento de tarefas e projetos. Para futuras expansões, pode-se adicionar funcionalidades como notificações, relatórios ou suporte a sub-tarefas.

