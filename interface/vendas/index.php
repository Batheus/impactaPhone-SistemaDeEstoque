<?php
require_once '../../App/auth.php';
require_once '../../layout/script.php';
require_once '../../App/Models/vendas.class.php';
require_once '../../App/Models/cliente.class.php';

echo $head;
echo $header;
echo $aside;

echo '<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Itens cadastrados
      </h1>
      <ol class="breadcrumb">
        <li><a href="../"><i class="fa fa-laptop"></i> Home</a></li>
        <li class="active">Itens</li>
      </ol>
    </section>

    <section class="content">';
    require '../../layout/alert.php';
    echo '
      <div class="row">
      	<div class="box box-primary">
            <div class="box-body">';
            if(!empty($_SESSION['msg'])){
              echo ' <div class="col-xs-12 col-md-12 text-success">'. $_SESSION['msg'].'</div>';
              unset($_SESSION['msg']);
          }
?>

<?php  
          if(isset($_POST['CPF'])){ 
            $cliente = new Cliente;
            $resps = $cliente->searchdata($_POST["CPF"]);  
              if($resps > 0 && $_POST['CPF'] != NULL){
                foreach ($resps['data'] as $resp) {
                 $_SESSION['CPF'] = $resp['cpfCliente'];
                 $_SESSION['Cliente'] = $resp['NomeCliente'];
                 $_SESSION['Email'] = $resp['EmailCliente'];
                 $_SESSION['cart'] = MD5('@?#'.$resp['cpfCliente'].'@'.date("d-m-Y H:i:s"));
                }
              }
            unset($_POST['CPF']);
          }
?>

<div class="row">
    <form id="form1" action="index.php" method="post">
      <div class="box-body">
      <div class="col-lg-6">
        <div class="input-group">
          <input type="text" class="form-control" id="cpfCliente" name="CPF" placeholder="Pesquisar CPF" autocomplete="off">
          <span class="input-group-btn">
            <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-floppy-save"></span></button>
          </span>
        </div>
        <div id="Listdata"></div>
      </div>
    </div>
    </form> 
</div>

            <form id="form2" action="../../App/Database/insertVendas.php" method="POST">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nome Cliente</label>
                  <input type="text" name="nomeCliente" class="form-control" id="exampleInputnome1" placeholder="Nome Cliente" value="<?php if(isset($_SESSION['Cliente'])){ echo $_SESSION['Cliente']; } ?>"/>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">E-mail</label>
                  <input type="text" name="emailCliente" class="form-control" id="exampleInputEmail1" placeholder="E-mail" value="<?php if(isset($_SESSION['Email'])){ echo $_SESSION['Email']; } ?>" />
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">CPF</label>
                  <input type="number" name="cpfcliente" class="form-control" id="exampleInputcpf1" placeholder="CPF" value="<?php if(isset($_SESSION['CPF'])){ echo $_SESSION['CPF']; } ?>" />
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">IMEI:</label>
                  <input type="text" name="IMEI" class="form-control" id="exampleInputEmail1" placeholder="IMEI">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Situação:</label>
                  <input type="text" name="situacao" class="form-control" id="exampleInputEmail1" placeholder="Situação">
                </div>

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Lista de Produtos</h3>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="form-group col-xs-12 col-sm-4">
          <input type="number" id="idItem" name="idItem" class="form-control" placeholder="Item">
        </div>
        <div class="form-group col-xs-12 col-sm-4">
          <input type="number" id="qtd" name="qtde" class="form-control" placeholder="Quantidade">
        </div>
        <div class="form-group col-xs-12 col-sm-4">
          <button type="button" id="prodSubmit" name="prodSubmit" onclick="prodSubmit();" value="carrinho" class="btn btn-primary col-xs-12">Registrar</button>
        </div>
      </div>
        <table class="table table-bordered" id="products-table">
          <tr>
            <th style="width: 10px">#</th>
            <th>ID Item</th>
            <th>Quantidade</th>
            <th style="width:40px" title="Remover">Deletar</th>
          </tr>
          <tbody id="listable">
            
<?php
	$pkCount = (isset($_SESSION['itens']) ? count($_SESSION['itens']) : 0);
	if ($pkCount == 0) {
		echo '<tr>
              		<td colspan="5">
              		<b>Carrinho Vazio</b>
              		</td>
              	</tr>';
        }else{
              $vendas = new Vendas;
              $cont = 1;
              foreach ($_SESSION['itens'] as $produtos => $quantidade) {
                echo '<tr>
                <td>'. $cont .'</td>
                <td>'. $produtos .'</td>                
                <td>'. $quantidade .'</td>
                <td>
                <input type="hidden" id="idItem" name="idItem['.$produtos.']" value="'.$produtos.'" /> 
                <input type="hidden" id="qtd" name="qtd['.$produtos.']" value="'.$quantidade.'" />
                <a title="Remover item código '. $produtos .'." href="../../App/Database/remover.php?remover=carrinho&id='.$produtos.'"><i class="fa fa-trash text-danger"></i></a>
                </td>
                </tr>';
                $cont = $cont + 1;
              }
            } 
            ?>
          </tbody>                  
        </table>
    </div>
  </div>
                <input type="hidden" name="iduser" value="'.$idUsuario.'">

                <div class="box-footer">
                  <button type="submit" name="comprar" class="btn btn-primary" value="Cadastrar">Comprar</button>
                  <a class="btn btn-danger" href="../../interface/vendas/">Cancelar</a>
                </div>
              </form>

<?php
echo'</div>';
echo '</div>';
echo '</section>';
echo '</div>';
unset($_SESSION['notavd']);
echo  $footer;
echo $javascript;
?>

