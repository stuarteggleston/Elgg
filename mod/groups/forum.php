<?php
	/**
	 * Elgg groups forum
	 * 
	 * @package ElggGroups
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Curverider
	 * @copyright Curverider Ltd 2008-2010
	 * @link http://elgg.com/
	 */

	require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");
	
	set_page_owner((int)get_input('group_guid'));
	if (!(page_owner_entity() instanceof ElggGroup)) forward();
	
	group_gatekeeper();
	
	//get any forum topics
	//get any forum topics
	$topics = list_entities_from_annotations("object", "groupforumtopic", "group_topic_post", "", 20, 0, get_input('group_guid'), false, false, false);
	set_context('search');	
	
	//set up breadcrumbs
	$area1 = elgg_view('page_elements/breadcrumbs', array( 
		'breadcrumb_root_url' => '',
		'breadcrumb_root_text' => 'Parent Group Name',
		'breadcrumb_currentpage' => elgg_echo('item:object:groupforumtopic')
		));
	
	
	$area1 .= elgg_view("forum/topics", array('topics' => $topics));
	set_context('groups');
	
	$body = elgg_view_layout('one_column_with_sidebar', $area1);
	
	$title = elgg_echo('item:object:groupforumtopic');
	
	// Finally draw the page
	page_draw($title, $body);



?>