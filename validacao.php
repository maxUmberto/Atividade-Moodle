<?php

function validacao(array $campos){
    //Variável que armazenará os erros
    $erro = '';
    
    //Validaçoes
    if(empty($campos['nome'])){//Verifica se o campo nome está vazio
        $erro = 'Nome em branco <br>';
    }elseif(strlen($campos['nome']) <= 6){//Verifica se o nome tem um tamanho válido
        $erro = 'Nome muito curto <br>';
    }/*if(!preg_match('/^([í\ú\ã\ô\é\a-zA-Z ]+)$/i',$campos['nome'])){
        $erro = 'Somente letras no nome<br>';
    }*/
        
    if(empty($campos['email'])){//Verifica se email está vazio
        $erro .='Email em branco<br>';
    }
    
    if(empty($campos['login'])){//Verifica se o Login está vazio
        $erro .= 'Login em branco<br>';
    }else if(strlen($campos['login']) < 5){//Verifica se login tem um tamanho válido
        $erro .= 'Login muito curto <br>';
    }
    
    //Como essa validação é usada tanto para o formulário de cadastro 
    //quanto para o de edição, é feita uma verificação para checar se
    //existe o campo senha, pois não é possível editar esse, logo também
    //não é possível fazer uma validação dele
    if(isset($campos['senha'])){
        if(empty($campos['senha'])){//Verifica se senha está vazia
            $erro .= 'Senha em branco <br>';
        }elseif(strlen($campos['senha']) < 8){//Verifica se senha tem um tamanho mínimo
            $erro .= 'Senha muito curta. Deve ter no mínimo 8 caracteres <br>';
        }elseif(empty($campos['senha2'])){//Verifica se a senha foi confirmada
            $erro .= 'Confirme sua senha<br>';
        }elseif($campos['senha'] != $campos['senha2']){//Verifica se as senhas são iguais
            $erro .= 'Senhas diferentes<br>';
        }
    }
    
    if($erro != ''){
        echo '<div class="erro">'.$erro.'</div>';
        return 1;
    }
}
?>