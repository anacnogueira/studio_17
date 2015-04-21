<div class="clientes index">
<h2><?php __('Clientes');?></h2>
<div class="filtro">
  <?php echo $this->Form->create(array('inputDefaults' => array(
                                                        'label' => false,
                                                        'div' => false))); ?>
  <table class="none">
    <tr>
      <td>Nome:</td>
      <td><?php echo $this->Form->input('nome'); ?></td>

    </tr>
    <tr>
      <td>Status:</td>
      <td><?php echo $this->Form->input('ativo',array('type'=>'select','options'=>$status)); ?></td>
      <td>Exibir:</td>
      <td>
        <?php echo $this->Form->input('qtde',array('type'=>'select','options'=>$qtde,'default'=>1)); ?>
        <?php echo $this->Form->submit('Pesquisar',array('div'=>false)); ?>
      </td>
    </tr>
  </table>
  </form>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Novo Cliente', true), array('action' => 'admin_add')); ?></li>
	</ul>
</div>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $this->Paginator->sort('ID','id');?></th>
	<th><?php echo $this->Paginator->sort('NOME','nome');?></th>
	<th><?php echo $this->Paginator->sort('E-MAIL','email');?></th>
  <th><?php echo $this->Paginator->sort('TELEFONE','telefone');?></th>
  <th>STATUS</th>
	<th class="actions"><?php __('Ações');?></th>
</tr>
<?php foreach ($clientes as $cliente): ?>
	<tr>
		<td><?php echo $cliente['Cliente']['id']; ?></td>
		<td><?php echo $cliente['Cliente']['nome']; ?></td>
		<td><?php echo $cliente['Cliente']['email']; ?></td>
    <td><?php echo $cliente['Cliente']['telefone']; ?></td>
		<td><?php echo $this->Status->showCurrentStatus('clientes','ativo',$cliente['Cliente']['ativo'],$cliente['Cliente']['id']); ?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('Editar', true), array('action' => 'admin_edit', $cliente['Cliente']['id'])); ?>
			<?php echo $this->Html->link(__('Excluir', true), array('action' => 'admin_delete', $cliente['Cliente']['id']), null, sprintf(__('Tem certeza que deseja excluir o registro # %s?', true), $cliente['Cliente']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $this->Paginator->prev('<< '.__('Anterior', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $this->Paginator->numbers();?>
	<?php echo $this->Paginator->next(__('Próximo', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>