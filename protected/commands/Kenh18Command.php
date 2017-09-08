<?php
class Kenh18Command extends CConsoleCommand
{
    public function run($args)
    {
		Member::genHtmlKenh18();
		echo "Done!";
    }
}
?>