<?php
class MemberCommand extends CConsoleCommand
{
    public function run($args)
    {
		Member::genHtmlBoxKenh18();
		Member::genHtmlBoxNews();
		Member::genHtmlBoxAlbum();
		
		echo "Done!";
	}
}
?>