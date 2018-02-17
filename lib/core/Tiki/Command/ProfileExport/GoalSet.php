<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: GoalSet.php 62177 2017-04-10 06:06:43Z drsassafras $

namespace Tiki\Command\ProfileExport;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GoalSet extends ObjectWriter
{
	protected function configure()
	{
		$this
			->setName('profile:export:goal-set')
			->setDescription('Export all goals into a set')
			;

		parent::configure();
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$writer = $this->getProfileWriter($input);

		if (\Tiki_Profile_InstallHandler_GoalSet::export($writer)) {
			$writer->save();
		}
	}
}
