<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de produtos</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav class="bg-blue-400">
        <ul>
            <li class="inline">
                <a href="../../index.html">Home</a>
            </li>
            <li class="inline">
                <a href="form_add_product.php">Novo produto</a>
            </li>
            <li class="inline">
                <a href="form_add_provider.php">Novo fornecedor</a>
            </li>
            <li class="inline">
                <a href="../Controller/Product.php?operation=list">Listar produtos</a>
            </li>
        </ul>
    </nav>
    <h1 class="my-4 text-3xl font-bold text-center text-blue-800">Lista de produtos cadastrados</h1>
    <table class="m-auto">
        <thead class="text-white bg-blue-400">
            <th>#</th>
            <th>Nome do produto</th>
            <th>Preço do produto</th>
            <th>Quantidade em estoque</th>
            <th>Ações</th>
        </thead>
        <tbody>
            <?php
            session_start();
            foreach ($_SESSION['list_of_products'] as $product) :
            ?>
                <tr>
                    <td>
                        <?= $product['product_code'] ?>
                    </td>
                    <td>
                        <?= $product['product_name'] ?>
                    </td>
                    <td>
                        R$ <?= str_replace(".", ",", $product['product_price']) ?>
                    </td>
                    <td>
                        <?= $product['product_quantity'] ?>
                    </td>
                    <td>
                        <a href="../Controller/Product.php?operation=find&code=<?= $product["product_code"] ?>">Editar</a>
                        <a href="../Controller/Product.php?operation=remove&code=<?= $product["product_code"] ?>">Remover</a>
                    </td>
                </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>
</body>

</html>