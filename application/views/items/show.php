view template
<form action="/items/add" method="post">
	<input type="text" name="title">
	<input type="text" name="summary">
	<button type="submit">Submit</button>
</form>
<?php var_dump($this); ?>
<?php var_dump($this->_router->is('items.view')); ?>
