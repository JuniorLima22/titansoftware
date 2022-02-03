<div class="titulo-pagina-2"><p><?= TITLE?></p></div>

<div class="informacao-pagina">
    <div style="width: 30%; margin-left: auto; margin-right: auto;">
        <?php if(!empty($mensagem)): ?>
            <div class="alert <?php if(!empty($tipo)) echo $tipo ?>">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                    <?= $mensagem ?>
            </div>
        <?php endif; ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <?php if(isset($_REQUEST['id'])): ?>
                <input type="hidden" name="id" value="<?= $_REQUEST['id']?>">
                <input type="hidden" name="id_prod" value="<?= $obProduto->id_prod?>">
                <input type="hidden" name="id_preco" value="<?= $obProduto->id_preco?>">
            <?php endif; ?>
            
            <input type="text" name="nome" value="<?php if(!empty($nome)) echo $nome; elseif(!empty($obProduto->nome)) echo $obProduto->nome; ?>" placeholder="Nome do produto" class="borda-preta">
            <?php if($validate->hasErro('nome', $validate->errorsFields)): ?>
                <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                    <?= $validate->errorMessage('nome', $validate->errorsFields) ?>
                </div>
            <?php endif; ?>
            <br>

            <select name="cor" <?php if(TITLE == 'Editar Produto') echo 'disabled' ?>>
                <option value="">-- Selecione uma cor --</option>
                <option value="amarelo"  <?php if((!empty($obProduto->cor) && $obProduto->cor == 'amarelo') OR !empty($cor) && $cor == 'amarelo') echo 'selected' ?> >Amarelo</option>
                <option value="azul"     <?php if((!empty($obProduto->cor) && $obProduto->cor == 'azul') OR !empty($cor) && $cor == 'azul') echo 'selected' ?> >Azul</option>
                <option value="vermelho" <?php if((!empty($obProduto->cor) && $obProduto->cor == 'vermelho') OR !empty($cor) && $cor == 'vermelho') echo 'selected' ?>>Vermelho</option>
            </select>
            <?php if($validate->hasErro('cor', $validate->errorsFields)): ?>
                <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                    <?= $validate->errorMessage('cor', $validate->errorsFields) ?>
                </div>
            <?php endif; ?>
            <br>

            <input type="number" name="preco" min="0" max="999999" step="0.01" value="<?php if(!empty($preco)) echo $preco; elseif(!empty($obProduto->preco)) echo $obProduto->preco;  ?>" placeholder="Preço do produto" class="borda-preta">
            <?php if($validate->hasErro('preco', $validate->errorsFields)): ?>
                <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                    <?= $validate->errorMessage('preco', $validate->errorsFields) ?>
                </div>
                <?php endif; ?>
            <br>
            
            <button type="submit" class="borda-preta"><?= (TITLE == 'Editar Produto') ? 'Atualizar' : 'Cadastrar' ?></button>
        </form>
    </div>
</div>