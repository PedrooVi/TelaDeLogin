document.addEventListener('DOMContentLoaded', () => {
    let check = document.getElementById('check');
    let password = document.getElementById('senha');


    function mostrarSenha() {
        if (check.checked) {
            password.setAttribute('type', 'text');
        } else {
            password.setAttribute('type', 'password');
        }
    }

    if (check) {
        check.addEventListener('change', mostrarSenha);
    }

    function verificarDados(event) {
        event.preventDefault();

        let emailRegistro = document.getElementById('register-email');
        let confirmarEmail = document.getElementById('confirm-email');
        let senhaRegistro = document.getElementById('password-register');
        let confirmarSenha = document.getElementById('password-confirm');

       
        if (senhaRegistro.value.length < 8 || senhaRegistro.value.length > 16) {
            alert("A senha deve ter entre 8 e 16 caracteres!");
            return;
        }

        
        if (emailRegistro.value !== confirmarEmail.value) {
            alert("Os emails não conferem!");
            return;
        }

        
        if (senhaRegistro.value !== confirmarSenha.value) {
            alert("As senhas não conferem!");
            return;
        }

        alert("Cadastro realizado com sucesso!");
    }

    let btnCadastrar = document.getElementById("btn-cadastrar");
    btnCadastrar.addEventListener('click', verificarDados);

});
