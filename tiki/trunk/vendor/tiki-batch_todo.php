<?php
// (c) Copyright 2002-2010 by authors of the Tiki Wiki/CMS/Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: tiki-batch_todo.php 28986 2010-09-06 21:45:34Z pkdille $

include('tiki-setup.php');
include_once('lib/todolib.php');

$todos = $todolib->listTodoObject();
foreach ($todos as $todo) {
	$todolib->applyTodo($todo);
}

