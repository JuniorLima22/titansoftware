<div class="titulo-pagina-2"><p>Listagems de Produtos</p></div>

<div class="informacao-pagina">
    <div style="width: 90%; margin-left: auto; margin-right: auto;">
        <?php if($session->has('message')): ?>
            <div class="alert <?php if($session->has('type')) echo $session->get('type') ?>">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                    <?= $session->get('message') ?>
            </div>
        <?php endif; ?>
        <table >
            <thead>
                <tr>
                    <td>#</td>
                    <td>Nome</td>
                    <td>Cor</td>
                    <td>Preço</td>
                    <td>Preço com desconto</td>
                    <td colspan="3">Ações</td>
                </tr>
            </thead>
            <tbody>
                <?php if(count($produtos) == 0): ?>
                    <tr>
                        <td colspan="8">Nenhum registro encontrado</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($produtos as $produto): ?>
                        <tr>
                            <td><?= $produto->id_prod ?></td>
                            <td><?= $produto->nome ?></td>
                            <td><?= ucfirst($produto->cor) ?></td>
                            <td><?= 'R$ '. number_format($produto->preco, 2, ',','.') ?></td>
                            <td>Desconto</td>
                            <td><button onclick="location.href='editar.php?id=<?=$produto->id_prod?>'" class="info  borda-branca">Editar</button></td>
                            <form action="excluir.php" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este produto?')">
                            <input type="hidden" name="id" value="<?=$produto->id_prod?>">
                            <input type="hidden" name="excluir" value="true">
                            <td>
                                <button class="texto-branco danger borda-branca">Excluir</button>
                            </td>
                            </form>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <div>
            <br>    
            Exibindo total  de produtos: <?= count($produtos); ?>
            <br>
        </div>
        
    </div>
</div>