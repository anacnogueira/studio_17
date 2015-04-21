<?php
  $script = $javascript->link(array('jquery.mousewheel','jquery.fancybox','config.fancybox'))."\n";
  $script .= $this->Html->css(array('jquery.fancybox'));
  echo $this->addScript('scripts_for_layout',$script);
?>
<div class="portfolio_videos index">
<h2><?php __('Fotógrafos');?></h2>
<div class="filtro">
  <?php echo $this->Form->create(array('inputDefaults' => array(
                                                        'label' => false,
                                                        'div' => false))); ?>
  <table class="none">
    <tr>
      <td>Descrição:</td>
      <td><?php echo $this->Form->input('descricao',array('type'=>'text')); ?></td>
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
		<li><?php echo $this->Html->link(__('Novo Vídeo', true), array('action' => 'admin_add')); ?></li>
	</ul>
</div>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $this->Paginator->sort('ID','id');?></th>
	<th><?php echo $this->Paginator->sort('DESCRIÇÃO','descricao');?></th>
  <th><?php echo $this->Paginator->sort('LINK YOUTUBE','link_youtube');?></th>
	<th class="actions"><?php __('Ações');?></th>
</tr>
<?php
$i = 0;
foreach ($videos as $video):

?>
	<tr>
		<td><?php echo $video['PortfolioVideo']['id']; ?></td>
		<td><?php echo $video['PortfolioVideo']['descricao']; ?></td>
    <td><?php echo $video['PortfolioVideo']['link_youtube']; ?></td>
   <td class="actions">
			<?php echo $this->Html->link(__('Visualizar', true), $video['PortfolioVideo']['link_youtube'],array("class"=>"youtube iframe.fancybox")); ?>
			<?php echo $this->Html->link(__('Editar', true), array('action' => 'admin_edit', $video['PortfolioVideo']['id'])); ?>
			<?php echo $this->Html->link(__('Excluir', true), array('action' => 'admin_delete', $video['PortfolioVideo']['id']), null, sprintf(__('Tem certeza que deseja excluir o registro # %s?', true), $video['PortfolioVideo']['id'])); ?>
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