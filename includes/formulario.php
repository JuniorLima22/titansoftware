<div class="titulo-pagina-2"><p>Adicionar Produto</p></div>

<div class="informacao-pagina">
    <div style="width: 30%; margin-left: auto; margin-right: auto;">
        <?php if(!empty($mensagem)): ?>
            <div class="alert <?php if(!empty($tipo)) echo $tipo ?>">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                    <?= $mensagem ?>
            </div>
        <?php endif; ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="text" name="nome" value="<?= (!empty($nome)) ? $nome : '' ?>" placeholder="Nome do produto" class="borda-preta">
            <?php if($validate->hasErro('nome', $validate->errorsFields)): ?>
                <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                    <?= $validate->errorMessage('nome', $validate->errorsFields) ?>
                </div>
            <?php endif; ?>
            <br>

            <select name="cor">
                <option value="">-- Selecione uma cor --</option>
                <option value="amarelo" <?php if (!empty($cor) && $cor == 'amarelo') echo 'selected' ?> >Amarelo</option>
                <option value="azul" <?= (!empty($cor) AND $cor == 'azul') ? 'selected' : '' ?>>Azul</option>
                <option value="vermelho" <?= (!empty($cor) AND $cor == 'vermelho') ? 'selected' : '' ?>>Vermelho</option>
            </select>
            <?php if($validate->hasErro('cor', $validate->errorsFields)): ?>
                <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                    <?= $validate->errorMessage('cor', $validate->errorsFields) ?>
                </div>
            <?php endif; ?>
            <br>

            <input type="number" name="preco" min="0" max="999999" step="0.01" value="<?= (!empty($preco)) ? $preco : '' ?>" placeholder="Preço do produto" class="borda-preta">
            <?php if($validate->hasErro('preco', $validate->errorsFields)): ?>
                <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                    <?= $validate->errorMessage('preco', $validate->errorsFields) ?>
                </div>
                <?php endif; ?>
            <br>
            
            <button type="submit" class="borda-preta">Cadastrar</button>
        </form>
    </div>
</div>