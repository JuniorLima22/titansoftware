<div class="titulo-pagina-2"><p>Listagems de Produtos</p></div>

<div class="informacao-pagina">
    <div style="width: 90%; margin-left: auto; margin-right: auto;">
        <?php if(!empty($mensagem)): ?>
            <div class="alert <?php if(!empty($tipo)) echo $tipo ?>">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                    <?= $mensagem ?>
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
                            <td><?= $produto->preco ?></td>
                            <td>Desconto</td>
                            <td><button onclick="location.href='editar.php?id=<?=$produto->id_prod?>'" class="info  borda-branca">Editar</button></td>
                            <form action="deletar.php?id=<?=$produto->id_prod?>" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este produto?')">
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