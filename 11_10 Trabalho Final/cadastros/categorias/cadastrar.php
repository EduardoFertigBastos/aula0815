<?php

/**
 * Menu para Cadastro
 */
function menuCadastro() {
    echo '<form method="post" action="' . LOCALHOST .'?pg=categorias">
           
            <div class="form-row">
                <div class="form-group col-sm-8 col-md-10 col-lg-8">
                    <label for="nome"> Nome </label>
                    <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome...">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-sm-8 col-md-10 col-lg-8">
                    <label for="descricao"> Descrição </label>
                    <input type="text" name="descricao" class="form-control" id="descricao" placeholder="Descrição...">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-sm-8 col-md-10 col-lg-8">
                    <label for="figura"> Figura </label>
                    <input type="text" name="figura" class="form-control" id="figura" placeholder="Figura...">
                </div>
            </div>
       
            <input type="submit" value="Cadastrar" name="cadastrar" class="btn btn-primary col-sm-8 col-md-10 col-lg-8 py-2">
            
        </form>'; 
}

/**
 * Cadastra os dados no banco.
 */
function cadastrarBanco($conn)
{
    if(isset($_POST['cadastrar'])) {
        try {
            /**
             * Buscar último ID inserido no banco ja que esta tabela não é auto_increment.
             */
            $sSql = "SELECT IDCategoria 
                       FROM categorias
                      ORDER BY IDCategoria DESC
                      LIMIT 1;";
        
            $stmt = $conn->prepare($sSql);
            $stmt->execute();            
            $aResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $iUltimoID = intval($aResult[0]['IDCategoria']) + 1;

            /**
             * Inserir no Banco de Dados os dados passados pelo formulário.
             */
            $sSql = ' INSERT INTO categorias (IDCategoria, NomeCategoria, Descricao, Figura)
                      VALUES (:id, :nome, :descricao, :figura)';
                      
            $stmt = $conn->prepare($sSql);
           
            $stmt->execute([
                ':id'        => $iUltimoID,
                ':nome'      => $_POST['nome'],
                ':descricao' => $_POST['descricao'],
                ':figura'    => $_POST['figura']
            ]);
            
            /**
             * Redirecionar para a listagem.
             */
            redirecionar([
                'pagina'    => 'categorias', 
                'mensagem'  => 'Registro cadastrado com sucesso.'
            ]);
        } catch(PDOException $e) {
            imprimirErro($e);
        }
    }
}

cadastrarBanco($conn);
?>

