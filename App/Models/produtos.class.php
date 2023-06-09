<?php
   require_once 'connect.php';
   class Produtos extends Connect{
   	public function index($value){
   		$this->query = "SELECT * FROM `produtos` WHERE `PublicProduto` = '$value'";
   		$this->result = mysqli_query($this->SQL, $this->query) or die ( mysqli_error($this->SQL));
   		if($this->result){
   			while ($row = mysqli_fetch_array($this->result)) {
            echo '<li>
          <span class="handle">
            <i class="fa fa-ellipsis-v"></i>
            <i class="fa fa-ellipsis-v"></i>
          </span>
          <form class="label" name="ativ'.$row['CodRefProduto'].'" action="../../App/Database/action.php" method="post">
                    <input type="hidden" name="id" id="id" value="'.$row['CodRefProduto'].'">
                    <input type="hidden" name="status" id="status" value="'.$row['Ativo'].'">
                    <input type="hidden" name="tabela" id="tabela" value="produtos"></form>';
                    echo '
          <span class="text"><span class="badge left">'.$row['NomeProduto'].'</span> '.$row['skuProduto'].'</span>
          <div class="tools right">
                      <a href="" data-toggle="modal" data-target="#myModalup'.$row['CodRefProduto'].'"><i class="fa fa-edit"></i></a>
                    <a href="" data-toggle="modal" data-target="#myModal'.$row['CodRefProduto'].'">';
                    if($row['PublicProduto'] == 0){echo '<i class="glyphicon glyphicon-trash" aria-hidden="true"></i>';}else{ echo '<i class="glyphicon glyphicon-trash" aria-hidden="true"></i>';}
                    echo '</a> </div>
  <div class="modal fade" id="myModal'.$row['CodRefProduto'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <form id="delprod'.$row['CodRefProduto'].'" name="delprod'.$row['CodRefProduto'].'" action="../../App/Database/delprod.php" method="post" style="color:#000;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Você tem certeza que deseja deletar este item?</h4>
          </div>
          <div class="modal-body">
            Nome: '.$row['NomeProduto'].'
          </div>
          <div class="modal-body">
            SKU: '.$row['skuProduto'].'
          </div>
          <input type="hidden" id="id" name="id" value="'.$row['CodRefProduto'].'">
          <div class="modal-footer">
            <button type="submit" value="Cancelar" class="btn btn-default">Não</button>
            <button type="submit" name="update" value="Cadastrar" class="btn btn-primary">Sim</button>
          </div>
        </div>
      </div>
      </form>
    </div>

  <div class="modal fade" id="myModalup'.$row['CodRefProduto'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <form id="Upprod'.$row['CodRefProduto'].'" name="Upprod'.$row['CodRefProduto'].'" action="../../App/Database/insertprod.php" method="post" style="color:#000;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Você tem certeza que deseja alterar o status deste item na sua lista?</h4>
          </div>
          
          <div class="modal-body">
            Nome Atual:
            <input type="text" id="nomeProduto" name="nomeProduto" value="'.$row['NomeProduto'].'">
          </div>
          <div class="modal-body">
            SKU Atual:
            <input type="text" id="skuProduto" name="skuProduto" value="'.$row['skuProduto'].'">
          </div>
          <input type="hidden" id="id" name="id" value="'.$row['CodRefProduto'].'">
          
          <div class="modal-footer">
            <button type="submit" value="Cancelar" class="btn btn-default">Não</button>
            <button type="submit" name="update" value="Cadastrar" class="btn btn-primary">Sim</button>
          </div>
        </div>
      </div>
      </form>
    </div>
        </li>';
      }
    }
  }

  public function listProdutos(){
   $this->query = "SELECT *FROM `produtos` WHERE `Ativo` = 1 AND `PublicProduto` = 1";
   $this->result = mysqli_query($this->SQL, $this->query) or die ( mysqli_error($this->SQL));
   if($this->result){
    while ($row = mysqli_fetch_array($this->result)) {
      if($value == $row['CodRefProduto']){ 
        $selected = "selected";
      }
      else{
        $selected = "";
      }
      echo '<option value="'.$row['CodRefProduto'].'" '.$selected.' >'.$row['skuProduto'].'</option>';
    }
  }
  }

  public function InsertProd($skuProduto, $nomeProduto, $idUsuario){
   $this->query = "INSERT INTO `produtos`(`CodRefProduto`, `skuProduto`, `NomeProduto`,`Ativo` ,`PublicProduto` , `Usuario_idUser`) VALUES (NULL,'$skuProduto', '$nomeProduto', 1 , 1 ,'$idUsuario')";
   if($this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL))){
    header('Location: ../../interface/prod/index.php?alert=1');
  }
  else{
    header('Location: ../../interface/prod/index.php?alert=0');
  }
  }

  public function UpdateProd($id, $skuProduto, $nomeProduto, $idUsuario){
      if(mysqli_query($this->SQL, "UPDATE `produtos` SET `skuProduto` = '$skuProduto', `NomeProduto` = '$nomeProduto', `Usuario_idUser` = '$idUsuario' WHERE `CodRefProduto` = '$id'") or die(mysqli_error($this->SQL))){
                header('Location: ../../interface/prod/index.php?alert=1');
      }
      else{
                header('Location: ../../interface/prod/index.php?alert=0');
              }
}

  public function DelProdutos($value){
        $this->query = "DELETE FROM `produtos` WHERE `CodRefProduto` = '$value'";
        if($this->query = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL))){
          header('Location: ../../interface/prod/index.php?alert=5'); 
        }
        else{
            header('Location: ../../interface/prod/index.php?alert=0');
        }
    } 

  public function Ativo($value, $id)
  {
    if($value == 0){ $v = 1; }else{ $v = 0; }
    $this->query = "UPDATE `produtos` SET `Ativo` = '$v' WHERE `CodRefProduto` = '$id'";
    $this->result = mysqli_query($this->SQL, $this->query) or die(mysqli_error($this->SQL));
    header('Location: ../../interface/prod/');
    }
  }

  $produtos = new Produtos;