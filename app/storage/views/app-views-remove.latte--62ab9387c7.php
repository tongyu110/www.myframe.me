<?php
// source: E:\xampp-7\htdocs\Web\app/views/remove.latte

use Latte\Runtime as LR;

class Template62ab9387c7 extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
?>
<div>
    <p><?php echo LR\Filters::escapeHtmlText($sitename) /* line 2 */ ?></p>
    <hr>
    <p>♥</p>
    <hr>
    <p>Nette Framework</p>
    <hr>
</div><?php
		return get_defined_vars();
	}

}
