<?php
function confirmacaoDeletar($id) 
{
    echo '<form method="post" action="' . LOCALHOST .'?pg=funcionarios&deletar=' . $id . '">

            Deseja realmente deletar o Registro #'. $id . '?
       
            <input type="submit" value="Deletar" name="deletar" class="btn btn-primary col-sm-8 col-md-10 col-lg-8 py-2">
            <a href="' . LOCALHOST .'?pg=funcionarios" class="btn btn-primary col-sm-8 col-md-10 col-lg-8 py-2 mt-1">
                Não Deletar
            </a>
        </form>'; 
}

function deletarBanco($conn)
{
    try {
        if (isset($_POST['deletar'])) {
            /**
             * Deletar no Banco de Dados o registro.
             */
            $sSql = "DELETE
                       FROM funcionarios
                      WHERE IDFuncionario = :id";
         
            $stmt = $conn->prepare($sSql);
            
            $stmt->bindParam(':id', $_GET['deletar'], PDO::PARAM_INT);
            $stmt->execute();
            
            /**
             * Redirecionar para a listagem.
             */
            redirecionar([
                'pagina'    => 'funcionarios', 
                'mensagem'  => 'Registro deletado com sucesso.'
            ]);
        }
    } catch(PDOException $e) {
        imprimirErro($e);
    }
}

deletarBanco($conn);
