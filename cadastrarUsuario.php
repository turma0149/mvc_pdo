<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <title>Cadastrar Usuário</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body>

    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-md-5">

                <h1 class="mb-4">
                    Criar usuário
                </h1>

                <div
                    id="mensagem"
                    class="alert d-none"></div>

                <form id="formUsuario">

                    <div class="mb-3">

                        <label class="form-label">
                            Nome
                        </label>

                        <input
                            type="text"
                            name="nome"
                            class="form-control"
                            required>

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            E-mail
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            required>

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Senha
                        </label>

                        <input
                            type="password"
                            name="senha"
                            class="form-control"
                            required>

                    </div>


                    <button
                        type="submit"
                        class="btn btn-primary w-100">
                        Cadastrar
                    </button>

                </form>


                <div class="text-center mt-3">

                    <a href="login.php">
                        Voltar para o login
                    </a>

                </div>

            </div>

        </div>

    </div>
    <script>
        formUsuario.onsubmit = async e => {
            e.preventDefault();

            const dados = new FormData(formUsuario);
            dados.append("acao", "cadastrar");

            const resposta = await fetch("UsuarioController.php", {
                method: "POST",
                body: dados
            });

            const json = await resposta.json();

            mensagem.className = `alert ${json.sucesso ? "alert-success" : "alert-danger"}`;
            mensagem.textContent = json.mensagem;

            if (json.sucesso) {
                setTimeout(() => location.href = "login.php", 1000);
            }
        };
    </script>



</body>

</html>