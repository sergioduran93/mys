<div class="users view">
<h2>User</h2>
	
			<?php echo $user['User']['id']; ?>
			<br>
			<?php echo $user['User']['name']; ?>
		<br>
			<?php echo $user['User']['username']; ?>
	<br>
			<?php echo $user['User']['password']; ?>
			<br>
			<?php echo Security::hash($user['User']['password']); ?>
<br>
			<?php echo $user['User']['email']; ?>
	
	
</div>
<div class="actions">
	<h3>Actions</h3>
	<ul>
	    <?php if ($current_user['id'] == $user['User']['id'] || $current_user['role'] == 'admin'): ?>
		    <li><?php echo $this->Html->link('Edit User', array('action' => 'edit', $user['User']['id'])); ?> </li>
		    <li><?php echo $this->Form->postLink('Delete User', array('action' => 'delete', $user['User']['id']), array('confirm'=>'Are you sure you want to delete that user?')); ?> </li>
		<?php endif; ?>
		<li><?php echo $this->Html->link('List Users', array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link('New User', array('action' => 'add')); ?> </li>
	</ul>
</div>
