<?php



// Load the engine class.
require_once('engine.php');



// Instanciate a new object from the Engine class.
$tpl = new Engine('template.tpl');

$page = trim($_GET['page']);


$menu_category = array('home', 'about', 'contact', 'download');

$menu = '<ul id="menu">' . "\r\n\t\t";
foreach ($menu_category as $item) {

	if($item == $page)

		$menu .= '<li><a href="?page=' . $item . '" id="active">' . $item . '</a></li>' ;
	else
		$menu .= '<li><a href="?page=' . $item . '">' . $item . '</a></li>';

	$menu .= "\r\n\t\t";
}
$menu .= '</ul>';



switch($page) {
	case 'home' :
		$content = '<h1>PHP Template Engine</h1>
		{IMAGE_HEADER}
		<p>Quick demo of my template engine in PHP and OOP. This page you see right here is running the PHP Template Engine.</p>
		<p>Well, let\'s <a href="?page=about">get started &raquo;</a></p>';
		break;
	case 'about' :
		$content = '<h1>About</h1>
		{IMAGE_HEADER}
		<p><b>This template engine enables you to create your own HTML-templates and add placeholders/tags {...} for your content.</b></p>
		<h1>How it works</h1>
		<ol>
			<li>Load the class into your PHP-project. Ex:
				<br /><pre><code>require_once(\'engine.php\');</code></pre></li>
			<li>Instantiate an object of the class and pass in your template into the constructor.<br />
			Your template-file can be any file you like. In this example I\'m using a *.tpl file. Ex:<br />
				<pre><code>$engine = new Engine(\'template.tpl\');</code></pre></li>
			<li>To replace a tag, call the <b>Set()</b> method. Ex:<br />
				<pre><code>$engine->Set(\'PLACEHOLDER\', \'Any content here...\');</code></pre></li>
			<li>When done, output the results to the browser by calling the <b>Out()</b> method. Ex:<br />
				<pre><code>$engine->Out();</code></pre></li>
		</ol>
		<h1>Example</h1>
		<p>Let\'s say we have a template, <i>template.tpl</i>, with the following content:</p>
		<pre><code>' . htmlentities(file_get_contents('template.tpl')) . '</code></pre>
		<p>Then simply replace the placeholders between the brackets {...} with any data. It can be contents
		from  a database, file or hardcoded, it doesn\'t matter. Same rule applies when replacing the placeholders... like this:</p>
		<pre><code>&lt;?php

// Load the engine class
require_once(\'engine.php\');

// Instantiate an object from the class and pass in the template file.
$engine = new Engine(\'template.tpl\');

// Replace the placeholders.
$engine->Set(\'TITLE\', \'This is my title\');
$engine->Set(\'CSS\', \'<link rel="stylesheet" href="my_layout.css" />\');
$engine->Set(\'MENU\', \'Menu from a database or file etc...\');
$engine->Set(\'CONTENT\', \'HTML here from a database or file etc\');
$engine->Set(\'FOOTER\', \'Copyright bla bla\');

// Output.
$engine->Out();</code></pre>';
		break;
	case 'contact' :
		$content = '<h1>Contact</h1>
		{IMAGE_HEADER}
		<p>You find me right here: <a href="http://www.nswardh.com/">nswardh.com</a></p>';
		break;
	case 'download' :
		$content = '<h1>Download</h1>
		{IMAGE_HEADER}
		<p>The most recent version of my PHP Template Engine can be downloaded from <a href="https://github.com/nickswardh/">GitHub &raquo;</a></p>';
		break;
	default :
		header('Location: ?page=home');
		exit;
		break;
}



// Replace the placeholders with contents.
$tpl->Set('CSS',	'<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">' .
					'<link rel="stylesheet" href="layout.css" />' );

$tpl->Set('TITLE', 'Template Engine Demo');
$tpl->Set('HEADER', '<h1>' . $header . '</h1>');
$tpl->Set('MENU', $menu);
$tpl->Set('FOOTER', '<p>PHP Template Engine by Nick Swardh - <a href="http://nswardh.com/">nswardh.com</a></p>');
$tpl->Set('CONTENT', $content);

$tpl->Set('IMAGE_HEADER', '<div id="header"></div>');

// Output template to browser.
$tpl->Out();