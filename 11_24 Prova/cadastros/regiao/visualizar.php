<?php

/**
 * Busca o registro que será visualizado.
 */
function colherDadosCampos($conn)
{
    $sSql = "SELECT *
               FROM regiao
              WHERE IDRegiao = :id";
                        
    $stmt = $conn->prepare($sSql);

    $stmt->bindParam(':id', $_GET['visualizar'], PDO::PARAM_INT);
    $stmt->execute();

    return  $stmt->fetchAll(PDO::FETCH_NUM);
}

/**
 * Menu para Cadastro
 */
function mostrarRegistro($aValores) 
{
    echo ' 
            <div class="form-row">
                <div class="form-group col-sm-8 col-md-10 col-lg-8">
                    <label for="codigo"> Código </label>
                    <input type="text" name="codigo" value="' . $aValores[0] . '" class="form-control" id="codigo" disabled>
                </div>
            </div>
    
            <div class="form-row">
                <div class="form-group col-sm-8 col-md-10 col-lg-8">
                    <label for="descricao"> Descrição </label>
                    <input type="text" name="descricao" value="' . $aValores[1] . '" class="form-control" id="descricao" disabled>
                </div>
            </div>

            <a href="' . LOCALHOST .'?pg=regiao" class="btn btn-primary col-sm-8 col-md-10 col-lg-8 py-2 mt-1">
                Voltar
            </a>';
}
